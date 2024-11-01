<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'user_id',
        'content',
    ];

    // Relation avec le post (un commentaire appartient à un post)
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    // Relation avec l'utilisateur (un commentaire appartient à un utilisateur)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
