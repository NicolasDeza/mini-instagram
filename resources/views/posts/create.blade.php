<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un nouveau post</title>
</head>
<body>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-semibold mb-6">Créer un nouveau post</h1>

        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="caption" class="block text-sm font-medium text-gray-700">Légende</label>
                <input type="text" name="caption" id="caption" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
            </div>

            <div class="mb-4">
                <label for="image_path" class="block text-sm font-medium text-gray-700">Image</label>
                <input type="file" name="image_path" id="image_path" class="mt-1 block w-full" required>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Publier</button>
        </form>
    </div>
</body>
</html>
