<?php

namespace App\Http\Livewire\Admin\Books;

use App\Models\Book;
use App\Models\BookAct;
use App\Models\Where;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class AddGetBookActs extends Component
{
    use LivewireAlert;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $book_id, $organization_id, $branch_id, $department_id, $where_id, $selected_id, $price=0, $summarka_raqam, $arrived_date, $wheres, $book, $roles, $book_acts;

    public $updateMode = false;

    public function mount($book_id)
    {
        $this->book_id = $book_id;
        $this->book = Book::find($book_id);
        $this->roles = Auth::user()->getRoleNames()->toArray();
        if(count($this->roles)>0){ 
            $user = Auth::user()->profile;
            
            if($user != null){
                $this->organization_id = $user->organization_id;
                $this->branch_id = $user->branch_id;
                $this->department_id = $user->department_id;
            }
        }
    }
    public function render()
    {
        $this->wheres = Where::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');

        if (in_array('SuperAdmin', $this->roles)){
            $this->book_acts = BookAct::with(['wheres', 'wheres.translation'])->where('book_id', '=', $this->book_id)->get();
        }else{
            $this->book_acts = BookAct::with(['wheres', 'wheres.translation'])->where('book_id', '=', $this->book_id)->where('organization_id', $this->organization_id)->get();
        }
      
        return view('livewire.admin.books.add-get-book-acts');
    }


    private function resetInput()
    {
        $this->where_id = null;
        $this->price = 0;
        $this->summarka_raqam = null;
        $this->arrived_date = null; 

    }
    public function store()
    {
         
        $this->validate([
            'summarka_raqam' => 'required',
            'where_id' => 'required',
            'arrived_date' => 'required',
        ],
        [
            'summarka_raqam.required' =>  __('The :attribute field is required.'),
            'where_id.required' =>  __('The :attribute field is required.'),
            'arrived_date.required' =>  __('The :attribute field is required.'),
        ],
        [
            'summarka_raqam' => __('Summarka Raqam'),
            'where_id' => __('Where'),
            'arrived_date' => __('Arrived Year'),
        ]);
        $data=[
            'where_id' => $this->where_id,
            'summarka_raqam' => $this->summarka_raqam,
            'price' => $this->price,
            // 'arrived_date' => $this->arrived_date,
            // 'arrived_year' => date('Y',strtotime($this->arrived_date)),
            'arrived_year' => $this->arrived_date,
            // 'arrived_month' => date('m',strtotime($this->arrived_date)),
            // 'arrived_day' => date('d',strtotime($this->arrived_date)),
            'book_id' => $this->book_id,
            'organization_id' => $this->organization_id,
            'branch_id' => $this->branch_id,
            'department_id' => $this->department_id,
        ];
 
        BookAct::create($data);
        $this->resetInput();
        $this->alert('success',  __('Successfully saved'));

    }
    public function edit($id)
    {
        $record = BookAct::findOrFail($id); 
        $this->selected_id = $id;
        $this->where_id = $record->where_id;
        $this->summarka_raqam = $record->summarka_raqam;
        $this->price = $record->price;
        $this->arrived_date = $record->arrived_year;

        $this->updateMode = true;

    }
    public function update()
    {
        $this->validate([
            'selected_id' => 'required|numeric',
            'summarka_raqam' => 'required',
            'where_id' => 'required',
            'arrived_date' => 'required',
        ],
        [
            'summarka_raqam.required' =>  __('The :attribute field is required.'),
            'where_id.required' =>  __('The :attribute field is required.'),
            'arrived_date.required' =>  __('The :attribute field is required.'),
        ],
        [
            'summarka_raqam' => __('Summarka Raqam'),
            'where_id' => __('Where'),
            'arrived_date' => __('Arrived Year'),
        ]);
        if ($this->selected_id) {
            $record = BookAct::find($this->selected_id);
            $record->update([
                'where_id' => $this->where_id,
                'summarka_raqam' => $this->summarka_raqam,
                'price' => $this->price,
                'arrived_year' => $this->arrived_date,
                // 'arrived_date' => $this->arrived_date,
                // 'arrived_year' => date('Y',strtotime($this->arrived_date)),
                // 'arrived_month' => date('m',strtotime($this->arrived_date)),
                // 'arrived_day' => date('d',strtotime($this->arrived_date)),
                'book_id' => $this->book_id,
                'organization_id' => $this->organization_id,
                'branch_id' => $this->branch_id,
                'department_id' => $this->department_id,    
            ]);
            $this->resetInput();
            $this->updateMode = false;
            $this->alert('success',  __('Successfully saved'));

        }
    }
    public function destroy($id)
    {
        if ($id) {
            if (in_array('SuperAdmin', $this->roles)){
    
                $record = BookAct::where('id', $id);
                $record->delete();
                $this->alert('success',  __('Successfully deleted'));
            }else{
                $this->alert('warning',  __('You do not have the super admin role and you cannot delete it!'));
            }
 
        }
    }

}
