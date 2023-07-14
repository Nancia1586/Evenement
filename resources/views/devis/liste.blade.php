<?php
    use App\Models\Util;
    use App\Models\Devis;
    use App\Models\Taxe;
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
                            <h5 class="card-title">Devis d'un spectacle</h5>
                        </div>
                        <div class="col-md-5">

                        </div>

                    </div>

                    <br/>
                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">Titre</th>
                        <th scope="col">Recette</th>
                        <th scope="col">Depense</th>
                        <th scope="col">Benefice brute</th>
                        <th scope="col">Taxe</th>
                        <th scope="col">Benefice reel</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($spectacle as $row){ ?>
                    <tr>
                        <th scope="row"><a href="#"><?php echo $row['titre']; ?></a></th>
                        <td><?php echo Util::format(Devis::totalrecette($row['id'])); ?></td>
                        <td><?php echo Util::format(Devis::totaldevis($row['id'])); ?></td>
                        <td><?php echo Util::format(Devis::totalbenefice($row['id'])); ?></td>
                        <td><?php echo Util::format(Taxe::montant(Devis::totalbenefice($row['id']))); ?></td>
                        <td><?php echo Util::format(Devis::totalbeneficereel($row['id'])); ?></td>
                        <td>
                            <a href="/devis/detail?idspectacle=<?php echo $row['id']; ?>"><button type="button" class="btn btn-primary">Details</button></a>
                        </td>
                        <td>
                            <a href="/devis/tarifplace?idspectacle=<?php echo $row['id']; ?>&&idlieu=<?php echo $row['lieuid']; ?>"><button type="button" class="btn btn-primary">Ajout tarif</button></a>
                        </td>
                        <td>
                            <a href="/devis/updatetarifplaceform?idspectacle=<?php echo $row['id']; ?>&&idlieu=<?php echo $row['lieuid']; ?>"><button type="button" class="btn btn-primary">Modifier tarif</button></a>
                        </td>
                        <td>
                            <a href="/devis/showpdf?idspectacle=<?php echo $row['id']; ?>"><button type="button" class="btn btn-success">PDF</button></a>
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                  <?php echo $spectacle->links(); ?>

                </div>

              </div>
            </div>
    </div>
</section>
@endsection
