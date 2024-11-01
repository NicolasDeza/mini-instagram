<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;


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

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
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
        // Validation pour la création d'un post
        $validatedData = $request->validate([
            'photo' => 'required|image|max:4096',  // La photo est obligatoire et doit être une image de 4 Mo max
            'caption' => 'nullable|string|max:255', // La légende est facultative, max 255 caractères
        ]);

        $user = Auth::user();

        // Téléchargement de l'image avec move()
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $filename = time() . '_' . $request->file('photo')->getClientOriginalName(); // Nom de fichier unique
            $imagePath = 'posts/' . $filename;

            // Utilisation de move() pour déplacer le fichier
            $request->file('photo')->move(public_path('storage/posts'), $filename);
        } else {
            return back()->withErrors(['photo' => 'Le fichier image est invalide ou n’a pas pu être téléchargé.'])->withInput();
        }

        // Création du post
        $post = new Post();
        $post->user_id = $user->id;
        $post->image_path = 'storage/' . $imagePath; // Chemin accessible publiquement
        $post->caption = $validatedData['caption'];
        $post->save();

        // Redirection vers le profil avec un message de succès
        return redirect()->route('profile.show', $user->id)->with('status', 'Post publié avec succès !');
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
