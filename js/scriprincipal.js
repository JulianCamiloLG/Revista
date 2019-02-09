$(document).ready(function () {
	// body...
	var formSesion= $("#logeo").validate({
			rules:{
				user:"required",
				password:"required"
			},
			messages:{
				user:"campo obligatorio",
				password:"campo obligatorio"
			}
		});

	var formRegis=$("#registro").validate({
		rules:{
			id:"required",
			contraseña:{
				required:true,
			},
			ccontraseña:{
				required:true,
				equalTo:"#contraseña"
			},
			nombre:"required",
			Apellido:"required",
			correo:{
				required:true,
				email:true
			}
		},
		messages:{
			id:"campo obligatorio",
			contraseña:{
				required:"campo obligatorio",
				
			},
			ccontraseña:{
				required:"campo obligatorio",
				equalTo:"las contraseñas no coinciden"
			},
			nombre:"campo obligatorio",
			Apellido:"campo obligatorio",
			correo:{
				required:"campo obligatorio",
				email:"formato no valido"}
		}
	});
	$("#logeo").on("submit", function (argument) {
		// body...
		argument.preventDefault();
		if ($("#logeo").valid()) {
			var user={user:$("#user").val(),
			            password:$("#password").val()
			        };
			 //console.log(sesion);

			$.post("../controllers/controladora.php",{iden:"iniciosesion",user:user},function (argument) {
				alert(argument);
				if(argument==="par")
					location.href="pares.html";

				else if(argument==="autor")
					location.href="autores.html";
				else if(argument==="editor")
					location.href="editor.html";
				else
					alert("el usuario no existe");
			});

		}
	});

	$("#registro").on("submit", function (argument) {
		// body...
		argument.preventDefault();
		
		if ($("#registro").valid()) {
			var tipo=$("#tipo").val();
			if (tipo=='par') {
				
				var nuevo={
				id:$("#id").val(),
				contraseña:$("#contraseña").val(),
				nombre:$("#nombre").val(),
				direccion:$("#Apellido").val(),
				telefono:$("#telefono").val(),
				correo:$("#correo").val(),
				departamento:$("#Departamento").val(),
				postgrado:$("#post").val()
			};
			$.post("../controllers/controladora.php",{iden:"nuevouserpar",nuevo:nuevo},function (argument) {
				// body...
				console.log(argument);
			});
			}
			else{
				var nuevo={
				id:$("#id").val(),
				contraseña:$("#contraseña").val(),
				nombre:$("#nombre").val(),
				direccion:$("#Apellido").val(),
				telefono:$("#telefono").val(),
				correo:$("#correo").val(),
				departamento:$("#Departamento").val()
			};
			console.log(nuevo);
			$.post("../controllers/controladora.php",{iden:"nuevouser",nuevo:nuevo},function (argument) {
				// body...
				console.log(argument);
			});
			}
			

		}
	});
	$("#par").on("click",function (argument) {
		// body...
		var tabla=$("#tableR");
		var titulos=$("<tr><td><label>Especializacion</label></td><td><input type=text id=post>");
		tabla.append(titulos);	
	});

	cargar_articulos();

});

function cargar_articulos(){
	$.post("../controllers/controladora.php",{iden:"articulos"},function(resp){
		var articulos=JSON.parse(resp);
		var html="";
		var images=['images/pic01.jpg','images/pic02.jpg','images/pic03.jpg','images/pic04.jpg','images/pic05.jpg'];
		for(var i in articulos){
			var index= Math.round(Math.random()*4);
			html+="<article>";
			html+="<a href='#' class='image'><img src='"+images[index]+"' alt='' /></a>";
			html+="<h3>"+articulos[i].titulo+"</h3>";
			html+="<p>"+articulos[i].resumen+"</p>";
			html+="<p><strong>"+articulos[i].autor+"</strong></p>";
			html+="<ul class='actions'>";
			html+="<li><a href='#' class='button' onclick='descargar(event,\""+articulos[i].ruta+"\")'>Descargar</a></li>";
			html+="</ul>";
			html+="</article>";
		}

		$("#articulos").html(html);
	});
}

function descargar(event,ruta){
	event.preventDefault();
	window.open("../controllers/descargador.php?ruta="+ruta);
}

function redireccionar(pag){
	location.href=pag+".html";
}