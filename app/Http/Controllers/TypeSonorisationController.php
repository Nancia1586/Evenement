<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\TypeSonorisation;
use App\Models\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TypeSonorisationController extends Controller
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

        $liste = TypeSonorisation::from("typesonorisation");
        //Izay mbola tsy supprimer (etat = 0) ihany no apoitra eo amle liste

        if ($type) {
            $liste->whereRaw('lower(type) like ?', ["%".strtolower($type)."%"]);
        }

        $liste->whereRaw('etat = 0');
        $liste->orderBy('id', 'asc');
        $typesonorisation = $liste->paginate(4);
        $typesonorisation->appends(request()->query());
        return view('typesonorisation.liste',
            [
                'type' => $typesonorisation
            ]);
    }

    //Ajout controller (insert)
    public function add()
    {
        $typesonorisation = new TypeSonorisation();
        $typesonorisation->type=request('type');
        $typesonorisation->etat=0;
        $typesonorisation->save();
        return redirect('/typesonorisation/liste');
    }

    //Update controller
    public function update()
    {
        $typesonorisation = TypeSonorisation::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        $typesonorisation->update([
            //Colonne rehetra modifiena
            'type' => request('type'),
            'etat' => 0
        ]);
        return redirect('/typesonorisation/liste');
    }

    //Supprimer controller
    public function supprimer()
    {
        $typesonorisation = TypeSonorisation::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        // $typesonorisation->delete();
        $typesonorisation->update([
            //Ovaina 1 ny etat rehefa supprimena le izy
            'etat' => 1
        ]);
        return redirect('/typesonorisation/liste');
    }
}
