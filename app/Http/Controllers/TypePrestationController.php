<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\TypePrestation;
use App\Models\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TypePrestationController extends Controller
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

        $liste = TypePrestation::from("typeprestation");
        //Izay mbola tsy supprimer (etat = 0) ihany no apoitra eo amle liste

        if ($type) {
            $liste->whereRaw('lower(type) like ?', ["%".strtolower($type)."%"]);
        }

        $liste->whereRaw('etat = 0');
        $liste->orderBy('id', 'asc');
        $typeprestation = $liste->paginate(4);
        $typeprestation->appends(request()->query());
        return view('typeprestation.liste',
            [
                'type' => $typeprestation
            ]);
    }

    //Ajout controller (insert)
    public function add()
    {
        $typeprestation = new TypePrestation();
        $typeprestation->type=request('type');
        $typeprestation->etat=0;
        $typeprestation->save();
        return redirect('/typeprestation/liste');
    }

    //Update controller
    public function update()
    {
        $typeprestation = TypePrestation::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        $typeprestation->update([
            //Colonne rehetra modifiena
            'type' => request('type'),
            'etat' => 0
        ]);
        return redirect('/typeprestation/liste');
    }

    //Supprimer controller
    public function supprimer()
    {
        $typeprestation = typeprestation::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        // $typeprestation->delete();
        $typeprestation->update([
            //Ovaina 1 ny etat rehefa supprimena le izy
            'etat' => 1
        ]);
        return redirect('/typeprestation/liste');
    }
}
