<?php

namespace App\Livewire;

use App\Http\Requests\ContactFormRequest;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactForm extends Component
{
    public $email;
    public $name;
    public $message;

    public function rules()
    {
        return (new ContactFormRequest())->rules();
    }

    public function render()
    {
        return view('livewire.contact-form');
    }

    public function updated($propertyName)
    {
        return $this->validateOnly($propertyName);
    }

    public function send()
    {
        $validated = $this->validate();
        Mail::to('21as0031_ms@psu.edu.ph')->send(new ContactMail($validated));
        $this->reset();
        session()->flash('success', 'Thanks for contacting us. We will get back to you soon.');
        return redirect()->route('dashboard');
    }
}
