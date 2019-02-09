/**
 * Created by Camilo on 01/12/2016.
 */
var inputs=[];
$.get("../controllers/controladora.php",{iden:"abierta"},function(abierta){
    if(abierta=="cerrada"){
        location.href="nolog.html";
    }
});

$(document).ready(function (){
    $.get("../controllers/controladora.php",{iden:"autor"},function(resp){
        var json=JSON.parse(resp);
        $("#nomautor").html(json.nombre);
    });
});

function subir (event){
    event.preventDefault();
    var html="<form enctype='multipart/form-data' id='form1'>";
    html+="<label>Titulo</label>";
    html+="<input type='text' name='titulo'/><br>";
    html+="<label>Resumen</label>";
    html+="<textarea rows='10' cols='30' name='resumen' placeholder='breve descripcion...'></textarea><br>";
    html+="<label>Temas</label>";
    html+="<input type='text' name='temas'/><br>";
    html+="<label>Palabras Clave</label>";
    html+="<input type='text' name='claves'/><br>";
    html+="<input type='file' id='file' name='archivo'/><br><br>";
    html+="<button id='btnSubir'>Subir</button>";
    html+="</form>";
    html+="<div id='mensaje'></div>";

    $("#content").html(html);

    $("#form1").on("submit", function(e){
        e.preventDefault();
        //var f = $(this);
        var formData = new FormData(document.getElementById("form1"));
        formData.append("iden", "subir");
        //formData.append(f.attr("name"), $(this)[0].files[0]);
        $.ajax({
                url: "../controllers/controladora.php",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            })
            .done(function(res){
                $("#mensaje").html(res);
            });
    });
}

function actualizar(event){
    event.preventDefault();
    $.get("../controllers/controladora.php",{iden:"autor"},function(resp){
        var datos=JSON.parse(resp);
        var html="<table>";
        for(var key in datos){
            html+="<tr>";
            html+="<th>"+key+"</th>";
            html+="<td id='cel"+key+"'>"+datos[key]+"</td>";
            html+="<td><a href='#' onclick='editar_campo(event,\""+key+"\")'>modificar</a></td>";
            html+="</tr>";
        }
        html+="</table>";
        html+="<button onclick='guardar()'>Guardar</button>";
        html+="<button onclick='recargar()'>Cancelar</button><br><br>";
        html+="<div id='mensaje'></div>";
        $("#content").html(html);
    });
    //$("#content").html(html);
}

function recargar(){
    location.href=location.href;
}

function guardar(){
    var json={};
    for(var i in inputs){
        var valor=document.getElementById("txt"+inputs[i]).value;
        json[inputs[i]]= valor;
    }
    var json2 ={iden:"modificarautor",autor:json};
    $.post("../controllers/controladora.php",json2,function(resp){
        $("#mensaje").html(resp);
    });
    recargar();
}

function editar_campo(event,campo){
    event.preventDefault();
    var id=campo;
    $("#cel"+campo).html("<input type='text' id='txt"+campo+"'/>");
    inputs.push(id);
}

function cerrar(){
    $.post("../controllers/controladora.php",{iden:"cerrar"});

}

function articulos_autor(event){
    event.preventDefault();
    $.get("../controllers/controladora.php",{iden:"articulosdeautor"},function (resp){
        var articulos=JSON.parse(resp);
        var html="";
        var images=['images/pic01.jpg','images/pic02.jpg','images/pic03.jpg','images/pic04.jpg','images/pic05.jpg'];
        for(var i in articulos){
            var index= Math.round(Math.random()*4);
            html+="<article>";
            html+="<a href='#' class='image'><img src='"+images[index]+"' alt='' /></a>";
            html+="<h3>"+articulos[i].titulo+"</h3>";
            html+="<p>"+articulos[i].resumen+"</p>";
            html+="<p><strong>Estado: </strong>"+articulos[i].estado+"</p>";
            html+="<p><strong>"+articulos[i].autor+"</strong></p>";
            html+="<ul class='actions'>";
            html+="<li><a href='#' class='button' onclick='descargar(event,\""+articulos[i].ruta+"\")'>Descargar</a></li>";
            html+="</ul>";
            html+="</article>";
        }

        $("#content").html(html);
    });

}
function descargar(event,ruta){
    event.preventDefault();
    window.open("../controllers/descargador.php?ruta="+ruta);
}