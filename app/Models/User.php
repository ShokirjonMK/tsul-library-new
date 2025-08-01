<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

// use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'inventar_number',
        'inventar',
        'student_id_number',
        'login'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne('App\Models\UserProfile', 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profiles()
    {
        return $this->hasMany(UserProfile::class);
    }

    public static function createOrUpdateUserByHemisData($data)
    {
        $student_id_number = trim($data['student_id_number']);
        $responseData = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('LOGIN_API_TOKEN')
        ])->get(env('HEMIS_BASE_URL') . '/rest/v1/data/student-info?student_id_number=' . $student_id_number);
        $faculty_id = null;
        $chair_id = null;
        $group_id = null;
        $oldUser = User::where('student_id_number', $student_id_number)->first();

        if ($responseData->getStatusCode() == 200) {
            $dataRes = $responseData->json()['data'];
            $faculty = Faculty::createOrUpdateByHemisCode($dataRes['department']);
            if ($faculty != null && $faculty) {
                $faculty_id = $faculty->id;
            }

            $chair = Chair::createOrUpdateByHemisCode($dataRes['specialty'], $dataRes['department']);
            if ($chair != null && $chair) {
                $chair_id = $chair->id;
            }

            $group = Group::createOrUpdateByHemisCode($dataRes['group'], $dataRes['specialty'], $dataRes['department']);
            if ($group != null && $group) {
                $group_id = $group->id;
            }
        }
        $image_path = null;
        $hemisImagePath = $data['image'];
        $inventar = trim($data['student_id_number']);
        $name = trim($data['full_name']);
        $email = trim($data['email']);
        $phone_number = trim($data['phone']);
        $date_of_birth = date("d.m.Y", $data['birth_date']);
        $course = $data['level']['name'];
        $gender_id = ReferenceGender::getGenderIdByHemisCode($data['gender']['code']);
        $passport_seria_number = $data['passport_number'];
        $address = $data['address'];
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
        }else{
            $image_path = $oldUser->profile->image;
        }
        $userData = [
            'password' => Hash::make($student_id_number),
            'status' => true,
            'name' => $name,
            'email' => $email,
            'login' => $student_id_number,
            'inventar_number' => $inventar,
            'inventar' => (User::count() + 1),
            'student_id_number' => $student_id_number,
        ];
        DB::beginTransaction();
        try {
            if (!$oldUser) {
                $newUser = User::create($userData);
                $newUser->assignRole('Reader');
                $profileData = [
                    'phone_number' => $phone_number,
                    'image' => $image_path,
                    'date_of_birth' => $date_of_birth,
                    'kursi' => $course,
                    'gender_id' => $gender_id,
                    'user_type_id' => 1,
                    'user_id' => $newUser->id,
                    'organization_id' => 1,
                    'branch_id' => 1,
                    'department_id' => 1,
                    'faculty_id' => $faculty_id,
                    'chair_id' => $chair_id,
                    'group_id' => $group_id,
                    'pnf_code' => $pnf_code,
                    'address' => $address,
                    'passport_seria_number' => $passport_seria_number,
                ];
                $userProfile = UserProfile::create($profileData);
            } else {
                $oldUser->update($userData);

                $newUser = $oldUser;

                $userProfile = UserProfile::where('user_id', $newUser->id)->first();
                $oldProfileData = [
                    'phone_number' => $phone_number,
                    'image' => $image_path,
                    'date_of_birth' => $date_of_birth,
                    'kursi' => $course,
                    'gender_id' => $gender_id,
                    'user_type_id' => 1,
                    'user_id' => $newUser->id,
                    'organization_id' => 1,
                    'branch_id' => 1,
                    'department_id' => 1,
                    'faculty_id' => $faculty_id,
                    'chair_id' => $chair_id,
                    'group_id' => $group_id,
                    'pnf_code' => $pnf_code,
                    'address' => $address,
                    'passport_seria_number' => $passport_seria_number,
                ];
                $userProfile->update($oldProfileData);
            }



            DB::commit();
            return $newUser;
            // all good
        } catch (\Throwable $e) {
            DB::rollback();
            // something went wrong
            throw $e;
        }

    }

    // All debtors

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function debtor()
    {
        return $this->hasMany('App\Models\Debtor', 'reader_id', 'id');
    }

    // Only active debtors with status = 1
    public function activeDebtors()
    {
        return $this->hasMany('App\Models\Debtor', 'reader_id', 'id')
            ->where('status', 1);
    }
}
