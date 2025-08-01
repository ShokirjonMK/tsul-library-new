<?php

namespace App\Http\Livewire\Admin\Books;

use App\Models\Book;
use App\Models\BookInformation;
use App\Models\BookInventar;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Organization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;

class AddBookData extends Component
{
    use LivewireAlert;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $book_id, $branch_id, $department_id, $arrived_year, $kutubxonada_bor = true, $elektronni_bor = true, $isActive = true, $summarka_raqam, $copies = 0;
    public $organizations, $organization_id, $branches, $departments, $book_informations, $book_information_id;
    public $book_inventars, $updateMode = false, $book, $roles,  $perPage = 20;
 
    public function mount($book_id)
    {
        $this->book_id = $book_id;
        $this->book = Book::find($book_id);
        $this->roles = Auth::user()->getRoleNames()->toArray();
        if (count($this->roles) > 0) {
            $user = Auth::user()->profile;
            if ($user != null) {
                $this->organization_id = $user->organization_id;
                $this->branch_id = $user->branch_id;
                $this->department_id = $user->department_id;
            }
        }
    }
    public function render()
    {
        if (in_array('SuperAdmin', $this->roles)) {
            $this->book_informations = BookInformation::where('book_id', '=', $this->book_id)->get();
        } else {
            $this->book_informations = BookInformation::where('book_id', '=', $this->book_id)->where('organization_id', $this->organization_id)->get();
        }

        $this->organizations = Organization::with('translations')->active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');

        if (!is_null($this->organization_id)) {
            $this->branches = Branch::with('translations')->where('organization_id', $this->organization_id)->active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
            if ($this->branches->count() == 0) {
                $this->branches = [];
                $this->branch_id = null;
            }
        } else {
            $this->branches = [];
            $this->branch_id = null;
        }
        if ($this->organization_id > 0 && $this->branch_id > 0) {
            $this->departments = Department::with(['translations', 'organization', 'branch', 'organization.translations',  'branch.translations'])->where('organization_id', $this->organization_id)->where('branch_id', $this->branch_id)->active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
            if ($this->departments->count() == 0) {
                $this->departments = [];
                $this->department_id = null;
            }
            // $this->departments = Department::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        } else {
            $this->departments = [];
            $this->department_id = null;
        }


        $bookinventars = BookInventar::with(['bookInformation', 'organization', 'branch', 'department', 'organization.translations',  'branch.translations', 'department.translations'])->where('book_id', '=', $this->book_id)->where('organization_id', $this->organization_id)->orderBy('id', 'desc')->paginate($this->perPage);

        $data = [
            'bookinventars' => $bookinventars,
        ];

        return view('livewire.admin.books.add-book-data', $data);
    }

    private function resetInput()
    {
        // $this->organization_id = null;
        // $this->branch_id = null;
        // $this->department_id = null;
        $this->arrived_year = null;
        $this->summarka_raqam = null;
        $this->kutubxonada_bor = true;
        $this->elektronni_bor = true;
        $this->copies = 0;
        $this->isActive = true;
    }
    public function save()
    {
        $this->validate(
            [
                'organization_id' => 'required',
                'branch_id' => 'required',
                'department_id' => 'required',
            ],
            [
                'organization_id.required' =>  __('The :attribute field is required.'),
                'branch_id.required' =>  __('The :attribute field is required.'),
                'department_id.required' =>  __('The :attribute field is required.'),
            ],
            [

                'organization_id' => __('Organization'),
                'branch_id' => __('Branches'),
                'department_id' => __('Departments'),
            ]
        );

        $input = [
            'isActive' => true,
            'organization_id' => $this->organization_id,
            'summarka_raqam' => $this->summarka_raqam,
            'arrived_year' => $this->arrived_year,
            'kutubxonada_bor' => $this->kutubxonada_bor,
            'elektronni_bor' => $this->elektronni_bor,
            'branch_id' => $this->branch_id,
            'deportmetn_id' => $this->department_id,
            'book_id' => $this->book_id,
        ];
       
        DB::beginTransaction();
        try {
             
            $old_book_informations = BookInformation::where('book_id', '=', $this->book_id)->where('deportmetn_id', '=', $this->department_id)->where('branch_id', '=', $this->branch_id)->get();

            if ($old_book_informations->count() == 0) {
                $bookInformation = BookInformation::create($input);
                $informationId = $bookInformation->id;
            } else {
                $informationId = $old_book_informations[0]->id;
            }

            if ($this->copies > 0) {
                BookInventar::generateInventars($this->book_id, $informationId, $this->branch_id, $this->department_id, $this->organization_id, intval($this->copies));
                $this->alert('success',  __('Successfully saved'));
            } elseif ($this->copies == 0 && $old_book_informations->count() > 0) {
                $this->alert('warning',  __('This data has already exist please fill another one!'));
            }
            DB::commit();
            $this->resetInput();
        } catch (\Exception $e) {
            DB::rollback();
            // Send error back to user
        }
        // return redirect()->to( app()->getLocale().'/admin/books/'.$this->book_id);        

    }

    public function edit($id)
    {
        $book_info = BookInformation::findOrFail($id);

        $this->book_information_id = $id;

        $this->organization_id = $book_info->organization_id;
        $this->branch_id = $book_info->branch_id;
        $this->department_id = $book_info->deportmetn_id;

        $this->isActive = $book_info->isActive;
        $this->arrived_year = $book_info->arrived_year;
        $this->summarka_raqam = $book_info->summarka_raqam;
        $this->kutubxonada_bor = $book_info->kutubxonada_bor;
        $this->elektronni_bor = $book_info->elektronni_bor;
        $this->book_id  = $book_info->book_id;
        $this->updateMode = true;
    }
    public function update()
    {
        $this->validate(
            [
                // 'arrived_year' => 'required|min:2',
                'organization_id' => 'required',
                'branch_id' => 'required',
                'department_id' => 'required',
            ],
            [
                // 'arrived_year.required' =>  __('The :attribute field is required.'),
                'organization_id.required' =>  __('The :attribute field is required.'),
                'branch_id.required' =>  __('The :attribute field is required.'),
                'department_id.required' =>  __('The :attribute field is required.'),
            ],
            [
                // 'arrived_year' => __('Arrived Year'),
                'organization_id' => __('Organization'),
                'branch_id' => __('Branches'),
                'department_id' => __('Departments'),
            ]
        );
        if ($this->book_information_id) {
            $record = BookInformation::find($this->book_information_id);
            
            $input = [
                'isActive' => $this->isActive,
                'summarka_raqam' => $this->summarka_raqam,
                'arrived_year' => $this->arrived_year,
                'kutubxonada_bor' => $this->kutubxonada_bor,
                'elektronni_bor' => $this->elektronni_bor,
                'organization_id' => $this->organization_id,
                'branch_id' => $this->branch_id,
                'deportmetn_id' => $this->department_id,
                'book_id' => $this->book_id,
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
            $record = BookInformation::find($id);
            $record->isActive = false;
            $record->save();
            // $record->delete();
        }
    }
}
