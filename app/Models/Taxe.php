<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taxe extends Model
{ protected $table = 'taxe';

    /**
     * @var array $fillable
     */
protected $id;
protected $taxe;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'taxe'
    ];
    use HasFactory;

    public static function pourcentage(){
        $tab=Lieu::fromQuery("select * from taxe");
        return $tab[0];
    }

    public static function montant($benefice){
        $taxe = Taxe::pourcentage();
        $pourcentage = $taxe['taxe'];
        $montant = ($benefice * $pourcentage) / 100;
        return $montant;
    }

    // public static function pourcentage(){
    //     $tab=TaxeBenefice::fromQuery("select * from taxebenefice");
    //     return $tab;
    // }

    // public static function montant($montant)
    // {
    //     $taxe = Taxe::pourcentage();
    //     $res = 0;
    //     for($i=0; $i<count($taxe); $i++){
    //         if(($montant >= $taxe[$i]['min']) && ($montant <= $taxe[$i]['max'])){
    //             $res = ($montant * $taxe[$i]['taxe']) / 100;
    //             break;
    //         }
    //     }
    //     return $res;
    // }
}
