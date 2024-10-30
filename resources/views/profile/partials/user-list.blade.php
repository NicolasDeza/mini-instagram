<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des utilisateurs</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <h1 class="text-2xl font-semibold mb-4">Liste des utilisateurs</h1>
    <div class="grid gap-4">
        @foreach ($users as $user)
            <div class="bg-white p-4 rounded-lg shadow-md flex justify-between items-center">
                <div>
                    <p class="font-semibold">{{ $user->name }}</p>
                    <p class="text-gray-600">{{ $user->email }}</p>
                </div>
                <div>
                    <!-- Vérifie si l'utilisateur connecté suit cet utilisateur -->
                    @if (Auth::user()->following->contains($user->id))
    <form action="{{ route('follow.destroy', $user) }}" method="POST" class="inline">
        @csrf
        @method('DELETE') <!-- Assure que Laravel utilise la méthode DELETE -->
        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Ne plus suivre</button>
    </form>
@else
    <form action="{{ route('follow.store', $user) }}" method="POST" class="inline">
        @csrf
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Suivre</button>
    </form>
@endif

                </div>
            </div>
        @endforeach
    </div>
</body>
</html>
