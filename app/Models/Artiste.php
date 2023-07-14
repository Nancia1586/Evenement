<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artiste extends Model
{ protected $table = 'artiste';

    /**
     * @var array $fillable
     */
protected $id;
protected $nom;
protected $tarif;
protected $frequenceid;
protected $photo;
protected $etat;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'nom',
        'tarif',
        'frequenceid',
        'photo',
        'etat'
    ];
    use HasFactory;

    public static function liste(){
        $tab=Artiste::fromQuery("select * from artiste where etat = 0");
        return $tab;
    }

    public static function getartistespectacle($idspectacle){
        $tab=Artiste::fromQuery("select * from artistespectacle where spectacleid = ".$idspectacle);
        return $tab;
    }
}
