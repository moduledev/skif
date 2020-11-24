<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Info extends Component
{
    public $phones;
    public $emails;
    public $messengers;
    public $social_links;

    public function mount($data)
    {
        $this->phones = $data->phones;
        $this->emails = $data->emails;
        $this->messengers = $data->messendgers;
        $this->social_links = $data->social_links;
    }

    public function render()
    {
        return view('livewire.info');
    }
}
