<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiversSpectacle extends Model
{ protected $table = 'diversspectacle';

    /**
     * @var array $fillable
     */
protected $id;
protected $spectacleid;
protected $diversid;
protected $montant;
protected $etat;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'spectacleid',
        'diversid',
        'montant',
        'etat'
    ];
    use HasFactory;

    public static function liste(){
        $tab=DiversSpectacle::fromQuery("select * from v_diversspectacle");
        return $tab;
    }

    public static function get($idspectacle){
        $tab=DiversSpectacle::fromQuery("select * from v_diversspectacle where etat = 0 and  spectacleid = ".$idspectacle);
        return $tab;
    }
}
