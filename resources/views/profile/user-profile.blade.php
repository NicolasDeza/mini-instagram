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

            <!-- Boutons Modifier le profil ou Suivre/Se désabonner -->
            @if(Auth::id() === $user->id)
                <!-- Boutons pour l'utilisateur connecté sur son propre profil -->
                <a href="{{ route('profile.edit') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Modifier le profil</a>
                <a href="{{ route('posts.create') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Ajouter un post</a>
            @else
                <!-- Formulaire pour suivre ou se désabonner d'un autre utilisateur -->
                @if(Auth::user()->following->contains($user->id))
                <!-- Formulaire pour se désabonner -->
                <form action="{{ route('follow.destroy', ['user' => $user->id]) }}" method="POST" class="mt-4">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Se désabonner</button>
                </form>
            @else
                <!-- Formulaire pour suivre -->
                <form action="{{ route('follow.store', ['user' => $user->id]) }}" method="POST" class="mt-4">
                    @csrf
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Suivre</button>
                </form>
            @endif
        @endif

            <!-- Publications de l'utilisateur -->
            <div class="mt-8">
                <h3 class="text-xl font-semibold">Publications de {{ $user->name }}</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                    @foreach($user->posts as $post)
                        <a href="{{ route('posts.show', $post->id) }}" class="bg-white shadow-md rounded-lg overflow-hidden block">
                            @if ($post->image_path)
                                <img src="{{ asset($post->image_path) }}" alt="Image du post" class="w-full h-64 object-cover">
                            @else
                                <p class="text-gray-500 text-center p-4">Aucune image disponible</p>
                            @endif
                            <div class="p-4">
                                <p>{{ $post->caption }}</p>
                                <p class="text-sm text-gray-500 mt-2">Posté le {{ $post->created_at->format('d M Y') }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

