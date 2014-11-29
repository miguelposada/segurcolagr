<?php 
//include the information needed for the connection to MySQL data base server. 
// we store here username, database and password 
include("Conexion.php");
 
// to the url parameter are added 4 parameters as described in colModel
// we should get these parameters to construct the needed query
// Since we specify in the options of the grid that we will use a GET method 
// we should use the appropriate command to obtain the parameters. 
// In our case this is $_GET. If we specify that we want to use post 
// we should use $_POST. Maybe the better way is to use $_REQUEST, which
// contain both the GET and POST variables. For more information refer to php documentation.
// Get the requested page. By default grid sets this to 1. 
$page = $_GET['page']; 
 
// get how many rows we want to have into the grid - rowNum parameter in the grid 
$limit = $_GET['rows']; 
 
// get index row - i.e. user click to sort. At first time sortname parameter -
// after that the index from colModel 
$sidx = $_GET['sidx']; 
 
// sorting order - at first time sortorder 
$sord = $_GET['sord']; 
 
// if we not pass at first time index use the first column for the index or what you want
if(!$sidx) $sidx =1; 

//$dbhost='localhost';
//$dbuser='root';
//$dbpassword='';
//$database='clinica_veterinaria';
 
// connect to the MySQL database server 
$db = mysql_connect($dbhost, $dbuser, $dbpassword) or die("Connection Error: " . mysql_error()); 
 
// select the database 
mysql_select_db($database) or die("Error connecting to db."); 
 
// calculate the number of rows for the query. We need this for paging the result 
$result = mysql_query("SELECT COUNT(*) AS count FROM pacientes"); 
$row = mysql_fetch_array($result,MYSQL_ASSOC); 
$count = $row['count']; 
 
// calculate the total pages for the query 
if( $count > 0 && $limit > 0) { 
              $total_pages = ceil($count/$limit); 
} else { 
              $total_pages = 0; 
} 
 
// if for some reasons the requested page is greater than the total 
// set the requested page to total page 
if ($page > $total_pages) $page=$total_pages;
 
// calculate the starting position of the rows 
$start = $limit*$page - $limit;
 
// if for some reasons start position is negative set it to 0 
// typical case is that the user type 0 for the requested page 
if($start <0) $start = 0; 
 
   /*capturar datos de pacientes que vienen desde la vista*/
   $pac_lp2 = $_GET['pac_lp2']; 
   $pac_nom="'".$_GET['pac_nom']."'"; 
   $pac_gen="'".$_GET['pac_gen']."'";
   $pac_fec_ing="'".$_GET['pac_fec_ing']."'";
   $pac_mic="'".$_GET['pac_mic']."'";  
   $pac_hxc="'".$_GET['pac_hxc']."'";
   $pac_tip_esp="'".$_GET['pac_tip_esp']."'";
   $pac_tip_raz ="'".$_GET['pac_tip_raz']."'"; 
   $pac_tip_cir=$_GET['pac_tip_cir'];
   $pac_cir_obs="'".$_GET['pac_cir_obs']."'";
   $pac_fec_cir="'".$_GET['pac_fec_cir']."'";
   $pac_eco="'".$_GET['pac_eco']."'";
   $pac_fec_eco="'".$_GET['pac_fec_eco']."'";   
   $pac_res="'".$_GET['pac_res']."'";
   $pac_act="'".$_GET['pac_act']."'";
   $pac_exa ="'".$_GET['pac_exa']."'";
   $pac_fec_exa ="'".$_GET['pac_fec_exa']."'";
   $pac_hos ="'".$_GET['pac_hos']."'";   
   $pac_con="'".$_GET['pac_con']."'";
   $pac_con_obs="'".$_GET['pac_con_obs']."'"; 
   $pac_fec_alt="'".$_GET['pac_fec_alt']."'";
   $pac_dia=$_GET['pac_dia'];
   $pac_obs="'".$_GET['pac_obs']."'";
   $pac_est="'".$_GET['pac_est']."'"; 
  // crear la fecha de reporte de la filiacion   
     $fechaCon = date("Y-m-d");
     $fechaCon = "'".$fechaCon."'";     
     
  //insertar en la tabla de pacientes  
