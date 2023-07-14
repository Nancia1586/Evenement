@extends('side')
@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-md-3">
                <h5 class="card-title">Tarif des places</h5>
            </div>
            <br/>
            <div class="card">
                <div class="card-body">
                    <br/>
                    <form action="/devis/addtarifplace" method="get">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Categorie</th>
                                    <th scope="col">Nombre de places</th>
                                    <th scope="col">Tarif par place (à entrer)</th>
                                </tr>
                            </thead>
                            <?php foreach($liste as $row){ ?>
                                <tr>
                                    <th><?php echo $row['categorie']; ?></th>
                                    <td><?php echo $row['nbplace']; ?> places</td>
                                    <td>
                                        <input type="hidden" name="categorie<?php echo $row['id']; ?>" value="<?php echo $row['categorieid']; ?>">
                                        <input style="width: 400px;" type="text" class="form-control" id="inputPassword4" name="tarif<?php echo $row['id']; ?>"
                                            placeholder="Tarif">
                                    </td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <th scope="col">
                                        <input type="submit" value="Ajouter" class="btn btn-primary">
                                    </th>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
