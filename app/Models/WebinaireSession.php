<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WebinaireSession extends Model
{
    protected $table = 'webinaire_sessions';

    public $timestamps = false;

    protected $fillable = [
        'titre',
        'date_session',
        'description',
        'statut',
    ];

    protected $casts = [
        'date_session' => 'date',
        'created_at' => 'datetime',
    ];

    public function avis(): HasMany
    {
        return $this->hasMany(Avis::class, 'session_id');
    }
}
