<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeLieu extends Model
{ protected $table = 'typelieu';

    /**
     * @var array $fillable
     */
protected $id;
protected $type;
protected $etat;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'type',
        'etat'
    ];
    use HasFactory;

    public static function liste(){
        $tab=TypeLieu::fromQuery("select * from typelieu where etat = 0");
        return $tab;
    }
}
