<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Search extends Model
{
    protected $fillable = [
        'user_id',
        'search_term',
    ];

    // Relation avec l'utilisateur (une recherche appartient à un utilisateur)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
