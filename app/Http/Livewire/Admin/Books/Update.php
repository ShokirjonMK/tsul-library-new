<?php

namespace App\Http\Livewire\Admin\Books;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookAccessType;
use App\Models\BookFileType;
use App\Models\BookLanguage;
use App\Models\BooksType;
use App\Models\BookSubject;
use App\Models\BookText;
use App\Models\BookTextType;
use App\Models\Subject;
use App\Models\Where;
use App\Models\Who;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use File;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Update extends Component
{
    public $book_id;
    use WithFileUploads;
    use LivewireAlert;

    public $branches, $book, $bookSubjects, $bookFileTypes, $bookAccessTypes, $bookTextTypes, $bookTexts, $bookLanguages, $bookTypes, $bookAuthors, $new_subjects, $wheres, $whos;
    public $departments;
    public $book_face_image, $book_full_text, $book_face_old_image, $old_full_text_path;
    public $dc_title, $authors_mark, $dc_published_city, $dc_publisher, $dc_UDK, $ISBN, $uk, $dc_description, $dc_source, $dc_date, $betlar_soni = 0, $price = 0, $status, $books_type, $book_language, $book_text, $book_text_type, $book_access_type, $book_file_type;
    public $selectedBranches = NULL, $new_subject, $where_id, $who_id;
    public $dc_authors = [], $subjects = [];
 
    public function mount($book_id)
    {
        $this->book_id = $book_id;
        $book = Book::find($this->book_id);
         
        $this->book = $book;
        $this->status = $book->status;
        $this->dc_title = $book->dc_title;
        $this->authors_mark = $book->authors_mark;
        $this->subjects = json_decode($book->dc_subjects);
        // dd(json_decode($book->dc_authors));
        $this->dc_authors = json_decode($book->dc_authors);
        $this->dc_UDK = $book->dc_UDK;
        $this->dc_publisher = $book->dc_publisher;
        $this->dc_published_city = $book->dc_published_city;
        $this->ISBN = $book->ISBN;
        $this->uk = $book->uk;
        $this->dc_description = $book->dc_description;
        $this->dc_source = $book->dc_source;
        $this->dc_date = $book->dc_date;
        $this->betlar_soni = $book->betlar_soni;
        $this->price = $book->price;
        $this->books_type = $book->books_type_id;
        $this->book_language = $book->book_language_id;
        $this->book_text = $book->book_text_id;
        $this->book_text_type = $book->book_text_type_id;
        $this->book_access_type = $book->book_access_type_id;
        $this->book_file_type = $book->book_file_type_id;
        $this->new_subject = $book->subject_id;
        $this->where_id = $book->where_id;
        $this->who_id = $book->who_id;
        $this->book_face_old_image = $book->image_path;
        $this->old_full_text_path = $book->full_text_path;
 
    }

    public function render()
    {
        
        $this->bookSubjects = BookSubject::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');

        $this->bookAuthors = Author::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $this->bookTypes = BooksType::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $this->bookLanguages = BookLanguage::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $this->bookTexts = BookText::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $this->bookTextTypes = BookTextType::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $this->bookAccessTypes = BookAccessType::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $this->bookFileTypes = BookFileType::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $this->new_subjects = Subject::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $this->wheres = Where::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $this->whos = Who::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');

        return view('livewire.admin.books.update');
    }


    public function update()
    {
        $this->validate(
            [
                'dc_title' => 'required|min:3',
                'dc_authors' => 'required',
                'dc_date' => 'required',
                'betlar_soni' => 'required',
                'books_type' =>'required',
            ],
            [
                'dc_title.required' =>  __('The :attribute field is required.'),
                'dc_authors.required' =>  __('The :attribute field is required.'),
                'dc_date.required' =>  __('The :attribute field is required.'),
                'betlar_soni.required' =>  __('The :attribute field is required.'),
                'books_type.required' =>  __('The :attribute field is required.'),

            ],
            [
                'dc_title' => __('Dc Title'),
                'dc_authors' => __('Dc Authors'),
                'dc_date' => __('Dc Date'),
                'betlar_soni' => __('Betlar Soni'),
                'books_type' => __('Books Type'),

            ]
        );
        $image_path=null;
        if($this->book_face_image!=null){
            $image_path = $this->book_face_image->store('books/face/images', 'public');
            $path = public_path('storage/'.$this->book_face_old_image);
            $isExists = file_exists($path);
            if($isExists && is_file($path)){
                unlink($path);
            }
        }else{
            $image_path=$this->book_face_old_image;
        }
        

        if($this->subjects != null && count($this->subjects)>0){
            foreach($this->subjects as $k=>$v){
                $book_subjects=BookSubject::whereTranslation("title", $v)->first();
                if($book_subjects==null){
                    $data=null;
                    $count=0;
                    foreach (config('app.locales') as $til_code => $locale) {
                        $data[$til_code] = [
                            'title' => $v
                        ];
                        $count+=1;
                    }
                    BookSubject::create($data);
                }
                
            }
        }
        if($this->dc_authors != null &&  count($this->dc_authors)>0){
            foreach($this->dc_authors as $k=>$v){
                $author=Author::whereTranslation("title", $v)->first();
                if($author==null){
                    $authorData=null;
                    $count=0;
                    foreach (config('app.locales') as $til_code => $locale) {
                        $authorData[$til_code] = [
                            'title' => $v
                        ];
                        $count+=1;
                    }
                    Author::create($authorData);
                }
            }
        }

        $new_subject_id=null;
        if ($this->new_subject != null) {
             
            $old_subject = Subject::find($this->new_subject);
            if ($old_subject == null) {
                $subjectData = null;
                $count = 0;
                foreach (config('app.locales') as $til_code => $locale) {
                    $subjectData[$til_code] = [
                        'title' => $this->new_subject
                    ];
                    $count += 1;
                }
               
                $old_subjcts = Subject::create($subjectData);
                $new_subject_id=$old_subjcts->id;
            }else{
                $new_subject_id= $old_subject->id;
            }
            $old_subject=null;     
        }
        $full_text_path=null;
        $file_format=null;
        $file_format_type=null; 
        $file_size=null;
        if($this->book_full_text!=null){
            $full_text_path = $this->book_full_text->store('books/fulltext', 'public');
            $file_format=$this->book_full_text->getClientOriginalExtension();
            $file_format_type=$this->book_full_text->getMimeType();
            $file_size=$this->book_full_text->getSize();
            if($this->old_full_text_path){
                $path = public_path('storage/'.$this->old_full_text_path);
                $isExists = file_exists($path);
                if($isExists && is_file($path)){
                    unlink($path);
                }
    
            }

        }else{
            $full_text_path = $this->old_full_text_path;
            $file_format=$this->book->file_format;
            $file_format_type=$this->book->file_format_type;
            $file_size=$this->book->file_size;
        }
       
        $input = [
            'dc_title' => trim($this->dc_title),
            'authors_mark' => trim($this->authors_mark),
            'dc_subjects' => json_encode($this->subjects),
            'dc_creators' => json_encode($this->dc_authors),
            'dc_authors' => json_encode($this->dc_authors),
            'dc_UDK' => trim($this->dc_UDK),
            'dc_source' => trim($this->dc_source),
            'dc_publisher' => trim($this->dc_publisher),
            'dc_published_city' => trim($this->dc_published_city),
            'ISBN' => trim($this->ISBN),
            'uk' => trim($this->uk),
            'dc_description' => trim($this->dc_description),
            'dc_date' => trim($this->dc_date),
            'betlar_soni' => trim($this->betlar_soni),
            'price' => trim($this->price),
            'status' => $this->status,
            'published_year' => trim($this->dc_date),
            'image_path' => $image_path,
            'books_type_id' => $this->books_type,
            'book_language_id' => $this->book_language,
            'book_text_id' => $this->book_text,
            'book_text_type_id' => $this->book_text_type,
            'book_access_type_id' => $this->book_access_type,
            'book_file_type_id' => $this->book_file_type,
            'where_id' => $this->where_id,
            'who_id' => $this->who_id,
            'subject_id' => $new_subject_id,
            'full_text_path' => $full_text_path,
            'file_format' => $file_format,
            'file_format_type' => $file_format_type,
            'file_size' => $file_size,
        ];
        // dd($input);
        $book = Book::find($this->book->id);
        $book->update($input);
        $this->alert('success',  __('Successfully saved'));

        return redirect()->to( app()->getLocale().'/admin/books/'.$book->id);        
    }

}
