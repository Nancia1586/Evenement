<?php

namespace App\Http\Controllers;

use App\Models\Affiche;
use App\Models\Artiste;
use App\Models\Spectacle;
use App\Models\Lieu;
use App\Models\ArtisteSpectacle;
use App\Models\CategorieLieu;
use App\Models\Devis;
use App\Models\LogistiqueSpectacle;
use App\Models\SonorisationSpectacle;
use App\Models\DiversSpectacle;
use App\Models\Divers;
use App\Models\Logistique;
use App\Models\Sonorisation;
use App\Models\TypeSonorisation;
use App\Models\TarifLieu;
use App\Models\TypeLogistique;
use App\Models\Vente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use FPDF;
use PDF;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\Writer;

class DevisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function spectacleform(){
        $lieu = Lieu::liste();
        return view('devis.spectacleform',
            [
                'lieu' => $lieu
            ]);
    }

    public function addspectacle()
    {
        if(request('date')){
            $spectacle = new Spectacle();
            $spectacle->titre=request('titre');
            $spectacle->date=request('date');
            $spectacle->heure=request('heure').":00";
            $spectacle->lieuid=request('lieu');
            $spectacle->montant=request('montant');
            $spectacle->etat=0;
            $spectacle->save();

            $idspectacle = Spectacle::lastid();
            Session::put('idspectacle',$idspectacle);
        }

        $artiste = Artiste::liste();
        // $liste = ArtisteSpectacle::liste();
        $liste = ArtisteSpectacle::get(Session::get('idspectacle'));
        return view('devis.artisteform',
            [
                'artiste' => $artiste,
                'liste' => $liste
            ]);
    }

    public function artisteform(){
        if(request('idspectacle')){
            $idspectacle = request('idspectacle');
            Session::put('idspectacle',$idspectacle);
        }

        $artiste = Artiste::liste();
        // $liste = ArtisteSpectacle::liste();
        $liste = ArtisteSpectacle::get(Session::get('idspectacle'));
        return view('devis.artisteform',
            [
                'artiste' => $artiste,
                'liste' => $liste
            ]);
    }

    public function addartiste()
    {
        $idspectacle = Session::get('idspectacle');

        if(request('artiste')){
            $artistespectacle = new ArtisteSpectacle();
            $artistespectacle->spectacleid=$idspectacle;
            $artistespectacle->artisteid=request('artiste');
            $artistespectacle->duree=request('duree');
            $artistespectacle->etat=0;
            $artistespectacle->save();
        }

        return redirect('/devis/addspectacle');
    }

    public function sonorisationform(){
        if(request('idspectacle')){
            $idspectacle = request('idspectacle');
            Session::put('idspectacle',$idspectacle);
        }

        $sonorisation = TypeSonorisation::liste();
        // $liste = SonorisationSpectacle::liste();
        $liste = SonorisationSpectacle::get(Session::get('idspectacle'));
        return view('devis.sonorisationform',
            [
                'sonorisation' => $sonorisation,
                'liste' => $liste
            ]);
    }

    public function addsonorisation()
    {
        $idspectacle = Session::get('idspectacle');

        if(request('type')){
            $sonorisationspectacle = new SonorisationSpectacle();
            $sonorisationspectacle->spectacleid=$idspectacle;
            $sonorisationspectacle->typesonorisationid=request('type');
            $sonorisationspectacle->duree=request('duree');
            $sonorisationspectacle->etat=0;
            $sonorisationspectacle->save();
        }

        return redirect('/devis/sonorisationform');
    }

    public function logistiqueform(){
        if(request('idspectacle')){
            $idspectacle = request('idspectacle');
            Session::put('idspectacle',$idspectacle);
        }
        // $liste = LogistiqueSpectacle::liste();
        $logistique = TypeLogistique::liste();
        $liste = LogistiqueSpectacle::get(Session::get('idspectacle'));

        return view('devis.logistiqueform',
            [
                'logistique' => $logistique,
                'liste' => $liste
            ]);
    }

    public function addlogistique()
    {
        $idspectacle = Session::get('idspectacle');

        if(request('type')){
            $logistiquespectacle = new LogistiqueSpectacle();
            $logistiquespectacle->spectacleid=$idspectacle;
            $logistiquespectacle->typelogistiqueid=request('type');
            $logistiquespectacle->duree=request('duree');
            $logistiquespectacle->etat=0;
            $logistiquespectacle->save();
        }

        return redirect('/devis/logistiqueform');
    }

    public function diversform(){
        if(request('idspectacle')){
            $idspectacle = request('idspectacle');
            Session::put('idspectacle',$idspectacle);
        }
        // $liste = DiversSpectacle::liste();
        $liste = DiversSpectacle::get(Session::get('idspectacle'));
        $divers = Divers::liste();
        return view('devis.diversform',
            [
                'divers' => $divers,
                'liste' => $liste
            ]);
    }

    public function adddivers()
    {
        $idspectacle = Session::get('idspectacle');

        if(request('divers')){
            $diversspectacle = new DiversSpectacle();
            $diversspectacle->spectacleid=$idspectacle;
            $diversspectacle->diversid=request('divers');
            $diversspectacle->montant=request('montant');
            $diversspectacle->etat=0;
            $diversspectacle->save();
        }

        return redirect('/devis/diversform');
    }

    public function liste(){
        $liste = Spectacle::from("v_spectacle");
        $liste->whereRaw('etat = 0');
        $liste->orderBy('date', 'asc');
        $spectacle = $liste->paginate(4);
        return view('devis.liste',
            [
                'spectacle' => $spectacle
            ]);
    }

    // UPDATE DEVIS
    public function updatelieuform()
    {
        $id = request('id');
        $lieu = Spectacle::get($id);
        $liste = Lieu::liste();
        return view('devis.updatelieuform',
            [
                'id' => $id,
                'lieu' => $lieu,
                'liste' => $liste
            ]);
    }

    public function updatelieu()
    {
        $lieu = Spectacle::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        $get = Spectacle::get(request('id'));
        $lieu->update([
            //Colonne rehetra modifiena
            'date' => $get['date'],
            'lieuid' => request('lieu'),
            'montant' => request('montant'),
            'etat' => 0
        ]);
        return redirect('/devis/detail');
    }

    public function updateartisteform()
    {
        $id = request('id');
        $artiste = Devis::getartiste($id);
        $liste = Artiste::liste();
        return view('devis.updateartisteform',
            [
                'id' => $id,
                'artiste' => $artiste,
                'liste' => $liste
            ]);
    }

    public function updateartiste()
    {
        $artiste = ArtisteSpectacle::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        $artiste->update([
            //Colonne rehetra modifiena
            'spectacleid' => request('spectacleid'),
            'artisteid' => request('artiste'),
            'duree' => request('duree')
        ]);
        return redirect('/devis/detail');
    }

    public function updatesonorisationform()
    {
        $id = request('id');
        $sonorisation = Devis::getsonorisation($id);
        $liste = TypeSonorisation::liste();
        return view('devis.updatesonorisationform',
            [
                'id' => $id,
                'sonorisation' => $sonorisation,
                'liste' => $liste
            ]);
    }

    public function updatesonorisation()
    {
        $sonorisation = SonorisationSpectacle::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        $sonorisation->update([
            //Colonne rehetra modifiena
            'spectacleid' => request('spectacleid'),
            'typesonorisationid' => request('sonorisation'),
            'duree' => request('duree')
        ]);
        return redirect('/devis/detail');
    }

    public function updatelogistiqueform()
    {
        $id = request('id');
        $logistique = Devis::getlogistique($id);
        $liste = TypeLogistique::liste();
        return view('devis.updatelogistiqueform',
            [
                'id' => $id,
                'logistique' => $logistique,
                'liste' => $liste
            ]);
    }

    public function updatelogistique()
    {
        $logistique = LogistiqueSpectacle::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        $logistique->update([
            //Colonne rehetra modifiena
            'spectacleid' => request('spectacleid'),
            'typelogistiqueid' => request('logistique'),
            'duree' => request('duree')
        ]);
        return redirect('/devis/detail');
    }

    public function updatediversform()
    {
        $id = request('id');
        $divers = Devis::getdivers($id);
        $liste = Divers::liste();
        return view('devis.updatediversform',
            [
                'id' => $id,
                'divers' => $divers,
                'liste' => $liste
            ]);
    }

    public function updatedivers()
    {
        $divers = DiversSpectacle::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        $divers->update([
            //Colonne rehetra modifiena
            'spectacleid' => request('spectacleid'),
            'diversid' => request('divers'),
            'montant' => request('montant')
        ]);
        return redirect('/devis/detail');
    }

    public function supprimerartiste()
    {
        $artiste = ArtisteSpectacle::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        // $artiste->delete();
        $artiste->update([
            //Ovaina 1 ny etat rehefa supprimena le izy
            'etat' => 1
        ]);
        return redirect('/devis/detail');
    }

    public function supprimersonorisation()
    {
        $sonorisation = SonorisationSpectacle::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        // $sonorisation->delete();
        $sonorisation->update([
            //Ovaina 1 ny etat rehefa supprimena le izy
            'etat' => 1
        ]);
        return redirect('/devis/detail');
    }

    public function supprimerlogistique()
    {
        $logistique = LogistiqueSpectacle::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        // $logistique->delete();
        $logistique->update([
            //Ovaina 1 ny etat rehefa supprimena le izy
            'etat' => 1
        ]);
        return redirect('/devis/detail');
    }

    public function supprimerdivers()
    {
        $divers = DiversSpectacle::find(request('id')); // retrouver l'utilisateur ayant l'ID 1
        // $divers->delete();
        $divers->update([
            //Ovaina 1 ny etat rehefa supprimena le izy
            'etat' => 1
        ]);
        return redirect('/devis/detail');
    }

    public function tarifplace()
    {
        if(request('idspectacle')){
            $idspectacle = request('idspectacle');
            Session::put('idspectacle',$idspectacle);
        }

        if(request('idlieu')){
            $idlieu = request('idlieu');
            Session::put('idlieu',$idlieu);
        }

        // $liste = CategorieLieu::gettarifcategorie(Session::get('idlieu'));
        $liste = CategorieLieu::get(Session::get('idlieu'));
        return view('devis.tarifplace',
            [
                'liste' => $liste
            ]);
    }

    public function addtarifplace()
    {
        $idspectacle = Session::get('idspectacle');
        $idlieu = Session::get('idlieu');
        // $liste = CategorieLieu::gettarifcategorie($idlieu);
        $liste = CategorieLieu::get($idlieu);

        foreach($liste as $row){
            $idcategorie = request('categorie'.$row['id']);
            $tarif = request('tarif'.$row['id']);

            $tariflieu = new TarifLieu();
            $tariflieu->spectacleid=$idspectacle;
            $tariflieu->categorieid=$idcategorie;
            $tariflieu->tarif=$tarif;
            $tariflieu->etat=0;
            $tariflieu->save();
        }
        return redirect('/devis/liste');
    }

    public function updatetarifplaceform()
    {
        if(request('idspectacle')){
            $idspectacle = request('idspectacle');
            Session::put('idspectacle',$idspectacle);
        }

        if(request('idlieu')){
            $idlieu = request('idlieu');
            Session::put('idlieu',$idlieu);
        }

        $liste = TarifLieu::get(Session::get('idspectacle'));
        // $liste = CategorieLieu::get(Session::get('idlieu'));
        return view('devis.updatetarifplace',
            [
                'liste' => $liste
            ]);
    }

    public function updatetarifplace()
    {
        $idspectacle = Session::get('idspectacle');
        $liste = TarifLieu::get($idspectacle);

        foreach($liste as $row){
            $idcategorie = request('categorie'.$row['id']);
            $tarif = request('tarif'.$row['id']);

            $tariflieu = TarifLieu::find($row['id']);
            $tariflieu->update([
                'spectacleid' => $idspectacle,
                'categorieid' => $idcategorie,
                'tarif' => $tarif,
                'etat' => 0
            ]);
        }
        return redirect('/devis/liste');
    }

    public function detail(){
        if(request('idspectacle')){
            $idspectacle = request('idspectacle');
            Session::put('idspectacle',$idspectacle);
        }

        $lieu = Devis::lieu(Session::get('idspectacle'));
        $artiste = Devis::artiste(Session::get('idspectacle'));
        $sonorisation = Devis::sonorisation(Session::get('idspectacle'));
        $logistique = Devis::logistique(Session::get('idspectacle'));
        $divers = Devis::divers(Session::get('idspectacle'));

        return view('devis.detail',
            [
                'lieu' => $lieu,
                'artiste' => $artiste,
                'sonorisation' => $sonorisation,
                'logistique' => $logistique,
                'divers' => $divers
            ]);


    }

    public function showpdf()
    {
        try {
            $pdf = new DomPDF();
            // $pdf->loadHtml($content->html);
            $idspectacle = request('idspectacle');

            $spectacle = Affiche::infospectacle($idspectacle);
            $artiste = Affiche::infoartiste($idspectacle);
            $prix = Affiche::infoprix($idspectacle);
            $pdf->loadHtml(view('devis.pdfaffiche', [
                'spectacle' => $spectacle,
                'artiste' => $artiste,
                'prix' => $prix
            ]));

            $pdf->render();
            $output = $pdf->output();
            return response($output, 200)->header('Content-Type', 'application/pdf');
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }


    //
    public function dupliquerform()
    {
        $idspectacle = request('idspectacle');
        Session::put('idspectacle',$idspectacle);

        return view('spectacle.dupliquerform');
    }

    public function dupliquer()
    {
        $idspectacle = Session::get('idspectacle');
            $origine =Spectacle::getspectacle($idspectacle);

            $spectacle = new Spectacle();
            $spectacle->titre=$origine['titre']." bis";
            $spectacle->date=request('date');
            $spectacle->heure=request('heure').":00";
            $spectacle->lieuid=$origine['lieuid'];
            $spectacle->montant=$origine['montant'];
            $spectacle->etat=0;
            $spectacle->save();

            $bis = Spectacle::lastid();

            //Artiste
            $artiste = Artiste::getartistespectacle($idspectacle);
            foreach($artiste as $row){
                $artistespectacle = new ArtisteSpectacle();
                $artistespectacle->spectacleid=$bis;
                $artistespectacle->artisteid=$row['artisteid'];
                $artistespectacle->duree=$row['duree'];
                $artistespectacle->etat=0;
                $artistespectacle->save();
            }

            //Sono
            $sono = Sonorisation::getsonorisationspectacle($idspectacle);
            foreach($sono as $row){
                $sonorisationspectacle = new SonorisationSpectacle();
                $sonorisationspectacle->spectacleid=$bis;
                $sonorisationspectacle->typesonorisationid=$row['typesonorisationid'];
                $sonorisationspectacle->duree=$row['duree'];
                $sonorisationspectacle->etat=0;
                $sonorisationspectacle->save();
            }

            //Log
            $log = Logistique::getlogistiquespectacle($idspectacle);
            foreach($log as $row){
                $logistiquespectacle = new LogistiqueSpectacle();
                $logistiquespectacle->spectacleid=$bis;
                $logistiquespectacle->typelogistiqueid=$row['typelogistiqueid'];
                $logistiquespectacle->duree=$row['duree'];
                $logistiquespectacle->etat=0;
                $logistiquespectacle->save();
            }

            //DIVERS
            $divers = Divers::getdiversspectacle($idspectacle);
            foreach($divers as $row){
                $diversspectacle = new DiversSpectacle();
                $diversspectacle->spectacleid=$bis;
                $diversspectacle->diversid=$row['diversid'];
                $diversspectacle->montant=$row['montant'];
                $diversspectacle->etat=0;
                $diversspectacle->save();
            }

            //TARIF LIEU
            $tariflieu = TarifLieu::gettariflieuspectacle($idspectacle);

            foreach($tariflieu as $row){
                $tariflieu = new TarifLieu();
                $tariflieu->spectacleid=$bis;
                $tariflieu->categorieid=$row['categorieid'];
                $tariflieu->tarif=$row['tarif'];
                $tariflieu->etat=0;
                $tariflieu->save();
            }

            //Vente
            $vente = Vente::getventespectacle($idspectacle);

            foreach($vente as $row){
                $vente = new vente();
                $vente->spectacleid=$bis;
                $vente->categorieid=$row['categorieid'];
                $vente->nbplace=$row['nbplace'];
                $vente->etat=0;
                $vente->save();
            }

            $liste = Spectacle::from("v_spectacle");
        $liste->whereRaw('etat = 0');
        $liste->orderBy('date', 'asc');
        $spectacle = $liste->paginate(4);
        return view('statistiqueevent.listespectacle',
            [
                'spectacle' => $spectacle
            ]);
    }
}
