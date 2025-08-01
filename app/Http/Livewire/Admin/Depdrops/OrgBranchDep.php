<?php

namespace App\Http\Livewire\Admin\Depdrops;

use App\Models\Group;
use App\Models\Branch;
use App\Models\Chair;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Organization; 
use Livewire\Component;

class OrgBranchDep extends Component
{

    public $organizations, $branches, $departments, $genders,  $organization_id, $branch_id, $department_id, $gender_id, $type;
    public $faculty_id = NULL;
    public $chair_id = NULL;
    public $group_id = NULL;
    public $faculties;
    public $chairs;
    public $groups;

    public function mount($type, $organization_id, $branch_id, $department_id, $faculty_id, $group_id)
    {
        $this->organizations = Organization::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $this->organization_id=$organization_id;
        $this->branch_id=$branch_id;
        $this->department_id=$department_id;
        $this->faculty_id=$faculty_id;
        $this->group_id=$group_id;
        $this->type=$type;

        // $this->branches = collect();
        // $this->user_id = $user_id;
        // $this->role = Auth::user()->getRoleNames()->toArray();
        // if(count($this->role)>0){ 
        //     $user = Auth::user()->profile;
        //     $this->organization_id = $user->organization_id;
        //     $this->branch_id = $user->branch_id;
        //     $this->department_id = $user->department_id;
        // } 

        // if ($this->user_id != null) {
        //     $this->edit($this->user_id);
        // } else {
        //     // if(count($this->role)>0){ 
        //     //     $user = Auth::user()->profile;
        //     //     $this->organization_id = $user->organization_id;
        //     //     $this->branch_id = $user->branch_id;
        //     //     $this->department_id = $user->department_id;
        //     // }
        // }
    }
    public function render()
    {
        
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


        return view('livewire.admin.depdrops.org-branch-dep');
    }
}
 