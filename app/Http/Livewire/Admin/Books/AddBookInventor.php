<?php

namespace App\Http\Livewire\Admin\Books;

use App\Models\BookInformation;
use App\Models\BookInventar;
use Livewire\Component;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;

class AddBookInventor extends Component
{
    use LivewireAlert;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public Collection $inputs;
    public $book_inventars, $isActive = true, $book_inventar_id, $book_information_id, $book_id, $IsActive, $organization_id, $branch_id, $deportmetn_id, $book_information, $book;

    public $updateMode = false, $inventar_number, $inventarNumberGenerator, $bar_code, $key, $from, $to, $inventar, $deleteId,  $perPage = 20;
    public $current_roles, $current_user;
    public function mount($infoid, $inventar_id = null)
    {

        $this->current_roles = Auth::user()->getRoleNames()->toArray();
        $this->current_user = Auth::user()->profile;

        $str_arr = explode("&", $infoid);
        if (count($str_arr) == 2) {
            $infoid = $str_arr[0];
            $this->edit($str_arr[1]);
        }

        $this->book_information_id = $infoid;
        $this->book_information = BookInformation::find($infoid);
        $this->book_id = $this->book_information->book->id;
        $this->book = $this->book_information->book;

        $this->organization_id = $this->book_information->organization_id;
        $this->branch_id = $this->book_information->branch_id;
        $this->deportmetn_id = $this->book_information->deportmetn_id;

        $this->fill([
            'inputs' => collect([
                ['inventar_number' => '', 'barcode' => ''],
            ]),
        ]);
    }
    public function render()
    {

        $bookinventars = BookInventar::with(['createdBy', 'updatedBy'])->where('book_id', '=', $this->book_id)->where('book_information_id', '=', $this->book_information_id)->where('branch_id', '=', $this->branch_id)->where('deportmetn_id', '=', $this->deportmetn_id)->orderBy('id', 'desc')->paginate($this->perPage);

        $this->book_information = BookInformation::find($this->book_information_id);
        $data = [
            'bookinventars' => $bookinventars,
        ];
        return view('livewire.admin.books.add-book-inventor', $data);
    }

