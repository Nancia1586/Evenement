<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{ protected $table = 'categorie';

    /**
     * @var array $fillable
     */
protected $id;
protected $categorie;
protected $etat;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'categorie',
        'etat'
    ];
    use HasFactory;

    public static function liste(){
        $tab=Categorie::fromQuery("select * from categorie where etat = 0");
        return $tab;
    }
}
