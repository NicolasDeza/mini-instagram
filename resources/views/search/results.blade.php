<x-app-layout>
    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-bold mb-6">Résultats de recherche</h1>

        @if($users->isEmpty() && $posts->isEmpty())
            <p class="text-gray-700">Aucun résultat trouvé pour "{{ request('query') }}"</p>
        @else
            <!-- Section des utilisateurs -->
            @if(!$users->isEmpty())
                <h2 class="text-2xl font-semibold mb-4">Utilisateurs</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    @foreach($users as $user)
                        <div class="bg-white shadow-md rounded-lg overflow-hidden p-4">
                            <div class="flex items-center">
                                <img src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : asset('images/default-profile.png') }}"
                                     alt="Photo de profil" class="w-16 h-16 rounded-full mr-4">
                                <div>
                                    <!-- Lien vers le profil de l'utilisateur -->
                                    <a href="{{ route('user.profile', ['user' => $user->id]) }}" class="text-lg font-semibold">{{ $user->name }}</a>

                                    <p class="text-sm text-gray-600">{{ $user->email }}</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                @if(auth()->id() !== $user->id)
                                @if(auth()->user()->following->contains($user->id))
                                    <form action="{{ route('follow.destroy', ['user' => $user->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-blue-500">Se désabonner</button>
                                    </form>
                                @else
                                    <form action="{{ route('follow.store', ['user' => $user->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-blue-500">Suivre</button>
                                    </form>
                                @endif
                            @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Section des posts -->
            @if(!$posts->isEmpty())
                <h2 class="text-2xl font-semibold mb-4">Posts</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($posts as $post)
                        <div class="bg-white shadow-md rounded-lg overflow-hidden">
                            <img src="{{ asset($post->image_path) }}" alt="Image du post" class="w-full h-64 object-cover">
                            <div class="p-4">
                                <h3 class="text-lg font-semibold mb-2">{{ $post->user->name }}</h3>
                                <p>{{ $post->caption }}</p>
                                <p class="text-sm text-gray-500 mt-2">Posté le {{ $post->created_at->format('d M Y') }}</p>
                                <div class="flex justify-between items-center mt-4">
                                    <div>
                                        <span class="text-gray-800 font-semibold">{{ $post->likes->count() }}</span> Likes
                                    </div>
                                    <a href="{{ route('posts.show', $post->id) }}" class="text-blue-500">Voir le post</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @endif
    </div>
</x-app-layout>
