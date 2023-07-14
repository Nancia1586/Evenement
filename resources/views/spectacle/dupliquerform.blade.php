@extends('side')
@section('content')
<section class="section">
    <div class="row">
    <div class="col-lg-6" style="margin-left: 300px;">

            <div class="card">
                <div class="card-body">
                    <center><h5 class="card-title">DUPLICATION</h5></center>

                    <!-- Vertical Form -->
                    <form action="/devis/dupliquer" method="get" class="row g-3">
                        <div class="col-12">
                            <label for="inputNanme4" class="form-label">Date</label>
                            <input type="date" name="date" class="form-control" id="inputNanme4">
                        </div>
                        <div class="col-12">
                            <label for="inputEmail4" class="form-label">Heure</label>
                            <input type="time" name="heure" class="form-control" id="inputEmail4">
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
