<x-app-layout>
    <div class="container mx-auto mt-8">
        <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-semibold mb-6">Créer un nouveau post</h2>
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="photo" class="block text-gray-700 font-medium mb-2">Photo</label>
                    <input type="file" name="photo" id="photo" class="block w-full text-gray-700 bg-gray-100 border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
                </div>

                <div class="mb-4">
                    <label for="caption" class="block text-gray-700 font-medium mb-2">Texte</label>
                    <textarea name="caption" id="caption" rows="3" class="block w-full text-gray-700 bg-gray-100 border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" placeholder="Ajouter une légende..."></textarea>
                </div>

                <button type="submit" class="w-full bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                    Publier
                </button>
            </form>
        </div>
    </div>
    @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</x-app-layout>
