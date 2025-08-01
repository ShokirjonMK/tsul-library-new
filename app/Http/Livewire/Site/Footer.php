<?php

namespace App\Http\Livewire\Site;

use App\Models\Contact;
use App\Models\Social;
use Livewire\Component;

class Footer extends Component
{
    public $contact, $socials;

    public function render()
    {
        $this->contact= Contact::with('translation')->orderBy('id', 'desc')->main()->first();
        $this->socials= Social::orderBy('order', 'ASC')->main()->get();
        
        return view('livewire.site.footer');
    }
}
