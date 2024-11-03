<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
{
    $users = User::where('id', '!=', Auth::id())->get(); // Récupère tous les utilisateurs sauf l'utilisateur connecté
    return view('user-list', compact('users'));
}
public function myProfile()
{

    // Charger les relations nécessaires et trier les posts du plus récent au plus ancien
    $user->load(['posts' => function($query) {
        $query->orderBy('created_at', 'desc');
    }, 'followers', 'following']);

    return view('profile.my-profile', compact('user'));
}
public function show(User $user)
    {
        // Charger les posts de l'utilisateur triés du plus récent au plus ancien
        $user->load(['posts' => function($query) {
            $query->orderBy('created_at', 'desc');
        }, 'followers', 'following']);

        return view('profile.user-profile', compact('user'));
    }

    /**
     * Display the user's profile form.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validation des données
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'bio' => 'nullable|string|max:255',
            'profile_photo_path' => 'nullable|image|max:4096',
        ]);

        // Mise à jour des informations de l'utilisateur
        $user->update($request->only('name', 'email', 'bio'));

        // Gestion de la photo de profil
        if ($request->hasFile('profile_photo_path') && $request->file('profile_photo_path')->isValid()) {
            // Supprimer l'ancienne photo si elle existe
            if (!empty($user->profile_photo_path)) {
                \Storage::disk('public')->delete($user->profile_photo_path);
            }

            // Déplacer le fichier uploadé
            $file = $request->file('profile_photo_path');
            $filename = uniqid() . '_' . $file->getClientOriginalName(); // Génère un nom de fichier unique
            $file->move(public_path('storage/profile_photos'), $filename);

            // Mettre à jour le chemin de la photo dans la base de données
            $user->profile_photo_path = 'profile_photos/' . $filename;
            $user->save();
        }

        // Redirection après la mise à jour
        return redirect()->route('profile.show', $user->id)->with('status', 'Profil mis à jour avec succès !');
    }








    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
