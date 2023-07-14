@extends('side')
@section('content')
<section class="section">
    <div class="row">
    <div class="col-lg-6" style="margin-left: 300px;">

            <div class="card">
                <div class="card-body">
                    <center><h5 class="card-title">PLACE VENDUE</h5></center>

                    <!-- Vertical Form -->
                    <form class="row g-3" action="/vente/addventeplace" method="get">
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Spectacle</label>
                            <select name="spectacle" class="form-control">
                                <?php foreach($spectacle as $key){ ?>
                                <option value="<?php echo $key['id']; ?>"><?php echo $key['titre']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Categorie</label>
                            <select name="categorie" class="form-control">
                                <?php foreach($categorie as $key){ ?>
                                <option value="<?php echo $key['id']; ?>"><?php echo $key['categorie']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="inputNanme4" class="form-label">Nombre de place vendue</label>
                            <input type="text" name="place" class="form-control" id="inputNanme4">
                        </div>
                        <br/>
                            <h5 style="color: red;"><?php echo $erreur; ?></h5>
                        <br/>
                        <div class="text-center">
                            <input type="submit" class="btn btn-primary" value="Valider">
                        </div>
                    </form><!-- Vertical Form -->

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
