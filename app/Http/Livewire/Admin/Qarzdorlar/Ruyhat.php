<?php

namespace App\Http\Livewire\Admin\Qarzdorlar;

use App\Models\Debtor;
use Livewire\Component;

class Ruyhat extends Component
{
    public $debtors, $status = 1, $perPage = 20;

    public function render()
    {
        if ($this->status == 99) {
            $this->debtors = Debtor::with(['reader', 'reader.profile'])->orderBy('return_time', 'asc')->orderBy('status', 'ASC')->get()->unique('reader_id');
        }elseif($this->status == 98){
            $this->debtors = Debtor::with(['reader', 'reader.profile'])->whereNull('returned_time')->where('return_time', '<', date("Y-m-d"))->orderBy('return_time', 'asc')->get()->unique('reader_id');
        } else {            
            $this->debtors = Debtor::with(['reader', 'reader.profile'])->where('status', '=', $this->status)->orderBy('return_time', 'asc')->get()->unique('reader_id');
        }
        // $this->debtors = Debtor::orderBy('return_time', 'desc')->get();

        return view('livewire.admin.qarzdorlar.ruyhat');
    }

    public function show($status)
    {
        $this->status = $status;
        // $this->debtors = Debtor::where('status', '=', $status)->get();
    }
}
