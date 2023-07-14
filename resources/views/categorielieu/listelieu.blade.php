<?php
    use App\Models\Util;
    use App\Models\Devis;
?>
@extends('adside')
@section('content')
<section class="section">
    <div class="row">
        <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <h5 class="card-title">Choix lieu</h5>
                        </div>
                        <div class="col-md-5">

                        </div>

                    </div>

                    <br/>
                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">Photo</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Nombre de place</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($lieu as $row){ ?>
                    <tr>
                        <td><img style="max-width: 100px;" src="<?php echo "/".$row['photo']; ?>" alt="<?php echo $row['nom']; ?>"></td>
                        <td><?php echo $row['nom']; ?></td>
                        <td><?php echo $row['nbplace']; ?></td>
                        <td>
                            <a href="/categorielieu/definirnbplace?idlieu=<?php echo $row['id']; ?>"><button style="width: 150px;" type="button" class="btn btn-primary">Definir place</button></a>
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                  <?php echo $lieu->links(); ?>

                </div>

              </div>
            </div>
    </div>
</section>
@endsection
