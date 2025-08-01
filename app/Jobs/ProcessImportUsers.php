<?php

namespace App\Jobs;

use App\Imports\UsersImport;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class ProcessImportUsers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $import = [];
        $data = Excel::import(new UsersImport, public_path('users.xlsx'));
       
        foreach ($data as $index => $item) {
            $import[$index]  = [
                'name'     => $item["name"],
                'email'    => $item["email"], 
                'password' => $item["password"],
            ];
        }
        User::insert($import);
    }
}
