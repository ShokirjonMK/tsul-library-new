<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Branch;
use App\Models\Chair;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Group;
use App\Models\Organization;
use App\Models\ReferenceGender;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\UserType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class Usercu extends Component
{
    use WithFileUploads;
    use LivewireAlert;
    public $branches, $departments, $organizations, $genders, $userTypes, $user_id, $updateMode = false, $roles, $organization_id, $branch_id, $department_id, $gender_id, $userType_id;
    public $userroles = [], $user, $isActive = true, $name, $inventar_number, $password, $password_confirmation, $email, $user_image, $user_old_image, $phone_number, $date_of_birth, $course, $pnf_code, $passport_seria_number, $address, $passport_copy;
    public $selectedState = NULL;
    public $selectedBranch = NULL, $role;
    public $faculty_id = NULL;
    public $chair_id = NULL;
    public $group_id = NULL;
    public $faculties;
    public $chairs;
    public $groups;

    public function mount($user_id)
    {
        $this->organizations = Organization::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $this->inventar_number = 'f' . (User::count() + 1);
        // $this->branches = collect();
        $this->user_id = $user_id;
        $this->role = Auth::user()->getRoleNames()->toArray();
        if (count($this->role) > 0) {
            $user = Auth::user()->profile;
            if ($user != null) {
                $this->organization_id = $user->organization_id;
                $this->branch_id = $user->branch_id;
                $this->department_id = $user->department_id;
            }
        }

        if ($this->user_id != null) {
            $this->edit($this->user_id);
        } else {
            // if(count($this->role)>0){ 
            //     $user = Auth::user()->profile;
            //     $this->organization_id = $user->organization_id;
            //     $this->branch_id = $user->branch_id;
            //     $this->department_id = $user->department_id;
            // }
        }
    }
    protected function edit($id)
    {
        $this->user = User::find($this->user_id);
        if ($this->user->roles != null && $this->user->roles->count() > 0) {
            $userOldROles = [];
            foreach ($this->user->roles as $k => $role) {
                $userOldROles[$k] = $role->name;
            }
            $this->userroles = $userOldROles;
        }
        $this->isActive = $this->user->status;
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->inventar_number = $this->user->inventar_number;

        if ($this->user->profile != null) {
            $this->phone_number = $this->user->profile->phone_number;
            $this->user_old_image = $this->user->profile->image;
            $this->date_of_birth = $this->user->profile->date_of_birth;
            $this->course = $this->user->profile->kursi;
            $this->gender_id = $this->user->profile->gender_id;
            $this->userType_id = $this->user->profile->user_type_id;
            $this->organization_id = $this->user->profile->organization_id;
            $this->branch_id = $this->user->profile->branch_id;
            $this->department_id = $this->user->profile->department_id;
            $this->faculty_id = $this->user->profile->faculty_id;
            $this->chair_id = $this->user->profile->chair_id;
            $this->group_id = $this->user->profile->group_id;
            $this->pnf_code = $this->user->profile->pnf_code;
            $this->address = $this->user->profile->address;
            $this->passport_seria_number = $this->user->profile->passport_seria_number;
        }

        $this->updateMode = true;
    }
    public function render()
    {
        // $this->organizations = Organization::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        // $this->branches = Branch::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');

        $this->genders = ReferenceGender::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $this->userTypes = UserType::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        if (in_array('SuperAdmin', $this->role)) {
            $this->roles = Role::pluck('name', 'name')->all();
        }
        if (in_array('Admin', $this->role)) {
            $this->roles = Role::where('name', '!=', 'SuperAdmin')->pluck('name', 'name')->all();
        }
        if (in_array('Manager', $this->role)) {
            $this->roles = Role::where('name', '!=', 'Admin')->where('name', '!=', 'SuperAdmin')->pluck('name', 'name')->all();
        }



        if (!is_null($this->organization_id)) {
            $this->branches = Branch::where('organization_id', $this->organization_id)->active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        }
        if ($this->organization_id > 0 && $this->branch_id > 0) {
            $this->departments = Department::where('organization_id', $this->organization_id)->where('branch_id', $this->branch_id)->active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
            // $this->departments = Department::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        }

        if (!is_null($this->organization_id) && !is_null($this->branch_id)) {
            $this->faculties = Faculty::where('organization_id', $this->organization_id)->where('branch_id', $this->branch_id)->active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
            if ($this->faculties->count() == 0) {
                $this->faculties = [];
                $this->faculty_id = null;
            }
        } else {
            $this->faculties = [];
            $this->faculty_id = null;
        }

        if (!is_null($this->organization_id) && !is_null($this->branch_id) && !is_null($this->faculty_id)) {
            $this->chairs = Chair::where('organization_id', $this->organization_id)->where('branch_id', $this->branch_id)->where('faculty_id', $this->faculty_id)->active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
            if ($this->chairs->count() == 0) {
                $this->chairs = [];
                $this->chair_id = null;
            }
        } else {
            $this->chairs = [];
            $this->chair_id = null;
        }


        if (!is_null($this->organization_id) && !is_null($this->branch_id) && !is_null($this->faculty_id) && !is_null($this->chair_id)) {
            $this->groups = Group::where('organization_id', $this->organization_id)->where('branch_id', $this->branch_id)->where('faculty_id', $this->faculty_id)->where('chair_id', $this->chair_id)->where('faculty_id', $this->faculty_id)->active()->pluck('title', 'id');
            if ($this->groups->count() == 0) {
                $this->groups = [];
                $this->group_id = null;
            }
        } else {
            $this->groups = [];
            $this->group_id = null;
        }



        return view('livewire.admin.users.usercu');
    }
    public function save()
    {

        $this->validate(
            [
                'name' => 'required',
                'gender_id' => 'required',
                'userType_id' => 'required',
                'organization_id' => 'required',
                'branch_id' => 'required',
                'department_id' => 'required',
                'phone_number' => 'required|unique:user_profiles,phone_number',
                'email' => 'required|email|unique:users,email',
                'inventar_number' => 'required|unique:users,inventar_number',
                'password' => 'required|confirmed',
                'userroles' => 'required'
            ],
            [
                'name.required' =>  __('The :attribute field is required.'),
                'organization_id.required' =>  __('The :attribute field is required.'),
                'branch_id.required' =>  __('The :attribute field is required.'),
                'department_id.required' =>  __('The :attribute field is required.'),
                'gender_id.required' =>  __('The :attribute field is required.'),
                'userType_id.required' =>  __('The :attribute field is required.'),
                'password.required' =>  __('The :attribute field is required.'),
                'email.required' =>  __('The :attribute field is required.'),
                'phone_number.required' =>  __('The :attribute field is required.'),
                'userroles.required' =>  __('The :attribute field is required.'),
                'inventar_number.required' =>  __('The :attribute field is required.'),
                'inventar_number.unique' =>  __('The :attribute has already been taken.'),
                'password.confirmed' =>  __('The :attribute confirmation does not match.'),
                'email.unique' =>  __('The :attribute has already been taken.'),
                'email.email' =>  __('Email must be email'),

                'phone_number.unique' =>  __('The :attribute has already been taken.'),
            ],
            [
                'inventar_number' => __('Bar code'),
                'name' => __('Name'),
                'email' => __('Email'),
                'password' => __('Password'),
                'organization_id' => __('Organization'),
                'branch_id' => __('Branches'),
                'department_id' => __('Departments'),
                'userType_id' => __('User Type'),
                'gender_id' => __('Reference Gender'),
                'phone_number' => __('Phone Number'),
                'userroles' => __('Role'),
            ]
        );

        $image_path = null;
        if ($this->user_image != null) {
            $image_path = $this->user_image->store('users/avatar/images', 'public');
        }
        $int_inventar = 0;
        $inventar = trim($this->inventar_number);
        if ($inventar[0] == 'f') {
            $inventar = trim($this->inventar_number);
            $int_inventar = substr($this->inventar_number, 1);
        } else {
            $int_inventar = trim($this->inventar_number);
            $inventar = 'f' . trim($this->inventar_number);
        }

        $userData = [
            'password' => Hash::make($this->password),
            'status' => $this->isActive,
            'name' => $this->name,
            'email' => $this->email,
            'login' => $this->email,
            'inventar_number' => $inventar,
            'inventar' => $int_inventar,
        ];
        DB::beginTransaction();
        try {
            $user = User::create($userData);
            $user->assignRole($this->userroles);

            $profileData = [
                'phone_number' => $this->phone_number,
                'image' => $image_path,
                'date_of_birth' => $this->date_of_birth,
                'kursi' => $this->course,
                'gender_id' => $this->gender_id,
                'user_type_id' => $this->userType_id,
                'user_id' => $user->id,
                'organization_id' => $this->organization_id,
                'branch_id' => $this->branch_id,
                'department_id' => $this->department_id,
                'faculty_id' => $this->faculty_id,
                'chair_id' => $this->chair_id,
                'group_id' => $this->group_id,
                'pnf_code' => $this->pnf_code,
                'address' => $this->address,
                'passport_seria_number' => $this->passport_seria_number,
            ];

            $userProfile = UserProfile::create($profileData);
            DB::commit();
            return redirect()->to(app()->getLocale() . '/admin/users/' . $user->id);
            // all good
        } catch (\Throwable $e) {
            DB::rollback();
            // something went wrong
            throw $e;
        }
    }
    public function updated($name, $value)
    {
        if ($name == 'inventar_number') {
            $inventar = $this->inventar_number;
            if ($value[0] == 'f') {
                $this->inventar_number = $value;
            } else {
                $this->inventar_number = 'f' . $value;
            }
        }
    }
    public function update()
    {


        $this->validate(
            [
                'name' => 'required',
                'gender_id' => 'required',
                'userType_id' => 'required',
                'organization_id' => 'required',
                'branch_id' => 'required',
                'department_id' => 'required',
                'phone_number' => 'required|unique:user_profiles,phone_number,' . $this->user->profile->id,
                'email' => 'required|email|unique:users,email,' . $this->user_id,
                'inventar_number' => 'required|unique:users,inventar_number,' . $this->user_id,
                'password' => 'confirmed',
                'userroles' => 'required'
            ],
            [
                'name.required' =>  __('The :attribute field is required.'),
                'organization_id.required' =>  __('The :attribute field is required.'),
                'branch_id.required' =>  __('The :attribute field is required.'),
                'department_id.required' =>  __('The :attribute field is required.'),
                'gender_id.required' =>  __('The :attribute field is required.'),
                'userType_id.required' =>  __('The :attribute field is required.'),
                'password.required' =>  __('The :attribute field is required.'),
                'email.required' =>  __('The :attribute field is required.'),
                'phone_number.required' =>  __('The :attribute field is required.'),
                'userroles.required' =>  __('The :attribute field is required.'),
                'inventar_number.required' =>  __('The :attribute field is required.'),
                'inventar_number.unique' =>  __('The :attribute has already been taken.'),
                'password.confirmed' =>  __('The :attribute confirmation does not match.'),
                'email.unique' =>  __('The :attribute has already been taken.'),
                'email.email' =>  __('Email must be email'),
                'phone_number.unique' =>  __('The :attribute has already been taken.'),
            ],
            [
                'inventar_number' => __('Bar code'),
                'name' => __('Name'),
                'email' => __('Email'),
                'password' => __('Password'),
                'branch_id' => __('Branches'),
                'userType_id' => __('User Type'),
                'department_id' => __('Departments'),
                'gender_id' => __('Reference Gender'),
                'phone_number' => __('Phone Number'),
                'organization_id' => __('Organization'),

                'userroles' => __('Role'),
            ]
        );

        $image_path = null;
        if ($this->user_image != null) {
            $image_path = $this->user_image->store('users/avatar/images', 'public');
            $path = public_path('storage/' . $this->user_old_image);
            $isExists = file_exists($path);
            if ($isExists && is_file($path)) {
                unlink($path);
            }
        } else {
            $image_path = $this->user_old_image;
        }
        $int_inventar = 0;
        $inventar = trim($this->inventar_number);
        if ($inventar[0] == 'f') {
            $inventar = trim($this->inventar_number);
            $int_inventar = substr($this->inventar_number, 1);
        } else {
            $int_inventar = trim($this->inventar_number);
            $inventar = 'f' . trim($this->inventar_number);
        }
        $userData = [
            'password' => Hash::make($this->password),
            'status' => $this->isActive,
            'name' => $this->name,
            'email' => $this->email,
            'login' => $this->email,
            'inventar_number' => $inventar,
            'inventar' => $int_inventar,
        ];
        if (!empty($this->password)) {
            $this->password = Hash::make($this->password);
        } else {
            $userData = Arr::except($userData, array('password'));
        }

        DB::beginTransaction();
        try {
            $user = User::find($this->user_id);
            $user->update($userData);
            DB::table('model_has_roles')->where('model_id', $this->user_id)->delete();
            $user->assignRole($this->userroles);

            $profileData = [
                'phone_number' => $this->phone_number,
                'image' => $image_path,
                'date_of_birth' => $this->date_of_birth,
                'kursi' => $this->course,
                'gender_id' => $this->gender_id,
                'user_type_id' => $this->userType_id,
                'user_id' => $user->id,
                'organization_id' => $this->organization_id,
                'branch_id' => $this->branch_id,
                'department_id' => $this->department_id,
                'faculty_id' => $this->faculty_id,
                'chair_id' => $this->chair_id,
                'group_id' => $this->group_id,
                'pnf_code' => $this->pnf_code,
                'address' => $this->address,
                'passport_seria_number' => $this->passport_seria_number,
            ];
            $userProfile = UserProfile::find($user->profile->id);
            $userProfile->update($profileData);
            DB::commit();
            return redirect()->to(app()->getLocale() . '/admin/users/' . $user->id);
            // all good
        } catch (\Throwable $e) {
            DB::rollback();
            // something went wrong
            throw $e;
        }
    }
}
