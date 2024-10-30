<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'data',
        'read_at',
    ];

    // Relation avec l'utilisateur (une notification appartient à un utilisateur)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