    public function generate()
    {
        $this->validate(
            [

                'from' => 'required',
                'to' => 'required',
            ],
            [
                'from.required' =>  __('The :attribute field is required.'),
                'to.required' =>  __('The :attribute field is required.'),
            ],
            [
                'from' => __('from'),
                'to' => __('to'),
            ]
        );
        if ($this->from < $this->to) {
            DB::beginTransaction();
            try {
                $count = 1;
                for ($i = $this->from; $i <= $this->to; $i++) {
                    $bookInventar = null;
                    $key = trim($this->key);
                    $generatedBarcode = null;

                    if ($key == BookInventar::$TYPE_UK && $this->inventarNumberGenerator != null) {

                        $ukInventarNumbers = preg_replace('/[^0-9]/', '', $this->inventarNumberGenerator);

                        // $letters = preg_replace('/[^a-zA-Z]/', '', $this->inventarNumberGenerator);
                        $generatedBarcode = BookInventar::generateNumber($ukInventarNumbers);

                        $inventarData = [
                            'isActive' => true,
                            'book_id' => $this->book_id,
                            'book_information_id' => $this->book_information_id,
                            'organization_id' => $this->organization_id,
                            'branch_id' => $this->branch_id,
                            'deportmetn_id' => $this->deportmetn_id,
                            'key' => $key,
                            'bar_code' => BookInventar::$TYPE_UK . $i . $generatedBarcode,
                            'inventar_number' => $this->inventarNumberGenerator,
                            'inventar' => BookInventar::$TYPE_UK . $i . $ukInventarNumbers,
                        ];
                        $bookInventar = BookInventar::where('bar_code', '=', BookInventar::$TYPE_UK . $i . $generatedBarcode)->where('organization_id', '=', $this->organization_id)->first();
                    } elseif ($key == BookInventar::$TYPE_SOVGA) {
                        // $generatedBarcode = BookInventar::generateNumber($i);

                        $ukInventarNumbers = preg_replace('/[^0-9]/', '', $this->inventarNumberGenerator);
                        $letters = preg_replace('/[^a-zA-Z]/', '', $this->inventarNumberGenerator);
                        $inventarData = [
                            'isActive' => true,
                            'book_id' => $this->book_id,
                            'book_information_id' => $this->book_information_id,
                            'organization_id' => $this->organization_id,
                            'branch_id' => $this->branch_id,
                            'deportmetn_id' => $this->deportmetn_id,
                            'key' => $key,
                            'bar_code' => BookInventar::$TYPE_SOVGA . '' . $count . '' . $i,
                            'inventar_number' => $this->inventarNumberGenerator . ' ' . $i,
                            'inventar' => BookInventar::$TYPE_SOVGA . '' . $count  . '' . $i,
                        ];
                         $bookInventar = BookInventar::where('bar_code', '=', BookInventar::$TYPE_SOVGA . '' . $count . '' . $i)->where('organization_id', '=', $this->organization_id)->first();
                    } elseif ($key == BookInventar::$TYPE_INVENTAR) {
                        $generatedBarcode = BookInventar::generateNumber($i);

                        // $ukInventarNumbers = preg_replace('/[^0-9]/', '', $this->inventarNumberGenerator);
                        $letters = preg_replace('/[^a-zA-Z]/', '', $this->inventarNumberGenerator);
                        $inventarData = [
                            'isActive' => true,
                            'book_id' => $this->book_id,
                            'book_information_id' => $this->book_information_id,
                            'organization_id' => $this->organization_id,
                            'branch_id' => $this->branch_id,
                            'deportmetn_id' => $this->deportmetn_id,
                            'key' => $key,
                            'bar_code' => BookInventar::$TYPE_INVENTAR . $count . $i,
                            'inventar_number' => $i,
                            'inventar' => BookInventar::$TYPE_INVENTAR . $i . $i,
                        ];
                        $bookInventar = BookInventar::where('bar_code', '=', BookInventar::$TYPE_INVENTAR . $count . $i)->where('organization_id', '=', $this->organization_id)->first();
                    } elseif ($key == BookInventar::$TYPE_DROP) {
                        $invents = explode("/", $this->inventarNumberGenerator);
                        $invent = $invents[0];
                        // $generatedBarcode = BookInventar::generateNumber(BookInventar::$TYPE_DROP . $i . $invent);

                        $inventarData = [
                            'isActive' => true,
                            'book_id' => $this->book_id,
                            'book_information_id' => $this->book_information_id,
                            'organization_id' => $this->organization_id,
                            'branch_id' => $this->branch_id,
                            'deportmetn_id' => $this->deportmetn_id,
                            'key' => $key,
                            'bar_code' => BookInventar::$TYPE_DROP . $i . $invent,
                            'inventar_number' => $invent . '/' . $i,
                            'inventar' => BookInventar::$TYPE_DROP . $i . $invent,
                        ];
                        $bookInventar = BookInventar::where('bar_code', '=', BookInventar::$TYPE_DROP . $i . $invent)->where('organization_id', '=', $this->organization_id)->first();
                    } elseif ($key == BookInventar::$TYPE_NUMLESS) {
                        $generatedBarcode = BookInventar::generateNumber(BookInventar::$TYPE_NUMLESS . $count . $i);

                        $inventarData = [
                            'isActive' => true,
                            'book_id' => $this->book_id,
                            'book_information_id' => $this->book_information_id,
                            'organization_id' => $this->organization_id,
                            'branch_id' => $this->branch_id,
                            'deportmetn_id' => $this->deportmetn_id,
                            'key' => BookInventar::$TYPE_NUMLESS,
                            'bar_code' => BookInventar::$TYPE_NUMLESS . $count . $i,
                            'inventar_number' => $i,
                            'inventar' => BookInventar::$TYPE_NUMLESS . $count . $i,
                        ];
                        $bookInventar = BookInventar::where('bar_code', '=', BookInventar::$TYPE_NUMLESS . $count . $i)->where('organization_id', '=', $this->organization_id)->first();
                    } elseif ($key == BookInventar::$TYPE_NUMLESS_SECOND) {
                        $generatedBarcode = BookInventar::generateNumber(BookInventar::$TYPE_NUMLESS_SECOND .  $i);

                        $inventarData = [
                            'isActive' => true,
                            'book_id' => $this->book_id,
                            'book_information_id' => $this->book_information_id,
                            'organization_id' => $this->organization_id,
                            'branch_id' => $this->branch_id,
                            'deportmetn_id' => $this->deportmetn_id,
                            'key' => BookInventar::$TYPE_NUMLESS_SECOND,
                            'bar_code' => $generatedBarcode,
                            'inventar_number' => $this->inventarNumberGenerator,
                            'inventar' => BookInventar::$TYPE_NUMLESS_SECOND .  $i,
                        ];
                        $bookInventar = BookInventar::where('bar_code', '=', $generatedBarcode)->where('organization_id', '=', $this->organization_id)->first();
                    } else {
                        $generatedBarcode = BookInventar::generateNumber($i);

                        $inventarData = [
                            'isActive' => true,
                            'book_id' => $this->book_id,
                            'book_information_id' => $this->book_information_id,
                            'organization_id' => $this->organization_id,
                            'branch_id' => $this->branch_id,
                            'deportmetn_id' => $this->deportmetn_id,
                            'key' => $key,
                            'bar_code' => $generatedBarcode,
                            'inventar_number' => $i,
                            'inventar' => $key . $i,
                        ];
                        $bookInventar = BookInventar::where('bar_code', '=', $generatedBarcode)->where('organization_id', '=', $this->organization_id)->first();
                    }

                    if ($bookInventar == null) {
                        $bookInventar = BookInventar::create($inventarData);
                    }
                    // $key = "";
                    $count++;
                }
                DB::commit();
                $this->alert('success',  __('Successfully saved'));
                $this->resetInputFields();
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            } catch (\Throwable $e) {
                DB::rollback();
                throw $e;
            }
        } else {
            $this->alert('error',  __('from must be less than to'));
        }
    }
    public function save()
    {
        $this->validate(
            [

                'book_id' => 'required',
                'book_information_id' => 'required',
                'branch_id' => 'required',
                'deportmetn_id' => 'required',
                'inputs.*.bar_code' => 'required|numeric',
            ],
            [
                'inputs.*.bar_code.required' =>  __('The :attribute field is required.'),
                'inputs.*.bar_code.numeric' =>  __('The :attribute must be integer.'),
                // 'inputs.*.bar_code.unique' =>  __('The :attribute has already been taken.'),
            ],
            [
                'inputs.*.bar_code' => __('Bar code'),
            ]
        );
        if ($this->inputs->count() > 0) {
            DB::beginTransaction();
            try {

                foreach ($this->inputs as $key => $value) {
                    $invent = trim($value['bar_code']);
                    // $generatedBarcode = BookInventar::generateNumber($invent);
                    $generatedBarcode = $invent;
                    // $firstEl = substr($generatedBarcode, 0, 1);
                    // if($invent=="0"){
                    //     echo "IIFFFFFFFFFFFF";
                    //     $generatedBarcode = "0". $generatedBarcode;
                    // }

                    $inventar_number = trim($value['inventar_number']);
                    $inventarIsExists =  BookInventar::where('bar_code', '=', $invent)->where('organization_id', '=', $this->organization_id)->first();

                    $pattern = "/(\d+)/";
                    $array = preg_split($pattern, $inventar_number, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
                    $key = null;
                    $barcode = $invent;
                    if (count($array) > 1) {
                        $key = $array[0];
                        $barcode = $array[1];
                    }
                    if ($inventar_number == "") {
                        $inventar_number = $invent;
                    }

                    $inventarData = [
                        'isActive' => true,
                        'book_id' => $this->book_id,
                        'book_information_id' => $this->book_information_id,
                        'organization_id' => $this->organization_id,
                        'branch_id' => $this->branch_id,
                        'deportmetn_id' => $this->deportmetn_id,
                        'inventar_number' => trim($inventar_number),
                        'inventar' => $invent,
                        'key' => $key,
                        'bar_code' => "" . $invent,
                    ];

                    if ($inventarIsExists == null) {
                        $bookInventar = BookInventar::create($inventarData);
                    } else {
                        $this->alert('error',  __("The inventar number has already been taken."));
                        $this->resetInputFields();
                        return false;
                    }
                }

                DB::commit();
                $this->alert('success',  __('Successfully saved'));

                $this->resetInputFields();
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            } catch (\Throwable $e) {
                DB::rollback();
                throw $e;
            }
        }
    }
    private function removeElementWithValue($array, $key, $value)
    {
        foreach ($array as $subKey => $subArray) {
            if ($subArray[$key] == $value) {
                unset($array[$subKey]);
            }
        }
        return $array;
    }
    public function clearPage()
    {
        // dd('/admin/books/' . $this->book_id . '/' . $this->book_information_id);
        return redirect()->to(app()->getLocale() . '/admin/books/' . $this->book_id . '/' . $this->book_information_id);
    }
    private function resetInputFields()
    {
        $this->inventar_number = '';
        $this->bar_code = null;
        $this->inventarNumberGenerator = null;
        $this->key = null;
        $this->from = null;
        $this->to = null;
        $this->fill([
            'inputs' => collect([
                ['inventar_number' => '', 'bar_code' => ''],
            ]),
        ]);
    }
    // private function resetInput()
    // {
    //     $this->branch_id = null;
    //     $this->department_id = null;
    //     $this->arrived_year = null;
    //     $this->summarka_raqam = null;
    //     $this->kutubxonada_bor = true;
    //     $this->elektronni_bor = true;
    //     $this->isActive = true;
    // }
    public function edit($id)
    {
        $book_inventar = BookInventar::findOrFail($id);
        $this->book_inventar_id = $book_inventar->id;
        $this->inventar_number = $book_inventar->inventar_number;
        $this->bar_code = $book_inventar->bar_code;
        $this->isActive = $book_inventar->isActive;
        // $this->book_information_id = $id;

        // $this->branch_id = $book_info->branch_id;
        // $this->isActive = $book_info->isActive;
        // $this->deportmetn_id = $book_info->deportmetn_id;
        // $this->arrived_year = $book_info->arrived_year;
        // $this->summarka_raqam = $book_info->summarka_raqam;
        // $this->kutubxonada_bor = $book_info->kutubxonada_bor;
        // $this->elektronni_bor = $book_info->elektronni_bor;
        // $this->book_id  = $book_info->book_id ;
        $this->updateMode = true;
        // return true;

    }
    public function update()
    {


        $this->validate(
            [
                'bar_code' => 'required|numeric|min:0|not_in:0|unique:book_inventars,bar_code,' . $this->book_inventar_id,
            ],
            [
                'bar_code.required' =>  __('The :attribute field is required.'),
                'bar_code.integer' =>  __('The :attribute must be integer.'),
                'bar_code.unique' =>  __('The :attribute has already been taken.'),
            ],
            [
                'bar_code' => __('Bar code'),
            ]
        );

        if ($this->book_inventar_id) {
            $record = BookInventar::find($this->book_inventar_id);

            $invent = trim($this->inventar_number);
            $pattern = "/(\d+)/";
            $array = preg_split($pattern, $invent, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
            $key = null;
            $barcode = $invent;

            if (count($array) > 1) {
                $key = $array[0];
                $barcode = $array[1];
            }
            $inventarData = [
                'isActive' => $this->isActive,
                'organization_id' => $this->organization_id,
                'branch_id' => $this->branch_id,
                'deportmetn_id' => $this->deportmetn_id,
                'inventar_number' => $this->inventar_number,
                'inventar' => $invent,
                'key' => $key,
                'bar_code' => $this->bar_code,
            ];

            $bookInventar = BookInventar::where('organization_id', '=', $this->current_user->organization_id)->where('bar_code', '=', BookInventar::generateNumber($this->bar_code))->whereNotNull('book_id')->first();

            if ($bookInventar == null) {
                $record->update($inventarData);
            }
            if ($bookInventar != null && ($this->book_inventar_id == $bookInventar->id)) {
                $record->update($inventarData);
            } else {
            }
            // $this->resetInput();
            $this->updateMode = false;
            $this->resetInputFields();
            $this->alert('success',  __('Successfully saved'));
            return $this->clearPage();
            // return redirect()->to(app()->getLocale() . '/admin/books/' . $this->book_id . '/' . $this->book_information_id);

            // return true;
            // return redirect()->to(app()->getLocale() . '/admin/books/' . $this->book_id);
            // return redirect()->to(app()->getLocale() . '/admin/books/' . $this->book_id . '/' . $this->book_information_id);

        }
    }
    public function addInput()
    {
        $this->inputs->push(['inventar_number' => '']);
    }

    public function removeInput($key)
    {

        $this->inputs->pull($key);
    }

    public function removeInventar($inventar_id)
    {
        $book_inventar = BookInventar::find($inventar_id);
        $book_inventar->isActive = false;
        $book_inventar->save();
    }

    public function editInventar($inventar_id)
    {
        $book_inventar = BookInventar::find($inventar_id);
        $book_inventar->isActive = true;
        $book_inventar->save();
    }

    public function deleteInventar($inventar_id)
    {
        $this->deleteId = $inventar_id;

        // $book_inventar = BookInventar::find($inventar_id);
        // $book_inventar->isActive = false;
        // $book_inventar->save();
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function delete()
    {
        if (Auth::user()->hasRole('SuperAdmin')) {
            BookInventar::find($this->deleteId)->delete();
            $this->alert('success',  __('Successfully deleted'));
        }
    }
}
