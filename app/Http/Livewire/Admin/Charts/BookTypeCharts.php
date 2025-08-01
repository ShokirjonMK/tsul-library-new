<?php

namespace App\Http\Livewire\Admin\Charts;

use App\Models\ReferenceGender;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class BookTypeCharts extends Component
{
    public $categories = [], $data = [], $genderName = [], $genderData = [];

//    protected $listeners = [
//        'onPointClick' => 'handleOnPointClick',
//        'onSliceClick' => 'handleOnSliceClick',
//        'onColumnClick' => 'handleOnColumnClick',
//    ];
//    public function handleOnPointClick($point)
//    {
//        echo "function handleOnPointClick";
//        dd($point);
//    }
//    public function handleOnSliceClick($slice)
//    {
//        echo "function handleOnSliceClick";
//        dd($slice);
//    }
//    public function handleOnColumnClick($column)
//    {
//        echo "function handleOnColumnClick";
//        dd($column);
//    }

    public function render()
    {

        $rolesWithUsersCount = Role::withCount('users')->get();

        $genderCounts = DB::table('user_profiles')
            ->select('gender_id', DB::raw('COUNT(*) as total'))
            ->groupBy('gender_id')
            ->get();

        foreach ($genderCounts as $book) {
            $this->genderName[] = ReferenceGender::getGenderTitleById($book->gender_id);
            $this->genderData[] = $book->total;
        }
        foreach ($rolesWithUsersCount as $book) {
            $this->categories[] = $book->name;
            $this->data[] = $book->users_count;
        }

        return view('livewire.admin.charts.book-type-charts');
    }
}
