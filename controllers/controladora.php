<?php 

/**
* 
*/
include_once ('../models/Usuario.php');
include_once ('../models/Autor.php');
include_once ('../models/Pares.php');
include_once ('../models/CRUDUsuario.php');
include_once ('../models/CRUDAutor.php');
include_once ('../models/CRUDPares.php');
include_once ('../models/Articulo.php');
include_once ('../models/CRUDArticulo.php');

class controladora 
{
	
	function __construct()
	{
		# code...
	}

	public function cesion_abierta(){
		session_start();
		if(count($_SESSION)==0){
			session_destroy();
			echo "cerrada";
		}else
			echo "abierta";

	}

	public function iniciosesion($datos)
	{
		# code...

		$usuario= new Usuario($datos["user"],$datos["password"]);
		$user=new CRUDUsuario($usuario);
		$resp=$user->consultar();
        if($resp){
			session_start();
			if($usuario->getUsuario()=="admin")
			{
				$_SESSION["usuario"]=$usuario;
				$_SESSION["tipo"]="editor";
			}
			else
				$this->tipo($usuario);
			echo $_SESSION["tipo"];
        }
		else
			echo "el usuario no existe";

	}


	public function registrar_archivo(){
		extract($_REQUEST);
		session_start();
		$autor=$_SESSION["usuario"]->nombre;
		$articulo=new Articulo($titulo,$autor,NULL,$resumen,$temas,$claves,"recibido",$ruta);
		$crud=new CRUDArticulo($articulo);
		$crud->ingresar();
	}

    public function tipo($usuario){
        $autor=new Autor("","","","","",$usuario->getUsuario(),$usuario->getPassword());
        $crud=new CRUDAutor($autor);
        $result=$crud->consultar();
        $row=pg_fetch_array($result);
        if($row!=NULL){
            $_SESSION["usuario"]=new Autor($row["nombre"],$row["direccion"],$row["telefono"],$row["email"],$row["departamento"],$row["usuario"],$row["password"]);
            $_SESSION["tipo"]="autor";
        }
        else{
            $crud2=new CRUDPares($autor);
            $result2=$crud2->consultar();
            $row2=pg_fetch_array($result2);
            echo json_encode($row2);
            $_SESSION["usuario"]=new Pares($row2["nombre"],$row2["direccion"],$row2["telefono"],$row2["email"],"",$row2["especializacion"],$row2["usuario"],$row2["password"]);
            $_SESSION["tipo"]="par";
        }

    }

    public function cerrar_sesion(){
        session_start();
        $_SESSION=Array();
        session_destroy();
    }

	public function nuevo($datos)
	{
		# code...
		extract($datos);
		$usuario= new Usuario($id,$contraseña);
		$user=new CRUDUsuario($usuario);
		$user->ingresar();
		$autor=new Autor($nombre,$direccion,$telefono,$correo,$departamento,$id,$contraseña);
		$autorcito=new CRUDAutor($autor);
		$autorcito->ingresar();
	}
	public function nuevopar($datos)
	{
		# code...
		extract($datos);
		$usuario= new Usuario($id,$contraseña);
		$user=new CRUDUsuario($usuario);
		$user->ingresar();
		$par=new Pares($nombre,$direccion,$telefono,$correo,$departamento,$postgrado,$id,$contraseña);
		$parcito=new CRUDPares($par);
		$parcito->ingresar();

	}

	public function articulos(){
		$articulo=new Articulo("","","","","","","","");
		$crud=new CRUDArticulo($articulo);
		$result=$crud->consultarPorTitulo();
        $array=Array();
		while($row=pg_fetch_array($result)){
            array_push($array,$row);
        }
        echo json_encode($array);
	}

	public function modificar_autor(){
		$crud=new CRUDAutor($_SESSION["usuario"]);
		foreach($_REQUEST["autor"] as $key => $value){
			if($key=="nombre"){
				$crud->autor->setNombre($value);
			}elseif($key=="direccion"){
				$crud->autor->setDireccion($value);
			}elseif($key=="email"){
				$crud->autor->setEmail($value);
			}elseif($key=="telefono"){
				$crud->autor->setTelefono($value);
			}elseif($key=="departamento"){
				$crud->autor->setDepartamento($value);
			}elseif($key=="usuario"){
				$crud->autor->setUsuario($value);
			}elseif($key=="password"){
				$crud->autor->setPassword($value);
			}
		}
		$crud->modificar2($_REQUEST["autor"]);
		echo "Datos Actualizados satisfactoriamente";
	}

	public function articulos_autor(){
		session_start();
		if($_SESSION['tipo']=="autor")
		{
			$crud=new CRUDAutor($_SESSION["usuario"]);
			$resul=$crud->obtener_articulos();
			$array=Array();
			while($row=pg_fetch_assoc($resul)){
				array_push($array,$row);
			}
			echo json_encode($array);
		}
	}

	public function articulos_revision(){
		session_start();
		if($_SESSION['tipo']=="editor"){
			$articulo=new Articulo("","","","","","","","");
			$crud=new CRUDArticulo($articulo);
			echo json_encode($crud->articulo_revision());
		}
	}
}

$obj=new controladora();
$funcion=$_REQUEST['iden'];


if ($funcion=='iniciosesion') {
	# code...
	$datos=$_REQUEST['user'];
	$obj->iniciosesion($datos);
}
elseif ($funcion=='nuevouser') {
	# code...
	$datos=$_REQUEST['nuevo'];
	#echo json_encode($datos);
	$obj->nuevo($datos);
}
elseif ($funcion=='nuevouserpar') {
	# code...
	$datos=$_REQUEST['nuevo'];
	$obj->nuevopar($datos);
}
elseif ($funcion=="articulos"){
	$obj->articulos();

}
elseif($funcion=="subir"){
	$nuevaruta="../files/";
	$archivo=$nuevaruta.basename($_FILES["archivo"]["name"]);
	$_REQUEST["ruta"]=$archivo;
	if(move_uploaded_file($_FILES["archivo"]["tmp_name"],$archivo))
	{
		$obj->registrar_archivo();
		echo "archivo subido correctamente";
	}

}
elseif($funcion=="cerrar"){
    $obj->cerrar_sesion();
}
elseif($funcion=="abierta"){
	$obj->cesion_abierta();
}
elseif($funcion=="autor"){
	session_start();
	if(count($_SESSION)>0){
		echo json_encode($_SESSION["usuario"]);
	}else
		session_destroy();
}
elseif($funcion=="modificarautor"){
	session_start();
	if(count($_SESSION)>0){
		$obj->modificar_autor();
	}else
		session_destroy();
}
elseif($funcion=="articulosdeautor"){
	$obj->articulos_autor();
}
elseif($funcion=="articulosrevision"){
	$obj->articulos_revision();
}

elseif($funcion=="autores"){

}
elseif($funcion=="pares"){

}
elseif($funcion=="usuarios"){

}
elseif($funcion=="revisiones"){

}
elseif($funcion=="articulos"){

}
else if($funcion=="descargar"){

}

 ?>