<?php

namespace App\Http\Livewire\Admin\Books;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Deletefiles extends Component
{
    use LivewireAlert;
    
    public $book;
    public function mount($book)
    {
        $this->book = $book;
        
    }

    public function render()
    {
        return view('livewire.admin.books.deletefiles');
    }

    public function destroy($id)
    {
        if ($id) {
            $book = Book::find($id);
            $book->full_text_path=null;
            $book->file_format=null;
            $book->file_format_type=null;
            $book->file_size=null;
            $book->save();
            $this->alert('success',  __('Successfully saved'));
            return redirect()->to(app()->getLocale().'/admin/books/'.$book->id.'/edit'); 


        }
    }
    public function destroyFromServer($id)
    {
        if ($id) {
            $book = Book::find($id);
                
            if(Storage::disk('public')->exists( $book->full_text_path)) {
                Storage::disk('public')->delete($book->full_text_path);

                $book->full_text_path=null;
                $book->file_format=null;
                $book->file_format_type=null;
                $book->file_size=null;
                $book->save();
                $this->alert('success',  __('Deleted successfully.'));
            } else {
                $this->alert('danger',  __('File not Found.'));                
            }
            return redirect()->to(app()->getLocale().'/admin/books/'.$book->id.'/edit'); 

            
        }
    }
}
