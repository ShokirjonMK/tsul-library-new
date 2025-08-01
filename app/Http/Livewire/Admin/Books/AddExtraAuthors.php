<?php

namespace App\Http\Livewire\Admin\Books;

use App\Models\Book;
use App\Models\ExtraAuthor;
use App\Models\ExtraAuthorBook;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class AddExtraAuthors extends Component
{
    use LivewireAlert;
    use WithPagination;

    public $book_id, $updateMode = false, $book, $authorTypes, $roles,  $perPage = 20, $extra_author_book_id, $extra_author_id, $fio, $current_roles, $current_user, $organization_id, $branch_id, $deportmetn_id;

    public function mount($book_id)
    {
        $this->book_id = $book_id;
        $this->book = Book::find($book_id);
        $this->current_roles = Auth::user()->getRoleNames()->toArray();
        $this->current_user = Auth::user()->profile;
        if ($this->current_user != null) {
            $this->organization_id = $this->current_user->organization_id;
            $this->branch_id = $this->current_user->branch_id;
            $this->deportmetn_id = $this->current_user->deportmetn_id;
        } else {
            $this->organization_id = 1;
            $this->branch_id = 1;
            $this->deportmetn_id = 1;
        }
    }

    public function render()
    {
        $this->authorTypes =  ExtraAuthor::with('translations')->active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $extraAuthors = ExtraAuthorBook::where('book_id', '=', $this->book_id)->orderBy('id', 'desc')->paginate($this->perPage);
        $data = [
            'extraAuthors' => $extraAuthors,
        ];

        return view('livewire.admin.books.add-extra-authors', $data);
    }

    public function save()
    {
        $this->validate(
            [
                'extra_author_id' => 'required',
                'fio' => 'required',
            ],
            [
                'extra_author_id.required' =>  __('The :attribute field is required.'),
                'fio.required' =>  __('The :attribute field is required.'),
            ],
            [
                'extra_author_id' => __('Extra Author'),
                'fio' => __('Author'),
            ]
        );

        $input = [
            'extra_author_id' => $this->extra_author_id,
            'book_id' => $this->book_id,
            'name' => $this->fio,
        ];
        try {
            ExtraAuthorBook::create($input);
            DB::beginTransaction();
            $this->alert('success',  __('Successfully saved'));
            $this->resetInput();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            // Send error back to user
        }
        // return redirect()->to( app()->getLocale().'/admin/books/'.$this->book_id);        

    }

    public function edit($id)
    {
        $model = ExtraAuthorBook::findOrFail($id);
        $this->extra_author_book_id = $model->id;
        $this->extra_author_id = $model->extra_author_id;
        $this->fio = $model->name;
        $this->updateMode = true;
    }
    public function update()
    {
        $this->validate(
            [
                'extra_author_id' => 'required',
                'fio' => 'required',
            ],
            [
                'extra_author_id.required' =>  __('The :attribute field is required.'),
                'fio.required' =>  __('The :attribute field is required.'),
            ],
            [
                'extra_author_id' => __('Extra Author'),
                'fio' => __('Author'),
            ]
        );

        if ($this->extra_author_book_id) {
            $record = ExtraAuthorBook::find($this->extra_author_book_id);
            $input = [
                'extra_author_id' => $this->extra_author_id,
                'book_id' => $this->book_id,
                'name' => $this->fio,
            ];

            $record->update($input);
            $this->resetInput();
            $this->updateMode = false;
            // alert()->success(__('Successfully'), __('Successfully saved'));
            // return redirect()->to( app()->getLocale().'/admin/books/'.$this->book_id);        
            $this->alert('success',  __('Successfully saved'));
        }
    }
    public function destroy($id)
    {
        if ($id) {
            $record = ExtraAuthorBook::find($id)->delete();
            // $record->isActive = false;
            // $record->save();
            // $record->delete();
        }
    }

    private function resetInput()
    {
        // $this->organization_id = null;
        // $this->branch_id = null;
        // $this->department_id = null;
        $this->extra_author_id = null;
        $this->fio = null;
    }
}
