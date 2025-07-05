<div>
    <div class="text-xl font-semibold mb-4">Créer une classe</div>
    <div class="max-w-3xl mx-auto mt-6 bg-white p-6 rounded shadow">
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form wire:submit.prevent="createClasse">
            <div class="mb-4">
                <label class="block font-medium">Nom de la classe</label>
                <input type="text" wire:model="nom" class="w-full border rounded p-2" placeholder="Ex: L2 Informatique">
                @error('nom') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-2">Sélectionner les étudiants</label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-2 max-h-64 overflow-y-auto border p-2 rounded">
                    @foreach ($etudiants as $etudiant)
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" value="{{ $etudiant->id }}" wire:model="selectedEtudiants">
                            <span>{{ $etudiant->name }} ({{ $etudiant->email }})</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Créer la classe
            </button>
        </form>
    </div>
</div>
