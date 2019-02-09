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
        alert(resp);
        var articulos=JSON.parse(resp);
        var html="<table>";
        html+="<tr>";
        html+="<th>Titulo</th>";
        html+="<th>Autor</th>";
        html+="<th>Temas</th>";
        html+="<th>Estado</th>";
        html+="<th>Par1</th>";
        html+="<th>Par2</th>";
        html+="<th>Par3</th>";
        html+="</tr>";
        for(var i in articulos){
            html+="<tr>";
            html+="<td>"+articulos[i].titulo+"</td>";
            html+="<td>"+articulos[i].autor+"</td>";
            html+="<td>"+articulos[i].temas+"</td>";
            html+="<td>"+articulos[i].estado+"</td>";
            html+="<td>"+articulos[i].par+"</td>";
            html+="<td>"+articulos[i].par2+"</td>";
            html+="<td>"+articulos[i].par3+"</td>";
            html+="</tr>";
        }
        html+="</table>";
        $("#row1").html(html);
    })
);
