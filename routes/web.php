<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontOfficeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view(
        'employe.login',
        [
            'id' => '1'
        ]
    );
});

// Route::auto('/chauffeur',ChauffeurController::class);
// Route::auto('/admin',AdminController::class);
// Route::auto('/vehicule',VehiculeController::class);
// Route::auto('/trajet',TrajetController::class);
// Route::auto('/echeance',EcheanceController::class);
// Route::auto('/util',UtilController::class);
// Route::auto('/email',EmailController::class);

// Route::get('/',[FrontOfficeController::class,'listeproduit']);

Route::auto('/employe',EmployeController::class);
Route::auto('/admin',AdminController::class);
Route::auto('/typeprestation',TypePrestationController::class);
Route::auto('/client',ClientController::class);
Route::auto('/artiste',ArtisteController::class);
Route::auto('/sonorisation',SonorisationController::class);
Route::auto('/logistique',LogistiqueController::class);
Route::auto('/typesonorisation',TypeSonorisationController::class);
Route::auto('/typelogistique',TypeLogistiqueController::class);
Route::auto('/lieu',LieuController::class);
Route::auto('/typelieu',TypeLieuController::class);
Route::auto('/divers',DiversController::class);
Route::auto('/categorie',CategorieController::class);
Route::auto('/categorielieu',CategorieLieuController::class);

Route::auto('/devis',DevisController::class);
Route::auto('/taxe',TaxeController::class);
Route::auto('/vente',VenteController::class);
Route::auto('/statistique',StatistiqueController::class);

Route::auto('/util',UtilController::class);
