{{-- resources/views/posts/show.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->caption }}</title>
</head>
<body>
    <div class="post-details">
        <h1>{{ $post->caption }}</h1>
        <p>Posté par : {{ $post->user->name }}</p>
        <p>Posté le : {{ $post->created_at->format('d M Y') }}</p>

        @if($post->image_path)
            <img src="{{ asset('storage/' . $post->image_path) }}" alt="Image du post">
        @endif

        <p>{{ $post->description ?? 'Aucune description.' }}</p>

        {{-- Bouton Like/Déliker --}}
        <form action="{{ route('posts.like', $post) }}" method="POST">
            @csrf
            @if(Auth::user()->likedPosts->contains($post->id))
                <button type="submit">Retirer le Like</button>
            @else
                <button type="submit">Aimer</button>
            @endif
        </form>
    </div>

    <a href="{{ route('posts.index') }}">Retour à la liste des posts</a>
</body>
</html>

