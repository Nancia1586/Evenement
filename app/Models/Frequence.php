<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frequence extends Model
{ protected $table = 'frequence';

    /**
     * @var array $fillable
     */
protected $id;
protected $frequence;
protected $etat;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'frequence',
        'etat'
    ];
    use HasFactory;

    public static function liste(){
        $tab=Frequence::fromQuery("select * from frequence where etat = 0");
        return $tab;
    }
}
