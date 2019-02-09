/**
 * Created by Camilo on 14/11/2016.
 */
var id="";
var vista="cliente";
var pagina=1;

function setId(id2){
    id=id2;
}

function setVista(vista2){
    vista=vista2;
}

function setPagina2(event,pagina2){
    event.preventDefault();
    setPagina(pagina2);
}

function setPagina(pagina2){
    if(pagina!=pagina2){
        pagina=pagina2;
        $("#row1").html("");
        mostrar_clientes();
    }
}

function insertar_datos(){
    for(var i=0;i<100;i++){
        var cliente=crear_cliente();
        mandar_datos("cliente",cliente);
        var mascotas=1+Math.round(Math.random()*2);
        for(var j=0;j<mascotas;j++){
            var mascota=crear_mascota();
            var asociacion=crear_asociacion(mascota,cliente);
            mandar_datos("mascota",mascota);
            mandar_datos("asociacion",asociacion);
        }
    }
}

function mandar_datos(tipo,objeto){
    var json={
        accion:"ingresar",
        objeto:objeto,
        tipo:tipo
    };
    $.post("../Controllers/controladora.php",json);
}

function crear_cliente(){
    var nombres=["camilo","juan","sebastian","esteban","santiago","carlos","julian","diana","andrea","tatiana","vanessa","veronica","natalia"];
    var apellidos=["rodriguez","perez","osorio","orozco","londoño","buitrago","toro","salazar","leon","rico","hernandez","loaiza","castaño","castrillon"];
    var nombre=Math.round(Math.random()*(nombres.length-1));
    var apellido=Math.round(Math.random()*(apellidos.length-1));
    var num1=Math.round(1+Math.random()*300);
    var num2=Math.round(1+Math.random()*300);
    var num3=Math.round(1+Math.random()*300);
    var direccion="CRA "+num1+" N° "+num2+" - "+num3;
    var cedula=Math.round(1000+Math.random()*1000000000);
    var cliente={
        cedula:cedula,
        nombre:nombres[nombre],
        apellido:apellidos[apellido],
        edad:Math.round(18+Math.random()*72),
        direccion:direccion,
        telefono:Math.round(1000000+Math.random()*1000000000)
    };

    //console.log(cliente);
    return cliente;
}

function crear_mascota(){
    var tipos=["perro","gato"];
    var nombres=["pepito","bethoven","tabi","max","rex","alvin","caty","homer","ed","elvis","titan","matias","orion","mongo","gaia","hercules","inca","kingo","fog","aristomulo","felix","lola","lulu","neon","lula","lucas","larry"];
    var tipo=Math.round(Math.random());
    var nombre=Math.round(Math.random()*(nombres.length-1));
    var mascota={
        codigo:Math.round(1+Math.random()*1000000000),
        nombre:nombres[nombre],
        edad:Math.round(1+Math.random()*15),
        tipo:tipos[tipo]
    };
    //console.log(mascota);
    return mascota;
}

function crear_asociacion(mascota,cliente){
    var asociacion={
        codigo:1+Math.round(Math.random()*1000000000),
        codigo_cliente:cliente.cedula,
        nombre_cliente:cliente.nombre,
        codigo_mascota:mascota.codigo,
        nombre_mascota:mascota.nombre
    };
    console.log(asociacion);
    return asociacion;
}

function mostrar_clientes(){
    var json={
        accion:"consultar",
        parametros:{
            tipo:"cliente",
            id:"todo",
            pagina:pagina
        }
    };
    $.get("../controllers/controladora.php",json,mostrar_informacion);
}

function datos_modificar(){
    var inputs=document.getElementsByClassName("mod");
    var json={id:id};
    for(var i in inputs){
        if(inputs[i].value!==""){
            var key=inputs[i].name;
            json[key]=inputs[i].value;
        }
    }
    return json;
}

function borrar(){
    var checks=document.getElementsByClassName("checkbox");
    for(var i in checks){
        if(checks[i].checked)
        {
            var json={
                accion:"borrar",
                id:checks[i].value,
                tipo:"cliente"
            };
            $.post("../Controllers/controladora.php",json);
        }
    }
    location.href="vista1.html";
}

