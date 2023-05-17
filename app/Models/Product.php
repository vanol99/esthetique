<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'libelle',
        'image',
        'description',
        'quantite',
        'price_sell',
        'price',
        'product_type_id',
        'fournisseur_id',
    ];
    public function categorie() {
        return $this->belongsTo(Product_type::class, 'product_type_id', 'id');
    }
    public function soins() {
        return $this->belongsToMany(Soin::class,'soin_products');
    }
}
