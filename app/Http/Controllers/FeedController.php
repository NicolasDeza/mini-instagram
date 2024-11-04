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
    $followingIds = Auth::user()->following->pluck('id');
    $posts = Post::whereIn('user_id', $followingIds)
                 ->orderBy('created_at', 'desc')
                 ->get();

    return view('feed.index', compact('posts'));
}
}
