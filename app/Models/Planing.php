<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planing extends Model
{
    use HasFactory;
    protected $fillable = [
        'jour',
        'heure_debut',
        'heure_fin',
        'date_planing',
        'user_id',
    ];
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
