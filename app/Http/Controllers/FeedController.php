<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class FeedController extends Controller
{
    public function index()
{
    $user = Auth::user();

    // Récupérer les posts uniquement des utilisateurs suivis
    $posts = Post::whereIn('user_id', $user->following()->pluck('id'))
                 ->orderBy('created_at', 'desc')
                 ->with(['user', 'likes', 'comments'])
                 ->paginate(10);

    return view('feed.index', compact('posts'));
}
}
