<?php  

//$set_salt = './1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
//$salt = sprintf('$2a$%02d$', 7);
//for($i = 0; $i < 22; $i++)
//{
//    $salt .= $set_salt[mt_rand(0, 63)];
//}
//echo $salt .'<br>';
//echo crypt('1234', $salt);
//$passfin = crypt('1234', $salt);
        
 
//if( crypt($password, $passfin) == $passfin) {
//    echo '<br>';
//    echo crypt($password, $passfin);
//    echo '<br>';
//    echo 'Es igual';
//} 
// conexiones del jqgrid
$dbhost='localhost';
$dbuser='root';
$dbpassword='';
$database='clinica_veterinaria';
        
class Conexion {

    private $conexion;
    private $total_consultas;

    public function Conexion() {        
            $this->conexion = (mysql_connect("localhost", "root", "")) or die(mysql_error());
            mysql_select_db("clinica_veterinaria", $this->conexion) or die(mysql_error());
            return $this->conexion;      
    }
   
   // se realiza la consulta para cargar el array en la base de datos
    public function consulta($consulta) {
        $this->total_consultas++;
        $c = $this->conexion();
        $resultado = mysql_query($consulta, $c)  or die("Error en login: " . mysql_error());
        $fila = mysql_fetch_array($resultado, MYSQL_ASSOC);        
        if (!$fila) {
            return 0 . mysql_error();            
        }else{
            return $fila;
        }      
       
    }

    public function fetch_array($consulta) {
        return mysql_fetch_array($consulta);
    }

    public function num_rows($consulta) {
        return mysql_num_rows($consulta);
    }

    public function getTotalConsultas() {
        return $this->total_consultas;
    }

}

?>