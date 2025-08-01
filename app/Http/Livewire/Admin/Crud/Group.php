<?php

namespace App\Http\Livewire\Admin\Crud;

use App\Models\Branch;
use App\Models\Chair;
use App\Models\Faculty;
use App\Models\Group as ModelsGroup;
use App\Models\Organization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Group extends Component
{
    use LivewireAlert;

    public $organizations;
    public $branches;
    public $faculties;
    public $chairs;

    public $updateMode=false, $group_id, $group, $title, $isActive= '1', $roles, $code;
    public $organization_id = NULL;
    public $branch_id = NULL;
    public $faculty_id = NULL;
    public $chair_id = NULL;
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function mount($group_id)
    {
        if(!is_null($group_id)){
            $this->group_id=$group_id;
            $this->updateMode=true;
            $this->group = ModelsGroup::find($group_id);
            $this->title=$this->group->title;
            $this->organization_id=$this->group->organization_id;
            $this->branch_id=$this->group->branch_id;
            $this->faculty_id=$this->group->faculty_id;
            $this->chair_id=$this->group->chair_id;
            $this->isActive=$this->group->isActive;
            $this->code=$this->group->code;
        }else{
            $this->roles = Auth::user()->getRoleNames()->toArray();
            if(count($this->roles)>0){
                $user = Auth::user()->profile;
                $this->organization_id = $user->organization_id;
                $this->branch_id = $user->branch_id;
            }
        }
        $this->organizations = Organization::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        // $this->branches = collect();
        // if(!is_null($this->organization_id)){
        //     $this->branches = Branch::where('organization_id', $this->organization_id)->active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        //     if($this->branches->count()==0){
        //         $this->branches=[];
        //         $this->branch_id=null;
        //     }
        // }else{
        //     $this->branches=[];
        //     $this->branch_id=null;
        // }

        // if(!is_null($this->organization_id) && !is_null($this->branch_id)){
        //     // $this->faculty_id=$faculty_id;
        //     $this->faculties = Faculty::where('organization_id', $this->organization_id)->where('branch_id', $this->branch_id)->active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        // }
        // $this->group = new Group();

    }


    public function render()
    {
        if(!is_null($this->organization_id)){
            $this->branches = Branch::where('organization_id', $this->organization_id)->active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
            if($this->branches->count()==0){
                $this->branches=[];
                $this->branch_id=null;
            }
        }else{
            $this->branches=[];
            $this->branch_id=null;
        }

        if(!is_null($this->organization_id) && !is_null($this->branch_id)){
            $this->faculties = Faculty::where('organization_id', $this->organization_id)->where('branch_id', $this->branch_id)->active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
            if($this->faculties->count()==0){
                $this->faculties=[];
                $this->faculty_id=null;
            }
        }else{
            $this->faculties=[];
            $this->faculty_id=null;
        }

        if(!is_null($this->organization_id) && !is_null($this->branch_id) && !is_null($this->faculty_id)){
            $this->chairs = Chair::where('organization_id', $this->organization_id)->where('branch_id', $this->branch_id)->where('faculty_id', $this->faculty_id)->active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
            if($this->chairs->count()==0){
                $this->chairs=[];
                $this->chair_id=null;
            }
        }else{
            $this->chairs=[];
            $this->chair_id=null;
        }
        return view('livewire.admin.crud.group');
    }
    public function save()
    {
        $this->validate(
            [
                'title' => 'required|min:2|unique:groups,title',
                'organization_id' => 'required',
                'branch_id' => 'required',
                'faculty_id' => 'required',
                'chair_id' => 'required',
            ],
            [
                'title.required' =>  __('The :attribute field is required.'),
                'organization_id.required' =>  __('The :attribute field is required.'),
                'branch_id.required' =>  __('The :attribute field is required.'),
                'faculty_id.required' =>  __('The :attribute field is required.'),
                'chair_id.required' =>  __('The :attribute field is required.'),
                'title.unique' =>  __('The :attribute has already been taken.'),

            ],
            [
                'title' => __('Title'),
                'organization_id' => __('Organization'),
                'branch_id' => __('Branches'),
                'faculty_id' => __('Faculties'),
                'chair_id' => __('Chairs'),
            ]
        );
        $input = [
            'title' => trim($this->title),
            'organization_id' => $this->organization_id,
            'branch_id' => $this->branch_id,
            'faculty_id' => $this->faculty_id,
            'chair_id' => $this->chair_id,
            'isActive' => $this->isActive,
            'code' => $this->code,
        ];
        DB::beginTransaction();
        try {
            $group = ModelsGroup::create($input);
            DB::commit();
            $this->alert('success',  __('Successfully saved'));

            return redirect()->to(app()->getLocale() . '/admin/groups/' . $group->id);
            // all good
        } catch (\Throwable $e) {
            DB::rollback();
            // something went wrong
        }
    }

    public function update()
    {

        $this->validate(
            [
                'title' => 'required|min:2|unique:groups,title,'.$this->group_id,
                'organization_id' => 'required',
                'branch_id' => 'required',
                'faculty_id' => 'required',
                'chair_id' => 'required',
            ],
            [
                'title.required' =>  __('The :attribute field is required.'),
                'organization_id.required' =>  __('The :attribute field is required.'),
                'branch_id.required' =>  __('The :attribute field is required.'),
                'faculty_id.required' =>  __('The :attribute field is required.'),
                'chair_id.required' =>  __('The :attribute field is required.'),
                'title.unique' =>  __('The :attribute has already been taken.'),

            ],
            [
                'title' => __('Title'),
                'organization_id' => __('Organization'),
                'branch_id' => __('Branches'),
                'faculty_id' => __('Faculties'),
                'chair_id' => __('Chairs'),
            ]
        );
        $input = [
            'title' => trim($this->title),
            'organization_id' => $this->organization_id,
            'branch_id' => $this->branch_id,
            'faculty_id' => $this->faculty_id,
            'chair_id' => $this->chair_id,
            'isActive' => $this->isActive,
            'code' => $this->code,
        ];
        DB::beginTransaction();
        try {
            $this->group->update($input);

            // $group = ModelsGroup::create($input);
            DB::commit();
            $this->alert('success',  __('Successfully saved'));

            return redirect()->to(app()->getLocale() . '/admin/groups/' . $this->group_id);
            // all good
        } catch (\Throwable $e) {
            DB::rollback();
            // something went wrong
        }

    }


}
