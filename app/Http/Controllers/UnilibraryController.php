<?php

namespace App\Http\Controllers;

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
use App\Services\UnilibraryService;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class UnilibraryController extends Controller
{

    protected $unilibraryService;

    public function __construct(UnilibraryService $unilibraryService)
    {
        $this->unilibraryService = $unilibraryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resourceTypes = [];

        $client = new \GuzzleHttp\Client();
        // API endpoint URL with your desired location and units (e.g., London, Metric units)
        $apiUrl = "https://api.unilibrary.uz/api/crm/resource-types/lists?language=uz&category_id=1";

        try {
            // Make a GET request to the OpenWeather API
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
        $resource_type_id = $request->input('resource_type_id', null);


        $page = $request->input('page', 1);
        $perPage = $request->input('per_page', 15);
        $title = $request->input('title', null);
        $resource_type_id = $request->input('resource_type_id', null);

        $muallif = $request->input('muallif', null);

        $paginator = $this->unilibraryService->getPaginatedData($page, $perPage, $title, $muallif, $resource_type_id);
        $show_accardion = false;
        if ($resource_type_id != null) {
            $show_accardion = true;
        }

        return view('unilibrary.index', compact('paginator', 'title', 'muallif', 'page', 'resourceTypes', 'resource_type_id', 'show_accardion'));
        // Create a new Guzzle client instance
//        $client = new Client();
//        // API endpoint URL with your desired location and units (e.g., London, Metric units)
//        $apiUrl = "https://api.unilibrary.uz/api/user/guest-publisher-resources?page=1&limit=51&resource_category_id=1&language=uz&sort=desc&sort_direction=id";
//
//        try {
//            // Make a GET request to the OpenWeather API
//            $response = $client->get($apiUrl);
//            // Get the response body as an array
//            $data = json_decode($response->getBody(), true);
//
//            return view('unilibrary.index', ['results' => $data['result']]);
//        } catch (\Exception $e) {
//            dd($e);
//            // Handle any errors that occur during the API request
//            return view('unilibrary.error', ['error' => $e->getMessage()]);
//        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {

        $client = new Client();
        // API endpoint URL with your desired location and units (e.g., London, Metric units)
        $apiUrl = "https://api.unilibrary.uz/api/user/guest-publisher-resources/$id?language=uz";

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
            $data = json_decode($response->getBody(), true);

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
            $whos = Who::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');

            $book->dc_title = $data['result'][0]['name'];
//            $book->dc_UDK = $import->UDK;
            $book->dc_publisher = $data['result'][0]['publisher_name'];
//            $book->dc_published_city = $import->published_city;
            $book->dc_date = $data['result'][0]['publisher_year'];
            $book->published_year = $data['result'][0]['publisher_year'];
            $book->dc_description = $data['result'][0]['abstract_name'];
//            $book->authors_mark = $import->authors_mark;
//
            $book->ISBN = $data['result'][0]['isbn'];
//            $book->full_text_path = $import->full_text_path;
//            $book->file_format = $import->file_format;
//            $book->file_format_type = $import->file_format_type;
//            $book->file_size = $import->file_size;
            $book->betlar_soni = $data['result'][0]['resource_page_count'];
//            $book->price = $import->price;
            $book->dc_source = "https://unilibrary.uz/literature/" . $data['result'][0]['id'];
//            $book->dc_authors = \App\Models\Author::GetIdByUnilibraryName($data['result'][0]['authors']);
            $book->dc_authors = $data['result'][0]['authors'];
            $import = null;
            return view('book.create', compact('import', 'book', 'bookSubjects', 'bookAuthors', 'bookTypes', 'bookLanguages', 'bookTexts', 'bookTextTypes', 'bookAccessTypes', 'bookFileTypes', 'subjects', 'wheres', 'whos'));

//            return view('unilibrary.show', ['result' => $data['result'][0]]);

        } catch (\Exception $e) {
            // Handle any errors that occur during the API request
            return view('unilibrary.error', ['error' => $e->getMessage()]);
        }
        //
    }

}
