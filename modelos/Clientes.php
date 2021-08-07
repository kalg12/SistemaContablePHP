<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Clientes
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}
	//Implementamos un método para insertar registros
	public function insertar($cedula,$nombre,$correo,$direccion,$telefono,$ContadorAsignado,$referencia)
	{
		$sql="INSERT INTO clientes (cedula,nombre,correo,direccion,telefono,estado,ContadorAsignado,referencia)
		VALUES ('$cedula','$nombre','$correo','$direccion','$telefono','1','$ContadorAsignado','$referencia')";
		return ejecutarConsulta($sql);
	}
    
	//Implementación de método para editar registros
	public function editar($idcliente,$cedula,$nombre,$correo,$direccion,$telefono,$ContadorAsignado,$referencia)
	{
		$sql="UPDATE clientes SET                     
                    cedula='$cedula',       
                    nombre='$nombre',
                    correo='$correo',
                    direccion='$direccion',
                    telefono='$telefono',
                    ContadorAsignado='$ContadorAsignado',
                    referencia='$referencia' 
                WHERE idcliente='$idcliente'";
		return ejecutarConsulta($sql);
	}
    
    //Implementamos el metodo para agregar botón de eliminar cuando desactivamos usuario 13/11/2020
    public function eliminar($idcliente)
    {
        $sql="DELETE FROM clientes WHERE idcliente='$idcliente'";
        return ejecutarConsulta($sql);
    }
    
	//Implementamos un método para desactivar Clientes
	public function desactivar($idcliente)
	{
		$sql="UPDATE clientes SET estado ='0' WHERE idcliente='$idcliente'";
		return ejecutarConsulta($sql);
	}
    //Implementamos un método para Activar Clientes
	public function activar($idcliente)
	{
		$sql="UPDATE clientes SET estado ='1' WHERE idcliente='$idcliente'";
		return ejecutarConsulta($sql);
	}
	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idcliente)
	{
		$sql="SELECT * FROM clientes WHERE idcliente='$idcliente'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM clientes";
		return ejecutarConsulta($sql);		
	}
    
    //Implementar un método para listar los registros y mostrar en el select
	public function select()
	{
		$sql="SELECT idcliente,nombre FROM clientes WHERE estado=1 ORDER BY nombre ASC";
		return ejecutarConsulta($sql);		
	}
}
?>