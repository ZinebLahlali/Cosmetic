<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Commande extends Model
{
    /** @use HasFactory<\Database\Factories\CommandeFactory> */
    use HasFactory;
    protected $fillable = [
        'statut',
        'adresse_livraison',
        'user_id',
    ];

    public function produits()
    {
        return $this->belongsToMany(Produit::class,'produit_commandes','commande_id','produit_id')->withPivot('quantite');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
