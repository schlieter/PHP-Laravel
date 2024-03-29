<?php
//include_once "./EmpleadoDB.php";

class Empleado{

    public $nombre;
    public $apellido;
    public $mail;
    public $clave;
    public $perfil;

    public static function Ingreso($mail, $clave){
        $empleados = Empleado::TodosLosEmpleados();
        foreach($empleados as $var){
            if($mail == $var->mail && $clave == $var->clave){
                return "Acceso permitido";
            }
        }
        return "Acceso denegado";
    }

    public function ToString(){
		return $this->nombre." ".$this->apellido." ".$this->mail." ".$this->perfil;
	}
    
    public static function TraerUno($mail, $clave){
        $empleados = Empleado::TodosLosEmpleados();
        foreach($empleados as $var){
            if($mail == $var->mail && $clave == $var->clave){
                return $var;
            }
        }
    }

    public function VerificarPorMail($mail){
        $empleados = Empleado::TodosLosEmpleados();
        foreach($empleados as $var){
            if($mail == $var->mail){
                return 1;
            }
        }
        return 0;
    }
    public function VerificarPorNombreApellido($nombre,$apellido){
        $empleados = $this->TodosLosEmpleados();
        foreach($empleados as $var){
            if($nombre == $var->nombre && $apellido == $var->apellido){
                return 1;
            }
        }
        return 0;
    }

    public function Guardar(){
        if($this->VerificarPorMail($this->mail) == 1){
            return "El mail ya se encuentra utilizado por otro usuario";
        }
        $empleadoDB = new EmpleadoDB();
        $empleadoDB->nombre = $this->nombre;
        $empleadoDB->apellido = $this->apellido;
        $empleadoDB->mail = $this->mail;
        $empleadoDB->clave = $this->clave;
        $empleadoDB->perfil = $this->perfil;
        $empleadoDB->InsertarEmpleado();
        return "ok";
    }

    public static function Borrar($mail){
        if(Empleado::VerificarPorMail($mail) == 0){
            return "El empleado no se encuentra registrado";
        }
        $empleadoDB = new EmpleadoDB();
        $empleadoDB = EmpleadoDB::TraerUnEmpleado($mail);
        $empleadoDB->BorrarEmpleado();
        return "ok";
    }

    public function TodosLosEmpleados(){
        return EmpleadoDB::TraerTodosLosEmpleados();
    }

    public function Modificar(){
        if($this->VerificarPorNombreApellido($this->nombre,$this->apellido) == 1){
            $empleadoDB = new EmpleadoDB();
            $empleadoDB = EmpleadoDB:: TraerUnEmpleadoNombreApellido($this->nombre,$this->apellido);
            $empleadoDB->mail = $this->mail;
            $empleadoDB->clave = $this->clave;
            $empleadoDB->turno = $this->turno;
            $empleadoDB->perfil = $this->perfil;
            $empleadoDB->ModificarEmpleado();
            return "ok";
        }
        return "El empleado no se encuentra registrado";
    }
}
