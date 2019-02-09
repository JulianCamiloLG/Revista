/**
 * Created by Camilo on 05/12/2016.
 */
var inputs=[];
$.get("../controllers/controladora.php",{iden:"abierta"},function(abierta){
    if(abierta=="cerrada"){
        location.href="nolog.html";
    }
});

$(document).ready(function (){
    $.get("../controllers/controladora.php",{iden:"par"},function(resp){
        var json=JSON.parse(resp);
        $("#nompar").html(json.nombre);
    });
});

function cerrar(){
    $.post("../controllers/controladora.php",{iden:"cerrar"});

}

function articulos(event){
    event.preventDefault();
    $.post("../controllers/controladora.php",{iden:"artipar"},function(resp){
        alert(resp);
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
            html+="<li><a href='#' class='button' onclick='evaluar(event,\""+articulos[i].id+"\")'>Evaluar</a></li>";
            html+="</ul>";
            html+="</article>";
        }

        $("#content").append(html);
    })

}

function evaluar(event,id){
    event.preventDefault();
    var html="";
    html+="<label>Ingrese nota </label>";
    html+="<input id='nota'><br>";
    html+="<label>Comentarios </label>";
    html+="<textarea id='comentarios' rows='10' cols='30'></textarea><br>";
    html+="<button id='final' onclick='calificar("+id+")'>Finalizar</button>"

    $("#content").append(html);
}

function calificar(id){
    var json={id:id,
        nota:document.getElementById('nota').value,
        comentarios:document.getElementById('comentarios').value
    };
    console.log(json);
    $.post("../controllers/controladora.php",{iden:"calificar",json:json},function(resp){
        console.log(resp);
    })
}