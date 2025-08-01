<?php

namespace App\Console\Commands;

use App\Jobs\ImportEmployeesJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ImportAllEmployees extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'employee:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import all employees from the API using queues';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }



    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
//        $url = "https://student.ttatf.uz/api/info/student?page=1"; // Start with page 1
//        $response = Http::get($url);
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('LOGIN_API_TOKEN')
        ])->get(env('HEMIS_BASE_URL') . '/rest/v1/data/employee-list?page=1&type=all');

        if ($response->successful()) {
            $data = $response->json();
            $totalPages = $data['data']['pagination']['pageCount'] ?? 1;

            // Dispatch a job for each page
            for ($page = 1; $page <= $totalPages; $page++) {
                ImportEmployeesJob::dispatch($page);
            }

            $this->info("Import jobs for all {$totalPages} pages have been dispatched.");
        } else {
            $this->error("Failed to fetch initial data.");
        }
    }

}
