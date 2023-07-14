<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\TypeLogistique;
use App\Models\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TypeLogistiqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function liste()
    {
        //Colonne anaovana recherche rehetra (pour recherche multicritere)
        $type = request('type');

        $liste = TypeLogistique::from("typelogistique");
        //Izay mbola tsy supprimer (etat = 0) ihany no apoitra eo amle liste

        if ($type) {
            $liste->whereRaw('lower(type) like ?', ["%".strtolower($type)."%"]);
        }

        $liste->whereRaw('etat = 0');
        $liste->orderBy('id', 'asc');
        $typelogistique = $liste->paginate(4);
        $typelogistique->appends(request()->query());
        return view('typelogistique.liste',
            [
                'type' => $typelogistique
            ]);
    }

    //Ajout controller (insert)
    public function add()
    {
        $typelogistique = new TypeLogistique();
        $typelogistique->type=request('type');
        $typelogistique->etat=0;
        $typelogistique->save();
        return redirect('/typelogistique/liste');
    }

    //Update controller
    public function update()
    {
        $typelogistique = TypeLogistique::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        $typelogistique->update([
            //Colonne rehetra modifiena
            'type' => request('type'),
            'etat' => 0
        ]);
        return redirect('/typelogistique/liste');
    }

    //Supprimer controller
    public function supprimer()
    {
        $typelogistique = TypeLogistique::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        // $typelogistique->delete();
        $typelogistique->update([
            //Ovaina 1 ny etat rehefa supprimena le izy
            'etat' => 1
        ]);
        return redirect('/typelogistique/liste');
    }
}
