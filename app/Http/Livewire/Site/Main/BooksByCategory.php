<?php

namespace App\Http\Livewire\Site\Main;

use App\Models\Book;
use App\Models\BooksType;
use Livewire\Component;

class BooksByCategory extends Component
{
    public $bookTypes, $book_type_id, $books;

    public function mount(){
        $this->books = Book::active()->with(['booksType', 'booksType.translations'])->latest()->limit(12)->get();

    }
    public function render()
    {
        $this->bookTypes = BooksType::active()->with('translations')->translatedIn(app()->getLocale())->limit(6)->get();
        // $this->books = Book::active()->latest()->limit(12)->get();

        return view('livewire.site.main.books-by-category');
    }


    public function getBooks($book_type_id)
    {
        $this->book_type_id=(int)$book_type_id;

        $this->books = Book::with('booksType', 'booksType.translations')->where('books_type_id', '=', $book_type_id)->active()->latest()->limit(12)->get();



    }



}
