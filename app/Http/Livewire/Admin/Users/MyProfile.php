<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Branch;
use App\Models\Department;
use App\Models\ReferenceGender;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Illuminate\Support\Arr;

class MyProfile extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $user_id, $userProfile, $user;
    public $userroles = [], $name, $inventar_number, $password, $password_confirmation,  $old_password, $email, $user_image, $user_old_image, $phone_number, $date_of_birth, $course;
    public $branches, $departments, $branch_id, $department_id, $gender_id;

    public function mount($user_id)
    {
        $this->user = Auth::user();
        $this->user_id=$user_id;
        $this->userProfile = $this->user->profile;
        if($this->userProfile != null){
            $this->user_old_image=$this->userProfile->image;
            $this->phone_number=$this->userProfile->phone_number;
            $this->branch_id=$this->userProfile->branch_id;
            $this->department_id=$this->userProfile->department_id;
            $this->gender_id=$this->userProfile->gender_id;
            $this->date_of_birth=$this->userProfile->date_of_birth;
            $this->course=$this->userProfile->kursi;

        }
        $this->name=$this->user->name;
        $this->email=$this->user->email;

     }

    public function render()
    {
        // $this->alert('success',  __('Successfully saved'));
        $this->branches = Branch::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $this->departments = Department::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $this->genders = ReferenceGender::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        return view('livewire.admin.users.my-profile');
    }

    public function update()
    {
         $this->validate(
            [
                'name' => 'required',
                'gender_id' => 'required',
                'branch_id' => 'required',
                'phone_number' => 'required|unique:user_profiles,phone_number,'.$this->user->profile->id,
                'department_id' => 'required',
                'email' => 'required|email|unique:users,email,'.$this->user_id,
                'password' => 'confirmed'
             ],
            [
                'name.required' =>  __('The :attribute field is required.'),
                'department_id.required' =>  __('The :attribute field is required.'),
                'gender_id.required' =>  __('The :attribute field is required.'),
                 'branch_id.required' =>  __('The :attribute field is required.'),
                'password.required' =>  __('The :attribute field is required.'),
                'email.required' =>  __('The :attribute field is required.'),
                'phone_number.required' =>  __('The :attribute field is required.'),
                'inventar_number.required' =>  __('The :attribute field is required.'),
                'inventar_number.unique' =>  __('The :attribute has already been taken.'),
                'password.confirmed' =>  __('The :attribute confirmation does not match.'),
                'email.unique' =>  __('The :attribute has already been taken.'),
                'phone_number.unique' =>  __('The :attribute has already been taken.'),
            ],
            [
                'inventar_number' => __('Inventar Number'),
                'name' => __('Name'),
                'email' => __('Email'),
                'password' => __('Password'),
                'branch_id' => __('Branches'),
                'userType_id' => __('User Type'),
                'department_id' => __('Departments'),
                'gender_id' => __('Reference Gender'),
                'phone_number' => __('Phone Number'),

             ]
        );
        $image_path=null;
        if($this->user_image!=null){
            $image_path = $this->user_image->store('users/avatar/images', 'public');
            $path = public_path('storage/'.$this->user_old_image);
            $isExists = file_exists($path);
            if($isExists && is_file($path)){
                unlink($path);
            }
        }else{
            $image_path=$this->user_old_image;
        }
        $userData = [
            'password' => Hash::make($this->password),
            'name' => $this->name,
            'email' => $this->email,
         ];
         $hashedPassword = Auth::user()->password;
        //  dd(Hash::check($this->old_password, $hashedPassword));
        //  dd($hashedPassword);
        // dd(\Hash::check($this->old_password , $hashedPassword ));
        if(!empty($this->old_password)) {
            if (\Hash::check($this->old_password , $hashedPassword )) {
                if (!\Hash::check($this->password , $hashedPassword)) {
                    $this->password = Hash::make($this->password);
                }else{
                    $this->alert('error',  __('New Password cannot be same as your current password.'));
                    session()->flash('message',__('New Password cannot be same as your current password.'));
                    return redirect()->to(app()->getLocale() . '/admin/my');
                }
            }else{
                $this->alert('error',  __('Your current password does not matches with the password.'));
                session()->flash('message',__('Your current password does not matches with the password.'));
                return redirect()->to(app()->getLocale() . '/admin/my');
            }
            // if (!Hash::check($this->old_password, $hashedPassword)) {
            //     // The passwords matches
            //     $this->alert('error',  __('Your current password does not matches with the password.'));
            //     // return redirect()->back()->with("error","Your current password does not matches with the password.");
            // }

            // if(strcmp($this->old_password, $this->password) == 0){
            //     // Current password and new password same
            //     $this->alert('error',  __('New Password cannot be same as your current password.'));
            // }


        } else {
            $userData = Arr::except($userData, array('password'));
        }
         DB::beginTransaction();
        try {
            $user = User::find($this->user_id);
            $user->update($userData);

            $profileData = [
                'phone_number' => $this->phone_number,
                'image' => $image_path,
                'date_of_birth' => $this->date_of_birth,
                'kursi' => $this->course,
                'gender_id' => $this->gender_id,
                 'user_id' => $user->id,
                'branch_id' => $this->branch_id,
                'department_id' => $this->department_id,
            ];
            $userProfile = UserProfile::find($user->profile->id);
            $userProfile->update($profileData);
            DB::commit();
            $this->alert('success',  __('Successfully saved'));

            return redirect()->to(app()->getLocale() . '/admin/my');
        } catch (\Throwable $e) {
            DB::rollback();
            // something went wrong
            throw $e;
        }


    }

}
