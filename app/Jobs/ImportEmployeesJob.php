<?php

namespace App\Jobs;

use App\Models\Branch;
use App\Models\Department;
use App\Models\ReferenceGender;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\UserType;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ImportEmployeesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $page;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($page)
    {
        $this->page = $page;
    }
    public function handle()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('LOGIN_API_TOKEN')
        ])->get(env('HEMIS_BASE_URL') . '/rest/v1/data/employee-list?type=all&page=' . $this->page);

        if ($response->successful()) {
            $data = $response->json();

            if (isset($data['data']['items'])) {
                foreach ($data['data']['items'] as $student) {
                    $image_path = null;

                    $employee_id_number = trim($student['employee_id_number']);
                    $inventar = $employee_id_number;
                    $name = trim($student['full_name']);
                    $email = $employee_id_number."@gmail.com";
                    $phone_number = $employee_id_number;
                    $date_of_birth = date("d.m.Y", abs($student['birth_date']));

//                    $course = $student['level']['name'];
                    $gender = ReferenceGender::createOrUpdateByHemisCode($student['gender']);

                    $userType = UserType::createOrUpdateByHemisCode($student['employeeType']);

                    $pnf_code = $employee_id_number;
                    $oldUser = User::where('student_id_number', $employee_id_number)->first();

                    $hemisImagePath = $student['image'];
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
                        ['student_id_number' => $employee_id_number], // Check by student ID
                        [
                            'password' =>  Hash::make($employee_id_number),
                            'status' => true,
                            'name' => $name,
                            'email' => $email,
                            'login' => $employee_id_number,
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
                        'gender_id' => $gender->id,
                        'user_type_id' => $userType->id,
                        'organization_id' => 1,
                        'branch_id' => $branch->id,
                        'department_id' => $dep->id,
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
