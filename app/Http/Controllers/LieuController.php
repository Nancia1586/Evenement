<?php

namespace App\Http\Controllers;

use App\Models\Artiste;
use App\Models\Frequence;
use App\Models\Lieu;
use App\Models\TypeLieu;
use App\Models\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LieuController extends Controller
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
        $placemin = request('placemin');
        $placemax = request('placemax');
        $type = request('type');

        //Pour recherche simple ---------------
        $mot = request('mot');
        // ------------------------------------

        $liste = Lieu::from("v_lieu");
        //Izay mbola tsy supprimer (etat = 0) ihany no apoitra eo amle liste

        if ($nom) {
            $liste->whereRaw('lower(nom) like ?', ["%".strtolower($nom)."%"]);
        }
        if ($placemin) {
            $liste->whereRaw('nbplace >= ?', [$placemin]);
        }
        if ($placemax) {
            $liste->whereRaw('nbplace <= ?', [$placemax]);
        }
        if ($type) {
            $liste->whereRaw('typelieuid = ?', [$type]);
        }

        //Pour recherche simple ---------------
        if ($mot) {
            $liste->orWhereRaw('lower(nom) like ?', ["%".strtolower($mot)."%"]);
            $liste->orWhereRaw('cast(nbplace as varchar) like ?', ["%".$mot."%"]);
            $liste->orWhereRaw('lower(type) like ?', ["%".strtolower($mot)."%"]);
        }
        // ------------------------------------

        $liste->whereRaw('etat = 0');
        $liste->orderBy('id', 'asc');
        $lieu = $liste->paginate(4);
        $lieu->appends(request()->query());
        $type = TypeLieu::liste();
        return view('lieu.liste',
            [
                'lieu' => $lieu,
                'type' => $type
            ]);
    }

    //Ajout controller (insert)
    public function add(Request $request)
    {
        $file = $request->file('image');
        $destinationPath = 'uploads';
        $photo = $file->getClientOriginalName();
        $file->move($destinationPath, $file->getClientOriginalName());

        $lieu = new Lieu();
        $lieu->nom=request('nom');
        $lieu->typelieuid=request('type');
        $lieu->nbplace=request('place');
        $lieu->photo = $destinationPath . "/" . $photo;
        $lieu->etat=0;
        $lieu->save();
        return redirect('/lieu/liste');
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
        $lieu = Lieu::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        $lieu->update([
            //Colonne rehetra modifiena
            'nom' => request('nom'),
            'typelieuid' => request('type'),
            'nbplace' => request('place'),
            'photo' => $upload,
            'etat' => 0
        ]);
        return redirect('/lieu/liste');
    }

    //Supprimer controller
    public function supprimer()
    {
        $lieu = Lieu::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        // $lieu->delete();
        $lieu->update([
            //Ovaina 1 ny etat rehefa supprimena le izy
            'etat' => 1
        ]);
        return redirect('/lieu/liste');
    }
}
