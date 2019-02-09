/**
 * Created by Camilo on 03/12/2016.
 */

$.get("../controllers/controladora.php",{iden:"abierta"},function(abierta){
    if(abierta=="cerrada"){
        location.href="noedit.html";
    }
});
$(document).ready(
    $.post("../controllers/controladora.php",{iden:"articulosrevision"},function(resp){
        var articulos=JSON.parse(resp);
        var html="<table>";
        html+="<tr>";
        html+="<th>Id</th>";
        html+="<th>Titulo</th>";
        html+="<th>Autor</th>";
        html+="<th>Temas</th>";
        html+="<th>Estado</th>";
        html+="<th>Nota1</th>";
        html+="<th>Nota2</th>";
        html+="<th>Nota3</th>";
        html+="<th>Calificacion</th>";
        html+="<th>Par1</th>";
        html+="<th>Par2</th>";
        html+="<th>Par3</th>";
        html+="</tr>";
        for(var i in articulos){
            html+="<tr id='fila"+i+"'>";
            html+="<td>"+articulos[i].id+"</td>";
            html+="<td>"+articulos[i].titulo+"</td>";
            html+="<td>"+articulos[i].autor+"</td>";
            html+="<td>"+articulos[i].temas+"</td>";
            html+="<td>"+articulos[i].estado+"</td>";
            html+="<td>"+articulos[i].nota1+"</td>";
            html+="<td>"+articulos[i].nota2+"</td>";
            html+="<td>"+articulos[i].nota3+"</td>";
            html+="<td>"+articulos[i].calificacion+"</td>";
            html+="<td class='campos"+i+"'>"+articulos[i].par1+"</td>";
            html+="<td class='campos"+i+"'>"+articulos[i].par2+"</td>";
            html+="<td class='campos"+i+"'>"+articulos[i].par3+"</td>";
            html+="<td><a href='#' onclick='asignar(event,\"campos"+i+"\")'>Asignar</a></td>";
            html+="<td><button onclick='guardar("+articulos[i].id+",\"campos"+i+"\")'>Guardar</button></td>";
            html+="</tr>";
        }
        html+="</table><br>";

        $("#row1").html(html);
    })
);


function asignar(event,clase){
    event.preventDefault();
    $.post("../controllers/controladora.php",{iden:"pares"},function(resp){
        var pares=JSON.parse(resp);
        var campos=document.getElementsByClassName(clase);

        for(var i in campos){
            console.log(pares);
            var select="<select id='select"+i+"'>";
            for(var j in pares){
                select+="<option value='"+pares[j].nombre+"'>"+pares[j].nombre+"</option>";
            }
            select+="</select>";
            $("."+clase).html(select);
        }
    });


}

function guardar(id,clase){
    var pares=document.getElementsByClassName(clase);
    var json={
        id:id,
        par:pares[0].children[0].value,
        par2:pares[1].children[0].value,
        par3:pares[2].children[0].value
    };
    console.log(json);
    $.post("../controllers/controladora.php",{iden:"updatepares",json:json},function(resp){
        console.log(resp);
    })

}