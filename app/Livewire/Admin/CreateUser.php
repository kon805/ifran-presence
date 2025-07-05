<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateUser extends Component
{
    use WithFileUploads;

    public $matricule, $nom, $email, $password, $role, $photo;

    public function createUser()
    {
        if ($this->role === 'admin' && User::where('role', 'admin')->count() >= 2) {
            session()->flash('error', 'Limite de 2 administrateurs atteinte.');
            return;
        }

        $path = $this->photo ? $this->photo->store('photos', 'public') : null;

        User::create([
            'name' => $this->nom,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'matricule' => $this->matricule,
            'role' => $this->role,
            'photo' => $path,
        ]);

        session()->flash('success', 'Utilisateur créé avec succès.');

        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.create-user')
            ->layout('layouts.app');
    }
}
