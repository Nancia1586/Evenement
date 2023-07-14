<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devis extends Model
{
    public static function artiste($idspectacle){
        $tab=Spectacle::fromQuery("select * from v_devisartiste where etat = 0 and id = ".$idspectacle);
        return $tab;
    }

    public static function sonorisation($idspectacle){
        $tab=Spectacle::fromQuery("select * from v_devissonorisation where etat = 0 and id = ".$idspectacle);
        return $tab;
    }

    public static function logistique($idspectacle){
        $tab=Spectacle::fromQuery("select * from v_devislogistique where etat = 0 and id = ".$idspectacle);
        return $tab;
    }

    public static function lieu($idspectacle){
        $tab=Spectacle::fromQuery("select * from v_spectacle where etat = 0 and id = ".$idspectacle);
        return $tab;
    }

    public static function divers($idspectacle){
        $tab=Spectacle::fromQuery("select * from v_devisdivers where etat = 0 and id = ".$idspectacle);
        return $tab;
    }

    public static function getartiste($id){
        $tab = Spectacle::fromQuery("select * from v_devisartiste where artistespectacleid = ". $id ." limit 1");
        return $tab[0];
    }

    public static function getsonorisation($id){
        $tab = Spectacle::fromQuery("select * from v_devissonorisation where sonorisationspectacleid = ". $id ." limit 1");
        return $tab[0];
    }

    public static function getlogistique($id){
        $tab = Spectacle::fromQuery("select * from v_devislogistique where logistiquespectacleid = ". $id ." limit 1");
        return $tab[0];
    }

    public static function getdivers($id){
        $tab = Spectacle::fromQuery("select * from v_devisdivers where diversspectacleid = ". $id ." limit 1");
        return $tab[0];
    }

    //TOTAL
    public static function totalartiste($idspectacle){
        $liste = Devis::artiste($idspectacle);
        $total = 0;
        foreach($liste as $row){
            $total = $total + ($row['duree'] * $row['tarif']);
        }
        return $total;
    }

    public static function totalsonorisation($idspectacle){
        $liste = Devis::sonorisation($idspectacle);
        $total = 0;
        foreach($liste as $row){
            $total = $total + ($row['duree'] * $row['tarif']);
        }
        return $total;
    }

    public static function totallogistique($idspectacle){
        $liste = Devis::logistique($idspectacle);
        $total = 0;
        foreach($liste as $row){
            $total = $total + ($row['duree'] * $row['tarif']);
        }
        return $total;
    }

    public static function totaldivers($idspectacle){
        $liste = Devis::divers($idspectacle);
        $total = 0;
        foreach($liste as $row){
            $total = $total + $row['tarif'];
        }
        return $total;
    }

    public static function totallieu($idspectacle){
        $liste = Devis::lieu($idspectacle);
        return $liste[0]['montant'];
    }

    //Depense
    public static function totaldevis($idspectacle){
        $artiste = Devis::totalartiste($idspectacle);
        $sonorisation = Devis::totalsonorisation($idspectacle);
        $logistique = Devis::totallogistique($idspectacle);
        $divers = Devis::totaldivers($idspectacle);
        $lieu = Devis::totallieu($idspectacle);

        $total = $artiste + $sonorisation + $logistique + $divers + $lieu;
        return $total;
    }

    //Recette
    public static function totalrecette($idspectacle){
        $tab = Spectacle::fromQuery("select spectacleid,sum(somme) as somme from v_venteplace where spectacleid = ". $idspectacle." group by spectacleid limit 1");
        return $tab[0]['somme'];
    }

    //Recette estime
    public static function totalrecetteestime($idspectacle){
        $tab = Spectacle::fromQuery("select * from v_totalrecettespectacle where id = ". $idspectacle ." limit 1");
        return $tab[0]['recette'];
    }

    //Benefice
    public static function totalbenefice($idspectacle){
        $recette = Devis::totalrecette($idspectacle);
        $depense = Devis::totaldevis($idspectacle);
        $benefice = $recette - $depense;
        return $benefice;
    }

    //Beneficereel
    public static function totalbeneficereel($idspectacle){
        $benefice = Devis::totalbenefice($idspectacle);
        $taxe = Taxe::montant($benefice);
        $reel = $benefice - $taxe;
        return $reel;
    }

    public static function pourcentagelieu($idspectacle){
        $total = Devis::totaldevis($idspectacle);
        $lieu = Devis::totallieu($idspectacle);
        $pourcentage = ($lieu * 100) / $total;
    }

    public static function pourcentagesonorisation($idspectacle){
        $total = Devis::totaldevis($idspectacle);
        $sonorisation = Devis::totalsonorisation($idspectacle);
        $pourcentage = ($sonorisation * 100) / $total;
    }

    public static function pourcentagelogistique($idspectacle){
        $total = Devis::totaldevis($idspectacle);
        $logistique = Devis::totallogistique($idspectacle);
        $pourcentage = ($logistique * 100) / $total;
    }

    public static function pourcentageartiste($idspectacle){
        $total = Devis::totaldevis($idspectacle);
        $artiste = Devis::totalartiste($idspectacle);
        $pourcentage = ($artiste * 100) / $total;
    }

    public static function pourcentagedivers($idspectacle){
        $total = Devis::totaldevis($idspectacle);
        $divers = Devis::totaldivers($idspectacle);
        $pourcentage = ($divers * 100) / $total;
    }
}
