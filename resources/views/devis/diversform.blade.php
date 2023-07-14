@extends('side')
@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-md-3">
                <h5 class="card-title">Divers depenses</h5>
            </div>
            <div class="col-md-12">
                <button style="width: 100px;" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addService">Nouveau</button>
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
                        <form action="/devis/adddivers" method="get" class="row g-3">
                            <div>
                                <center>
                                    <select style="width: 400px;" name="divers" class="form-control">
                                        <?php foreach($divers as $key){ ?>
                                        <option value="<?php echo $key['id']; ?>"><?php echo $key['designation']; ?></option>
                                        <?php } ?>
                                    </select>
                                </center>
                            </div>
                            <br/>
                            <center><div class="col-12">
                                <input style="width: 400px;" type="text" name="montant" class="form-control" id="inputNanme4" placeholder="Montant">
                            </div></center>
                            <br/>
                            <center><input style="width: 100px;" type="submit" class="btn btn-primary" value="Ajouter"></center>
                        </form>
                        <div class="col-md-12" style="height: 20px;">

                        </div>
                    </div>
                </div>
            </div>
            <br/>
            <div class="card">
                <div class="card-body" style="width: 1300px;">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Divers</th>
                                <th scope="col">Montant</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($liste as $row){ ?>
                            <tr>
                                <th scope="row"><?php echo $row['designation'] ?></th>
                                <td><?php echo $row['montant'] ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <br/>
                <div class="card-body" style="width: 1300px;">
                    <a href="/devis/spectacleform"><button type="button" class="btn btn-success">Terminer</button></a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
