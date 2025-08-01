<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Services\AndqxaiService;
use Illuminate\Http\Request;

class AndqxaiController extends Controller
{

    protected $andqxaiService;

    public function __construct(AndqxaiService $andqxaiService)
    {
        $this->andqxaiService = $andqxaiService;
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

}
