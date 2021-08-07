<?php
//session_start(); 
require_once "../modelos/Clientes.php";

$cliente=new Clientes();

//Variables
$idcliente=isset($_POST["idcliente"])? limpiarCadena($_POST["idcliente"]):"";
$cedula=isset($_POST["cedula"])? limpiarCadena($_POST["cedula"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$correo=isset($_POST["correo"])? limpiarCadena($_POST["correo"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$ContadorAsignado=isset($_POST["ContadorAsignado"])? limpiarCadena($_POST["ContadorAsignado"]):"";
$referencia=isset($_POST["referencia"])? limpiarCadena($_POST["referencia"]):"";

switch ($_GET["op"]){
    
     case 'eliminar':
        $rspta=$cliente->eliminar($idcliente);
        echo $rspta ? "Cliente eliminado" : "No se puede eliminar el cliente";
    break; 
        
    case 'guardaryeditar':
		if (empty($idcliente)){
			$rspta=$cliente->insertar($cedula,$nombre,$correo,$direccion,$telefono,$ContadorAsignado,$referencia);
			echo $rspta ? "Cliente registrado" : "No se puede registar al cliente";
		}
		else {
			$rspta=$cliente->editar($idcliente,$cedula,$nombre,$correo,$direccion,$telefono,$ContadorAsignado,$referencia);
			echo $rspta ? "Cliente actualizado" : "No se puede registar al cliente";
		}
	break;

	case 'desactivar':
		$rspta=$cliente->desactivar($idcliente);
 		echo $rspta ? "Cliente desactivado" : "No se puede desactivar al cliente";
	break;

	case 'activar':
		$rspta=$cliente->activar($idcliente);
 		echo $rspta ? "Cliente activado" : "No se puede desactivar al cliente";
	break;
        
	case 'mostrar':
		$rspta=$cliente->mostrar($idcliente);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;
        
	case 'listar':
		$rspta=$cliente->listar($idcliente);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idcliente.')"><i class="fa fa-pencil"></i></button>'.
                	'<button class="btn btn-danger" onclick="desactivar('.$reg->idcliente.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idcliente.')"><i class="fa fa-pencil"></i></button>'.
 					'<button class="btn btn-primary" onclick="activar('.$reg->idcliente.')"><i class="fa fa-check"></i></button>'.
                    '<button class="btn btn-danger" onclick="eliminar('.$reg->idcliente.')"> <i class="fa fa-trash"> </i></button>',
                                                    
 				"1"=>$reg->cedula,
 				"2"=>$reg->nombre,
                "3"=>$reg->correo,
 			    "4"=>$reg->direccion,
 				"5"=>$reg->telefono,
                "7"=>$reg->ContadorAsignado,
                "8"=>$reg->referencia,
                "6"=>($reg->estado)?'<span class="label bg-primary">Activado</span>':'<span class="bg-warning">Desactivado</span>');
                
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
        
        //AGREGADO DEL LIST KEVIN 17/11/2020
        
    case "selectUsuario":
        require_once "../modelos/Usuarios.php";
        $usuario = new Usuarios();
        
        $rspta = $usuario->select();
        
        while($reg = $rspta->fetch_object())
        {
            echo '<option value='.$reg->idusuario .'>'.$reg->nombre .'</option>';
        }
    break;        
}
?>