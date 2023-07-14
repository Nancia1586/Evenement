<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\Divers;
use App\Models\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DiversController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function liste()
    {
        //Colonne anaovana recherche rehetra (pour recherche multicritere)
        $designation = request('designation');

        $liste = Divers::from("divers");
        //Izay mbola tsy supprimer (etat = 0) ihany no apoitra eo amle liste

        if ($designation) {
            $liste->whereRaw('lower(designation) like ?', ["%".strtolower($designation)."%"]);
        }

        $liste->whereRaw('etat = 0');
        $liste->orderBy('id', 'asc');
        $divers = $liste->paginate(4);
        $divers->appends(request()->query());
        return view('divers.liste',
            [
                'divers' => $divers
            ]);
    }

    //Ajout controller (insert)
    public function add()
    {
        $divers = new Divers();
        $divers->designation=request('designation');
        $divers->etat=0;
        $divers->save();
        return redirect('/divers/liste');
    }

    //Update controller
    public function update()
    {
        $divers = Divers::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        // $divers->update([
        //     //Colonne rehetra modifiena
        //     'designation' => request('designation'),
        //     'etat' => 0
        // ]);
        $divers->designation=request('designation');
        $divers->etat=0;
        $divers->save();
        return redirect('/divers/liste');
    }

    //Supprimer controller
    public function supprimer()
    {
        $divers = divers::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        // $divers->delete();
        $divers->update([
            //Ovaina 1 ny etat rehefa supprimena le izy
            'etat' => 1
        ]);
        return redirect('/divers/liste');
    }
}
