<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{ protected $table = 'employe';

    /**
     * @var array $fillable
     */
protected $id;
protected $nom;
protected $email;
protected $mdp;
protected $etat;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'nom',
        'email',
        'mdp',
        'etat'
    ];
    use HasFactory;

    public static function login($email,$mdp){
        $tab=Employe::fromQuery("select * from employe where Email='".$email."' and mdp=md5('".$mdp."') limit 1");
        $id=0;
        if(count($tab)==0){
            return -1;
        }
        return $tab[0]['id'];
    }
}
