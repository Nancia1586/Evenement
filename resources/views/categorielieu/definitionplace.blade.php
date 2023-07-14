@extends('adside')
@section('content')
<section class="section">
    <div class="row">
        <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <h5 class="card-title">Liste des categories de places</h5>
                        </div>
                        <div class="col-md-7">

                        </div>
                        <div class="col-md-2">
                            <br/>
                            <div class="col-md-12">
                                <button style="width: 150px;" type="button"
                                        class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addService">Nouveau</button>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="addService" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Nouveau</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="col-md-12" style="height: 20px;">

                                        </div>
                                        <form action="/categorielieu/addnbplace" method="get" class="row g-3">
                                            <div>
                                                <center>
                                                    <select style="width: 400px;" name="categorie" class="form-control">
                                                        <option value="">Selectionnez une categorie</option>
                                                        <?php foreach($categorie as $key){ ?>
                                                        <option value="<?php echo $key['id']; ?>"><?php echo $key['categorie']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </center>
                                                <br>
                                                <center><input style="width: 400px;" type="text" class="form-control" id="inputPassword4" name="nbplace"
                                                        placeholder="Nombre de place"></center>
                                                <br>

                                            </div>
                                            <center><input style="width: 100px;" type="submit" class="btn btn-primary" value="Ajouter"></center>
                                        </form>
                                        <div class="col-md-12" style="height: 20px;">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h5 class="card-title" style="color: red;"><?php echo $erreur; ?></h5>

                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Categorie</th>
                        <th scope="col">Nombre de place</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($liste as $row){ ?>
                    <tr>
                        <th scope="row"><a href="#"><?php echo $row['nom']; ?></a></th>
                        <td><?php echo $row['categorie']; ?></td>
                        <td><?php echo $row['nbplace']; ?></td>
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
