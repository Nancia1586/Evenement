<?php

namespace App\Http\Controllers;

use App\Models\Artiste;
use App\Models\Frequence;
use App\Models\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ArtisteController extends Controller
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
        $nom = request('nom');
        $tarifmin = request('tarifmin');
        $tarifmax = request('tarifmax');
        $frequence = request('frequence');

        //Pour recherche simple ---------------
        $mot = request('mot');
        // ------------------------------------

        $liste = Artiste::from("v_artiste");
        //Izay mbola tsy supprimer (etat = 0) ihany no apoitra eo amle liste

        if ($nom) {
            $liste->whereRaw('lower(nom) like ?', ["%".strtolower($nom)."%"]);
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
            $liste->orWhereRaw('lower(nom) like ?', ["%".strtolower($mot)."%"]);
            $liste->orWhereRaw('cast(tarif as varchar) like ?', ["%".$mot."%"]);
            $liste->orWhereRaw('lower(frequence) like ?', ["%".strtolower($mot)."%"]);
        }
        // ------------------------------------

        $liste->whereRaw('etat = 0');
        $liste->orderBy('id', 'asc');
        $artiste = $liste->paginate(4);
        $artiste->appends(request()->query());
        $frequence = Frequence::liste();
        return view('artiste.liste',
            [
                'artiste' => $artiste,
                'frequence' => $frequence
            ]);
    }

    //Ajout controller (insert)
    public function add(Request $request)
    {
        $file = $request->file('image');
        $destinationPath = 'uploads';
        $photo = $file->getClientOriginalName();
        $file->move($destinationPath, $file->getClientOriginalName());

        $artiste = new Artiste();
        $artiste->nom=request('nom');
        $artiste->tarif=request('tarif');
        $artiste->frequenceid=request('frequence');
        $artiste->photo = $destinationPath . "/" . $photo;
        $artiste->etat=0;
        $artiste->save();
        return redirect('/artiste/liste');
    }

    //Update controller
    public function update(Request $request)
    {
        $upload = request('photo');
        if($request->file('image')){
            $file = $request->file('image');
            $destinationPath = 'uploads';
            $photo = $file->getClientOriginalName();
            $file->move($destinationPath, $file->getClientOriginalName());

            $upload = $destinationPath . "/" . $photo;
        }

        $artiste = Artiste::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        $artiste->update([
            //Colonne rehetra modifiena
            'nom' => request('nom'),
            'tarif' => request('tarif'),
            'frequenceid' => request('frequence'),
            'photo' => $upload,
            'etat' => 0
        ]);
        return redirect('/artiste/liste');
    }

    //Supprimer controller
    public function supprimer()
    {
        $artiste = Artiste::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        // $artiste->delete();
        $artiste->update([
            //Ovaina 1 ny etat rehefa supprimena le izy
            'etat' => 1
        ]);
        return redirect('/artiste/liste');
    }
}
