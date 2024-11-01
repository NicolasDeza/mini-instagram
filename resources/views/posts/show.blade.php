<x-app-layout>
    <div class="container mx-auto mt-8">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <!-- Correction du chemin de l'image -->
            <img src="{{ asset($post->image_path) }}" alt="Image du post" class="w-full h-64 object-cover">
            <div class="p-4">
                <h3 class="text-lg font-semibold mb-2">{{ $post->user->name }}</h3>
                <p>{{ $post->caption }}</p>
                <p class="text-sm text-gray-500 mt-2">Posté le {{ $post->created_at->format('d M Y') }}</p>
                <div class="flex justify-between items-center mt-4">
                    <div>
                        <span class="text-gray-800 font-semibold">{{ $post->likes->count() }}</span> Likes
                    </div>
                    <form action="{{ route('posts.like', $post->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="text-blue-500">Aimer</button>
                    </form>
                </div>

                <!-- Affichage des commentaires -->
                <h4 class="text-xl font-semibold mt-8">Commentaires</h4>
                @foreach($post->comments as $comment)
                    <div class="mt-4">
                        <span class="font-semibold">{{ $comment->user->name }}</span> :
                        <p>{{ $comment->content }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Bouton de désabonnement si l'utilisateur connecté suit l'auteur du post -->
    @if(Auth::user()->id !== $post->user->id && Auth::user()->following->contains($post->user))
        <form action="{{ route('follow.destroy', $post->user->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Se désabonner</button>
        </form>
    @endif
</x-app-layout>
