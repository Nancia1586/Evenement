<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logistique extends Model
{ protected $table = 'logistique';

    /**
     * @var array $fillable
     */
protected $id;
protected $typelogistiqueid;
protected $tarif;
protected $frequenceid;
protected $etat;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'typelogistiqueid',
        'tarif',
        'frequenceid',
        'etat'
    ];
    use HasFactory;

    public static function getlogistiquespectacle($idspectacle){
        $tab=Logistique::fromQuery("select * from logistiquespectacle where spectacleid = ".$idspectacle);
        return $tab;
    }
}
