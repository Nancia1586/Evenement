<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divers extends Model
{ protected $table = 'divers';

    /**
     * @var array $fillable
     */
protected $id;
protected $divers;
protected $etat;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'divers',
        'etat'
    ];
    use HasFactory;

    public static function liste(){
        $tab=Divers::fromQuery("select * from divers where etat = 0");
        return $tab;
    }

    public static function getdiversspectacle($idspectacle){
        $tab=Divers::fromQuery("select * from diversspectacle where spectacleid = ".$idspectacle);
        return $tab;
    }
}
