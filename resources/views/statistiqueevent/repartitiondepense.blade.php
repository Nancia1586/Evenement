{{-- data: [
    @foreach ($recette as $row)
        {{ $row->montant }},
    @endforeach
]

Atao entre ' ' raha text
categories: [
    @foreach ($mois as $row)
        '{{ $row->abreviation }}',
    @endforeach
] --}}

<?php
    use App\Models\Util;
    use App\Models\Devis;
    use App\Models\Taxe;
?>
@extends('side')
@section('content')
<section class="section">
    <div class="row">
        <div class="col-12">
              <div class="card">

                <div class="card-body">
                  <h5 class="card-title">Repartition des depenses</span></h5>

                    {{-- <a href="#" id="downloadPdf">Download Repossrt Page as PDF</a> --}}
                    {{-- <button id="downloadPdf">Download pdf</button> --}}
                    <br /><br />
                        <div style="width: 30%; height: 400px; clear: both;">
                            <canvas id="fromage" style="width: 40%"></canvas>
                        </div>
                    <script>
                        var xValues = [
                            @foreach ($spectacle as $row)
                                '{{ $row->titre }}',
                            @endforeach
                        ];
                        var yValues = [
                            @foreach ($spectacle as $row)
                                // {{ $row->montant }},
                                {{ Devis::totaldevis($row->id) }},
                            @endforeach
                        ];
                        var barColors = [
                            "#b91d47",
                            "#00aba9",
                            "#2b5797",
                            "#e8c3b9",
                            "#1e7145"
                        ];

                        new Chart("fromage", {
                            type: "pie",
                            data: {
                                labels: xValues,
                                datasets: [{
                                    backgroundColor: barColors,
                                    data: yValues
                                }]
                            },
                            options: {
                                title: {
                                    display: true,
                                    text: "Repartition des depenses"
                                }
                            }
                        });
                    </script>

                </div>

              </div>
            </div>

            <script>
                document.getElementById('downloadPdf').addEventListener('click', function() {
                    var element = document.querySelector('.card-body'); // Sélectionnez l'élément à convertir en PDF
                    var opt = {
                        margin: 1,
                        filename: 'repartition_depenses.pdf',
                        image: { type: 'jpeg', quality: 0.98 },
                        html2canvas: { scale: 2 },
                        jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
                    };
                    html2pdf().from(element).set(opt).save(); // Générer et télécharger le PDF
                });
            </script>

    </div>
</section>
@endsection
