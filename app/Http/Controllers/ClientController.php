<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\Client;
use App\Models\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClientController extends Controller
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
        $contact = request('contact');

        //Pour recherche simple ---------------
        $mot = request('mot');
        // ------------------------------------

        $liste = Client::from("client");
        //Izay mbola tsy supprimer (etat = 0) ihany no apoitra eo amle liste

        if ($nom) {
            $liste->whereRaw('lower(nom) like ?', ["%".strtolower($nom)."%"]);
        }
        if ($contact) {
            $liste->whereRaw('lower(contact) like ?', ["%".strtolower($contact)."%"]);
        }

        //Pour recherche simple ---------------
        if ($mot) {
            $liste->orWhereRaw('lower(nom) like ?', ["%".strtolower($mot)."%"]);
            $liste->orWhereRaw('lower(contact) like ?', ["%".strtolower($mot)."%"]);
        }
        // ------------------------------------

        $liste->whereRaw('etat = 0');
        $liste->orderBy('id', 'asc');
        $client = $liste->paginate(4);
        $client->appends(request()->query());
        return view('client.liste',
            [
                'client' => $client
            ]);
    }

    //Ajout controller (insert)
    public function add()
    {
        $client = new Client();
        $client->nom=request('nom');
        $client->contact=request('contact');
        $client->save();
        return redirect('/client/liste');
    }

    //Update controller
    public function update()
    {
        $client = Client::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        $client->update([
            //Colonne rehetra modifiena
            'nom' => request('nom'),
            'contact' => request('contact')
        ]);
        return redirect('/client/liste');
    }

    //Supprimer controller
    public function supprimer()
    {
        $client = Client::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        // $client->delete();
        $client->update([
            //Ovaina 1 ny etat rehefa supprimena le izy
            'etat' => 1
        ]);
        return redirect('/client/liste');
    }
}
