<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produit extends Model
{
    /** @use HasFactory<\Database\Factories\ProduitFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'slug',
        'description',
        'categorie_id'
    ];

    public function categorie(): BelongsTo
    {
        return $this->belongsTo(Categorie::class);
    }

    public function imageProduits(): HasMany
    {
        return $this->hasMany(ImageProduit::class);
    }

    public function commandes()
    {
        return $this->belongsToMany(Commande::class,'produit_commandes','produit_id','commande_id')->withPivot('quantite');
    }
}
