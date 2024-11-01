<x-app-layout>
    <div class="container mx-auto mt-8">
        <div class="flex justify-between items-center mb-4">
            <a href="{{ url()->previous() }}" class="text-blue-500 hover:underline">← Retour</a>
        </div>
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="container mx-auto mt-8">
        <div class="bg-white shadow-md rounded-lg overflow-hidden max-w-3xl mx-auto">
            <!-- Affichage de l'image et des informations du post -->
            <img src="{{ asset($post->image_path) }}" alt="Image du post" class="w-full h-80 object-cover rounded-t-lg">

            <div class="p-6">
                <h3 class="text-2xl font-semibold mb-2 text-gray-800">{{ $post->user->name }}</h3>
                <p class="text-lg text-gray-700 mb-4">{{ $post->caption }}</p>
                <p class="text-sm text-gray-500">Posté le {{ $post->created_at->format('d M Y') }}</p>

                <div class="flex items-center mt-4 space-x-4">
                    <div class="text-gray-800 font-semibold">
                        <span>{{ $post->likes->count() }}</span> Likes
                    </div>

                    <form action="{{ route('posts.like', $post->id) }}" method="POST">
                        @csrf
                        @if(Auth::user()->likedPosts->contains($post->id))
                            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">Je n'aime plus</button>
                        @else
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Aimer</button>
                        @endif
                    </form>
                </div>

                <!-- Section des commentaires -->
                <h4 class="text-xl font-semibold mt-8 text-gray-800">Commentaires</h4>
                <div class="space-y-4">
                    @foreach($post->comments as $comment)
                        <div class="border-t border-gray-200 pt-4">
                            <span class="font-semibold text-gray-800">{{ $comment->user->name }}</span> :
                            <p class="text-gray-600">{{ $comment->content }}</p>
                        </div>
                    @endforeach
                </div>

                <!-- Formulaire pour ajouter un commentaire -->
                @auth
                    <form action="{{ route('comments.store', $post->id) }}" method="POST" class="mt-6">
                        @csrf
                        <textarea name="content" rows="3" class="w-full rounded-lg border-gray-300 p-2" placeholder="Ajoutez un commentaire..."></textarea>
                        <button type="submit" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Commenter</button>
                    </form>
                @endauth
            </div>
        </div>
    </div>
</x-app-layout>
