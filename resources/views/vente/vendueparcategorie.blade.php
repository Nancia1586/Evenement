<?php
    use App\Models\Util;
    use App\Models\Devis;
    use App\Models\Vente;
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
                            <h5 class="card-title">Nombre de place vendue</h5>
                        </div>
                        <div class="col-md-5">

                        </div>

                    </div>

                    <br/>
                  <table class="table table-borderless">
                    <?php foreach($categorie as $row){ ?>
                    <tr>
                        <th scope="row"><a href="#"><?php echo $row['categorie']; ?></a></th>
                        <td>
                            <?php echo Vente::placevendue($idspectacle,$row['id']); ?>
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                  </table>


                </div>

              </div>
            </div>
    </div>
</section>
@endsection
