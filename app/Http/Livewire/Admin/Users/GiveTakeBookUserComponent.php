<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Debtor;
use Livewire\Component;

class GiveTakeBookUserComponent extends Component
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
        $query = Debtor::where('created_by', $this->user_id);
        // Apply date range filter if both dates are set
        if ($this->fromDate && $this->toDate) {
            $query->whereBetween('created_at', [$this->fromDate, $this->toDate]);
        }
        $users = $query->orderBy('created_at', 'DESC')->paginate($this->perPage);

        return view('livewire.admin.users.give-take-book-user-component', ['users' => $users]);
    }
}
