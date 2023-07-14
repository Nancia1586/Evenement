<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtisteSpectacle extends Model
{ protected $table = 'artistespectacle';

    /**
     * @var array $fillable
     */
protected $id;
protected $spectacleid;
protected $artisteid;
protected $duree;
protected $etat;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'spectacleid',
        'artisteid',
        'duree',
        'etat'
    ];
    use HasFactory;

    public static function liste(){
        $tab=ArtisteSpectacle::fromQuery("select * from v_artistespectacle");
        return $tab;
    }

    public static function get($idspectacle){
        $tab=ArtisteSpectacle::fromQuery("select * from v_artistespectacle where etat = 0 and spectacleid = ".$idspectacle);
        return $tab;
    }
}
