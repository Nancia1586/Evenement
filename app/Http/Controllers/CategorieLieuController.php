<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\Categorie;
use App\Models\CategorieLieu;
use App\Models\TarifLieu;
use App\Models\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategorieLieuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listelieu()
    {
        $liste = Categorie::from("lieu");
        $liste->whereRaw('etat = 0');
        $liste->orderBy('id', 'asc');
        $lieu = $liste->paginate(4);
        $lieu->appends(request()->query());
        return view('categorielieu.listelieu',
            [
                'lieu' => $lieu
            ]);
    }

    public function definirnbplace()
    {
        if(request('idlieu')){
            $idlieu = request('idlieu');
            Session::put('idlieu',$idlieu);
        }

        $categorie = Categorie::liste();
        $liste = CategorieLieu::get(Session::get('idlieu'));
        $erreur = "";
        if(request('erreur')){
            $erreur = "Le nombre de place defini depasse le normale";
        }
        return view('categorielieu.definitionplace',
            [
                'categorie' => $categorie,
                'liste' => $liste,
                'erreur' => $erreur
            ]);
    }

    public function addnbplace()
    {
        $place = CategorieLieu::place(Session::get('idlieu'));
        if(($place['defini'] + request('nbplace')) > $place['totalplace']){
            return redirect('/categorielieu/definirnbplace?erreur=1');
        }

        $categorielieu = new CategorieLieu();
        $categorielieu->lieuid=Session::get('idlieu');
        $categorielieu->categorieid=request('categorie');
        $categorielieu->nbplace=request('nbplace');
        $categorielieu->etat=0;
        $categorielieu->save();

        return redirect('/categorielieu/definirnbplace');
    }

    //Ajout controller (insert)
    // public function add()
    // {
    //     $categorie = new Categorie();
    //     $categorie->categorie=request('categorie');
    //     $categorie->etat=0;
    //     $categorie->save();
    //     return redirect('/categorie/liste');
    // }

    // //Update controller
    // public function update()
    // {
    //     $categorie = Categorie::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
    //     $categorie->update([
    //         //Colonne rehetra modifiena
    //         'categorie' => request('categorie'),
    //         'etat' => 0
    //     ]);
    //     return redirect('/categorie/liste');
    // }

    // //Supprimer controller
    // public function supprimer()
    // {
    //     $categorie = Categorie::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
    //     // $categorie->delete();
    //     $categorie->update([
    //         //Ovaina 1 ny etat rehefa supprimena le izy
    //         'etat' => 1
    //     ]);
    //     return redirect('/categorie/liste');
    // }
}
