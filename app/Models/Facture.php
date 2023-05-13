<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;
    protected $fillable = [
        'numero',
        'date_facture',
        'montantht',
        'tva',
        'montantttc',
        'reduction',
        'adresse',
        'customer_id',
        'user_id',
        'soin_id',
    ];
    public function customer() {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function soin() {
        return $this->belongsTo(Soin::class, 'soin_id', 'id');
    }
}
