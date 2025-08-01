<?php

namespace App\Http\Livewire\Admin\Books;

use App\Models\Debtor;
use Livewire\Component;

class DebtorStatistics extends Component
{
    public $user_id, $perPage=20;
    public function mount($user_id)
    {
        $this->user_id=$user_id;
    }

    public function render()
    {
        $debtors = Debtor::where('reader_id', $this->user_id)->orderBy('return_time', 'asc')->orderBy('status', 'ASC')->paginate($this->perPage);
       

        $data = [
            'debtors' => $debtors,
        ];

        return view('livewire.admin.books.debtor-statistics', $data);
    }
}
