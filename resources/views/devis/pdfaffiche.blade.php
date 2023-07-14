
        <style>
            table {
                margin-bottom: 1em;
            }

            table td {
                padding: 3px;
            }

            .table1 {
                border: 1px solid rgb(255, 255, 255);
            }

            .table2,.table2 td {
                border: 1px solid silver;
                border-collapse: collapse;
            }

            .table2 td:first-child {
                background-color: lightblue;
            }

            .CSSTableGenerator {
                margin: 0px;
                padding: 0px;
                width: 100%;
                box-shadow: 10px 10px 5px #888888;
                border: 1px solid #000000;
                -moz-border-radius-bottomleft: 0px;
                -webkit-border-bottom-left-radius: 0px;
                border-bottom-left-radius: 0px;
                -moz-border-radius-bottomright: 0px;
                -webkit-border-bottom-right-radius: 0px;
                border-bottom-right-radius: 0px;
                -moz-border-radius-topright: 0px;
                -webkit-border-top-right-radius: 0px;
                border-top-right-radius: 0px;
                -moz-border-radius-topleft: 0px;
                -webkit-border-top-left-radius: 0px;
                border-top-left-radius: 0px;
            }

            .CSSTableGenerator table {
                border-collapse: collapse;
                border-spacing: 0;
                width: 100%;
                height: 100%;
                margin: 0px;
                padding: 0px;
            }

            .CSSTableGenerator tr:last-child td:last-child {
                -moz-border-radius-bottomright: 0px;
                -webkit-border-bottom-right-radius: 0px;
                border-bottom-right-radius: 0px;
            }

            .CSSTableGenerator table tr:first-child td:first-child {
                -moz-border-radius-topleft: 0px;
                -webkit-border-top-left-radius: 0px;
                border-top-left-radius: 0px;
            }

            .CSSTableGenerator table tr:first-child td:last-child {
                -moz-border-radius-topright: 0px;
                -webkit-border-top-right-radius: 0px;
                border-top-right-radius: 0px;
            }

            .CSSTableGenerator tr:last-child td:first-child {
                -moz-border-radius-bottomleft: 0px;
                -webkit-border-bottom-left-radius: 0px;
                border-bottom-left-radius: 0px;
            }

            .CSSTableGenerator tr:hover td {

            }

            .CSSTableGenerator tr:nth-child(odd) {
                background-color: #f1f1ff;
            }o

            .CSSTableGenerator tr:nth-child(even) {
                background-color: #ffffff;
            }

            .CSSTableGenerator td {
                vertical-align: middle;
                border: 1px solid #000000;
                border-width: 0px 1px 1px 0px;
                text-align: left;
                padding: 7px;
                font-size: 15px;
                font-family: Arial, Helvetica, sans-serif;
                font-weight: normal;
                color: #000000;
            }

            .CSSTableGenerator tr:last-child td {
                border-width: 0px 1px 0px 0px;
            }

            .CSSTableGenerator tr td:last-child {
                border-width: 0px 0px 1px 0px;
            }

            .CSSTableGenerator tr:last-child td:last-child {
                border-width: 0px 0px 0px 0px;
            }

            .CSSTableGenerator tr:first-child td {
                background: -o-linear-gradient(bottom, #ff7f00 5%, #bf5f00 100%);
                background: -webkit-gradient(linear, left top, left bottom, color-stop(0.05, #ff7f00), color-stop(1, #bf5f00));
                background: -moz-linear-gradient(center top, #ff7f00 5%, #bf5f00 100%);
                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#ff7f00", endColorstr="#bf5f00");
                background: -o-linear-gradient(top, #ff7f00, bf5f00);
                background-color:#9bb2f7;
                border: 0px solid #000000;
                text-align: center;
                border-width: 0px 0px 1px 1px;
                font-size: 14px;
                font-family: Arial;
                font-weight: bold;
                color: #ffffff;
            }

            .CSSTableGenerator tr:first-child:hover td {
                background: -o-linear-gradient(bottom, #ff7f00 5%, #bf5f00 100%);
                background: -webkit-gradient(linear, left top, left bottom, color-stop(0.05, #ff7f00), color-stop(1, #bf5f00));
                background: -moz-linear-gradient(center top, #ff7f00 5%, #bf5f00 100%);
                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#ff7f00", endColorstr="#bf5f00");
                background: -o-linear-gradient(top, #ff7f00, bf5f00);
                background-color: #ff7f00;
            }

            .CSSTableGenerator tr:first-child td:first-child {
                border-width: 0px 0px 1px 0px;
            }
            .CSSTableGenerator tr:first-child td:last-child {
                border-width: 0px 0px 1px 1px;
            }
        </style>
       <div class="col-lg-12" style="font-family: Arial, Helvetica, sans-serif">
            {{-- Titre --}}
            <center><h1 style="font-family:Bahnschrift;"><?php echo $spectacle[0]['titre']; ?></h1></center>
            <br/>

            {{-- LIEU --}}
            <?php

            ?>

            <center><img style="max-width: 400px;" src="{{Util::base64($spectacle[0]['photolieu'])}}"/></center>
            <center><div>
                <h3 style="background-color: #82e4e7;">Lieu: <?php echo $spectacle[0]['nomlieu']; ?></h3>
                <h3>Date: <?php echo Util::date($spectacle[0]['date']); ?> , Heure: <?php echo Util::heure($spectacle[0]['heure']); ?></h3>
            </div></center>

            <div class="col-lg-12" style="font-family: Arial, Helvetica, sans-serif">
                <div class="card">
                    <table border="0" class="CSSTableGenerator">
                        <tbody>
                           <tr>
                             <td>

                            </td>
                              <td>

                            </td>
                           </tr>
                            <?php foreach($artiste as $row){ ?>
                            <tr style="font-size:80px">
                                <td>
                                    <img style="max-width:80px;" src="{{Util::base64($row['photo'])}}}}"/>
                                </td>
                                <td scope="row"><?php echo $row['nom']; ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div style="padding:0px 100px">
                <h4>Vidim-pidirana: </h4>
                    <table border="0">
                        <tbody>
                            <?php foreach($prix as $row){ ?>
                            <tr>
                                <div style="">
                                </div>
                                <td><?php echo $row['categorie']; ?> : <?php echo  Util::format($row['tarif']); ?>Ar</td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
</div>        </div>
        </div>
    </div>
