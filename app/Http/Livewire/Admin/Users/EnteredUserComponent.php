<?php

namespace App\Http\Livewire\Admin\Users;

use App\Http\Middleware\User;
use App\Models\UserProfile;
use Livewire\Component;

class EnteredUserComponent extends Component
{
    public $user_id, $perPage = 20;
    public $fromDate, $toDate;

    public function mount($user_id)
    {
        $this->user_id = $user_id;
    }
    public function resetFilters()
    {
        $this->fromDate = null;
        $this->toDate = null;
    }

    public function render()
    {
        $query = UserProfile::where('created_by', $this->user_id);

//        $users = UserProfile::where('created_by', $this->user_id)->orderBy('created_at', 'DESC')->paginate($this->perPage);
        // Apply date range filter if both dates are set
        if ($this->fromDate && $this->toDate) {
            $query->whereBetween('created_at', [$this->fromDate, $this->toDate]);
        }
        $users = $query->orderBy('created_at', 'DESC')->paginate($this->perPage);

        return view('livewire.admin.users.entered-user-component', ['users' => $users]);
    }

}