if (isset($_GET['guardarAnimal'])){   
      
   $SQL = "INSERT INTO pacientes (pac_lp2, pac_nom, pac_gen, pac_fec_ing, pac_mic, pac_hxc,
              pac_tip_esp, pac_tip_raz, pac_tip_cir, pac_obs_cir, pac_fec_cir, pac_eco_rx,
              pac_fec_rx, pac_hos, pac_res, pac_act, pac_exa_lab, pac_fec_exa, pac_tip_con, 
              pac_fec_con, pac_fec_alt, pac_dia_hos, pac_obs, pac_est, pac_con_obs)
              
    VALUES ($pac_lp2, $pac_nom, $pac_gen, $pac_fec_ing, $pac_mic, $pac_hxc,$pac_tip_esp,
           $pac_tip_raz, $pac_tip_cir, $pac_cir_obs, $pac_fec_cir,$pac_eco, $pac_fec_eco,
           $pac_hos, $pac_res, $pac_act, $pac_exa, $pac_fec_exa,$pac_con,$fechaCon,
           $pac_fec_alt,$pac_dia,$pac_obs, $pac_est,$pac_con_obs)";   
  }
  /*para eliminar animal*/
  if (isset($_GET['Elim'])){    
     
    $SQL = "DELETE FROM pacientes WHERE pacientes.pac_lp2 = $pac_lp2";   
  }
  /* si se realizara una actualizacion*/
  if (isset($_GET['actualizar'])){ 
    $SQL = "UPDATE pacientes (pac_nom=$pac_nom, pac_gen=$pac_gen, 
              pac_fec_ing=$pac_fec_ing, pac_mic=$pac_mic, pac_hxc=$pac_hxc,
              pac_tip_esp=$pac_tip_esp, pac_tip_raz=$pac_tip_raz, 
              pac_tip_cir=$pac_tip_cir, pac_obs_cir=$pac_cir_obs, 
              pac_fec_cir=$pac_fec_cir, pac_eco_rx=$pac_eco,
              pac_fec_rx=$pac_fec_eco, pac_hos=$pac_hos, pac_res=$pac_res, 
              pac_act=$pac_act, pac_exa_lab=$pac_exa, pac_fec_exa=$pac_fec_exa, 
              pac_tip_con=$pac_con, pac_fec_alt=$pac_fec_alt, pac_dia_hos=$pac_dia,
              pac_obs=$pac_obs, pac_est=$pac_est, pac_con_obs=$pac_con_obs
              WHERE pac_lp2=$pac_lp2)";
    
}

   $result = mysql_query( $SQL ) or die("Couldn't insert data.".mysql_error()); 
   echo  $result;

// the actual query for the grid data 
$SQL = "SELECT * FROM pacientes ORDER BY $sidx $sord LIMIT $start , $limit"; 
$result = mysql_query( $SQL ) or die("Couldn't execute query.".mysql_error()); 

$responce = new stdClass();

$responce->page = $page; 
$responce->total = $total_pages; 
$responce->records = $count;
$i=0;

while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
  $responce->rows[$i]['pac_lp2']=$row['pac_lp2']; 
  $responce->rows[$i]['cell']=array($row['pac_lp2'], $row['pac_nom'], $row['pac_gen']
                                    , $row['pac_fec_ing'], $row['pac_mic'], $row['pac_hxc'], $row['pac_tip_esp']
                                    , $row['pac_tip_raz'], $row['pac_tip_cir'], $row['pac_obs_cir'], $row['pac_fec_cir']
                                    , $row['pac_eco_rx'], $row['pac_fec_rx'], $row['pac_hos'], $row['pac_res']
                                    , $row['pac_act'], $row['pac_exa_lab'], $row['pac_fec_exa'], $row['pac_tip_con'], $row['pac_fec_con']
                                    , $row['pac_fec_alt'], $row['pac_dia_hos'], $row['pac_obs'], $row['pac_est'], $row['pac_con_obs']);
  $i++;  
}

echo json_encode($responce);
?>