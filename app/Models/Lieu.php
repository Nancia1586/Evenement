<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lieu extends Model
{ protected $table = 'lieu';

    /**
     * @var array $fillable
     */
protected $id;
protected $nom;
protected $typelieuid;
protected $nbplace;
protected $photo;
protected $etat;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'nom',
        'typelieuid',
        'nbplace',
        'photo',
        'etat'
    ];
    use HasFactory;

    public static function liste(){
        $tab=Lieu::fromQuery("select * from lieu where etat = 0");
        return $tab;
    }
}
