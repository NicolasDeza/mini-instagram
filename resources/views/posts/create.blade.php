<x-app-layout>
    <div class="container mx-auto mt-8">
        <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-semibold mb-6">Créer un nouveau post</h2>
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="caption" class="block text-sm font-medium text-gray-700">Légende</label>
                    <textarea name="caption" id="caption" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                </div>
                <div class="mb-4">
                    <label for="photo" class="block text-sm font-medium text-gray-700">Image</label>
                    <input type="file" name="photo" id="photo" class="mt-1 block w-full text-sm text-gray-500">
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Publier</button>
            </form>
        </div>
    </div>
</x-app-layout>
