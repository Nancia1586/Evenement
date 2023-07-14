<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Util extends Model
{
    public static function diff_datetime($debut, $fin){
        $datetime1 = \Carbon\Carbon::parse($fin);
        $datetime2 = \Carbon\Carbon::parse($debut);
        $diff = $datetime1->diff($datetime2);   //datetime2 - datetime1
        $array = [];
        $array[0] = $diff->format('%d');    //jours
        $array[1] = $diff->format('%h');    //heures
        $array[2] = $diff->format('%i');    //minutes
        $array[3] = $diff->format('%s');    //secondes
        // dump($array);
        return $array;
    }

    public static function diff_date($debut, $fin){
        $date1 = \Carbon\Carbon::parse($fin);
        $date2 = \Carbon\Carbon::parse($debut);
        $diff = $date1->diffInDays($date2);   //date2 - date1
        echo $diff;
    }

    public static function diff_time($debut, $fin){
        $time1 = \Carbon\Carbon::parse($fin);
        $time2 = \Carbon\Carbon::parse($debut);
        $diff = $time1->diff($time2);   //time2 - time1
        $array = [];
        $array[0] = $diff->format('%h');    //heures
        $array[1] = $diff->format('%i');    //minutes
        $array[2] = $diff->format('%s');    //secondes
        // dump($array);
        return $array;
    }

    public function addToDate($datetime, $jour=0, $heure=0, $minute=0, $seconde=0){
        $date = \Carbon\Carbon::parse($datetime);
        $time = \Carbon\CarbonInterval::create(0, 0, 0, $jour, $heure, $minute, $seconde); // Créer un intervalle de temps de 1 heure et 30 minutes
        $date->add($time); // Ajouter le temps à la date actuelle
        // echo $date; // Afficher la nouvelle date
        return $date;
    }

    //Recherche simple
    public static function recherche_simple($mot){
        $tab = Util::fromQuery("select * from auteur where upper(nom) like upper('%".$mot."%') or upper(email) like upper('%".$mot."%')");
        return $tab;
    }

    //Recherche multicritere
    public static function recherche_multicritere($req){
        $tab = Util::fromQuery($req);
        return $tab;
    }

    public static function format($num){
        return number_format($num, 2, '.', ' ');
    }

    public static function base64($photo){
         $path='D:/Etudes/S6/EVALUATION2/Evenement/public/'.$photo;
                $type=pathinfo($path,PATHINFO_EXTENSION);
                $data=file_get_contents($path);
                $photolieu='data:image/'.$type.';base64,'.base64_encode($data);
                return $photolieu;
    }

    public static function date($date){
        // return date('j F Y', strtotime($date));;
        $date = \Carbon\Carbon::createFromFormat('Y/m/d', '2023/06/26')->locale('fr');;
        $formattedDate = $date->format('d F Y');
        // $frs =
        // return $formattedDate;
        return str_replace("Juin", "June", $formattedDate);
    }

    public static function heure($heure){
        $heure = \Carbon\Carbon::createFromFormat('H:i:s', '15:00:00');
        $formattedHeure = $heure->format('H:i');
        return $formattedHeure;
    }

    public static function now(){
        return date('Y-m-j', strtotime('today'));;
    }
}
