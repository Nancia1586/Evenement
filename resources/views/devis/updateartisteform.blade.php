@extends('side')
@section('content')
<section class="section">
    <div class="row">
    <div class="col-lg-6" style="margin-left: 300px;">

            <div class="card">
                <div class="card-body">
                    <center><h5 class="card-title">MODIFICATION</h5></center>

                    <!-- Vertical Form -->
                    <form class="row g-3" action="/devis/updateartiste" method="get">
                        <input type="hidden" name="id" class="form-control" value="<?php echo $id; ?>" id="inputNanme4">
                        {{-- idspectacle --}}
                        <input type="hidden" name="spectacleid" class="form-control" value="<?php echo $artiste['id']; ?>" id="inputNanme4">
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Artiste</label>
                            <select name="artiste" class="form-control">
                                <option value="<?php echo $artiste['artisteid']; ?>"><?php echo $artiste['nom']; ?></option>
                                <?php foreach($liste as $key){ ?>
                                <option value="<?php echo $key['id']; ?>"><?php echo $key['nom']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="inputNanme4" class="form-label">Duree</label>
                            <input type="text" name="duree" value="<?php echo $artiste['duree']; ?>" class="form-control" id="inputNanme4">
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
