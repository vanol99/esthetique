<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soin extends Model
{
    use HasFactory;
    protected $fillable = [
        'libelle',
        'description',
        'price',
        'duree',
        'soin_type_id'
    ];
    public function type() {
        return $this->belongsTo(Soin_type::class, 'soin_type_id', 'id');
    }
    public function products() {
        return $this->belongsToMany(Product::class,'soin_products');
    }
}
