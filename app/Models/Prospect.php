<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prospect extends Model
{
    protected $table = 'prospects';

    public $timestamps = false;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'whatsapp',
        'secteur',
        'profil',
        'niveau',
        'preference',
        'consentement',
    ];

    protected $casts = [
        'consentement' => 'boolean',
        'date_inscription' => 'datetime',
    ];
}
