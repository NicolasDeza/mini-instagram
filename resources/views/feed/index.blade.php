<x-app-layout>
    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-bold mb-6">Fil d'actualité</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($posts as $post)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <!-- Lien autour de l'image pour ouvrir le post individuel -->
                    <a href="{{ route('posts.show', $post->id) }}">
                        <img src="{{ asset($post->image_path) }}" alt="Image du post" class="w-full h-64 object-cover">
                    </a>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">{{ $post->user->name }}</h3>
                        <p>{{ $post->caption }}</p>
                        <p class="text-sm text-gray-500 mt-2">Posté le {{ $post->created_at->format('d M Y') }}</p>
                        <div class="flex justify-between items-center mt-4">
                            <div>
                                <span class="text-gray-800 font-semibold">{{ $post->likes->count() }}</span> Likes
                            </div>
                            <a href="{{ route('posts.show', $post->id) }}" class="text-blue-500">Voir les commentaires</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-8">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
