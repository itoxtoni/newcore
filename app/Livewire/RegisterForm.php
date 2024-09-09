<?php

namespace App\Livewire;

use App\Facades\Model\UserModel;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Component;

class RegisterForm extends Component
{
    #[Validate(['required', 'string', 'max:255'])]
    public $first_name = '';

    public $last_name = '';

    #[Validate(['required', 'email', 'string', 'max:255', 'unique:users'])]
    public $email = '';

    #[Validate(['required', 'string', 'max:15'])]
    public $phone = '';

    #[Validate(['required', 'date'])]
    public $birthday = '';

    #[Validate(['required', 'string', 'min:8'])]
    public $password = '';

    public function save()
    {
        $this->validate();

        return UserModel::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'birthday' => $this->birthday,
            'name' => $this->first_name.' '.$this->last_name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        session()->flash('status', 'Post successfully updated.');

        return $this->redirect('/');
    }

    public function render()
    {
        return view('livewire.register-form');
    }
}
