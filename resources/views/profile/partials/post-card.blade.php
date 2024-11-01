<div class="post-card">

    @dump($post->image_path)

    <img src="{{ asset($post->image_path) }}" alt="Image du post" class="w-full h-48 object-cover rounded-lg">

    <div class="p-4">
        <h3 class="text-lg font-bold">{{ $post->caption }}</h3>
        <p class="text-gray-600 text-sm">Posté le {{ $post->created_at->format('d M Y') }}</p>

        <!-- Affichage du nombre de likes -->
        <p class="text-gray-600 text-sm">{{ $post->likes->count() }} j'aime</p>

        <!-- Bouton de like/unlike -->
        <form action="{{ route('like.toggle', $post->id) }}" method="POST">
            @csrf
            @if (Auth::user()->likedPosts->contains($post->id))
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded mt-2">Je n'aime plus</button>
            @else
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">J'aime</button>
            @endif
        </form>
    </div>
</div>
