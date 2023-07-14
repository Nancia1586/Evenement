<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        $email=request('email');
        $mdp=request('mdp');
        $id = Employe::login($email,$mdp);
        if($id == -1){
            return view('employe.login',
            [
                'error' => 'Email ou mot de passe incorrect'
            ]);
        }
        Session::put('idemploye', $id);
        return redirect('/employe/home');
    }

    public function inscription()
    {
        $employe = new Employe();
        $employe->nom=request('nom');
        $employe->email=request('email');
        $employe->mdp=md5(request('mdp'));
        $employe->etat=0;
        $mdp2=request('mdp2');
        if($mdp2 != request('mdp')){
            return view('employe.inscription',
            [
                'error' => 'Les mots de passes que vous avez saisi sont différents'
            ]);
        }
        $employe->save();
        return view('employe.login');
    }

    // public function login(){
    //     $datetime = '2023-04-23 12:22:00';
    //     $datetime2 = '2023-03-15 12:22:00';
    //     $date = \Carbon\Carbon::parse($datetime);
    //     $date2 = \Carbon\Carbon::parse($datetime2);
    //     if($date->isBefore($date2)){
    //         echo "date < date2";
    //     }
    //     else{
    //         echo "date > date2";
    //     }
    // }

    public function inscriptionform(){
        return view('employe.inscription');
    }

    public function home(){
        return redirect('/devis/spectacleform');
    }
}
