<?php

namespace App\Http\Livewire\Admin\Journal;

use App\Models\MagazineIssue;
use Livewire\Component;
use Livewire\WithPagination;

class GetMagazinesByJournal extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public   $perPage = 20, $journal_id ;

    public function mount($journal_id = null)
    {
        $this->journal_id=$journal_id;
        // $this->magazineIssues = MagazineIssue::where('journal_id', '=', $journal_id)->orderBy('id', 'desc')->get();
        
    }
    public function render()
    {
        $model = MagazineIssue::where('journal_id', '=', $this->journal_id)->orderBy('id', 'desc')->paginate($this->perPage);
        $data = [
            'magazineIssues' => $model,
        ];

        return view('livewire.admin.journal.get-magazines-by-journal', $data);
    }
}
