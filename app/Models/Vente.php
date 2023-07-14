<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{ protected $table = 'vente';

    /**
     * @var array $fillable
     */
protected $id;
protected $spectacleid;
protected $categorieid;
protected $nbplace;
protected $etat;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'spectacleid',
        'categorieid',
        'nbplace',
        'etat'
    ];
    use HasFactory;

    // public static function liste(){
    //     $tab=TarifLieu::fromQuery("select * from v_tariflieu where etat = 0");
    //     return $tab;
    // }

    // public static function get($idspectacle){
    //     $tab=CategorieLieu::fromQuery("select * from v_tariflieu where etat = 0 and spectacleid = ".$idspectacle);
    //     return $tab;
    // }

    public static function placevendue($idspectacle, $idcategorie){
        $tab=CategorieLieu::fromQuery("select * from v_placevenduespectacle where id = ".$idspectacle." and categorieid = ".$idcategorie);
        return $tab[0]['placevendue'];
    }

    public static function placespectacle($idspectacle, $idcategorie){
        $tab=CategorieLieu::fromQuery("select * from v_placespectacle where spectacleid = ".$idspectacle." and categorieid = ".$idcategorie);
        return $tab[0];
    }

    public static function getventespectacle($idspectacle){
        $tab=Sonorisation::fromQuery("select * from vente where spectacleid = ".$idspectacle);
        return $tab;
    }
}
