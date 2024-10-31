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
public function show(User $user)
{
    // Charger les posts de l'utilisateur pour les afficher
    $user->load('posts');

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
