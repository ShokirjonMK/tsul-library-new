<?php

namespace App\Http\Livewire\Site;

use App\Models\Contact;
use App\Models\Social;
use Livewire\Component;

class Header extends Component
{
    public $contact=null, $socials=null;

    public function render()
    { 
        $this->contact= Contact::with('translation')->orderBy('id', 'desc')->main()->first();
        $this->socials= Social::orderBy('order', 'ASC')->main()->get();
 
        return view('livewire.site.header');
    }
}
