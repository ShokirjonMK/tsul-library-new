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

class AddingBookRfidToBranchComponent extends Component
{
    public $book_id, $rfid_tag, $branch_id, $department_id, $arrived_year, $kutubxonada_bor = true, $elektronni_bor = true, $isActive = true, $summarka_raqam, $copies = 0;

    public $book_inventars, $updateMode = false, $book, $roles, $perPage = 20, $isRFIDSave = true;
    public $organizations, $organization_id, $branches, $departments, $book_informations, $book_information_id;

    public function mount($book_id, $rfid_tag)
    {
        $this->book_id = $book_id;
        $this->rfid_tag = $rfid_tag;

        $this->roles = Auth::user()->getRoleNames()->toArray();
        if (count($this->roles) > 0) {
            $user = Auth::user()->profile;
            if ($user != null) {
                $this->organization_id = $user->organization_id;
                $this->branch_id = $user->branch_id;
                $this->department_id = $user->department_id;
            }
        }
        $oldBookInventar = BookInventar::where('organization_id', '=', $this->organization_id)->where('rfid_tag_id', '=', $rfid_tag)->first();
        if($oldBookInventar != null){
            $this->isRFIDSave = false;
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
            $this->departments = Department::with(['translations', 'organization', 'branch', 'organization.translations', 'branch.translations'])->where('organization_id', $this->organization_id)->where('branch_id', $this->branch_id)->active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
            if ($this->departments->count() == 0) {
                $this->departments = [];
                $this->department_id = null;
            }
            // $this->departments = Department::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        } else {
            $this->departments = [];
            $this->department_id = null;
        }


        return view('livewire.admin.books.adding-book-rfid-to-branch-component');
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
                'organization_id.required' => __('The :attribute field is required.'),
                'branch_id.required' => __('The :attribute field is required.'),
                'department_id.required' => __('The :attribute field is required.'),
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

            $last = BookInventar::orderByRaw('bar_code * 1 desc')->where('organization_id', '=', $this->organization_id)->whereNotNull('book_id')->limit(1)->first();
            $informationId=null;
            $old_book_informations = BookInformation::where('book_id', '=', $this->book_id)->where('deportmetn_id', '=', $this->department_id)->where('branch_id', '=', $this->branch_id)->get();

            if ($old_book_informations->count() == 0) {
                $bookInformation = BookInformation::create($input);
                $informationId = $bookInformation->id;
            } else {
                $informationId = $old_book_informations[0]->id;
            }


            $lN =0;
            if($last != null){
                $lN =filter_var($last->bar_code, FILTER_SANITIZE_NUMBER_INT);
            }
            $lN +=1;

            $generatedBarcode = BookInventar::generateNumber($lN);
            $inventarData = [
                'isActive' => true,
                'book_id' => $this->book_id,
                'book_information_id' => $informationId,
                'organization_id' => $this->organization_id,
                'branch_id' => $this->branch_id,
                'deportmetn_id' => $this->department_id,
                'key' => null,
                'bar_code' => $generatedBarcode,
                'inventar_number' => $lN,
                'inventar' => $lN,
                'rfid_tag_id' => $this->rfid_tag,
            ];

//            $bookInventar = BookInventar::where('organization_id', '=', $this->organization_id)->where('bar_code', '=', $generatedBarcode)->whereNotNull('book_id')->first();

//            if ($bookInventar == null) {
//            }
            $bookInventar = BookInventar::create($inventarData);


            DB::commit();
            redirect()->to( app()->getLocale().'/admin/books/rfidshow'.$this->rfid_tag.'/'.$this->book_id);
            $this->resetInput();
        } catch (\Exception $e) {
            DB::rollback();
            // Send error back to user
        }
        // return redirect()->to( app()->getLocale().'/admin/books/'.$this->book_id);

    }
}
