<?php

namespace App\Http\Livewire\Admin\References;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Organization;
use Livewire\Component;

class OrgBranch extends Component
{
    public $organizations;
    public $branches;
    
    public $organization = NULL;
    public $selectedBranch = NULL;
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function mount($org_id, $branch_id)
    {
        $this->organization=$org_id;

        $this->organizations = Organization::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $this->branches = collect();
        if(!is_null($this->organization)){
            $this->selectedBranch=$branch_id;
            $this->branches = Branch::where('organization_id', $this->organization)->active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        }
    }
    public function render()
    {
        if(!is_null($this->organization)){
            $this->branches = Branch::where('organization_id', $this->organization)->active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        }
        return view('livewire.admin.references.org-branch');
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
