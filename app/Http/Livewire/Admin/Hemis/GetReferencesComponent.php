<?php

namespace App\Http\Livewire\Admin\Hemis;

use App\Models\Branch;
use App\Models\Chair;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Group;
use App\Models\ReferenceGender;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class GetReferencesComponent extends Component
{
    use LivewireAlert;

    public $referenceType;

    public function mount($referenceType)
    {
        if (!is_null($referenceType)) {
            $this->referenceType = $referenceType;
        }
    }


    public function render()
    {
        return view('livewire.admin.hemis.get-references-component');
    }

    public function getData()
    {
        if ($this->referenceType == 'faculty') {
            $responseData = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('LOGIN_API_TOKEN')
            ])->get(env('HEMIS_BASE_URL') . '/rest/v1/data/department-list?limit=200&_structure_type=11');
            if ($responseData->getStatusCode() == 200) {
                $dataRes = $responseData->json()['data'];
                try {
                    DB::transaction(function () use ($dataRes) {
                        foreach ($dataRes['items'] as $item) {

                            Faculty::createOrUpdateByHemisCode($item);

                        }
                    });
                    $this->alert('success', __('Successfully'));
                    return redirect()->to(app()->getLocale() . '/admin/faculties/');
                } catch (\Exception $e) {
//                    dd($e->getMessage());
                    $this->alert('warning', __("Not work,  $e"));
                }

            } else {
                $message = $responseData->json()['error'];
                $this->alert('warning', __("Not work, $message"));
            }
        } elseif ($this->referenceType == 'chair') {
            $responseData = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('LOGIN_API_TOKEN')
            ])->get(env('HEMIS_BASE_URL') . '/rest/v1/data/specialty-list?limit=200');
            if ($responseData->getStatusCode() == 200) {
                $dataRes = $responseData->json()['data'];
                try {
                    DB::transaction(function () use ($dataRes) {
                        foreach ($dataRes['items'] as $item) {
                            if ($item['department'] != null) {
                                Chair::createOrUpdateByHemisCode($item, $item['department']);
                            }
                        }
                    });
                    $this->alert('success', __('Successfully'));
                    return redirect()->to(app()->getLocale() . '/admin/chairs/');
                } catch (\Exception $e) {
//                    dd($e->getMessage());
                    $this->alert('warning', __("Not work,  $e"));
                }

            } else {
                $message = $responseData->json()['error'];
                $this->alert('warning', __("Not work, $message"));
            }
        } elseif ($this->referenceType == 'group') {
            $responseData = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('LOGIN_API_TOKEN')
            ])->get(env('HEMIS_BASE_URL') . '/rest/v1/data/group-list');
            if ($responseData->getStatusCode() == 200) {
                $dataRes = $responseData->json()['data'];
                try {
                    DB::transaction(function () use ($dataRes) {
                        foreach ($dataRes['items'] as $item) {
                            if ($item['department'] != null) {
                                Group::createOrUpdateByHemisCode($item, $item['specialty'], $item['department']);
                            }
                        }
                    });
                    $this->alert('success', __('Successfully'));
                    return redirect()->to(app()->getLocale() . '/admin/groups/');
                } catch (\Exception $e) {
                    dd($e->getMessage());
                    $this->alert('warning', __("Not work,  $e"));
                }

            } else {
                $message = $responseData->json()['error'];
                $this->alert('warning', __("Not work, $message"));
            }
        } elseif ($this->referenceType == 'student') {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('LOGIN_API_TOKEN')
            ])->get(env('HEMIS_BASE_URL') . '/rest/v1/data/student-list?page=1');

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
                        $gender_id = ReferenceGender::getGenderIdByHemisCode($student['gender']['code']);
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
//                    if($oldUser !=null && !$oldUser) {
//                        $image_path = $oldUser->profile->image;
//                    }
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
                            'gender_id' => $gender_id,
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
}
