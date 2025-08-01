<?php

namespace App\Http\Livewire\Admin\Statistic;

use App\Models\BooksType;
use Livewire\Component;

class ManagerStatistics extends Component
{
    public $user_id, $months, $years, $type, $year;
    public $message = 'Hello World!';

    public function mount($user_id )
    {
         
        $this->user_id = $user_id;        
    }

    public function render()
    {
        // $year = (trim($request->get('year')))?trim($request->get('year')):date('Y');
        $this->year = date('Y');

        $this->months = BooksType::getMonths();
        $this->years = range(2021, strftime("%Y", time()));

        // , [
        //     'user_id' => $this->user_id,
        //     'type' => $this->type,
        //     'months' => $this->months,
        //     'years' => $this->years,
        //     'year' => $this->year,
        // ]
        return view('livewire.admin.statistic.manager-statistics');
    }
}
