<?php

namespace App\Http\Livewire\Admin\Depdrops;

use App\Models\Journal;
use App\Models\MagazineIssue;
use Livewire\Component;

class JournalMagazineDropDown extends Component
{
    public $journals, $magazines, $journal_id=null, $magazine_issue_id=null;

    public function mount($journal_id, $magazine_issue_id)
    {
        $this->journals = Journal::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $this->journal_id=$journal_id;
        $this->magazine_issue_id=$magazine_issue_id;
    }

    public function render()
    {
        if (!is_null($this->journal_id)) {
            $this->magazines = MagazineIssue::where('journal_id', $this->journal_id)->active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        }

        return view('livewire.admin.depdrops.journal-magazine-drop-down');
    }
}
