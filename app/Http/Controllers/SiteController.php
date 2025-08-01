<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookLanguage;
use App\Models\BooksType;
use App\Models\BookSubject;
use App\Models\Journal;
use App\Models\MagazineIssue;
use App\Models\Udc;
use App\Services\AndqxaiService;
use App\Services\UnilibraryService;
use http\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{

    protected $unilibraryService;
    protected $andqxaiService;

    public function __construct(UnilibraryService $unilibraryService, AndqxaiService $andqxaiService)
    {
        $this->unilibraryService = $unilibraryService;
        $this->andqxaiService = $andqxaiService;

    }

    public function index()
    {
        $bookTypes = BooksType::active()->with('translations')->translatedIn(app()->getLocale())->limit(5)->get();
        // $books = Book::active()->with(['booksType', 'booksType.translations'])->orderBy('id', 'desc')->limit(8)->get();
        $journals = Journal::active()->with(['translations', 'booksType', 'booksType.translations'])->orderBy('id', 'desc')->limit(8)->get();
        $magazines = MagazineIssue::active()->with(['translations', 'journal', 'journal.translations'])->orderBy('id', 'desc')->translatedIn(app()->getLocale())->limit(12)->get();
        $topBooks = DB::table('debtors')
            ->select('book_id', DB::raw('count(*) as total'))
            ->groupBy('book_id')
            ->orderBy('total', 'DESC')
            ->limit(10)
            ->get();

        return view('site.index', compact('bookTypes', 'journals', 'magazines', 'topBooks'));
    }

    public function categories()
    {

        $bookTypes = BooksType::active()->with('translations')->translatedIn(app()->getLocale())->limit(5)->get();
        return redirect()->route('welcome', app()->getLocale());

        // return view('site.index', compact('bookTypes'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function category($language, $slug)
    {

        $bookTypes = BooksType::active()->with('translations')->translatedIn(app()->getLocale())->limit(5)->get();
        // dd("all categories slug $slug");
        return redirect()->route('welcome', app()->getLocale());

        // return view('site.index', compact('bookTypes'));
    }

    public function udcs($language, Request $request)
    {

        $q = Udc::query();
        $perPage = 20;
        $keyword = trim($request->get('keyword'));

        if (strpos($keyword, '\\') !== FALSE) {
            $keyword = addslashes($keyword);
        }
        if ($keyword != null) {
            $q->Where('udc_number', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhere('number_of_codes', 'LIKE', "%$keyword%")
                ->orWhere('notes', 'LIKE', "%$keyword%");

        }
        //    ->where('parent_id',NULL)
        $udcs = $q->orderBy('id', 'desc')->paginate($perPage);
        // $udcs = Udc::where('parent_id',NULL)->orderBy('id', 'desc')->paginate($perPage);
        if (strpos($keyword, '\\') !== FALSE) {
            $keyword = stripslashes($keyword);
        }

        return view('site.udcs', compact('udcs', 'keyword'))
            ->with('i', (request()->input('page', 1) - 1) * $udcs->perPage());
    }

    public function unilibrary(Request $request)
    {
        $resourceTypes = [];

        $client = new \GuzzleHttp\Client();
        // API endpoint URL with your desired location and units (e.g., London, Metric units)
        $apiUrl = "https://api.unilibrary.uz/api/crm/resource-types/lists?language=uz&category_id=1";

        try {
            // Make a GET request to the OpenWeather API
//            $response = $client->get($apiUrl);
            $response = $client->request('GET', $apiUrl, [
                'headers' => [
                    'Referer' => 'https://unilibrary.uz/',
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)', // optional, ba'zi serverlar kerak qiladi
                    'Accept' => 'application/json',
                ],
            ]);

            // Get the response body as an array
            $resourceType = json_decode($response->getBody(), true);
            $resourceTypes = $resourceType['result'];
        } catch (\Exception $e) {
            $resourceTypes = [];
        }

        $page = $request->input('page', 1);
        $perPage = $request->input('per_page', 16);
        $title = $request->input('title', null);
        $resource_type_id = $request->input('resource_type_id', null);

        $muallif = $request->input('muallif', null);

        $paginator = $this->unilibraryService->getPaginatedDataFront($page, $perPage, $title, $muallif, $resource_type_id);

        return view('site.unilibrary', compact('paginator', 'title', 'muallif', 'page', 'resourceTypes', 'resource_type_id'));

    }

    public function andqxai(Request $request)
    {
        $resourceTypes = [];

        $client = new \GuzzleHttp\Client();
        // API endpoint URL with your desired location and units (e.g., London, Metric units)
        $apiUrl = "https://demo.andqxai.uz/api/user/book?page=0&size=8&sort=id,desc";

        try {
            // Make a GET request to the OpenWeather API
            $response = $client->get($apiUrl);
            // Get the response body as an array
            $resourceType = json_decode($response->getBody(), true);
            $resourceTypes = $resourceType['result'];
        } catch (\Exception $e) {
            $resourceTypes = [];
        }

        $page = $request->input('page', 1);
        $perPage = $request->input('per_page', 16);
        $search = $request->input('keyword', null);
        $resource_type_id = $request->input('resource_type_id', null);

        $muallif = $request->input('muallif', null);

        $paginator = $this->andqxaiService->getPaginatedDataFront($page, $perPage, $search, $muallif, $resource_type_id);

        return view('site.andqxai', compact('paginator', 'search', 'muallif', 'page', 'resourceTypes', 'resource_type_id'));

    }

    public function books(Request $request)
    {

        $keyword = trim($request->get('search'));
        $type = trim($request->get('type'));
        $language = trim($request->get('language'));
        $bookSubject = trim($request->get('bookSubject'));

        $perPage = 12;

        $show_accardion = false;
        $q = Book::query();

        $book_bookType_id = trim($request->get('type'));
        $book_bookLanguage_id = trim($request->get('language'));
        $book_bookText_id = trim($request->get('book_text_id'));
        $book_bookTextType_id = trim($request->get('book_text_type_id'));
        $book_access_type_id = trim($request->get('book_access_type_id'));
        $book_file_type_id = trim($request->get('book_file_type_id'));
        $book_subject_id = trim($request->get('bookSubject'));
        $book_author_id = trim($request->get('book_author_id'));
        $status = trim($request->get('status'));
        $keyword = trim($request->get('keyword'));

        $perPage = 20;
        $sqlBuild = '';
        if ($book_bookType_id != null && $book_bookType_id > 0) {
            $q->where('books_type_id', '=', $book_bookType_id);
        }
        if ($book_bookLanguage_id != null && $book_bookLanguage_id > 0) {
            $q->where('book_language_id', '=', $book_bookLanguage_id);
        }
        if ($book_bookText_id != null && $book_bookText_id > 0) {
            $q->where('book_text_id', '=', $book_bookText_id);
        }
        if ($book_bookTextType_id != null && $book_bookTextType_id > 0) {
            $q->where('book_text_type_id', '=', $book_bookTextType_id);
        }
        if ($book_access_type_id != null && $book_access_type_id > 0) {
            $q->where('book_access_type_id', '=', $book_access_type_id);
        }
        if ($book_file_type_id != null && $book_file_type_id > 0) {
            $q->where('book_file_type_id', '=', $book_file_type_id);
        }
        if ($book_subject_id != null) {
            $dc_subjects = \App\Models\BookSubject::GetTitleById($book_subject_id);
            $q->whereJsonContains('dc_subjects', $book_subject_id);
        }

        if ($book_author_id != null && $book_author_id > 0) {
            $author = \App\Models\Author::GetTitleById($book_author_id);
            $q->whereJsonContains('dc_authors', $author);
        }
        if ($status != null) {
            $q->where('status', '=', $status);
        } else {
            $status = 1;
        }
        if ($keyword != null) {
            $q->where(function ($query) use ($keyword) {
                $query->orWhere('dc_authors', 'LIKE', '%' . $keyword . '%');
            })
                ->orWhere('dc_title', 'LIKE', "%$keyword%")
                ->orWhere('dc_UDK', 'LIKE', "%$keyword%")
                ->orWhere('ISBN', 'LIKE', "%$keyword%")
                ->orWhere('published_year', 'LIKE', "%$keyword%")->orWhereHas('extraAuthorBooks', function ($query) use ($keyword) {
                    if ($keyword) {
                        $query->where('name', 'like', '%' . $keyword . '%');
                    }
                });
        }
        $bookTypes = BooksType::active()->with('translations')->translatedIn(app()->getLocale())->get();

        $bookLanguages = BookLanguage::active()->with('translations')->translatedIn(app()->getLocale())->get();
        $bookSubjects = BookSubject::active()->with('translations')->translatedIn(app()->getLocale())->get();
        $books = $q->with('bookInventar')->with(['booksType', 'booksType.translations'])->orderBy('id', 'desc')->active()->paginate($perPage);

//        $page = request()->get('page', 1); // joriy sahifa
//        $perPage = $perPage ?? 15;         // fallback agar null bo‘lsa
//        $cacheKey = "books_list_page_{$page}_perpage_{$perPage}";
//
//        $books = Cache::remember($cacheKey, 86400, function () use ($q, $perPage) {
//            return $q->with([
//                'bookInventar',
//                'booksType',
//                'booksType.translations'
//            ])->orderBy('id', 'desc')->paginate($perPage);
//        });

        return view('site.books', compact('books', 'bookTypes', 'bookLanguages', 'bookSubjects', 'type', 'language', 'bookSubject'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function book($language, $slug)
    {

        $book = Book::active()->where('id', $slug)->first();
        if ($book != null) {
            $books = Book::active()->with(['booksType', 'booksType.translations'])->where('books_type_id', $book->books_type_id)->where('id', '<>', $book->id)->limit(8)->get();
            return view('site.bookdetails', compact('book', 'books'));
        } else {
            abort(404);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function bookpdf($language, $id)
    {
        if (!Auth::guest()) {
            $book = Book::active()->where('id', $id)->first();
            if ($book != null) {
                return view('site.bookdetailspdf', compact('book'));
            } else {
                abort(404);
            }
        } else {
            toast(__('Library membership required to download full text'), 'info');
            return redirect()->to(app()->getLocale() . '/books/' . $id);
        }
    }

    public function journals()
    {
        $perPage = 12;
        $journals = Journal::active()->with(['translations', 'booksType', 'booksType.translations'])->orderBy('id', 'desc')->paginate($perPage);
        $bookSubjects = BookSubject::active()->with('translations')->translatedIn(app()->getLocale())->get();
        return view('site.journals', compact('journals', 'bookSubjects'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function journal($language, $slug)
    {
        $perPage = 12;
        $journal = Journal::active()->whereTranslation('slug', $slug)->first();

        if ($journal != null) {
            $magazines = MagazineIssue::active()->translatedIn(app()->getLocale())->where('journal_id', $journal->id)->paginate($perPage);
            return view('site.journal-magazines', compact('journal', 'magazines'));
        } else {
            abort(404);
        }
        // $bookTypes = BooksType::active()->translatedIn(app()->getLocale())->limit(5)->get();
        // dd("all categories slug $slug");
        // return redirect()->route('welcome', app()->getLocale());

        // return view('site.journal-magazines', compact('journal'));
    }

    public function magazine($language, $slug, $subslug)
    {

        $journal = Journal::active()->whereTranslation('slug', $slug)->first();

        if ($journal != null) {
            $magazine = MagazineIssue::active()->translatedIn(app()->getLocale())->where('journal_id', $journal->id)->whereTranslation('slug', $subslug)->first();

            return view('site.journal-magazine', compact('journal', 'magazine'));
        } else {
            abort(404);
        }
        return view('site.journal-magazine');
    }


}
