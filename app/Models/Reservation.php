<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    const PENDING="PENDING";
    const ACCEPTED="ACCEPTED";
    const DENIED="DENIED";
    protected $fillable = [
        'date_reservation',
        'heure_reservation',
        'status',
        'total',
        'customer_id',
        'user_id',
    ];
/*    public function soin() {
        return $this->belongsTo(Soin::class, 'soin_id', 'id');
    }*/
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function customer() {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }
}
