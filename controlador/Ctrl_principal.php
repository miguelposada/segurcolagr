<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of newPHPClass
 *
 * @author MPosada
 */
session_start(); 
include_once '../../clinicaveterinaria/clases/Cla_principal.php';
$ctprincipal = new Cla_principal(); 

 if (isset($_GET['usuario'])&&isset($_GET['clave'])) {      
       
     $usu = $ctprincipal->iniciarsesion($_GET['usuario'], $_GET['clave']); 
      if (count($usu)!=0)//si coinciden los datos de login
       { 
        $_SESSION['SesionUsuario']=$_GET['usuario'];//crear sesion con usuario
        $_SESSION['SesionClave']=$_GET['clave'];//crear sesion con contraseña
        echo json_encode($usu);
       }else{           
        echo json_encode($usu);
       }
 }
 // consultar si hay sesion activa de lo contrario crear las sesion
  if (isset($_GET['estadosesion'])) { 
       
        if(!@$_SESSION['estadosesion']){//si no esta iniciada la sesion
             $html =0; 
              echo json_encode($html); 
        }else{           
            $var = strtotime(date("Y-m-d H:i:s")) - strtotime(date($_SESSION['SesionUsuario'])); 
            if($var > 1200){ //si pasaron 20 minutos de inactividad 60*20=1200 segundos
                session_destroy();  //destruye todas las sesiones iniciadas//                 
                header("Location:../../clinicaveterinaria/index.html");  
            }else{       
                $_SESSION['SesionUsuario'] = date("Y-m-d H:i:s"); //sesion iniciada desde hora actual
                echo json_encode($_SESSION['SesionUsuario']);
            }             
        }   
 }
 //se destruye la sesion
 if(isset($_GET['cerrarSession'])){
  session_destroy();
  $html =0; 
  echo json_encode($html); 
 }
 
 
 //cargar el grid con los datos d ela base de datos y cargar el consecutivo LP2
 if(isset($_GET['AsigLP2'])){
   $carg = $ctprincipal->AsigLP2();    
     if (count($carg)!=0)//si trae algun dato
       { 
        $carg=$carg['maximo'];
        echo json_encode($carg);
       }else{           
        echo json_encode($carg);
       }
 }
 
