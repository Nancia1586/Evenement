<?php

namespace App\Http\Controllers;

use App\Models\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Session;
use FPDF;

class UtilController extends Controller
{

    //Liste controller
    // public function liste()
    // {
    //     //Colonne anaovana recherche rehetra (pour recherche multicritere)
    //     $emplacement = request('emplacement');
    //     $contact = request('contact');

    //     //Pour recherche simple ---------------
    //     $mot = request('mot');
    //     // ------------------------------------

    //     $liste = PointVente::from("pointvente");
    //     //Izay mbola tsy supprimer (etat = 0) ihany no apoitra eo amle liste

    //     if ($emplacement) {
    //         $liste->whereRaw('lower(emplacement) like ?', ["%".strtolower($emplacement)."%"]);
    //     }
    //     if ($contact) {
    //         $liste->whereRaw('lower(contact) like ?', ["%".strtolower($contact)."%"]);
    //     }

    //     //Pour recherche simple ---------------
    //     if ($mot) {
    //         $liste->orWhereRaw('lower(emplacement) like ?', ["%".strtolower($mot)."%"]);
    //         $liste->orWhereRaw('lower(contact) like ?', ["%".strtolower($mot)."%"]);
    //         //Rehefa numerique ilay colonne anaovana recherche
    //         $liste->orWhereRaw('cast(quantitePaquet as varchar) like ?', ["%".$mot."%"]);
    //         $liste->orWhereRaw('cast(prix as varchar) like ?', ["%".$mot."%"]);
    //     }
    //     // ------------------------------------

    //     $liste->whereRaw('etat = 0');
    //     $liste->orderBy('id', 'asc');
    //     $pointvente = $liste->paginate(4);
    //     $pointvente->appends(request()->query());
    //     return view('pointvente.liste',
    //         [
    //             'pointvente' => $pointvente
    //         ]);
    // }

    // //Ajout controller (insert)
    // public function add()
    // {
    //     $pointvente = new PointVente();
    //     $pointvente->emplacement=request('emplacement');
    //     $pointvente->contact=request('contact');
    //     $pointvente->save();
    //     return redirect('/pointvente/liste');
    // }

    // //Update controller
    // public function update()
    // {
    //     $pointvente = PointVente::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
    //     $pointvente->update([
    //         //Colonne rehetra modifiena
    //         'emplacement' => request('emplacement'),
    //         'contact' => request('contact')
    //     ]);
    //     return redirect('/pointvente/liste');
    // }

    // //Supprimer controller
    // public function supprimer()
    // {
    //     $pointvente = PointVente::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
    //     // $pointvente->delete();
    //     $pointvente->update([
    //         //Ovaina 1 ny etat rehefa supprimena le izy
    //         'etat' => 1
    //     ]);
    //     return redirect('/pointvente/liste');
    // }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function recherche_multicritere()
    // {
    //     $req = "select * from auteur where 1 = 1";
    //     if(request('nom') != null){
    //         $req = $req + " and nom = '".request('nom')."'";
    //     }
    //     if(request('prenoms') != null){
    //         $req = $req + " and prenoms = '".request('prenoms')."'";
    //     }
    //     if(request('email') != null){
    //         $req = $req + " and email = '".request('email')."'";
    //     }
    //     $result = Util::recherche_multicritere($req);
    //     return view('result_search',
    //     [
    //         'result' => $result
    //     ]);
    // }

    public function uploadform(Request $request)
    {
        return view('util.upload');
    }

    public function upload(Request $request)
    {
        $file = $request->file('image');
        $destinationPath = 'uploads';
        $photo = $file->getClientOriginalName();
        $file->move($destinationPath, $file->getClientOriginalName());

        // $info = new Info();
        // $info->image = $destinationPath . "/" . $photo;
        // $info->save();
        echo "Photo importée";
    }

    public function deconnexionadmin(Request $request)
    {
        // Session::forget('idadmin');
        return redirect('/');
    }

    public function deconnexionemploye(Request $request)
    {
        // Session::forget('idemploye');
        return redirect('/');
    }

    //Ajax view
    // <script type="text/javascript">

    // function find_endroit()
    // {
    //     //création de l'objet XMLHttpRequest
    //     var xhr;
    //     try {  xhr = new ActiveXObject('Msxml2.XMLHTTP');   }
    //     catch (e)
    //     {
    //         try {   xhr = new ActiveXObject('Microsoft.XMLHTTP'); }
    //         catch (e2)
    //         {
    //         try {  xhr = new XMLHttpRequest();  }
    //         catch (e3) {  xhr = false;   }
    //         }
    //     }

    //     //Définition des changements d'états
    //     xhr.onreadystatechange  = function()
    //     {
    //     if(xhr.readyState  == 4){
    //             if(xhr.status  == 200) {
    //                 var retour = JSON.parse(xhr.responseText);
    //                 // var option = '';
    //                 // for( $i=0; $i<retour.length; $i++){
    //                 //     option = option + '<option value='+retour[$i].id+'>'+retour[$i].nom+'</option>';
    //                 // }
    //                 // document.getElementById('client_list').innerHTML = option;
    //                 console.log(retour);
    //             } else {
    //                 document.dyn="Error code " + xhr.status;
    //             }
    //         }
    //     };
    // //XMLHttpRequest.open(method, url, async)
    // var mot = document.getElementById("endroit");
    // xhr.open("GET", "trouver_endroit?mot="+mot.value, true);

    // //XMLHttpRequest.send(body)
    // xhr.send(null);
    // }

    // </script>

}
