<?php 



/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


include_once 'Conexion.php';
 
  class Cla_principal extends Conexion{
      private $consulta;
    //funcion para consultar los datos ingresados por formulario para iniciar sesion
    public function iniciarsesion($usuario,$clave){  
        $salt = sprintf('$2a$%02d$', 7);
        $clave = crypt($clave, $salt);
        $this->consulta="SELECT * FROM usuarios WHERE usu_log='$usuario' AND usu_con='$clave'";
        return parent::consulta($this->consulta);        
    }   
    // cargar todos los datos del consecutivo LP2
    public function AsigLP2(){        
        $this->consulta="SELECT Max( pac_lp2 ) as maximo FROM pacientes";
        return parent::consulta($this->consulta);        
    } 
    
    
   
    
    
  }
  