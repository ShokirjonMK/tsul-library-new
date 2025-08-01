<?php

namespace App\Http\Livewire\Admin\Statistic;

use App\Models\BooksType;
use Livewire\Component;

class BookStatistics extends Component
{
    public $user_id, $months, $years, $type, $year;
    public $message = 'Hello World!';

    public function render()
    {
        $this->months = BooksType::getMonths();
        
        $this->years = range(2021, strftime("%Y", time()));
        // $this->message="SALOM DUNYO";
        return view('livewire.admin.statistic.book-statistics');
    }
}
