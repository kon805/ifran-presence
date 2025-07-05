<?php

namespace App\Livewire\Coordinateur;

use App\Models\Classe;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class CreateClasse extends Component
{
    public $nom;
    public $selectedEtudiants = [];

    public function createClasse()
    {
        $this->validate([
            'nom' => 'required|string|max:255',
            'selectedEtudiants' => 'array',
        ]);

        DB::transaction(function () {
            $classe = Classe::create(['nom' => $this->nom]);
            User::whereIn('id', $this->selectedEtudiants)
                ->update(['classe_id' => $classe->id]);
        });

        session()->flash('success', 'Classe créée et étudiants assignés.');

        $this->reset(['nom', 'selectedEtudiants']);
    }

    public function render()
    {
        $etudiants = User::where('role', 'etudiant')->get();
        return view('livewire.coordinateur.create-classe', compact('etudiants'));
    }
}
