<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Avis extends Model
{
    protected $table = 'avis';

    public $timestamps = false;

    protected $fillable = [
        'session_id',
        'nom',
        'prenom',
        'email',
        'whatsapp',
        'pays',
        'secteur',
        'profil',
        'niveau',
        'accompagnement',
        'note',
        'commentaire',
    ];

    protected $casts = [
        'note' => 'integer',
        'date_avis' => 'datetime',
    ];

    public function session(): BelongsTo
    {
        return $this->belongsTo(WebinaireSession::class, 'session_id');
    }
}
