<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorieLieu extends Model
{ protected $table = 'categorielieu';

    /**
     * @var array $fillable
     */
protected $id;
protected $lieuid;
protected $categorieid;
protected $nbplace;
protected $etat;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'lieuid',
        'categorieid',
        'nbplace',
        'etat'
    ];
    use HasFactory;

    public static function liste(){
        $tab=CategorieLieu::fromQuery("select * from v_categorielieu where etat = 0");
        return $tab;
    }

    public static function get($idlieu){
        $tab=CategorieLieu::fromQuery("select * from v_categorielieu where etat = 0 and lieuid = ".$idlieu);
        return $tab;
    }

    public static function gettarifcategorie($idspectacle){
        $tab=CategorieLieu::fromQuery("select * from v_tarifcategorielieu where spectacleid = ".$idspectacle);
        return $tab;
    }

    public static function place($idlieu){
        $tab=CategorieLieu::fromQuery("select * from v_nombreplacelieu where lieuid = ".$idlieu);
        return $tab[0];
    }

    public static function getcategorielieuspectacle($idlieu){
        $tab=Logistique::fromQuery("select * from categorielieu where lieuid = ".$idlieu);
        return $tab;
    }
}
