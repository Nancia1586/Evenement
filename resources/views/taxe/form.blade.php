@extends('adside')
@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-md-3">
                <h5 class="card-title">Liste</h5>
            </div>
            <div class="col-md-12">
                <button style="width: 100px;" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addService">Nouveau</button>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="modifier" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Modification</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="col-md-12" style="height: 20px;">

                                        </div>
                                        <form action="/taxe/update" method="get">
                                           <div>
                                                <input type="hidden" name="id" value="<?php echo $taxe['id']; ?>">
                                                <center><input style="width: 400px;" type="text" class="form-control" id="inputPassword4" name="taxe"
                                                        placeholder="Numero" value="<?php echo $taxe['taxe']; ?>"></center>
                                            </div>
                                            <center><input style="width: 100px;" type="submit" class="btn btn-primary" value="Modifier"></center>
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
                        <tbody>
                            <tr>
                                <th scope="row">Taxe</th>
                                <td><?php echo $taxe['taxe']; ?> % </td>
                                <td>
                                    <button style="width: 150px;" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modifier">Modifier</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
