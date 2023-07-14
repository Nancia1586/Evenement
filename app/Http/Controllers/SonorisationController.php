<?php

namespace App\Http\Controllers;

use App\Models\Sonorisation;
use App\Models\Frequence;
use App\Models\TypeSonorisation;
use App\Models\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SonorisationController extends Controller
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
        $typesonorisation = request('type');
        $tarifmin = request('tarifmin');
        $tarifmax = request('tarifmax');
        $frequence = request('frequence');

        //Pour recherche simple ---------------
        $mot = request('mot');
        // ------------------------------------

        $liste = Sonorisation::from("v_sonorisation");
        //Izay mbola tsy supprimer (etat = 0) ihany no apoitra eo amle liste

        if ($typesonorisation) {
            $liste->whereRaw('typeSonorisationId = ?', [$typesonorisation]);
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
        $sonorisation = $liste->paginate(4);
        $sonorisation->appends(request()->query());
        $frequence = Frequence::liste();
        $type = TypeSonorisation::liste();
        return view('sonorisation.liste',
            [
                'sonorisation' => $sonorisation,
                'frequence' => $frequence,
                'type' => $type
            ]);
    }

    //Ajout controller (insert)
    public function add()
    {
        $sonorisation = new Sonorisation();
        $sonorisation->typesonorisationid=request('type');
        $sonorisation->tarif=request('tarif');
        $sonorisation->frequenceid=request('frequence');
        $sonorisation->etat=0;
        $sonorisation->save();
        return redirect('/sonorisation/liste');
    }

    //Update controller
    public function update()
    {
        $sonorisation = Sonorisation::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        $sonorisation->update([
            //Colonne rehetra modifiena
            'typesonorisationid' => request('type'),
            'tarif' => request('tarif'),
            'frequenceid' => request('frequence'),
            'etat' => 0
        ]);
        return redirect('/sonorisation/liste');
    }

    //Supprimer controller
    public function supprimer()
    {
        $sonorisation = Sonorisation::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        // $sonorisation->delete();
        $sonorisation->update([
            //Ovaina 1 ny etat rehefa supprimena le izy
            'etat' => 1
        ]);
        return redirect('/sonorisation/liste');
    }
}
