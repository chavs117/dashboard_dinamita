<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard dinamita</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="section">
            <button class="btn" id="aforoA">Ver aforo actual</button>
            <table>
                <thead>
                    <tr>
                        <th>Aforo actual </th>
                    </tr>
                </thead>
                <tbody id="res">
                    
                </tbody>
            </table>
            <button class="btn" id="aforoD">Ver aforo del día</button>
            <table>
                <thead>
                    <tr>
                        <th>Aforo del día</th>
                    </tr>
                </thead>
                <tbody id="afoD">
                    
                </tbody>
            </table>
            <button class="btn" id="rechazo">Ver rechazos</button>
            <table>
                <thead>
                    <tr>
                        <th>Cantidad de rechazos</th>
                    </tr>
                </thead>
                <tbody id="rech">

                </tbody>
            </table>
        </div>
    </div>
    <canvas id="chart" width="706" height="352"></canvas>
    
    <script src="ajax.js"></script>    
</body>
<script>
    let miCanvas = document.getElementById('chart').getContext('2d');

    const xhttp = new XMLHttpRequest();
    xhttp.open('GET', 'http://arango.dinamita.site/_db/Aforo_dinamita/dinamita/rechazos', true);
    xhttp.send();
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            //console.log(this.responseText);
            let datos = JSON.parse(this.responseText);
            //console.log(datos);
            let rech = document.querySelector('#rech');
            rech.innerHTML = '';

            var matriz = {};
            datos.forEach(function(recha) {
                var motivo = recha["motivo_rechazo"];
                matriz[motivo] = matriz[motivo] ? (matriz[motivo] + 1) : 1;
            });

            matriz = Object.keys(matriz).map(function(motivo) {
                return { Motivo: motivo, cantidad: matriz[motivo] };
            });
            //console.log(matriz);

            for(let item of matriz){
                //console.log(item.motivo_rechazo);
                var chart = new Chart(miCanvas, {
                    type: "bar",
                    data: {
                        labels: ["Temperatura","Aforo"],
                        datasets: [
                            {
                                label: "Motivo de rechazo",
                                backgroundColor: "blue",
                                borderColor: "rgb(0,255,0)",
                                borderWidth: 2,
                                borderRadius: 5,
                                borderSkipped: false,
                                data: [item.cantidad,item.cantidad]
                            }
                        ]
                    }
                })
            }  
        }
    }
</script>
</html>