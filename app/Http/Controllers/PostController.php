<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    return view('posts.create');
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Validation des données
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'bio' => 'nullable|string|max:255',
            'profile_photo_path' => 'nullable|image|max:4096',
        ]);

        // Mise à jour des informations du profil
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->bio = $validatedData['bio'] ?? $user->bio;

        // Mise à jour de la photo de profil si un fichier est téléchargé
        if ($request->hasFile('profile_photo_path') && $request->file('profile_photo_path')->isValid()) {
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }
            $user->profile_photo_path = $request->file('profile_photo_path')->store('profile_photos', 'public');
        }

        $user->save();

        return redirect()->route('profile.edit')->with('status', 'Profil mis à jour avec succès !');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->user_id == Auth::id()) { // Utilisation de Auth::id() au lieu de auth()->id()
            $post->delete();
            return redirect()->route('posts.index')->with('success', 'Post supprimé');
        }

        return redirect()->route('posts.index')->with('error', 'Action non autorisée');
    }
}
