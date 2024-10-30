<div class="container mx-auto p-4">
    <div class="bg-white shadow-md rounded-lg p-6 flex flex-col items-center space-y-4 md:flex-row md:space-x-6">
        <!-- Photo de profil ronde -->
        @if($user->profile_photo_path)
    <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="Photo de profil">
@else
    <img src="{{ asset('images/default-profile.png') }}" alt="Photo de profil par défaut">
@endif

        <!-- Informations utilisateur -->
        <div class="text-center md:text-left">
            <h1 class="text-2xl font-semibold text-gray-800">{{ $user->name }}</h1>
            <p class="text-gray-600">{{ $user->bio ? $user->bio : 'Pas de bio disponible' }}</p>
            <p class="text-sm text-gray-500">{{ $user->email }}</p>

            <!-- Statistiques de publications et abonnements -->
            <div class="mt-4 flex justify-center md:justify-start space-x-4">
                <div>
                    <span class="font-semibold text-gray-800">{{ $user->posts->count() }}</span> Publications
                </div>
                <div>
                    <span class="font-semibold text-gray-800">{{ $user->followers->count() }}</span> Followers
                </div>
                <div>
                    <span class="font-semibold text-gray-800">{{ $user->following->count() }}</span> Abonnements
                </div>
            </div>

            <!-- Bouton pour modifier le profil -->
            <a href="{{ route('profile.edit') }}"
               class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300 transform hover:scale-105 shadow-md">
                Modifier le profil
            </a>
        </div>
    </div>

    <!-- Liste des publications -->
    <div class="mt-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Publications de {{ $user->name }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($user->posts as $post)
                <div class="bg-white shadow-md rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <img src="{{ asset('storage/' . $post->image_path) }}" alt="Image du post" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">{{ $post->caption }}</h3>
                        <p class="text-sm text-gray-500">Posté le {{ $post->created_at->format('d M Y') }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="flex justify-center mt-10">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Bouton de Test
        </button>
    </div>
</div>
