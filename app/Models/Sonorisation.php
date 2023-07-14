<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sonorisation extends Model
{ protected $table = 'sonorisation';

    /**
     * @var array $fillable
     */
protected $id;
protected $typesonorisationid;
protected $tarif;
protected $frequenceid;
protected $etat;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'typesonorisationid',
        'tarif',
        'frequenceid',
        'etat'
    ];
    use HasFactory;

    public static function liste(){
        $tab=Sonorisation::fromQuery("select * from v_sonorisation where etat = 0");
        return $tab;
    }

    public static function getsonorisationspectacle($idspectacle){
        $tab=Sonorisation::fromQuery("select * from sonorisationspectacle where spectacleid = ".$idspectacle);
        return $tab;
    }
}
