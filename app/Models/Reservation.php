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
        'type_paiement',
        'total',
        'totalht',
        'totaltva',
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
    public function scopeCaisse($query)
    {//caisse
        return $query->where('type_paiement', '=', 1)->where(['status'=>self::PENDING]);
    }
    public static function setPayement($payment){
        $val=2;
        switch ($payment){
            case "paypal":
                $val= 1;
                break;
            case "caisse":
                $val=  2;
                break;
            case "bank_transfert":
                $val=  3;
                break;
        }
        return $val;
    }
    public function getPayement($payment_type){
        $val="Caisse";
        switch ($payment_type){
            case 1:
                $val= "Paypal";
                break;
            case 2:
                $val=  "Caisse";
                break;
            case 3:
                $val=  "Carte bancaire";
                break;
        }
        return $val;
    }
}
