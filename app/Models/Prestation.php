<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestation extends Model
{
    use HasFactory;
    protected $fillable = [
        'reservation_id',
        'soin_id',
    ];
    public function reservation() {
        return $this->belongsTo(Reservation::class, 'reservation_id', 'id');
    }
    public function soin() {
        return $this->belongsTo(Soin::class, 'soin_id', 'id');
    }
}
