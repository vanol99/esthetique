<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conge extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date_debut',
        'date_fin',
        'heure_debut',
        'heure_fin',
        'user_id',
    ];
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
