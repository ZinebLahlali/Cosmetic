<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImageProduit extends Model
{
    /** @use HasFactory<\Database\Factories\ImageProduitFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'produit_id',
    ];

    public function produit(): BelongsTo
    {
        return $this->belongsTo(Produit::class);
    }
}
