<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxeBenefice extends Model
{ protected $table = 'taxebenefice';

    /**
     * @var array $fillable
     */
protected $id;
protected $min;
protected $max;
protected $taxe;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'min',
        'max',
        'taxe'
    ];
    use HasFactory;

    // public static function pourcentage(){
    //     $tab=TaxeBenefice::fromQuery("select * from taxe");
    //     return $tab[0];
    // }

    // public static function montant($benefice){
    //     $taxe = Taxe::pourcentage();
    //     $pourcentage = $taxe['taxe'];
    //     $montant = ($benefice * $pourcentage) / 100;
    //     return $montant;
    // }

    //Raha par intervalle
    // public static function montant($montant)
    // {
    //     $taxe = Taxe::pourcentage();
    //     $total = $montant;
    //     $m = $total;
    //     $res = 0;
    //     for($i=0; $i<count($taxe); $i++){
    //         if($m - $taxe[$i]['max'] > 0){
    //             $res = $res + (($taxe[$i]['max'] * $taxe[$i]['taxe']) / 100);
    //             $m = $m - $taxe[$i]['max'];
    //             continue;
    //         }
    //         else{
    //             $res = $res + (($m * $taxe[$i]['taxe']) / 100);
    //             break;
    //         }
    //     }
    //     return $res;
    // }

    public static function pourcentage(){
        $tab=TaxeBenefice::fromQuery("select * from taxebenefice");
        return $tab;
    }

    public static function montant($montant)
    {
        $taxe = Taxe::pourcentage();
        $res = 0;
        for($i=0; $i<count($taxe); $i++){
            if(($montant >= $taxe[$i]['min']) && ($montant <= $taxe[$i]['max'])){
                $res = ($montant * $taxe[$i]['taxe']) / 100;
                break;
            }
        }
        return $res;
    }
}
