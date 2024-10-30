<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
// Dans LikeController.php
public function toggleLike(Post $post)
{
    $user = Auth::user();

    // Vérifie si l'utilisateur a déjà liké le post
    if ($user->likedPosts->contains($post->id)) {
        // Si oui, retire le like
        $user->likedPosts()->detach($post->id);
        return back()->with('success', 'Vous avez retiré votre like');
    } else {
        // Sinon, ajoute le like
        $user->likedPosts()->attach($post->id);
        return back()->with('success', 'Vous avez aimé cette publication');
    }
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Like $like)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Like $like)
    {
        //
    }
}
