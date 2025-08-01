<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookAccessType;
use App\Models\BookFileType;
use App\Models\BookInformation;
use App\Models\BookLanguage;
use App\Models\BooksType;
use App\Models\BookSubject;
use App\Models\BookText;
use App\Models\BookTextType;
use App\Models\Debtor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReaderController extends Controller
{

   
   /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('auth'); 
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id=Auth::user()->id;

        $perPage = 20;
        $debtors = Debtor::where('reader_id', '=', $user_id)->where('status', '=', Debtor::$GIVEN)->orderBy('return_time', 'ASC')->paginate($perPage);
        // $debtors = Debtor::whereNull('qaytargan_vaqti')->groupBy('kitobxon_id')->orderBy('qaytarish_vaqti', 'asc')->paginate();
        
        // dd($debtors);groupBy('reader_id')->
        return view('reader.index', compact('debtors'))
            ->with('i', (request()->input('page', 1) - 1) * $debtors->perPage());
    }
     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user()
    {
        return view('reader.user');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function book($language, Request $request)
    {
        $show_accardion=false;
        $q = Book::query();

        $book_bookType_id=trim($request->get('book_type_id'));
        $book_bookLanguage_id=trim($request->get('book_language_id'));
        $book_bookText_id=trim($request->get('book_text_id'));
        $book_bookTextType_id=trim($request->get('book_text_type_id'));
        $book_access_type_id=trim($request->get('book_access_type_id'));
        $book_file_type_id=trim($request->get('book_file_type_id'));
        $book_subject_id=trim($request->get('book_subject_id'));
        $book_author_id=trim($request->get('book_author_id'));
        $status=trim($request->get('status'));
        $keyword=trim($request->get('keyword'));
         
        $perPage = 20;
        $sqlBuild='';
        if ($book_bookType_id != null && $book_bookType_id>0)
        {
            $show_accardion=true;
            $q->where('books_type_id', '=', $book_bookType_id);
        }
        if ($book_bookLanguage_id != null && $book_bookLanguage_id>0)
        {
            $show_accardion=true;
            $q->where('book_language_id', '=', $book_bookLanguage_id);
        }
        if ($book_bookText_id != null && $book_bookText_id>0)
        {
            $show_accardion=true;
            $q->where('book_text_id', '=', $book_bookText_id);
        }
        if ($book_bookTextType_id != null && $book_bookTextType_id>0)
        {
            $show_accardion=true;
            $q->where('book_text_type_id', '=', $book_bookTextType_id);
        }
        if ($book_access_type_id != null && $book_access_type_id>0)
        {
            $show_accardion=true;
            $q->where('book_access_type_id', '=', $book_access_type_id);
        }
        if ($book_file_type_id != null && $book_file_type_id>0)
        {
            $show_accardion=true;
            $q->where('book_file_type_id', '=', $book_file_type_id);
        }
        if ($book_subject_id != null && $book_subject_id>0)
        {
            $show_accardion=true;
            $dc_subjects = \App\Models\BookSubject::GetTitleById($book_subject_id);
            $q->whereJsonContains('dc_subjects', $dc_subjects);
        }
        
        // if ($book_author_id != null && $book_author_id>0)
        // {
        //     $show_accardion=true;
        //     $author = \App\Models\Author::GetTitleById($book_author_id);
        //     $q->whereJsonContains('dc_authors', $author);
        // }

        if ($status != null)
        {
            $show_accardion=true;
            $q->where('status', '=', $status);
        }else{
            $status=1;
        }
        if($keyword != null){
            $show_accardion=true;
            
            $q->where(function($query) use($keyword){
                $query->orWhere('dc_authors', 'LIKE', '%'.$keyword.'%');
            })->orWhere('dc_title', 'LIKE', "%$keyword%")
            ->orWhere('dc_UDK', 'LIKE', "%$keyword%")
            ->orWhere('ISBN', 'LIKE', "%$keyword%")
            ->orWhere('extra1', 'LIKE', "%$keyword%")
            ->orWhere('dc_description', 'LIKE', "%$keyword%")
            ->orWhere('published_year', 'LIKE', "%$keyword%")->orWhereHas('extraAuthorBooks', function ($query) use ($keyword) {
                if($keyword) {
                    $query->where('name', 'like', '%'.$keyword.'%');
                }
            });
        }

        $bookTypes = BooksType::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookLanguages = BookLanguage::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookTexts = BookText::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookTextTypes = BookTextType::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookAccessTypes = BookAccessType::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookFileTypes = BookFileType::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookSubjects = BookSubject::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        
        $bookAuthors = Author::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');

        $books = $q->with('bookInventar')->orderBy('id', 'desc')->paginate($perPage);
         
        return view('reader.books', compact('books','bookSubjects', 'bookAuthors', 'bookTypes', 'bookLanguages', 'bookTexts', 'bookTextTypes', 'bookAccessTypes', 'bookFileTypes', 'book_bookType_id', 'book_bookLanguage_id', 'book_bookText_id', 'book_bookTextType_id', 'book_access_type_id', 'book_file_type_id', 'book_subject_id', 'status', 'keyword', 'show_accardion', 'book_author_id'))
            ->with('i', (request()->input('page', 1) - 1) * $books->perPage());
    }
    

     /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function showbook($language, $id)
    {
        $book = Book::find($id);
        $book_informations = BookInformation::where('book_id', '=', $id)->get();
        return view('reader.readershowbook', compact('book', 'book_informations'));
    }

}
