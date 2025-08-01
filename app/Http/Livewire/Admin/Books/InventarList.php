<?php

namespace App\Http\Livewire\Admin\Books;

use App\Models\Book;
use Livewire\Component;
use Livewire\WithPagination;

class InventarList extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = "", $perPage=20, $rfid_tag;

    public function mount($rfid_tag){
        $this->rfid_tag = $rfid_tag;
    }

    public function render()
    {
        $q = Book::query();

        if ($this->search != '') {
            $keyword = trim($this->search);

            $q->where(function ($query) use ($keyword) {
                $query->where('dc_authors', 'LIKE', "%$keyword%")
                    ->orWhere('dc_title', 'LIKE', "%$keyword%")
                    ->orWhere('location_index', 'LIKE', "%$keyword%")
                    ->orWhere('dc_UDK', 'LIKE', "%$keyword%")
                    ->orWhere('dc_BBK', 'LIKE', "%$keyword%")
                    ->orWhere('ISBN', 'LIKE', "%$keyword%")
                    ->orWhere('extra1', 'LIKE', "%$keyword%")
                    ->orWhere('dc_description', 'LIKE', "%$keyword%")
                    ->orWhere('published_year', 'LIKE', "%$keyword%")
                    ->orWhereHas('extraAuthorBooks', function ($subQuery) use ($keyword) {
                        $subQuery->where('name', 'LIKE', "%$keyword%");
                    });
            });
        }

        $books = $q->with(['booksType', 'booksType.translations', 'bookLanguage', 'bookInventar', 'bookLanguage.translations', 'bookFileType', 'bookFileType.translations'])->orderBy('id', 'desc')->paginate($this->perPage);


        $data = [
            'books' => $books,
        ];

        return view('livewire.admin.books.inventar-list', $data);
    }
}
