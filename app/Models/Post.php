<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'caption',
        'image_path',
    ];
  // Relation avec l'utilisateur (un post appartient à un utilisateur)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

 // Relation avec les commentaires (un post peut avoir plusieurs commentaires)
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

// Relation avec les likes (un post peut recevoir plusieurs likes)
public function likes()
{
    return $this->belongsToMany(User::class, 'likes');
}
}
