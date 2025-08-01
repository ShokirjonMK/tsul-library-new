<?php

namespace App\Http\Livewire\Admin\Qarzdorlar;

use App\Models\BookInventar;
use App\Models\Debtor;
use App\Models\User;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class KitobOlishBerish extends Component
{
    use LivewireAlert;

    public $gtin, $book, $user, $userId;
    public $total_in_cart = 0, $items, $isUser = false, $userProfile, $debtors;

    protected $listeners = [
        'getLatitudeForInput',
        'updateCartValueToDays',
        'cartUpdated' => '$refresh'
    ];



    public function getLatitudeForInput($value)
    {

        if (!is_null($value)) {
            $this->addToCartProduct($value);
            $this->gtin = $value;
        }
        // $this->latitud = null;
        $this->gtin = null;
    }
    public function render()
    {
        $this->userId = 'kitobolber' . auth()->user()->id; // or any string represents user identifier

        \Cart::session($this->userId);
        $this->total_in_cart = count(\Cart::session($this->userId)->getContent()->toArray());
        $this->items = \Cart::session($this->userId)->getContent()->toArray();

        return view('livewire.admin.qarzdorlar.kitob-olish-berish');
    }
    public function courseSelected()
    {
        $this->addToCartProduct($this->gtin);
    }

    protected function addToCartProduct($gtin)
    {
       
        $gtin = trim($gtin);
        if ($gtin != null) {
            $type = null;
            if (strtolower($gtin[0]) == 'f') {
                $isUser = User::where('inventar_number', '=', $gtin)->first();
                

                if (isset($isUser) & $isUser != null) {
                    $this->user = User::where('inventar_number', '=', $gtin)->first();
                    $this->debtors = Debtor::where('reader_id', '=', $this->user->id)->where('status', '=', Debtor::$GIVEN)->orderBy('return_time',  'ASC')->get();
                    
                    $type = 'user';
                    $this->isUser = true;
                    $this->userProfile = $this->user->profile;
                } else {
                    $this->debtors = null;
                    $this->user = null;
                    $this->isUser = false;
                    $this->userProfile = null;
                }
            } else {
                 
                $this->book = BookInventar::where('bar_code', '=', $gtin)->whereNotNull("book_id")->first();
                 
                if ($this->book != null && $this->book->isActive == BookInventar::$ACTIVE) {
                    $type = 'book';
                }
                if ($this->book != null && $this->book->isActive == BookInventar::$GIVEN) {

                    $this->alert('error', __('The book was taken by another reader!'));
                    $this->gtin = null;
                    return;
                }
                if ($this->book != null && $this->book->isActive == BookInventar::$WAREHOUSE) {

                    $this->alert('error', __('The book was removed or sent to warehouse!'));
                    $this->gtin = null;
                    return;
                }
            }

            if ($this->isUser && $type == 'user') {
                $this->alert('success', __('User has found!'));
                 
                $this->gtin = null;
            } elseif ($type == 'book') {
                if ($this->total_in_cart > 0) {
                    foreach (\Cart::session($this->userId)->getContent()->toArray() as $k => $v) {
                        if ($v['attributes']['gtin'] == $gtin) {
                            $this->alert('warning', __('Item has already selected!'));
                            $this->gtin = null;
                            return false;
                        }
                    }
                }

                if ($this->book != null) {
                    \Cart::session($this->userId)->add([
                        'id' => $this->book->id,
                        'name' => $this->book->book->dc_title,
                        'price' => 0,
                        'quantity' => 10,
                        'product_id' => null,
                        'color_id' => null,
                        'attributes' => array(
                            'gtin' => $gtin,
                            'type' => $type,
                            'image_path' => $this->book->book->image_path,
                            'book_id' => $this->book->book_id,
                            'book_information_id' => $this->book->book_information_id,
                            'book_inventar_id' => $this->book->id,
                            'how_many_days' => 10,
                            'authors' => json_decode($this->book->book->dc_authors),
                            'subjects' => json_decode($this->book->book->dc_subjects),
                        )
                    ]);
                }
                $this->alert('success', __('Book Added to Cart Successfully!'));
                $this->gtin = null;
            } else {
                $this->alert('error', __('Item not found!'));
                $this->gtin = null;
            }
        }
    }


    public function saveAllCart()
    {
        if ($this->user != null && count($this->items) > 0) {

            // 'qaytarish_vaqti' => date("Y-m-d", $qaytarish_vaqti),
            // 'olgan_vaqti' => date("Y-m-d"),
            $finalArray = array();
            $branch_id = null;
            $department_id = null;
            if ($this->user->profile) {
                $branch_id = $this->user->profile->branch_id;
                $department_id = $this->user->profile->department_id;
            }
            foreach ($this->items as $key => $value) {
                $qaytarish_vaqti = strtotime(date("Y-m-d") . "+ " . $value['quantity'] . " days");
 
                array_push(
                    $finalArray,
                    array(
                        'status' => Debtor::$GIVEN,
                        'taken_time' => date("Y-m-d"),
                        'return_time' => date("Y-m-d", $qaytarish_vaqti),
                        'count_prolong' => 1,
                        'how_many_days' => $value['quantity'],
                        'reader_id' => $this->user->id,
                        'book_id' => $value['attributes']['book_id'],
                        'book_information_id' => $value['attributes']['book_information_id'],
                        'book_inventar_id' => $value['attributes']['book_inventar_id'],
                        'branch_id' => $branch_id,
                        'department_id' => $department_id,
                        "created_at" =>  \Carbon\Carbon::now(),
                        'created_by' =>  auth()->user()->id,
                    )
                );

                \App\Models\BookInventar::changeStatus($value['attributes']['book_inventar_id'], BookInventar::$GIVEN);
            };
            Debtor::insert($finalArray);
            $this->alert('success', __('Books has successfully given!'));
            $this->clearAllCart();
        } else {
            $this->alert('warning', __('Please select user!'));
        }
    }
    public function clearAllCart()
    {

        \Cart::session($this->userId)->clear();
        $this->user = null;
        $this->isUser = false;
        $this->debtors = null;
        // $this->clearSessionData();
        $this->alert('warning', __('All Item Cleared Successfully!'));
    }
    public function removeCartInput($id)
    {

        \Cart::session($this->userId)->remove($id);
        $this->alert('success', __('Item has removed!'));
    }
    public function updateCartValueToDays($cartId, $days)
    {

        if ($days > 0) {
            \Cart::session($this->userId)->update($cartId, [
                'quantity' => [
                    'relative' => false,
                    'value' => $days
                ]
            ]);
            $this->alert('success', __('Item added successfully!'));

            $this->emit('cartUpdated');
            return redirect()->to(app()->getLocale() . '/admin/take-give');
        } else {
            $this->removeCartInput($cartId);
        }
    }

    public function accept($debtor_id)
    {
        $debtor = Debtor::find($debtor_id);
        if ($debtor != null) {
            $debtor->status = Debtor::$TAKEN;
            $debtor->returned_time = date("Y-m-d");
            $debtor->updated_at  = \Carbon\Carbon::now();
            $debtor->updated_by = auth()->user()->id;
            $debtor->save();
            \App\Models\BookInventar::changeStatus($debtor->book_inventar_id, BookInventar::$ACTIVE);
            $this->alert('success', __('Book accepted successfully!'));
            $this->debtors = Debtor::where('reader_id', '=', $this->user->id)->where('status', '=', Debtor::$GIVEN)->orderBy('return_time',  'ASC')->get();
        }
    }

    public function acceptAll()
    {
        if ($this->debtors != null && $this->debtors->count() > 0) {
            foreach ($this->debtors as $k => $v) {
                $debtor = Debtor::find($v->id);
                if ($debtor != null) {
                    $debtor->status = Debtor::$TAKEN;
                    $debtor->returned_time = date("Y-m-d");
                    $debtor->updated_at  = \Carbon\Carbon::now();
                    $debtor->updated_by = auth()->user()->id;
                    $debtor->save();
                    \App\Models\BookInventar::changeStatus($debtor->book_inventar_id, BookInventar::$ACTIVE);
                    // $this->debtors = Debtor::where('reader_id', '=', $this->user->id)->where('status', '=', Debtor::$GIVEN)->orderBy('return_time',  'ASC')->get();
                }
            }
            $this->alert('success', __('Book accepted successfully!'));
            $this->clearAllCart();
        }
    }
}
