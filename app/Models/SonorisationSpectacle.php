<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SonorisationSpectacle extends Model
{ protected $table = 'sonorisationspectacle';

    /**
     * @var array $fillable
     */
protected $id;
protected $spectacleid;
protected $typesonorisationid;
protected $duree;
protected $etat;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'spectacleid',
        'typesonorisationid',
        'duree',
        'etat'
    ];
    use HasFactory;

    public static function liste(){
        $tab=SonorisationSpectacle::fromQuery("select * from v_sonorisationspectacle");
        return $tab;
    }

    public static function get($idspectacle){
        $tab=DiversSpectacle::fromQuery("select * from v_sonorisationspectacle where etat = 0 and spectacleid = ".$idspectacle);
        return $tab;
    }
}
