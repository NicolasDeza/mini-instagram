<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class FeedController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Récupérer les posts des utilisateurs suivis, triés par popularité et date de création
        $posts = Post::whereIn('user_id', $user->following->pluck('id'))
            ->orWhereHas('likes', function ($query) {
                $query->select('post_id')
                    ->groupBy('post_id')
                    ->havingRaw('COUNT(post_id) > ?', [10]);
            })
            ->orderBy('created_at', 'desc') // Trie du plus récent au plus ancien
            ->with(['user', 'likes', 'comments'])
            ->paginate(10);

        return view('feed.index', compact('posts'));
    }

}
