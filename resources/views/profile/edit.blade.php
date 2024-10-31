<x-app-layout>
    <div class="container mx-auto mt-8">
        <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-semibold mb-6">Modifier votre profil</h2>
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div class="mb-4">
                    <label for="bio" class="block text-sm font-medium text-gray-700">Bio</label>
                    <textarea name="bio" id="bio" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('bio', $user->bio) }}</textarea>
                </div>
                <div class="mb-4">
                    <label for="profile_photo_path" class="block text-sm font-medium text-gray-700">Photo de profil</label>
                    <input type="file" name="profile_photo_path" id="profile_photo_path" class="mt-1 block w-full text-sm text-gray-500">
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Sauvegarder</button>
            </form>
        </div>
    </div>
</x-app-layout>
