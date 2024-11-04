<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class FeedController extends Controller
{
    public function index()
    {
        // Récupérer les utilisateurs suivis par l'utilisateur connecté
        $followedUserIds = Auth::user()->following()->pluck('id');

        // Récupérer les posts des utilisateurs suivis, paginés par 9
        $posts = Post::whereIn('user_id', $followedUserIds)
                     ->orderBy('created_at', 'desc')
                     ->paginate(9);

        return view('feed.index', compact('posts'));
    }
}
