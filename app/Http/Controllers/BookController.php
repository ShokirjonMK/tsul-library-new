<?php

namespace App\Http\Controllers;

use App\Exports\BooksWithIncentarsExport;
use App\Exports\BooksWithInventarsExport;
use App\Exports\ExportBooks;
use App\Models\Author;
use App\Models\Book;
use App\Models\BookAccessType;
use App\Models\BookFileType;
use App\Models\BookInformation;
use App\Models\BookInventar;
use App\Models\BookLanguage;
use App\Models\BooksType;
use App\Models\BookSubject;
use App\Models\BookText;
use App\Models\BookTextType;
use App\Models\Debtor;
use App\Models\Depository;
use App\Models\Import;
use App\Models\Organization;
use App\Models\Subject;
use App\Models\Where;
use App\Models\Who;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDO;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class BookController
 * @package App\Http\Controllers
 */
class BookController extends Controller
{
        /**
     * create a new instance of the class
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware(['role:SuperAdmin|Admin|Manager']);

        // $this->middleware('permission:list|create|edit|delete|user-list|user-create|user-edit|user-delete', ['only' => ['index', 'store']]);
        // $this->middleware('permission:create|user-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:edit|user-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:delete|user-delete', ['only' => ['destroy']]);
        // $this->middleware('permission:deletedb', ['only' => ['destroyDB']]);
        //  $this->middleware('permission:list|create|edit|delete', ['only' => ['index', 'store']]);
        //  $this->middleware('permission:create', ['only' => ['create', 'store']]);
        //  $this->middleware('permission:edit', ['only' => ['edit', 'update']]);
        //  $this->middleware('permission:delete', ['only' => ['destroy']]);
        //  $this->middleware('permission:deletedb', ['only' => ['destroyDB']]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($language, Request $request)
    {
        $show_accardion=false;
        $q = Book::query();
 
        $organization_id  =trim($request->get('organization_id'));
        $dc_date=trim($request->get('dc_date'));

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
        $book_subject_id=trim($request->get('book_subject_id'));
        $id=trim($request->get('id'));
        $isbn=trim($request->get('isbn'));
        $title=trim($request->get('title'));
        $muallif=trim($request->get('muallif'));
        $location_index=trim($request->get('location_index'));
        $perPage = 20;
        $sqlBuild='';

        $current_roles = Auth::user()->getRoleNames()->toArray();
        $current_user = Auth::user()->profile;
    

        if ($book_bookType_id != null && $book_bookType_id>0)
        {
            $show_accardion=true;
            $q->where('books_type_id', '=', $book_bookType_id);
        }
 
        if ($organization_id != null && $organization_id>0)
        {
            $show_accardion=true;
            $q->where('organization_id', '=', $organization_id);
        }else{
            $show_accardion=true;
            $organization_id=$current_user->organization_id;
            $q->where('organization_id', '=', $organization_id);
        }
        
        if ($book_bookLanguage_id != null && $book_bookLanguage_id>0)
        {
            $show_accardion=true;
            $q->where('book_language_id', '=', $book_bookLanguage_id);
        }
        
        if ($dc_date != null && $dc_date>0)
        {
            $show_accardion=true;
            $q->where('dc_date', '=', $dc_date);
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
        
        // if ($book_subject_id != null && $book_subject_id>0)
        // {
        //     $show_accardion=true;
        //     $q->where('subject_id', '=', $book_subject_id);
        // }

        if ($book_subject_id != null && $book_subject_id>0)
        {
            $show_accardion=true;
            $dc_subjects = \App\Models\BookSubject::GetTitleById($book_subject_id);
            
            $q->whereJsonContains('dc_subjects', $dc_subjects);
        }
        
        if ($book_author_id != null && $book_author_id>0)
        {
            $show_accardion=true;
            $author = \App\Models\Author::GetTitleById($book_author_id);
            $q->whereJsonContains('dc_authors', $author);
            
        }

        if ($status != null)
        {
            $show_accardion=true;
            if($status>2){
                if($status==3){
                    $q->where('full_text_path', '<>', "");
                }
                if($status==4){
                    $q->where('dc_source', '<>', "");
                }

            }else{
                $q->where('status', '=', $status);
            } 
        }else{
            $status=1;
        }
        if($keyword != null){
            $show_accardion=true;
            $q->where(function($query) use($keyword){
                $query->orWhere('dc_authors', 'LIKE', '%'.$keyword.'%');
            })
            ->orWhere('dc_title', 'LIKE', "%$keyword%")
            ->orWhere('location_index', 'LIKE', "%$keyword%")
            ->orWhere('dc_UDK', 'LIKE', "%$keyword%")
            ->orWhere('dc_BBK', 'LIKE', "%$keyword%")
            ->orWhere('ISBN', 'LIKE', "%$keyword%")
            ->orWhere('extra1', 'LIKE', "%$keyword%")
            ->orWhere('dc_description', 'LIKE', "%$keyword%")
            ->orWhere('published_year', 'LIKE', "%$keyword%")
            ->orWhereHas('extraAuthorBooks', function ($query) use ($keyword) {
                if($keyword) {
                    $query->where('name', 'like', '%'.$keyword.'%');
                }
            });
        }

        if ($id != null && $id>0)
        {
            $q->where('id', '=', $id);
        }
        if ($isbn != null && $isbn>0)
        {
            $q->where('ISBN', 'LIKE', "%$isbn%");
        }
        if ($title != "")
        {
            $q->where('dc_title', 'LIKE', "%$title%");
        }
        if ($muallif != "")
        {
            $q->where('extra1', 'LIKE', "%$muallif%")
            ->orWhere(function($query) use($muallif){
                $query->orWhere('dc_authors', 'LIKE', '%'.$muallif.'%');
            });
        }

        if ($location_index != "")
        {
            $q->where('location_index', 'LIKE', "%$location_index%");
        }

        $bookTypes = BooksType::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookLanguages = BookLanguage::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookTexts = BookText::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookTextTypes = BookTextType::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookAccessTypes = BookAccessType::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookFileTypes = BookFileType::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookSubjects = BookSubject::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $subjects = Subject::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $organizations = Organization::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        
        $bookAuthors = Author::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');

        $books = $q->with(['BooksType', 'BooksType.translations', 'BookLanguage', 'BookLanguage.translations'])->orderBy('id', 'desc')->paginate($perPage);

        
        return view('book.index', compact('books','bookSubjects', 'organizations', 'bookAuthors', 'bookTypes', 'bookLanguages', 'bookTexts', 'bookTextTypes', 'bookAccessTypes', 'bookFileTypes', 'book_bookType_id', 'book_bookLanguage_id', 'book_bookText_id', 'book_bookTextType_id', 'book_access_type_id', 'book_file_type_id', 'book_subject_id', 'status', 'keyword', 'show_accardion', 'book_author_id', 'subjects', 'book_subject_id', 'current_roles', 'current_user', 'id', 'isbn', 'title', 'location_index', 'request', 'muallif', 'dc_date', 'organization_id'))
            ->with('i', (request()->input('page', 1) - 1) * $books->perPage());
    }
    
    public function export($language, Request $request){
        $file_name = 'book_'.date('Y_m_d_H_i_s').'.xlsx';
        return Excel::download(new ExportBooks($request), $file_name);
    }

    public function exportWithInventars($language, Request $request) 
    {
        $file_name = 'book_'.date('Y_m_d_H_i_s').'.xlsx';

        // return (new BooksWithInventarsExport($request))->queue($file_name)->allOnQueue('member');

        return Excel::download(new BooksWithInventarsExport($request), $file_name);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $book = new Book();
        $bookSubjects = BookSubject::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookAuthors = Author::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookTypes = BooksType::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookLanguages = BookLanguage::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookTexts = BookText::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookTextTypes = BookTextType::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookAccessTypes = BookAccessType::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookFileTypes = BookFileType::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $subjects = Subject::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $wheres = Where::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $whos  = Who::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');

        $book->price = 0;
        $book->betlar_soni = 0;
        $import = null;
        return view('book.create', compact('import', 'book', 'bookSubjects', 'bookAuthors', 'bookTypes', 'bookLanguages', 'bookTexts', 'bookTextTypes', 'bookAccessTypes', 'bookFileTypes', 'subjects', 'wheres', 'whos'));
    }

    public function inventarstorage(Request $request){
        $inventar_id = $request->input('inventar_id');
        $comment = $request->input('comment');
        $inventar = BookInventar::find($inventar_id);
        if($inventar){
            try {
                $data=[
                    'comment'=>$comment,
                    'inventar_number'=>$inventar->inventar_number,
                    'bar_code'=>$inventar->bar_code,
                    'book_id'=>$inventar->book_id,
                    'book_information_id'=>$inventar->book_information_id,
                    'book_inventar_id'=>$inventar->id,
                    'branch_id'=>$inventar->branch_id,
                    'department_id'=>$inventar->deportmetn_id,
                ];
                $depository = Depository::create($data);
                BookInventar::changeStatus($inventar->id, BookInventar::$WAREHOUSE);
                toast(__('Successfully saved'), 'success');

                return redirect()->back();
              } catch (Exception $e) {
                return $e->getMessage();
              }
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(
            [
                'dc_title' => 'required|min:3', 
                'dc_date' => 'required',
                'betlar_soni' => 'required',
                'betlar_soni' => 'required',
                'books_type_id' => 'required',
                'price' => 'required', 
                
            ],
            [
                'dc_title.required' =>  __('The :attribute field is required.'),
                'dc_authors.required' =>  __('The :attribute field is required.'),
                'dc_date.required' =>  __('The :attribute field is required.'),
                'betlar_soni.required' =>  __('The :attribute field is required.'),
                'books_type_id.required' =>  __('The :attribute field is required.'),
                'price.required' =>  __('The :attribute field is required.'),
                'authors_mark.required' =>  __('The :attribute field is required.'),
            ],
            [
                'dc_title' => __('Dc Title'),
                'dc_authors' => __('Dc Authors'),
                'dc_date' => __('Dc Date'),
                'betlar_soni' => __('Betlar Soni'),
                'books_type_id' => __('Books Type'),
                'price' => __('Price'),
                'authors_mark' => __("Author's mark"),
            ]
        );
        $extra1="";

        $subjectsAll = [];
        
        if ($request->input('dc_subjects') != null ) {
            $book_subjects = BookSubject::find($request->input('dc_subjects'));
            $subjectsAll[0] = $book_subjects->title;
        }
       
        $authorsAll = [];
        if ($request->input('dc_authors') != null ) {
            $tags = explode(",", $request->input('dc_authors'));
            foreach ($tags as $k => $v) {
                $author = Author::find($v);
                if ($author == null) {
                    $authorData = null;
                    $count = 0;
                    foreach (config('app.locales') as $til_code => $locale) {
                        $authorData[$til_code] = [
                            'title' => $v,
                            'slug' => \Carbon\Carbon::now()->toDateTimeString(),
                        ];
                        $count += 1;
                    }
                    Author::create($authorData);
                    $authorsAll[$k] = $v;
                    $extra1.=$v.", ";
                } else {
                    $extra1.=$author->title.", ";
                    $authorsAll[$k] = $author->title;
                }
            }
        }
        $image_path = null;
        if ($request->file('file')) {
            $filePath = Auth::id() . '_' . uniqid() . '_' . time() . '.' . $request->file('file')->getClientOriginalExtension();
            $up = $request->file('file')->storeAs('books/face/images', $filePath, 'public');
            $image_path = "books/face/images/" . $filePath;
        }

        $full_text_path = null;
        $file_format = null;
        $file_format_type = null;
        $file_size = null;
        $import = Import::find($request->input('import_id'));
        
        if ($request->file('full_text')) {
            $filePath = Auth::id() . '_' . uniqid() . '_' . time() . '.' . $request->file('full_text')->getClientOriginalExtension();
            $up = $request->file('full_text')->storeAs('books/fulltext', $filePath, 'public');
            $full_text_path = "books/fulltext/" . $filePath;
            $file_format = $request->file('full_text')->getClientOriginalExtension();
            $file_format_type = $request->file('full_text')->getMimeType();
            $file_size = $request->file('full_text')->getSize();
        }else{
            if($import!=null){
                $full_text_path = $import->full_text_path;
                $file_format = $import->file_format;
                $file_format_type = $import->file_format_type;
                $file_size = $import->file_size;
            }
            
        }

        $input = [
            'dc_title' => $request->input('dc_title'),
            'location_index' => $request->input('location_index'),
            'dc_subjects' => json_encode($subjectsAll),
            'dc_creators' => json_encode($authorsAll),
            'dc_authors' => json_encode($authorsAll),
            'dc_UDK' => $request->input('dc_UDK'),
            'dc_BBK' => $request->input('dc_BBK'),
            'dc_source' => $request->input('dc_source'),
            'dc_publisher' => $request->input('dc_publisher'),
            'dc_published_city' => $request->input('dc_published_city'),
            'ISBN' => $request->input('ISBN'),
            'dc_description' => $request->input('dc_description'),
            'dc_date' => $request->input('dc_date'),
            'betlar_soni' => $request->input('betlar_soni'),
            'price' => $request->input('price'),
            'status' => $request->input('status'),
            'published_year' => $request->input('dc_date'),
            'image_path' => $image_path,
            'books_type_id' =>  $request->input('books_type_id'),
            'book_language_id' =>  $request->input('book_language_id'),
            'book_text_id' =>  $request->input('book_text_id'),
            'book_text_type_id' => $request->input('book_text_type_id'),
            'book_access_type_id' =>  $request->input('book_access_type_id'),
            'book_file_type_id' =>  $request->input('book_file_type_id'),
            'subject_id' =>  $request->input('subject_id'),
            'where_id' =>  $request->input('where_id'),
            'who_id' =>  $request->input('who_id'),
            'authors_mark' =>  $request->input('authors_mark'),
            'circulation' =>  $request->input('circulation'),
            'printing_plate' =>  $request->input('printing_plate'),
            'full_text_path' => $full_text_path,
            'file_format' => $file_format,
            'file_format_type' => $file_format_type,
            'file_size' => $file_size,
            'extra1'=>$extra1,
        ]; 
        $previous_page=$request->input('previous_page');
        
        DB::beginTransaction();
        try {
            $book = Book::create($input); 
            if($import!=null){
                $import->status=2;
                $import->save();    
            }
            DB::commit();
            toast(__('Successfully saved'), 'success');
            // return redirect()->route('books.index', app()->getLocale());
            // return redirect()->route('dashboard');
            // return redirect()->to(app()->getLocale() . '/admin/books/' . $book->id);
            return redirect()->to(app()->getLocale() . '/admin/books/' . $book->id.'?previous_page='.$previous_page);

        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            // Send error back to user
        }
 
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $book = Book::find($id);
        $bookSubjects = BookSubject::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookAuthors = Author::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookTypes = BooksType::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookLanguages = BookLanguage::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookTexts = BookText::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookTextTypes = BookTextType::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookAccessTypes = BookAccessType::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookFileTypes = BookFileType::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        // $book->dc_authors = \App\Models\Author::GetIdByJsonName($book->dc_authors);
        $book->dc_authors = \App\Models\Author::GetStringNameByJsonName($book->dc_authors);
        $book->dc_subjects = \App\Models\BookSubject::GetIdByJsonName($book->dc_subjects);
        $subjects = Subject::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $wheres = Where::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $whos  = Who::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $import = null; 

        return view('book.edit', compact('import', 'book', 'bookSubjects', 'bookAuthors', 'bookTypes', 'bookLanguages', 'bookTexts', 'bookTextTypes', 'bookAccessTypes', 'bookFileTypes', 'subjects', 'wheres', 'whos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Book $book
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, Book $book)
    {
        request()->validate(
            [
                'dc_title' => 'required|min:3', 
                'dc_date' => 'required',
                'betlar_soni' => 'required',
                'betlar_soni' => 'required',
                'books_type_id' => 'required',
                'price' => 'required', 
            ],
            [
                'dc_title.required' =>  __('The :attribute field is required.'),
                'dc_authors.required' =>  __('The :attribute field is required.'),
                'dc_date.required' =>  __('The :attribute field is required.'),
                'betlar_soni.required' =>  __('The :attribute field is required.'),
                'books_type_id.required' =>  __('The :attribute field is required.'),
                'price.required' =>  __('The :attribute field is required.'),
                'authors_mark.required' =>  __('The :attribute field is required.'),
            ],
            [
                'dc_title' => __('Dc Title'),
                'dc_authors' => __('Dc Authors'),
                'dc_date' => __('Dc Date'),
                'betlar_soni' => __('Betlar Soni'),
                'books_type_id' => __('Books Type'),
                'price' => __('Price'),
                'authors_mark' => __("Author's mark"),
            ]
        );
        $subjectsAll = [];
        $extra1="";   
        if ($request->input('dc_subjects') != null ) {
            $book_subjects = BookSubject::find($request->input('dc_subjects'));
            $subjectsAll[0] = $book_subjects->title;
        }
       
        $authorsAll = [];
        if ($request->input('dc_authors') != null ) {
            $tags = explode(",", $request->input('dc_authors'));
            foreach ($tags as $k => $v) {
                $author = Author::find($v);
                if ($author == null) {
                    $authorData = null;
                    $count = 0;
                    foreach (config('app.locales') as $til_code => $locale) {
                        $authorData[$til_code] = [
                            'title' => $v
                        ];
                        $count += 1;
                    }
                    Author::create($authorData);
                    $authorsAll[$k] = $v;
                    $extra1.=$v.", ";
                } else {
                    $extra1.=$author->title.", ";
                    $authorsAll[$k] = $author->title;
                }
            }
        }

        $image_path = null;
        if ($request->file('file')) {
            $filePath = Auth::id() . '_' . uniqid() . '_' . time() . '.' . $request->file('file')->getClientOriginalExtension();
            $up = $request->file('file')->storeAs('books/face/images', $filePath, 'public');
            $image_path = "books/face/images/" . $filePath;
            if ($book->image_path != null) {
                $path = public_path('storage/' . $book->image_path);
                $isExists = file_exists($path);
                if ($isExists && is_file($path)) {
                    unlink($path);
                }
            }
        } else {
            $image_path = $book->image_path;
        }


        $full_text_path = null;
        $file_format = null;
        $file_format_type = null;
        $file_size = null;
        if ($request->file('full_text')) {
            $filePath = Auth::id() . '_' . uniqid() . '_' . time() . '.' . $request->file('full_text')->getClientOriginalExtension();
            $up = $request->file('full_text')->storeAs('books/fulltext', $filePath, 'public');
            $full_text_path = "books/fulltext/" . $filePath;
            $file_format = $request->file('full_text')->getClientOriginalExtension();
            $file_format_type = $request->file('full_text')->getMimeType();
            $file_size = $request->file('full_text')->getSize();
            if ($book->full_text_path != null) {
                $path = public_path('storage/' . $book->full_text_path);
                $isExists = file_exists($path);
                if ($isExists && is_file($path)) {
                    unlink($path);
                }
            }
        } else {
            $full_text_path = $book->full_text_path;
            $file_format = $book->file_format;
            $file_format_type = $book->file_format_type;
            $file_size = $book->file_size;
        }
        $input = [
            'dc_title' => $request->input('dc_title'),
            'location_index' => $request->input('location_index'),
            'dc_subjects' => json_encode($subjectsAll),
            'dc_creators' => json_encode($authorsAll),
            'dc_authors' => json_encode($authorsAll),
            'dc_UDK' => $request->input('dc_UDK'),
            'dc_BBK' => $request->input('dc_BBK'),
            'dc_source' => $request->input('dc_source'),
            'dc_publisher' => $request->input('dc_publisher'),
            'dc_published_city' => $request->input('dc_published_city'),
            'ISBN' => $request->input('ISBN'),
            'dc_description' => $request->input('dc_description'),
            'dc_date' => $request->input('dc_date'),
            'betlar_soni' => $request->input('betlar_soni'),
            'price' => $request->input('price'),
            'status' => $request->input('status'),
            'published_year' => $request->input('dc_date'),
            'image_path' => $image_path,
            'books_type_id' =>  $request->input('books_type_id'),
            'book_language_id' =>  $request->input('book_language_id'),
            'book_text_id' =>  $request->input('book_text_id'),
            'book_text_type_id' => $request->input('book_text_type_id'),
            'book_access_type_id' =>  $request->input('book_access_type_id'),
            'book_file_type_id' =>  $request->input('book_file_type_id'),
            'subject_id' =>  $request->input('subject_id'),
            'where_id' =>  $request->input('where_id'),
            'who_id' =>  $request->input('who_id'),
            'authors_mark' =>  $request->input('authors_mark'),
            'circulation' =>  $request->input('circulation'),
            'printing_plate' =>  $request->input('printing_plate'),
            'full_text_path' => $full_text_path,
            'file_format' => $file_format,
            'file_format_type' => $file_format_type,
            'file_size' => $file_size,
            'extra1'=>$extra1,
        ];
        $previous_page=$request->input('previous_page');
         
        DB::beginTransaction();
        
        try {
            $new_book = Book::find($book->id);
            $new_book->update($input);
            DB::commit();
            toast(__('Successfully saved'), 'success');
            // return redirect()->route('books.index', app()->getLocale());
            // return redirect()->route('dashboard');
            return redirect()->to(app()->getLocale() . '/admin/books/' . $book->id.'?previous_page='.$previous_page);
        } catch (\Exception $e) {
            DB::rollback();
            // Send error back to user
        }

        // request()->validate(Book::rules());

        // $book->update(Book::GetData($request));
        // toast(__('Updated successfully.'), 'success');

        // return redirect()->route('books.index', app()->getLocale());
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id, Request $request)
    {
        $book = Book::with(['bookFileType', 'bookFileType.translation', 'booksType', 'booksType.translation'])->find($id); 
        $previous_page = $request->get('previous_page');
        
        return view('book.show', compact('book', 'previous_page'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function inventarshow($language, $id, Request $request)
    {
        $perPage = 20;
        $bookInventar = BookInventar::find($id);
        $book_id = trim($request->get('book_id'));
        
        if($bookInventar != null && $book_id != null){
            $debtors = Debtor::where('book_inventar_id','=',$bookInventar->id)->orderBy('status', 'asc')->paginate($perPage);
            $book = Book::find($book_id);
            $book_information = BookInformation::where('book_id', '=', $book_id)->first();
            
            return view('book.debtors', compact('bookInventar','debtors', 'book', 'book_information'));
        }else{
            abort(404);
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function inventarremove($language, $id, Request $request)
    {
        $bookInventar = BookInventar::find($id)->delete();
        
        toast(__('Deleted successfully.'), 'info');
        return back();    
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function printinventar($language, $id,  Request $request)
    {
        $from = trim($request->get('from'));
        $to = trim($request->get('to'));
        $inventar = trim($request->get('inventar'));
        $q = BookInventar::query();
       
        if (!empty($from) && !empty($to)) {
            
            $q->whereBetween('bar_code', [intval($from), intval($to)]);
        } elseif (!empty($from)) {
            $q->where('bar_code', '=', $from);
        } elseif (!empty($to)) {
            $q->where('bar_code', '=', $to);
        } 
        
        if ($inventar != "") {
            $q->where('inventar_number', '=', $inventar);    
        }
        $bookInventars= $q->with(['book', 'branch', 'branch.translations', 'department', 'department.translations'])->orderBy('id', 'desc')->get();
         

        if ($id == 'all') {
            $bookInventars = BookInventar::active()->orderBy('id', 'desc')->get();
            return view('pdf.inventarall', compact('bookInventars'));
        }elseif ($id == 10) {
            
            // $bookInventars = BookInventar::whereBetween('bar_code', [intval($from), intval($to)])->get();
            return view('pdf.inventarallpdf', compact('bookInventars'));
        }elseif (!empty($from) && !empty($to)) {

            // $bookInventars = BookInventar::whereBetween('bar_code', [intval($from), intval($to)])->get();
            return view('pdf.inventarall', compact('bookInventars'));
        } else {
            $bookInventar = BookInventar::find($id);
            return view('pdf.inventarone', compact('bookInventar'));
        }
    }
   
    public function inventarByBookId ($language, $id,  Request $request)
    {
        $book_id = trim($request->get('book_id'));

        $q = BookInventar::query();
        
        
        if ($book_id != "") {
            $q->where('book_id', '=', $book_id);    
        }
        $bookInventars= $q->with(['book', 'branch', 'branch.translations', 'department', 'department.translations'])->orderBy('id', 'desc')->get();
         
        if($id==1){
            return view('pdf.inventarallpdf', compact('bookInventars'));
        }else{
            return view('pdf.inventarall', compact('bookInventars'));
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function inventaronebarcode($language, $id,  Request $request)
    {
        $from = trim($request->get('from'));
        $to = trim($request->get('to'));
        $book_information = trim($request->get('book_information'));

        if (!empty($from) && !empty($to)) {
            $bookInventars = BookInventar::whereBetween('bar_code', [intval($from), intval($to)])->get();
        }elseif(!empty($book_information)){
            $bookInventars = BookInventar::where('book_information_id', $book_information)->get();
        } else {
            $bookInventars = BookInventar::find($id);
        }
 
        return view('pdf.inventarall', compact('bookInventars'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function inventar($language, Request $request)
    {
        $from = trim($request->get('from'));
        $to = trim($request->get('to'));
        $inventar = trim($request->get('inventar'));
        $perPage = 20;
        $q = BookInventar::query();
        
        if (!empty($from) && !empty($to)) {
            $q->whereBetween('bar_code', [intval($from), intval($to)]);
        } elseif (!empty($from)) {
            $q->where('bar_code', '=', $from);
        } elseif (!empty($to)) {
            $q->where('bar_code', '=', $to);
        } 

        if ($inventar != "") {
            $q->where('inventar_number', '=', $inventar);
        }

        $current_roles = Auth::user()->getRoleNames()->toArray();
        $current_user = Auth::user()->profile;
        if($current_user != null){
            $q->where('organization_id', '=', $current_user->organization_id);
        }
        
        $barcodes= $q->with(['book', 'organization', 'organization.translations', 'branch', 'branch.translations', 'department', 'department.translations'])->orderBy('id', 'desc')->paginate($perPage);
        
        

        return view('book.inventar', compact('barcodes', 'from', 'to', 'inventar'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function addinventar($language, $id, $book_information_id)
    {

        $book = Book::find($id);
        if($book!=null){
            return view('book.addinventar', compact('book', 'book_information_id'));
        }else{
            toast(__('Nothing found'), 'danger');
            return back();    
        }
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id, Request $request)
    {
        $type=$request->input('type');
        
        
        if($type == null){
            $book = Book::find($id);
            $book->status = false;
            $book->save();
            toast(__('Deleted successfully.'), 'info');
    
            return redirect()->route('books.index', app()->getLocale());
        }elseif($type=='DELETE_FILE'){
            $book = Book::find($id);
            $book->full_text_path=null;
            $book->file_format=null;
            $book->file_format_type=null;
            $book->file_size=null;
            $book->save();
            // $booksType->isActive=false;
            // $booksType->Save();
            toast(__('Deleted successfully.'), 'info');
            return back();    
        }
        
        return back();    
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function delete($language, $id, Request $request)
    {
        $type=$request->input('type');
        if (Auth::user()->hasRole('SuperAdmin')){

            // BooksType::find($id)->delete();
            $book= Book::find($id);
            if($type=='DELETE'){
                // Book::find($id)->delete();
                $book = Book::find($id);

                if(Storage::disk('public')->exists( $book->full_text_path)) {
                    Storage::disk('public')->delete($book->full_text_path);
                } 
                $book->delete();
                // $booksType->isActive=false;
                // $booksType->Save();


                toast(__('Deleted successfully.'), 'info');
                return back();    
            }elseif($type=='DELETE_FULL_FROM_SERVER'){
                $book = Book::find($id);
                
                if(Storage::disk('public')->exists( $book->full_text_path)) {
                    Storage::disk('public')->delete($book->full_text_path);

                    $book->full_text_path=null;
                    $book->file_format=null;
                    $book->file_format_type=null;
                    $book->file_size=null;
                    $book->save();
                    toast(__('Deleted successfully.'), 'info');
                    return back();    
                } else {
                    toast(__('File not Found.'), 'danger');
                    return back();    
                }
                
            }else{
                return view('book.show', compact('book'));
            }
        }else{
            toast(__('You are not SuperAdmin'), 'danger');
            return back();    
        }
    }
}
