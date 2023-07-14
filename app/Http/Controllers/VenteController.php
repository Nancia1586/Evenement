<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Spectacle;
use App\Models\Taxe;
use App\Models\Vente;
use App\Models\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function venteplaceform()
    {
        $spectacle = Spectacle::liste();
        $categorie = Categorie::liste();
        $erreur = "";
        if(request('erreur')){
            $erreur = "Place insuffisant. Place restant: ".request('erreur');
        }
        return view('vente.venteplaceform',
            [
                'spectacle' => $spectacle,
                'categorie' => $categorie,
                'erreur' => $erreur
            ]);
    }

    public function addventeplace()
    {
        $placespectacle = Vente::placespectacle(request('spectacle'),request('categorie'));
        if(($placespectacle['placevendue'] + request('place')) > $placespectacle['placetotal']){
            return redirect('/vente/venteplaceform?erreur='.$placespectacle['placerestant']);
        }

        $vente = new Vente();
        $vente->spectacleid=request('spectacle');
        $vente->categorieid=request('categorie');
        $vente->nbplace=request('place');
        $vente->etat=0;
        $vente->save();
        return redirect('/vente/venteplaceform');
    }

    public function listeplacevendue(){
        $liste = Spectacle::from("v_spectacle");
        $liste->whereRaw('etat = 0');
        $liste->orderBy('date', 'asc');
        $spectacle = $liste->paginate(4);
        return view('vente.listeplacevendue',
            [
                'spectacle' => $spectacle
            ]);
    }

    public function vendueparcategorie(){
        $categorie = Categorie::liste();
        $idspectacle = request('idspectacle');
        return view('vente.vendueparcategorie',
            [
                'categorie' => $categorie,
                'idspectacle' => $idspectacle
            ]);
    }

}
