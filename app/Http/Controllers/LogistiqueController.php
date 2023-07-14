<?php

namespace App\Http\Controllers;

use App\Models\Logistique;
use App\Models\Frequence;
use App\Models\TypeLogistique;
use App\Models\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LogistiqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Liste controller
    public function liste()
    {
        //Colonne anaovana recherche rehetra (pour recherche multicritere)
        $typelogistique = request('type');
        $tarifmin = request('tarifmin');
        $tarifmax = request('tarifmax');
        $frequence = request('frequence');

        //Pour recherche simple ---------------
        $mot = request('mot');
        // ------------------------------------

        $liste = Logistique::from("v_logistique");
        //Izay mbola tsy supprimer (etat = 0) ihany no apoitra eo amle liste

        if ($typelogistique) {
            $liste->whereRaw('typeLogistiqueId = ?', [$typelogistique]);
        }
        if ($tarifmin) {
            $liste->whereRaw('tarif >= ?', [$tarifmin]);
        }
        if ($tarifmax) {
            $liste->whereRaw('tarif <= ?', [$tarifmax]);
        }
        if ($frequence) {
            $liste->whereRaw('frequenceId = ?', [$frequence]);
        }

        //Pour recherche simple ---------------
        if ($mot) {
            $liste->orWhereRaw('lower(type) like ?', ["%".strtolower($mot)."%"]);
            $liste->orWhereRaw('cast(tarif as varchar) like ?', ["%".$mot."%"]);
            $liste->orWhereRaw('lower(frequence) like ?', ["%".strtolower($mot)."%"]);
        }
        // ------------------------------------

        $liste->whereRaw('etat = 0');
        $liste->orderBy('id', 'asc');
        $logistique = $liste->paginate(4);
        $logistique->appends(request()->query());
        $frequence = Frequence::liste();
        $type = TypeLogistique::liste();
        return view('logistique.liste',
            [
                'logistique' => $logistique,
                'frequence' => $frequence,
                'type' => $type
            ]);
    }

    //Ajout controller (insert)
    public function add()
    {
        $logistique = new Logistique();
        $logistique->typelogistiqueid=request('type');
        $logistique->tarif=request('tarif');
        $logistique->frequenceid=request('frequence');
        $logistique->etat=0;
        $logistique->save();
        return redirect('/logistique/liste');
    }

    //Update controller
    public function update()
    {
        $logistique = Logistique::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        $logistique->update([
            //Colonne rehetra modifiena
            'typelogistiqueid' => request('type'),
            'tarif' => request('tarif'),
            'frequenceid' => request('frequence'),
            'etat' => 0
        ]);
        // echo request('type');
        return redirect('/logistique/liste');
    }

    //Supprimer controller
    public function supprimer()
    {
        $logistique = Logistique::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        // $logistique->delete();
        $logistique->update([
            //Ovaina 1 ny etat rehefa supprimena le izy
            'etat' => 1
        ]);
        return redirect('/logistique/liste');
    }
}
