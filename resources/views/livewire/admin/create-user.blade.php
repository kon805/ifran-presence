<div>
    <div class="max-w-2xl mx-auto p-6 bg-white shadow rounded-xl mt-4">
            <h2 class="text-xl font-bold mb-4">Créer un utilisateur</h2>

            @if (session('success'))
                <div class="text-green-600 mb-2">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="text-red-600 mb-2">{{ session('error') }}</div>
            @endif

            <form wire:submit.prevent="createUser" class="space-y-4">
                <div>
                    <label class="block font-medium">Matricule</label>
                    <input type="text" wire:model="matricule" class="w-full border rounded p-2">
                    @error('matricule') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block font-medium">Nom</label>
                    <input type="text" wire:model="nom" class="w-full border rounded p-2">
                    @error('nom') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block font-medium">Email</label>
                    <input type="email" wire:model="email" class="w-full border rounded p-2">
                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block font-medium">Mot de passe</label>
                    <input type="password" wire:model="password" class="w-full border rounded p-2">
                    @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block font-medium">Rôle</label>
                    <select wire:model="role" class="w-full border rounded p-2">
                        <option value="">-- Choisir un rôle --</option>
                        <option value="admin">Admin</option>
                        <option value="coordinateur">Coordinateur</option>
                        <option value="professeur">Professeur</option>
                        <option value="etudiant">Étudiant</option>
                    </select>
                    @error('role') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block font-medium">Photo</label>
                    <input type="file" wire:model="photo" class="w-full">
                    @error('photo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Créer
                </button>
            </form>
        </div>
</div>
