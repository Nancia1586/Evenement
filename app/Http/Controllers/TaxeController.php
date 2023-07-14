<?php

namespace App\Http\Controllers;

use App\Models\Taxe;
use App\Models\Categorie;
use App\Models\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TaxeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function form(){
        $taxe =Taxe::pourcentage();
        return view('taxe.form',
            [
                'taxe' => $taxe
            ]);
    }

    public function update()
    {
        $taxe = Taxe::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        $taxe->update([
            //Colonne rehetra modifiena
            'taxe' => request('taxe')
        ]);
        return redirect('/taxe/form');
    }

}
