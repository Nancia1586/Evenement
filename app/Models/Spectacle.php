<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spectacle extends Model
{ protected $table = 'spectacle';

    /**
     * @var array $fillable
     */
protected $id;
protected $titre;
protected $date;
protected $heure;
protected $lieuid;
protected $montant;
protected $etat;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'titre',
        'date',
        'heure',
        'lieuid',
        'montant',
        'etat'
    ];
    use HasFactory;

     public static function lastid(){
        $tab = Spectacle::fromQuery("select * from spectacle order by id desc limit 1");
        return $tab[0]['id'];
    }

    public static function liste(){
        $tab=Spectacle::fromQuery("select * from spectacle where etat = 0");
        return $tab;
    }

    public static function get($id){
        $tab = Spectacle::fromQuery("select * from v_spectacle where id = ". $id ." limit 1");
        return $tab[0];
    }

    public static function getspectacle($id){
        $tab = Spectacle::fromQuery("select * from spectacle where id = ". $id ." limit 1");
        return $tab[0];
    }
}
