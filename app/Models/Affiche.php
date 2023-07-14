<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affiche extends Model
{
    public static function infospectacle($idspectacle){
        $tab=Artiste::fromQuery("select * from v_spectacle where id = ".$idspectacle);
        return $tab;
    }

    public static function infoartiste($idspectacle){
        $tab=Artiste::fromQuery("select * from v_artistespectacle where spectacleid = ".$idspectacle);
        return $tab;
    }

    public static function infoprix($idspectacle){
        $tab=Artiste::fromQuery("select * from v_tariflieu where spectacleid = ".$idspectacle);
        return $tab;
    }
}
