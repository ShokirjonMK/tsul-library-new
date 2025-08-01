<?php

namespace App\Http\Livewire\Admin\Qarzdorlar;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class KitobOlishBerishUpdate extends Component
{
    use LivewireAlert;


    public $cartItems = [];
    public $quantity = 1, $total_quantity, $userId;
    protected $listeners = [
        'cartUpdated' => '$refresh'
    ];
    public function mount($item)
    {
       
        $this->cartItems = $item;

        $this->quantity = $item['quantity'];
    }
    public function updateCart()
    {
        \Cart::session($this->userId)->update($this->cartItems['id'], [
            'quantity' => [
                'relative' => false,
                'value' => $this->quantity
            ]
        ]);
        $this->alert('success', __('Item added successfully!'));
          
         
        $this->emit('cartUpdated');
            
    }
    public function render()
    {
        $this->userId = 'kitobolber' . auth()->user()->id; // or any string represents user identifier

        return view('livewire.admin.qarzdorlar.kitob-olish-berish-update');
    }
}
