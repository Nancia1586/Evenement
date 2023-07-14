<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\TypeLieu;
use App\Models\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TypeLieuController extends Controller
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

        $liste = TypeLieu::from("typelieu");
        //Izay mbola tsy supprimer (etat = 0) ihany no apoitra eo amle liste

        if ($type) {
            $liste->whereRaw('lower(type) like ?', ["%".strtolower($type)."%"]);
        }

        $liste->whereRaw('etat = 0');
        $liste->orderBy('id', 'asc');
        $typelieu = $liste->paginate(4);
        $typelieu->appends(request()->query());
        return view('typelieu.liste',
            [
                'type' => $typelieu
            ]);
    }

    //Ajout controller (insert)
    public function add()
    {
        $typelieu = new TypeLieu();
        $typelieu->type=request('type');
        $typelieu->etat=0;
        $typelieu->save();
        return redirect('/typelieu/liste');
    }

    //Update controller
    public function update()
    {
        $typelieu = TypeLieu::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        $typelieu->update([
            //Colonne rehetra modifiena
            'type' => request('type'),
            'etat' => 0
        ]);
        return redirect('/typelieu/liste');
    }

    //Supprimer controller
    public function supprimer()
    {
        $typelieu = TypeLieu::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        // $typelieu->delete();
        $typelieu->update([
            //Ovaina 1 ny etat rehefa supprimena le izy
            'etat' => 1
        ]);
        return redirect('/typelieu/liste');
    }
}
