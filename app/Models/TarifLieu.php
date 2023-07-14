<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TarifLieu extends Model
{ protected $table = 'tariflieu';

    /**
     * @var array $fillable
     */
protected $id;
protected $spectacleid;
protected $categorieid;
protected $tarif;
protected $etat;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'spectacleid',
        'categorieid',
        'tarif',
        'etat'
    ];
    use HasFactory;

    public static function liste(){
        $tab=TarifLieu::fromQuery("select * from v_tariflieu where etat = 0");
        return $tab;
    }

    public static function get($idspectacle){
        $tab=CategorieLieu::fromQuery("select * from v_tariflieu where etat = 0 and spectacleid = ".$idspectacle);
        return $tab;
    }

    public static function gettariflieuspectacle($idspectacle){
        $tab=Logistique::fromQuery("select * from tariflieu where spectacleid = ".$idspectacle);
        return $tab;
    }

}
