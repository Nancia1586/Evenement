<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypePrestation extends Model
{ protected $table = 'typeprestation';

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

}
