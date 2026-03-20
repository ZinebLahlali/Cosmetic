<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProduitCommande extends Pivot
{
    protected $table = 'produit_commandes';
    protected $fillable = [
        'quantite',
        'produit_id',
        'commande_id',
    ];


    
}
