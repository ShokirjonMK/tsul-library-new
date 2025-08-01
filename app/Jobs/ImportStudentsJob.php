<?php

namespace App\Jobs;

use App\Models\Branch;
use App\Models\Chair;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Group;
use App\Models\ReferenceGender;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ImportStudentsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
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
//        $url = "https://student.ttatf.uz/api/info/student?page=" . $this->page; // Replace with your actual API URL
//        $response = Http::get($url);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('LOGIN_API_TOKEN')
        ])->get(env('HEMIS_BASE_URL') . '/rest/v1/data/student-list?page=' . $this->page);

        if ($response->successful()) {
            $data = $response->json();

            if (isset($data['data']['items'])) {
                foreach ($data['data']['items'] as $student) {
                    $student_id_number = trim($student['student_id_number']);
                    $faculty_id = null;
                    $chair_id = null;
                    $group_id = null;
                    $faculty = Faculty::createOrUpdateByHemisCode($student['department']);
                    if ($faculty != null && $faculty) {
                        $faculty_id = $faculty->id;
                    }

                    $chair = Chair::createOrUpdateByHemisCode($student['specialty'], $student['department']);
                    if ($chair != null && $chair) {
                        $chair_id = $chair->id;
                    }

                    $group = Group::createOrUpdateByHemisCode($student['group'], $student['specialty'], $student['department']);
                    if ($group != null && $group) {
                        $group_id = $group->id;
                    }

                    $oldUser = User::where('student_id_number', $student_id_number)->first();
                    $image_path = null;
                    $hemisImagePath = $student['image'];
                    $inventar = $student_id_number;
                    $name = trim($student['full_name']);
                    $email = $student_id_number."@gmail.com";
                    $phone_number = $student_id_number;
                    $date_of_birth = date("d.m.Y", $student['birth_date']);
                    $course = $student['level']['name'];
                    $gender = ReferenceGender::createOrUpdateByHemisCode($student['gender']);

                    $pnf_code = $student_id_number;

                    if ($hemisImagePath != null && $oldUser == null) {
                        $response = Http::get($hemisImagePath);
                        if ($response->successful()) {
                            // Get file extension from URL
                            $extension = pathinfo(parse_url($hemisImagePath, PHP_URL_PATH), PATHINFO_EXTENSION);
                            // Generate a unique file name
                            $fileName = 'users/avatar/images/' . uniqid() . '.' . $extension;
                            // Save the file to storage
                            Storage::put('public/' . $fileName, $response->body());
                            $image_path = $fileName;
                        }
                    }
                    if ($oldUser) {
                        $image_path = $oldUser->profile->image ?? null;
                    }
                    $user = User::updateOrCreate(
                        ['student_id_number' => $student_id_number], // Check by student ID
                        [
                            'password' =>  Hash::make($student_id_number),
                            'status' => true,
                            'name' => $name,
                            'email' => $email,
                            'login' => $student_id_number,
                            'inventar_number' => $inventar,
                            'inventar' => (User::count() + 1),
                        ]
                    );
                    $user->assignRole('Reader');
                    $dep = Department::where('organization_id', 1)->first();
                    $branch = Branch::where('organization_id', 1)->first();
                    $profileData = [
                        'phone_number' => $phone_number,
                        'image' => $image_path,
                        'date_of_birth' => $date_of_birth,
                        'kursi' => $course,
                        'gender_id' => $gender->id,
                        'user_type_id' => 1,
                        'organization_id' => 1,
                        'branch_id' => $branch->id,
                        'department_id' => $dep->id,
                        'faculty_id' => $faculty_id,
                        'chair_id' => $chair_id,
                        'group_id' => $group_id,
                        'pnf_code' => $pnf_code,
                    ];

                    UserProfile::updateOrCreate(
                        ['user_id' => $user->id],
                        $profileData
                    );
                }
            }
        }
    }
}
