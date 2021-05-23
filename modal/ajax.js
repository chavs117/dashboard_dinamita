//console.log('correcto');
document.querySelector('#aforoA').addEventListener('click', traerDatos);
document.querySelector('#rechazo').addEventListener('click', traerRechazo);
document.querySelector('#aforoD').addEventListener('click', traerAforoD);

function traerDatos(){
    //console.log('dentro de la funcion');
    const xhttp = new XMLHttpRequest();
    xhttp.open('GET', 'http://arango.dinamita.site/_db/Aforo_dinamita/dinamita/aforo_total/aforo_actual', true);
    xhttp.send();
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            //console.log(this.responseText);
            let datos = JSON.parse(this.responseText);
            //console.log(datos);
            let res = document.querySelector('#res');
            res.innerHTML = '';

            for(let item of Object.keys(datos)){
                var aforo = datos[item];
                //console.log(aforo.cantidad_personas);
                res.innerHTML += `
                    <tr>
                        <td>${aforo.cantidad_personas}</td>
                    </tr>
                `
            }
        }
    }
}

/*function traerRechazo(){
    //console.log('dentro de la funcion');
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
                rech.innerHTML += `
                    <tr>
                        <td>${item.Motivo}: ${item.cantidad}</td>
                    </tr>
                `
            }
        }
    }
}*/

function traerAforoD(){
    //console.log('dentro de la funcion');
    const xhttp = new XMLHttpRequest();
    xhttp.open('GET', 'http://arango.dinamita.site/_db/Aforo_dinamita/dinamita/aforo_total', true);
    xhttp.send();
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            //console.log(this.responseText);
            let datos = JSON.parse(this.responseText);
            //console.log(datos);
            let afoD = document.querySelector('#afoD');
            afoD.innerHTML = '';

            for(let item of datos){
                //console.log(item.motivo_rechazo);
                afoD.innerHTML += `
                    <tr>
                        <td>${item.cantidad_personas}</td>
                    </tr>
                `
            }
        }
    }
}