<?php
    use App\Models\Util;
    use App\Models\Devis;
?>
@extends('side')
@section('content')
<section class="section">
    <div class="row">
        <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <h5 class="card-title">Details devis d'un spectacle</h5>
                        </div>
                        <div class="col-md-5">

                        </div>

                    </div>

                    <br/>
                    <div class="row">
                        <div class="col-md-4">
                            <h2 class="card-title">Titre: <?php echo $lieu[0]['titre']; ?></h2>
                        </div>
                        <div class="col-md-4">
                            <h3 class="card-title">Date: <?php echo $lieu[0]['date']; ?></h3>
                        </div>
                        <div class="col-md-4">
                            <h3 class="card-title">Heure: <?php echo $lieu[0]['heure']; ?></h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <h3 style="color: red;" class="card-title">RECETTE: <?php echo Util::format(Devis::totalrecette($lieu[0]['id'])); ?></h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <h3 style="color: red;" class="card-title">DEVIS (DEPENSE): <?php echo Util::format(Devis::totaldevis($lieu[0]['id'])); ?></h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <h3 style="color: red;" class="card-title">BENEFICE: <?php echo Util::format(Devis::totalbenefice($lieu[0]['id'])); ?></h3>
                        </div>
                    </div>
                    <br/>
                    {{-- LIEU --}}
                    <div class="row">
                        <div class="col-md-3">
                            <h5 style="color: green;" class="card-title">Lieu: <?php echo Util::format(Devis::totallieu($lieu[0]['id'])); ?></h5>
                        </div>
                    </div>
                    <table class="table table-bordered" border="1">
                        <thead>
                        <tr>
                            <th></th>
                            <th scope="col">Lieu</th>
                            <th scope="col">Nombre de place</th>
                            <th scope="col">Montant</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($lieu as $row){ ?>
                        <tr>
                            <td><img style="max-width: 100px;" src="<?php echo "/".$row['photolieu']; ?>" alt="<?php echo $row['nom']; ?>"></td>
                            <th scope="row"><a href="#"><?php echo $row['nomlieu']; ?></a></th>
                            <td><?php echo $row['nbplace']; ?></td>
                            <td><?php echo $row['montant']; ?></td>
                            <td>
                                <a href="/devis/updatelieuform?id=<?php echo $row['id']; ?>"><button style="width: 150px;" type="button" class="btn btn-primary">Modifier</button></a>
                            </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <br/>

                    {{-- ARTISTE --}}
                    <div class="row">
                        <div class="col-md-3">
                            <h5 style="color: green;" class="card-title">Artiste: <?php echo Util::format(Devis::totalartiste($lieu[0]['id'])); ?></h5>
                        </div>
                    </div>
                    <br/>
                    <a href="/devis/artisteform?idspectacle=<?php echo $lieu[0]['id']; ?>"><button style="width: 150px;" type="button" class="btn btn-success">Nouveau</button></a>
                    <br/>
                    <table class="table table-bordered" border="1">
                        <thead>
                        <tr>
                            <th></th>
                            <th scope="col">Artiste</th>
                            <th scope="col">Duree</th>
                            <th scope="col">Tarif</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($artiste as $row){ ?>
                        <tr>
                            <td><img style="max-width: 100px;" src="<?php echo "/".$row['photo']; ?>" alt="<?php echo $row['nom']; ?>"></td>
                            <th scope="row"><a href="#"><?php echo $row['nom']; ?></a></th>
                            <td><?php echo $row['duree']; ?></td>
                            <td><?php echo $row['tarif']; ?> par <?php echo $row['frequence']; ?></td>
                            <td>
                                <a href="/devis/updateartisteform?id=<?php echo $row['artistespectacleid']; ?>"><button style="width: 150px;" type="button" class="btn btn-primary">Modifier</button></a>
                            </td>
                            <td>
                                <a href="/devis/supprimerartiste?id=<?php echo $row['artistespectacleid']; ?>"><button style="width: 150px;" type="button" class="btn btn-danger">Supprimer</button></a>
                            </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <br/>

                    {{-- SONORISATION --}}
                    <div class="row">
                        <div class="col-md-3">
                            <h5 style="color: green;" class="card-title">Sonorisation: <?php echo Util::format(Devis::totalsonorisation($lieu[0]['id'])); ?></h5>
                        </div>
                    </div>
                    <br/>
                    <a href="/devis/sonorisationform?idspectacle=<?php echo $lieu[0]['id']; ?>"><button style="width: 150px;" type="button" class="btn btn-success">Nouveau</button></a>
                    <br/>
                    <table class="table table-bordered" border="1">
                        <thead>
                        <tr>
                            <th scope="col">Type</th>
                            <th scope="col">Duree</th>
                            <th scope="col">Tarif</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($sonorisation as $row){ ?>
                        <tr>
                            <th scope="row"><a href="#"><?php echo $row['type']; ?></a></th>
                            <td><?php echo $row['duree']; ?></td>
                            <td><?php echo $row['tarif']; ?> par <?php echo $row['frequence']; ?></td>
                            <td>
                                <a href="/devis/updatesonorisationform?id=<?php echo $row['sonorisationspectacleid']; ?>"><button style="width: 150px;" type="button" class="btn btn-primary">Modifier</button></a>
                            </td>
                            <td>
                                <a href="/devis/supprimersonorisation?id=<?php echo $row['sonorisationspectacleid']; ?>"><button style="width: 150px;" type="button" class="btn btn-danger">Supprimer</button></a>
                            </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <br/>

                    {{-- LOGISTIQUE --}}
                    <div class="row">
                        <div class="col-md-3">
                            <h5 style="color: green;" class="card-title">Logistique: <?php echo Util::format(Devis::totallogistique($lieu[0]['id'])); ?></h5>
                        </div>
                    </div>
                    <br/>
                    <a href="/devis/logistiqueform?idspectacle=<?php echo $lieu[0]['id']; ?>"><button style="width: 150px;" type="button" class="btn btn-success">Nouveau</button></a>
                    <br/>
                    <table class="table table-bordered" border="1">
                        <thead>
                        <tr>
                            <th scope="col">Type</th>
                            <th scope="col">Duree</th>
                            <th scope="col">Tarif</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($logistique as $row){ ?>
                        <tr>
                            <th scope="row"><a href="#"><?php echo $row['type']; ?></a></th>
                            <td><?php echo $row['duree']; ?></td>
                            <td><?php echo $row['tarif']; ?> par <?php echo $row['frequence']; ?></td>
                            <td>
                                <a href="/devis/updatelogistiqueform?id=<?php echo $row['logistiquespectacleid']; ?>"><button style="width: 150px;" type="button" class="btn btn-primary">Modifier</button></a>
                            </td>
                            <td>
                                <a href="/devis/supprimerlogistique?id=<?php echo $row['logistiquespectacleid']; ?>"><button style="width: 150px;" type="button" class="btn btn-danger">Supprimer</button></a>
                            </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <br/>

                    {{-- DIVERS --}}
                    <div class="row">
                        <div class="col-md-5">
                            <h5 style="color: green;" class="card-title">Divers dépenses: <?php echo Util::format(Devis::totaldivers($lieu[0]['id'])); ?></h5>
                        </div>
                    </div>
                    <br/>
                    <a href="/devis/diversform?idspectacle=<?php echo $lieu[0]['id']; ?>"><button style="width: 150px;" type="button" class="btn btn-success">Nouveau</button></a>
                    <br/>
                    <table class="table table-bordered" border="1">
                        <thead>
                        <tr>
                            <th scope="col">Type</th>
                            <th scope="col">Tarif</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($divers as $row){ ?>
                        <tr>
                            <th scope="row"><a href="#"><?php echo $row['designation']; ?></a></th>
                            <td><?php echo $row['tarif']; ?></td>
                            <td>
                                <a href="/devis/updatediversform?id=<?php echo $row['diversspectacleid']; ?>"><button style="width: 150px;" type="button" class="btn btn-primary">Modifier</button></a>
                            </td>
                            <td>
                                <a href="/devis/supprimerdivers?id=<?php echo $row['diversspectacleid']; ?>"><button style="width: 150px;" type="button" class="btn btn-danger">Supprimer</button></a>
                            </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <br/>
                </div>

              </div>
            </div>
    </div>
</section>
@endsection
