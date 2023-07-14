@extends('side')
@section('content')
<section class="section">
    <div class="row">
    <div class="col-lg-6" style="margin-left: 300px;">

            <div class="card">
                <div class="card-body">
                    <center><h5 class="card-title">DEVIS SPECTACLE</h5></center>

                    <!-- Vertical Form -->
                    <form class="row g-3" action="/devis/addspectacle" method="get">
                        <div class="col-12">
                            <label for="inputNanme4" class="form-label">Titre</label>
                            <input type="text" name="titre" class="form-control" id="inputNanme4">
                        </div>
                        <div class="col-12">
                            <label for="inputNanme4" class="form-label">Date</label>
                            <input type="date" name="date" class="form-control" id="inputNanme4">
                        </div>
                        <div class="col-12">
                            <label for="inputNanme4" class="form-label">Heure</label>
                            <input type="time" name="heure" class="form-control" id="inputNanme4">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Lieu</label>
                            <select name="lieu" class="form-control">
                                <?php foreach($lieu as $key){ ?>
                                <option value="<?php echo $key['id']; ?>"><?php echo $key['nom']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="inputNanme4" class="form-label">Montant (lieu)</label>
                            <input type="text" name="montant" class="form-control" id="inputNanme4">
                        </div>
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
