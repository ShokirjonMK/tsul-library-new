<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator;

class UnilibraryService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.unilibrary.uz/', // Replace with your API base URI
        ]);
    }

    public function getPaginatedData($page = 1, $perPage = 15, $name, $authors, $resource_type_id)
    {
        $response = $this->client->request('GET', '/api/user/guest-publisher-resources', [
            'headers' => [
                'Referer' => 'https://unilibrary.uz/',
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)', // optional, ba'zi serverlar kerak qiladi
                'Accept' => 'application/json',
            ],
            'query' => [
                'page' => $page,
                'per_page' => $perPage,
                'limit' => 15,
                'resource_category_id' => 1,
                'language' => "uz",
                'sort' => "desc",
                'sort_direction' => "id",
                'name' => $name,
                'authors' => $authors,
                'resource_type_id' => $resource_type_id,
            ]
        ]);

        $data = json_decode($response->getBody()->getContents(), true)['result'];
        // Assuming the API returns the total number of items in the `total` field
        $total = $data['total'];

        // Assuming the API returns the current page's data in the `data` field
        $items = $data['data'];

        // Create a Laravel Paginator instance
        $paginator = new LengthAwarePaginator(
            $items,         // Items for the current page
            $total,         // Total number of items
            $perPage,       // Items per page
            $page,          // Current page
            ['path' => route('unilibrary.index', app()->getLocale())] // Path for pagination links
        );

        return $paginator;
    }
    public function getPaginatedDataFront($page = 1, $perPage = 15, $name, $authors, $resource_type_id)
    {
        $response = $this->client->request('GET', '/api/user/guest-publisher-resources', [
            'headers' => [
                'Referer' => 'https://unilibrary.uz/',
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)', // optional, ba'zi serverlar kerak qiladi
                'Accept' => 'application/json',
            ],
            'query' => [
                'page' => $page,
                'per_page' => $perPage,
                'limit' => $perPage,
                'resource_category_id' => 1,
                'language' => "uz",
                'sort' => "desc",
                'sort_direction' => "id",
                'name' => $name,
                'authors' => $authors,
                'resource_type_id' => $resource_type_id,
            ]
        ]);

        $data = json_decode($response->getBody()->getContents(), true)['result'];
        // Assuming the API returns the total number of items in the `total` field
        $total = $data['total'];

        // Assuming the API returns the current page's data in the `data` field
        $items = $data['data'];

        // Create a Laravel Paginator instance
        $paginator = new LengthAwarePaginator(
            $items,         // Items for the current page
            $total,         // Total number of items
            $perPage,       // Items per page
            $page,          // Current page
            ['path' => route('site.unilibrary', app()->getLocale())] // Path for pagination links
        );

        return $paginator;
    }
}
