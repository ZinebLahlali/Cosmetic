<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProduitCommande extends Model
{
    protected $fillable = [
        'quantite',
        'produit_id',
        'commande_id',
    ];
}
