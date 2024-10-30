<div class="bg-white shadow-md rounded-lg p-6">
    <h1 class="text-3xl font-semibold mb-2">{{ $user->name }}</h1>
    <p class="text-gray-600 mb-4">{{ $user->email }}</p>

    @if (Auth::user()->following->contains($user->id))
        <!-- Bouton "Ne plus suivre" -->
        <form action="{{ route('follow.destroy', $user) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Ne plus suivre</button>
        </form>
    @else
        <!-- Bouton "Suivre" -->
        <form action="{{ route('follow.store', $user) }}" method="POST">
            @csrf
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Suivre</button>
        </form>
    @endif
</div>
