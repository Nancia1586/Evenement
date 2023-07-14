<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\Categorie;
use App\Models\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function liste()
    {
        //Colonne anaovana recherche rehetra (pour recherche multicritere)
        $categorie = request('categorie');

        $liste = Categorie::from("categorie");
        //Izay mbola tsy supprimer (etat = 0) ihany no apoitra eo amle liste

        if ($categorie) {
            $liste->whereRaw('lower(categorie) like ?', ["%".strtolower($categorie)."%"]);
        }

        $liste->whereRaw('etat = 0');
        $liste->orderBy('id', 'asc');
        $categorie = $liste->paginate(4);
        $categorie->appends(request()->query());
        return view('categorie.liste',
            [
                'categorie' => $categorie
            ]);
    }

    //Ajout controller (insert)
    public function add()
    {
        $categorie = new Categorie();
        $categorie->categorie=request('categorie');
        $categorie->etat=0;
        $categorie->save();
        return redirect('/categorie/liste');
    }

    //Update controller
    public function update()
    {
        $categorie = Categorie::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        $categorie->update([
            //Colonne rehetra modifiena
            'categorie' => request('categorie'),
            'etat' => 0
        ]);
        return redirect('/categorie/liste');
    }

    //Supprimer controller
    public function supprimer()
    {
        $categorie = Categorie::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        $categorie->delete();
        $categorie->update([
            //Ovaina 1 ny etat rehefa supprimena le izy
            'etat' => 1
        ]);
        return redirect('/categorie/liste');
    }
}
