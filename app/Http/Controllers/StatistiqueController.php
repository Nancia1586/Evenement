<?php

namespace App\Http\Controllers;

use App\Models\Devis;
use App\Models\Spectacle;
use App\Models\Frequence;
use App\Models\TypeSonorisation;
use App\Models\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StatistiqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Liste controller
    public function listespectacle(){
        $liste = Spectacle::from("v_spectacle");
        $liste->whereRaw('etat = 0');
        $liste->orderBy('date', 'asc');
        $spectacle = $liste->paginate(4);
        return view('statistiqueevent.listespectacle',
            [
                'spectacle' => $spectacle
            ]);
    }
    public function listespectacle2(){
        $liste = Spectacle::from("v_spectacle");
        $liste->whereRaw('etat = 0');
        $liste->orderBy('date', 'asc');
        $spectacle = $liste->paginate(4);
        return view('statistiqueevent.listespectacle2',
            [
                'spectacle' => $spectacle
            ]);
    }

    public function repartitiondepense(){
        $spectacle = Spectacle::liste();
        return view('statistiqueevent.repartitiondepense',
            [
                'spectacle' => $spectacle
            ]);
    }

    public function repartition(){
        $spectacle = Spectacle::liste();
        $lieu=Devis::totallieu(request('id'));
        $sonorisation=Devis::totalsonorisation(request('id'));
        $logistique=Devis::totallogistique(request('id'));
        $divers=Devis::totaldivers(request('id'));
        $artiste=Devis::totalartiste(request('id'));

        // $lieu=Devis::pourcentagelieu(request('id'));
        // $sonorisation=Devis::pourcentagesonorisation(request('id'));
        // $logistique=Devis::pourcentagelogistique(request('id'));
        // $divers=Devis::pourcentagedivers(request('id'));
        // $artiste=Devis::pourcentageartiste(request('id'));

        return view('statistiqueevent.repartition',
            [
                'spectacle' => $spectacle,
                'lieu'=>$lieu,
                'sonorisation'=>$sonorisation,
                'logistique'=>$logistique,
                'divers'=>$divers,
                'artiste'=>$artiste
            ]);
    }
}

