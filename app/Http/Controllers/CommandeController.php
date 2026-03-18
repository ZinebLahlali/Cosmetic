<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Http\Requests\StoreCommandeRequest;
use App\Http\Requests\UpdateCommandeRequest;
use App\Models\ProduitCommande;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\DB;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommandeRequest $request)
    {
          $commande = Commande::create([
            'statut' => 'pending',
            'adresse_livraison' => $request->adresse_livraison,
            'user_id' => auth('api')->id()
          ]);

          ProduitCommande::create([
             'produit_id' => $request->produit_id,
             'commande_id' => $commande->id,
             'quantite' => $request->quantite
          ]);

          return response()->json([
              'message' => 'commande a été crée',
             'produits' => $commande->produits,
            ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function showMyCommandes()
    {
        $user = auth('api')->user();

        $commandes = DB::table('users')
        ->join('commandes', 'commandes.user_id', '=', 'users.id')
        ->join('produit_commandes', 'commandes.id', '=', 'produit_commandes.commande_id')
        ->join('produits', 'produits.id', '=', 'produit_commandes.produit_id')
        ->select('users.name as nom','commandes.*', 'produit_commandes.produit_id', 'produit_commandes.quantite', 'produits.name')
        ->where('users.id', $user->id)
        ->get();

        return response()->json([
            'commandes' => $commandes
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commande $commande)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommandeRequest $request, $id)
    {    
        
        $user = auth('api')->user();
        $commandes = DB::table('commandes')
        ->where('id', $id)
        ->where('user_id', $user->id)
        ->update($request->validated());

        if(!$commandes){
            return response()->json([
            "message" => "La commande n'a pas trouvé "
        ]);
        }

        return response()->json([
            "message" => "La commande a été annulé"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commande $commande)
    {
        //
    }
}
