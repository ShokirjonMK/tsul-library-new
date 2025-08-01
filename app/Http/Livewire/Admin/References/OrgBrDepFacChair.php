<?php

namespace App\Http\Livewire\Admin\References;

use App\Models\Branch;
use App\Models\Chair;
use App\Models\Faculty;
use App\Models\Organization;
use Livewire\Component;

class OrgBrDepFacChair extends Component
{

    public $organizations;
    public $branches;
    public $faculties;
    public $chairs;
    
    public $organization_id = NULL;
    public $branch_id = NULL;
    public $faculty_id = NULL;
    public $chair_id = NULL;

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function mount($org_id, $branch_id, $faculty_id, $chair_id)
    {
        $this->organization_id=$org_id;

        $this->organizations = Organization::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $this->branches = collect();
        if(!is_null($this->organization_id)){
            $this->branch_id=$branch_id;
            $this->branches = Branch::where('organization_id', $this->organization_id)->active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        }

        if(!is_null($this->organization_id) && !is_null($this->branch_id)){
            $this->faculty_id=$faculty_id;
            $this->faculties = Faculty::where('organization_id', $this->organization_id)->where('branch_id', $this->branch_id)->active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        }
        

    }

    public function render()
    {
        if(!is_null($this->organization_id)){
            $this->branches = Branch::where('organization_id', $this->organization_id)->active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        }
        if(!is_null($this->organization_id) && !is_null($this->branch_id)){
            $this->faculties = Faculty::where('organization_id', $this->organization_id)->where('branch_id', $this->branch_id)->active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        }
        
        if(!is_null($this->organization_id) && !is_null($this->branch_id) && !is_null($this->faculty_id)){
            $this->chairs = Chair::where('organization_id', $this->organization_id)->where('branch_id', $this->branch_id)->where('faculty_id', $this->faculty_id)->active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        }

        return view('livewire.admin.references.org-br-dep-fac-chair');
    }

      /**
     * Write code on Method
     *
     * @return response()
     */
    public function updatedSelectedState($state)
    {
        if (!is_null($state)) {
            $this->branches = Branch::where('organization_id', $state)->active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        }
    }
    
}
