<?php
//include_once "./AccesoDatos.php";
class EmpleadoDB{

    public $nombre;
    public $apellido;
    public $mail;
    public $clave;
    public $perfil;

	
	public function ToString(){
		return $this->nombre." ".$this->apellido." ".$this->mail." ".$this->perfil;
	}

	public function InsertarEmpleado()
	{
			   $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			   $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into empleados (nombre,apellido,clave,mail,perfil)values(:nombre,:apellido,:clave,:mail,:perfil)");
			   $consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
			   $consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR);
			   $consulta->bindValue(':mail', $this->mail, PDO::PARAM_STR);
			   $consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
               $consulta->bindValue(':perfil', $this->perfil, PDO::PARAM_STR);
  
			   $consulta->execute();		
			   return $objetoAccesoDato->RetornarUltimoIdInsertado();
	}

	public function BorrarEmpleado()
	{
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
            delete 
            from empleados 				
            WHERE mail=:mail");	
        $consulta->bindValue(':mail',$this->mail, PDO::PARAM_STR);		
        $consulta->execute();
        return $consulta->rowCount();
	}
	public static function TraerUnEmpleado($mail)
	{
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("select * from empleados WHERE mail=:mail");
        $consulta->bindValue(':mail', $mail, PDO::PARAM_STR);
        $consulta->execute();
        $empleado = $consulta->fetchObject('EmpleadoDB');
        return $empleado;
    }
    
    public static function TraerUnEmpleadoNombreApellido($nombre,$apellido)
	{
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("select * from empleados WHERE nombre=:nombre AND apellido=:apellido");
        $consulta->bindValue(':nombre', $nombre, PDO::PARAM_STR);
        $consulta->bindValue(':apellido', $apellido, PDO::PARAM_STR);
        $consulta->execute();
        $empleado = $consulta->fetchObject('EmpleadoDB');
        return $empleado;
	}

	public function ModificarEmpleado()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("
			update empleados 
			set mail=:mail,
			clave=:clave,
			perfil=:perfil
            WHERE nombre=:nombre
            AND apellido=:apellido");
        $consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR);		
		$consulta->bindValue(':mail', $this->mail, PDO::PARAM_STR);
		$consulta->bindValue(':perfil', $this->perfil, PDO::PARAM_STR);
		return $consulta->execute();
	}


  	public static function TraerTodosLosEmpleados()
	{
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("select * from empleados");
        $consulta->execute();			
        return $consulta->fetchAll(PDO::FETCH_CLASS, "EmpleadoDB");
	}
}