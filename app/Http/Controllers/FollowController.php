<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class FollowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

     public function store(User $user): RedirectResponse
     {
         $currentUser = Auth::user();

         // Vérifie si l'utilisateur courant ne suit pas déjà cet utilisateur
         if (!$currentUser->following->contains($user->id)) {
             $currentUser->following()->attach($user->id);
         }

         return redirect()->back()->with('success', 'Vous suivez maintenant cet utilisateur.');
     }
    /**
     * Display the specified resource.
     */
    public function show(Follow $follow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Follow $follow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Follow $follow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        $currentUser = Auth::user();

        // Vérifie si l'utilisateur courant suit cet utilisateur
        if ($currentUser->following->contains($user->id)) {
            $currentUser->following()->detach($user->id);
        }

        return redirect()->back()->with('success', 'Vous ne suivez plus cet utilisateur.');
    }
}
