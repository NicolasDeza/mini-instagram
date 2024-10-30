<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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

        dd(Auth::user()); // Debug pour vérifier l'authentification
        $request->validate([
            'caption' => 'required|string|max:255',
            'image_path' => 'required|image|max:2048',
        ]);

        $post = new Post();
        $post->user_id = Auth::id();
        $post->caption = $request->caption;
        $post->image_path = $request->file('image_path')->store('posts', 'public');
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post créé avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
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
