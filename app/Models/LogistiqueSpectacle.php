<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogistiqueSpectacle extends Model
{ protected $table = 'logistiquespectacle';

    /**
     * @var array $fillable
     */
protected $id;
protected $spectacleid;
protected $typelogistiqueid;
protected $duree;
protected $etat;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'spectacleid',
        'typelogistiqueid',
        'duree',
        'etat'
    ];
    use HasFactory;

    public static function liste(){
        $tab=LogistiqueSpectacle::fromQuery("select * from v_logistiquespectacle");
        return $tab;
    }

    public static function get($idspectacle){
        $tab=DiversSpectacle::fromQuery("select * from v_logistiquespectacle where etat = 0 and spectacleid = ".$idspectacle);
        return $tab;
    }
}
