@extends('adside')
@section('content')
<section class="section">
    <div class="row">
        <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <h5 class="card-title">Liste des lieux</h5>
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
                                        <form action="/lieu/add" enctype="multipart/form-data" method="post" class="row g-3">
                                            @csrf
                                            <div>
                                                <center>
                                                    <div class="col-12">
                                                        <input type="file" style="width: 400px;" name="image" class="form-control" id="inputNanme4">
                                                    </div>
                                                </center>
                                                <br/>
                                                <center><input style="width: 400px;" type="text" class="form-control" id="inputPassword4" name="nom"
                                                        placeholder="Nom"></center>
                                                <br>
                                                <center><input style="width: 400px;" type="text" class="form-control" id="inputPassword4" name="place"
                                                        placeholder="Nombre de places"></center>
                                                <br>
                                                <center>
                                                    <select style="width: 400px;" name="type" class="form-control">
                                                        <option value="">Selectionnez un type</option>
                                                        <?php foreach($type as $key){ ?>
                                                        <option value="<?php echo $key['id']; ?>"><?php echo $key['type']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </center>

                                            </div>
                                            <center><input style="width: 100px;" type="submit" class="btn btn-primary" value="Ajouter"></center>
                                        </form>
                                        <div class="col-md-12" style="height: 20px;">

                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Modal modifier --}}
                            <?php foreach($lieu as $row){ ?>
                            <div class="modal fade" id="modifier<?php echo $row['id']; ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Modification</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="col-md-12" style="height: 20px;">

                                        </div>
                                        <form action="/lieu/update" enctype="multipart/form-data" method="post" class="row g-3">
                                            @csrf
                                            <div>
                                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                <input type="hidden" name="photo" value="<?php echo $row['photo']; ?>">
                                                <center>
                                                    <div class="col-12">
                                                        <input type="file" value="<?php echo $row['photo']; ?>" style="width: 400px;" name="image" class="form-control" id="inputNanme4">
                                                    </div>
                                                </center>
                                                <br/>
                                                <center><input style="width: 400px;" type="text" class="form-control" id="inputPassword4" name="nom"
                                                        placeholder="Numero" value="<?php echo $row['nom']; ?>"></center>
                                                <br>
                                                <center><input style="width: 400px;" type="text" class="form-control" id="inputPassword4" name="place"
                                                        placeholder="Numero" value="<?php echo $row['nbplace']; ?>"></center>
                                                <br>
                                                <center>
                                                    <select style="width: 400px;" name="type" class="form-control">
                                                        <option value="<?php echo $row['typelieuid']; ?>"><?php echo $row['type']; ?></option>
                                                        <?php foreach($type as $key){ ?>
                                                        <option value="<?php echo $key['id']; ?>"><?php echo $key['type']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </center>
                                            </div>
                                            <center><input style="width: 100px;" type="submit" class="btn btn-primary" value="Modifier"></center>
                                        </form>
                                        <div class="col-md-12" style="height: 20px;">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>

                            {{-- Modal supprimer --}}
                            {{-- Modal modifier --}}
                            <?php foreach($lieu as $row){ ?>
                            <div class="modal fade" id="supprimer<?php echo $row['id']; ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Suppression</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                         <div class="col-md-12" style="height: 20px;">

                                        </div>
                                        <center><p>Etes-vous sur de vouloir continuer la suppression?</p></center>
                                        <center><button style="width: 150px;" type="button" data-bs-dismiss="modal" class="btn btn-danger">Annuler</button>
                                        <a href="/lieu/supprimer?id=<?php echo $row['id']; ?>"><button style="width: 150px;" type="button" class="btn btn-primary">Supprimer</button></a></center>
                                        <div class="col-md-12" style="height: 20px;">

                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>

                  <table class="table table-borderless">
                    <thead>
                        {{-- Recherche simple --}}
                    <form action="/lieu/liste">
                     <tr>
                        <th scope="col">
                            <input type="text" name="mot" class="form-control" placeholder="Saisissez">
                        </th>
                        <th>
                            <input type="submit" value="Rechercher" class="btn btn-primary">
                        </th>
                        <th></th>
                        <th></th>
                      </tr>
                    </form>

                    {{-- Recherche multicritere --}}
                     <form action="/lieu/liste">
                     <tr>
                        <th scope="col">
                            <input type="text" name="nom" class="form-control" placeholder="Nom">
                        </th>
                        <th scope="col">
                            <input type="text" name="placemin" class="form-control" placeholder="Place min">
                        </th>
                        <th scope="col">
                            <input type="text" name="placemax" class="form-control" placeholder="Place max">
                        </th>
                        <th scope="col">
                            <select name="type" class="form-control">
                                <option value="">Type</option>
                                <?php foreach($type as $key){ ?>
                                <option value="<?php echo $key['id']; ?>"><?php echo $key['type']; ?></option>
                                <?php } ?>
                            </select>
                        </th>
                        <th>
                            <input type="submit" value="Rechercher" class="btn btn-primary">
                        </th>
                        <th></th>
                      </tr>
                      </form>
                      <tr>
                        <th scope="col">Photo</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Nombre de places</th>
                        <th></th>
                        <th scope="col">Type</th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($lieu as $row){ ?>
                    <tr>
                        <td><img style="max-width: 100px;" src="<?php echo "/".$row['photo']; ?>" alt="<?php echo $row['nom']; ?>"></td>
                        <th scope="row"><a href="#"><?php echo $row['nom']; ?></a></th>
                        <td><?php echo $row['nbplace']; ?></td>
                        <td></td>
                        <td><?php echo $row['type']; ?></td>
                        <td>
                            <button style="width: 150px;" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modifier<?php echo $row['id']; ?>">Modifier</button>
                        </td>
                        <td>
                            <button style="width: 150px;" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#supprimer<?php echo $row['id']; ?>">Supprimer</button>
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