function mostrar_informacion(resp){
    var clientes = JSON.parse(resp);
    var html="<table id='tabla' class='table table-bordered'>";
    html+="<tr><th>selec.</th>";
    for(var key in clientes[0]){
        html+="<th>"+key+"</th>";
    }
    html+="<th></th></tr>";
    for(var i in clientes){
        html+="<tr><td><input type='checkbox' value='"+clientes[i].cedula+"' class='checkbox'></td>";
        for(var key in clientes[i]){
            html+="<td>"+clientes[i][key]+"</td>";
        }
        html+="<td><a href='#' data-toggle='modal' data-target='#myModal' onclick='setId("+clientes[i].cedula+")'>modificar</a></td></tr>";
    }
    html+="</table><button class='btn btn-primary' onclick='borrar()'>Eliminar</button>";
    $("#row1").html(html);
    paginador();
}

function paginador(){
    var json={
        accion:"consultar",
        parametros:{
            tipo:"cliente",
            id:"cantidad"
        }
    };
    $.get("../Controllers/controladora.php",json,function (resp){
        json=JSON.parse(resp);
        var cantidad=parseInt(json.cantidad);
        crearPaginador(cantidad);
    });
}

function crearPaginador(cantidad){
    var html="<nav aria-label='Page navigation'>";
    html+="<ul class='pagination'>";
    html+="<li>";
    html+="<a href='#' aria-label='Previous' onclick='anterior()'>";
    html+="<span aria-hidden='true'>&laquo;</span>";
    html+="</a>";
    html+="</li>";
    html+="<li><a href='#' onclick='setPagina2(event,1);' class='pag'>1</a></li>";
    html+="<li><a href='#' onclick='setPagina2(event,2);' class='pag'>2</a></li>";
    html+="<li><a href='#' onclick='setPagina2(event,3);' class='pag'>3</a></li>";
    html+="<li><a href='#' onclick='setPagina2(event,4);' class='pag'>4</a></li>";
    html+="<li><a href='#' onclick='setPagina2(event,5);' class='pag'>5</a></li>";
    html+="<li>";
    html+="<a href='#' aria-label='Next' onclick='siguiente("+cantidad+")'>";
    html+="<span aria-hidden='true'>&raquo;</span>";
    html+="</a>";
    html+="</li>";
    html+="</ul>";
    html+="</nav>";
    $("#row1").append(html);

}

function correr(){

}

function siguiente(cantidad){
    if((pagina+1)*14-cantidad<14){
        setPagina(pagina+1);

    }
}

function anterior(){
    if(pagina>1){
        setPagina(pagina-1);

    }
}

function modificar(){
    if(vista=="cliente"){
        modificar1();
    }
    else if(vista=="mascota"){
        modificar2();
    }
}

function modificar1(){
    var html="<div class='container-fluid'>";
    html+="<div class='row'>";
    html+="<label class='col-xs-4'>Cedula</label>";
    html+="<label class='col-xs-4'>Nombre</label>";
    html+="<label class='col-xs-4'>Apellido</label>";
    html+="</div>";

    html+="<div class='row'>";
    html+="<input type='text' id='txtcedula' name='cedula' class='col-xs-3 mod'>";
    html+="<input type='text' id='txtnombre' name='nombre' class='col-xs-3 col-xs-offset-1 mod'>";
    html+="<input type='text' id='txtapellido' name='apellido' class='col-xs-3 col-xs-offset-1 mod'>";
    html+="</div>";
    html+="<br>";

    html+="<div class='row'>";
    html+="<label class='col-xs-4'>Edad</label>";
    html+="<label class='col-xs-4'>Direccion</label>";
    html+="<label class='col-xs-4' >Telefono</label>";
    html+="</div>";

    html+="<div class='row'>";
    html+="<input type='text' id='txtedad' name='edad' class='col-xs-3 mod'>";
    html+="<input type='text' id='txtdireccion' name='direccion' class='col-xs-3 col-xs-offset-1 mod'>";
    html+="<input type='text' id='txttelefono' name='telefono' class='col-xs-3 col-xs-offset-1 mod'>";
    html+="</div>";
    html+="</div>";
    $("#cuerpo").html(html);
}

function modificar2(){

}

$(document).ready(function(){
    mostrar_clientes();
    modificar();

    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').focus()
    });

    $("#guardar").click(function(){
        var json={
            accion:"modificar",
            tipo:vista,
            parametros:datos_modificar()
        };
        $.post("../Controllers/controladora.php",json);
        location.href="vista1.html";
    });



    $("#crear").click(function(event){
        event.preventDefault();
        insertar_datos();
        mostrar_clientes();
    });
});

