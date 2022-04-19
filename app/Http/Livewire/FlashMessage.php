<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FlashMessage extends Component
{
    protected $listeners = [
        'message'
    ];

    public function render()
    {
        return view('livewire.flash-message');
    }

    public function message($data)
    {
        session()->flash('alert-' . ($data['type'] ?? 'danger'), $data['message'] ??  'Something went wrong.');
    }
}
