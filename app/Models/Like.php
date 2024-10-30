<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{
    protected $fillable = [
        'user_id',
        'post_id',
    ];

    // Relation avec l'utilisateur (un like appartient à un utilisateur)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec le post (un like est associé à un post)
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
