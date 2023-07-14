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
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($spectacle as $row){ ?>
                    <tr>
                        <th scope="row"><a href="#"><?php echo $row['titre']; ?></a></th>
                        <td>
                            <a href="/vente/vendueparcategorie?idspectacle=<?php echo $row['id']; ?>"><button style="width: 150px;" type="button" class="btn btn-primary">Voir</button></a>
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
