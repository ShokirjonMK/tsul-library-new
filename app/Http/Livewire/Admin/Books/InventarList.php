<?php

namespace App\Http\Livewire\Admin\Books;

use App\Models\BookInventar;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination; 

class InventarList extends Component
{
    public Collection $gtins;
    public Collection $selectedGtins;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $term = "", $perPage=20; 

    public function mount(){
        $this->gtins=BookInventar::orderBy('id', 'desc')->get();
        $this->selectedGtins=collect();
    }

    public function render()
    {
        if($this->term != ''){
            $barcodes = BookInventar::where('bar_code', 'like', '%'.$this->term.'%')
            // ->orWhere('gtin', 'like', '%'.$this->term.'%')
            ->orderBy('id', 'desc')->paginate($this->perPage);
        }else{
            $barcodes = BookInventar::orderBy('id', 'desc')->paginate($this->perPage);
        }
        $data = [
            'barcodes' => $barcodes,
        ];
 
        return view('livewire.admin.books.inventar-list', $data);
    }
}
