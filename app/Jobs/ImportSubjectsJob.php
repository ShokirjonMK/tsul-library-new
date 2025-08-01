<?php

namespace App\Jobs;

use App\Models\EducationType;
use App\Models\Subject;
use App\Models\SubjectGroup;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class ImportSubjectsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $tries = 5; // Increase retry attempts

    protected $page;

    /**
     * Create a new job instance.
     */
    public function __construct($page)
    {
        $this->page = $page;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('LOGIN_API_TOKEN')
        ])->get(env('HEMIS_BASE_URL') . '/rest/v1/data/subject-meta-list?page=' . $this->page);

        if ($response->successful()) {
            $data = $response->json();

            if (isset($data['data']['items'])) {
                foreach ($data['data']['items'] as $subject) {
                    Subject::updateOrCreate(
                        ['code' => $subject['code']], // Check by student ID
                        [
                            'isActive' => true,
                            'subject_group_id' => SubjectGroup::createOrUpdateByHemisCode($subject['subjectGroup'])->id,
                            'education_type_id' => EducationType::createOrUpdateByHemisCode($subject['educationType'])->id,
                            'uz' => [
                                "title" => $subject['name'],
                                "locale" => "uz",
                                "slug" => null
                            ],
                        ]
                    );
                }
            }
        }
    }
}
