<?php

namespace App\Http\Livewire\Admin\Journal;

use App\Models\ScientificPublication;
use Livewire\Component;
use Livewire\WithPagination;

class GetArticlesByMagazine extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public   $perPage = 20, $magazine_id ;

    public function mount($magazine_id = null)
    {
        $this->magazine_id=$magazine_id;
        
    }

    public function render()
    {
        $model = ScientificPublication::with(['resTypeLang', 'resField', 'translations'])->where('key', '=', 'journal-article')->where('magazine_issue_id', '=', $this->magazine_id)->with('translations')->orderBy('id', 'desc')->paginate($this->perPage);
        $data = [
            'magazineIssues' => $model,
        ];

        return view('livewire.admin.journal.get-articles-by-magazine', $data);
    }
}
 