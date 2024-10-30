<form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="caption">Caption</label>
        <input type="text" name="caption" id="caption" required>
    </div>
    <div>
        <label for="image_path">Image</label>
        <input type="file" name="image_path" id="image_path" accept="image/*" required>
    </div>
    <button type="submit">Create Post</button>
</form>
