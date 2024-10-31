<x-app-layout>
    <div class="container mx-auto mt-8">
        <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
            <div class="flex items-center">
                <img src="{{ asset($user->profile_photo_path ? 'storage/' . $user->profile_photo_path : 'images/default-profile.png') }}" alt="Photo de profil" class="w-24 h-24 rounded-full">
                <div class="ml-4">
                    <h2 class="text-2xl font-semibold">{{ $user->name }}</h2>
                    <p class="text-gray-600">{{ $user->bio ?: 'Pas de bio disponible' }}</p>
                    <p class="text-sm text-gray-500">{{ $user->email }}</p>
                    <div class="mt-4">
                        <span class="font-semibold text-gray-800">{{ $user->posts->count() }}</span> Publications
                        <span class="ml-4 font-semibold text-gray-800">{{ $user->followers->count() }}</span> Abonnés
                        <span class="ml-4 font-semibold text-gray-800">{{ $user->following->count() }}</span> Abonnements
                    </div>
                </div>
            </div>
            @if(Auth::user()->id === $user->id)
                <a href="{{ route('profile.edit') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Modifier le profil</a>
            @endif
            @if(Auth::user()->id !== $user->id)
                @if(Auth::user()->following->contains($user))
                    <form action="{{ route('follow.destroy', $user->id) }}" method="POST" class="mt-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Se désabonner</button>
                    </form>
                @else
                    <form action="{{ route('follow.store', $user->id) }}" method="POST" class="mt-4">
                        @csrf
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Suivre</button>
                    </form>
                @endif
            @endif
            <a href="{{ route('posts.create') }}" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                Ajouter un post
            </a>


        <div class="mt-8">
            <h3 class="text-xl font-semibold">Publications de {{ $user->name }}</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                @foreach($user->posts as $post)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <img src="{{ asset('storage/' . $post->image_path) }}" alt="Image du post" class="w-full h-64 object-cover">
                        <div class="p-4">
                            <p>{{ $post->caption }}</p>
                            <p class="text-sm text-gray-500 mt-2">Posté le {{ $post->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- Bouton pour ouvrir la modale -->

    </div>
</x-app-layout>
