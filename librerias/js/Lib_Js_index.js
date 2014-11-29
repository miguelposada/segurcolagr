
/******************************************************************************/


/*************validar la sesion para saber si se carga el form de login o el menu principal**************/
function VerificarSesion(){     
    if (jQuery('#estadosesion').val()==null || jQuery('#estadosesion').val()=='' ){    
      jQuery('#principal').load('../clinicaveterinaria/vista/vis_login.html')
    }else{       
      jQuery.getJSON("../clinicaveterinaria/controlador/Ctrl_principal.php",{estadosesion:jQuery("#estadosesion").val()}, DatosSesion); 
       
    }
    
}
/* si no hay sesion activa se procede a cargar formlogin o cargar */
function DatosSesion(res){    
  if(res==0){      
   jQuery('#principal').load('../clinicaveterinaria/vista/vis_login.html')    
  }else{
    $("#bod_princ").append("<div><a href='#' onclick='Destruir_Sesion()'>Cerrar Sesion: "+jQuery('#estadosesion').val()+"</a></div>")  
    //crear el elemento que visualiza el nomnre de la sesion  
  }  
    
}
/* validar que tenga sesion iniciada*/
function ValidarLogin(){
      //que no este vacio el campo usuario  
   if(jQuery("#usuario").val().length < 1 || jQuery("#clave").val().length < 1){
          alert('no puede estar vacio ninguno de los dos campos.');
          jQuery("#usuario").focus();
      }
   if(jQuery("#usuario").val().length > 0 && jQuery("#clave").val().length > 0){       
        jQuery.getJSON("../clinicaveterinaria/controlador/Ctrl_principal.php",{usuario:jQuery("#usuario").val(),clave:jQuery("#clave").val()}, mostrarSesion);
      }    
  }

function mostrarSesion (res){    
  if(res==0){
   alert('no coinciden los datos. intentelo de nuevo o contacte el administrador(@)'); 
   jQuery("#usuario").focus();
  }else{      
   jQuery('#estadosesion').val(res['usu_nom']);   
   DatosSesion(res['usu_nom']);
   //jQuery('#principal').load('../clinicaveterinaria/vista/vis_ingreso.html')
   //cargar grid de los usuarios dek sistema
   //jQuery('#principal').load('../clinicaveterinaria/vista/jqgridADMINPACIENTES.php')
   location.href="../clinicaveterinaria/vista/jqgridADMINPACIENTES.php"   
  }   
}

/*******FUNCION PARA PREGUNTAR ANTES DE CERRAR EL NAVEGADOR*********************************/

function PreguntarCerrar(){                                  
 var ventana=confirm("Desea Salir Del sistema?");            
 if (ventana) {                     
  window.close();            
 }else {                  
 }                 
}

// esto es para redireccionar  
  
/***************VALIDA  TECLA ENTER DE CAMPO password de formulario**********************/

function validarEnter(e) {    
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13) ValidarLogin();
}


/*******DESTRUIR LA SESION ***************/
  function Destruir_Sesion(){ 
    var ventana = confirm("Desea Salir Del sistema?");
    if (ventana) {
      jQuery('#principal').empty(); // se limpia el contenedor principal  
      jQuery('#estadosesion').val('');    
      jQuery.getJSON("../clinicaveterinaria/controlador/Ctrl_principal.php",{cerrarSession:1}, DatosSesion);
    } else {
    }  
} 

/*****FUNCIONES PARA INSERTAR DATOS EN LA BASE DE DATOS****/

function mostrarGrid(res){    
   
    var tabla='';
    var salida = '';
    var totColum=1;
    tabla += '<table>'  
     tabla += '<tr>'
      tabla += '<td>Identificador</td>'
      tabla += '<td>Nombre</td>'
      tabla += '<td>Genero</td>'
      tabla += '<td>fecha Ingreso</td>'
     tabla +='</tr>'
     tabla +='<tr>'
        for (property in res) {     
          if(totColum % 5 == 0){
           tabla += '</tr><tr><td>'+res[property]+'</td>'      
          }else{
           tabla += '<td>'+res[property]+'</td>'
           totColum ++;
          }   
         salida += property + ': ' + res[property]+'; ';  
         alert(salida);
       }    
      totColum=1;
    tabla += '</table>'
    document.getElementById("resultadoGrid").innerHTML = tabla;
}

//cargar fomulario de ingreso en el grid
function cargarEnGridFormIngreso(){ 
  jQuery('#formIngresoAnimal').load('../../clinicaveterinaria/vista/vis_ingreso.html') 
  jQuery.getJSON("../../clinicaveterinaria/controlador/Ctrl_principal.php",{AsigLP2:1}, AsigLP2);
}

//asignar consecutivo LP2
function AsigLP2(res){  
 res++
 jQuery("#pac_lp2").attr('value', +res);
 
}

//validar los datos del formulario

var IdDoc='';// almacena el tipo de documento
 function validarCamposSelect_Text_Form(){
    
     // validar radio buttons genero
    var con =0;// variable para saber si esta selecciono genero
    for(i=0;i<document.forms[0].pac_gen.length;i++){//buscar el genero que fue seleccionado
        if(document.forms[0].pac_gen[i].checked){
            IdDoc =  document.forms[0].pac_gen[i].value; 
            con=1;// si selecciono alguno de los 2            
        } 
    } 
    
    //se calculan los dias de hospitalizacion   
    var fecha_ini= new Date(document.forms[0].pac_fec_ing.value);
    var fecha_fin= new Date(document.forms[0].pac_fec_alt.value);
    var TotDias= fecha_fin - fecha_ini
    TotDias=(((TotDias/1000)/60)/60)/24;
    jQuery('#pac_dia').val(TotDias);
    
    //verificarSesionActiva();
//    if(variabSesion==0){          
//          return 0;
//    }else
    if(con==0){
     alert("Error:Debe seleccionar un genero"); 
     jQuery("#pac_gen").focus();
     return 0
    }else if(jQuery("#pac_nom").val().length < 1){
     alert("Error:Falta ingresar un nombre");
     jQuery("#pac_nom").focus(); 
     return 0
   }else if ( jQuery("#pac_fec_ing").val().length < 1 ){
     alert("Error:Falta Ingresar Fecha de Ingreso"); 
     jQuery("#pac_fec_ing").focus(); 
     return 0
   }else if (document.forms[0].pac_tip_esp.value< 1){//cargar variables para guardar; modif 14-12-2011
     alert("Error:Falta Elegir especie");
     jQuery("#pac_tip_esp").focus();    
     return 0
   }else if (document.forms[0].pac_tip_raz.value< 1){
     alert("Error:Falta Elegir la raza");     
     jQuery("#pac_tip_raz").focus();
     return 0
   }else if (jQuery("#pac_fec_alt").val().length < 1) {
     alert("Error:Falta Ingresar Fecha de alta"); 
     jQuery("#pac_fec_alt").focus(); 
     return 0
   }else if(TotDias<0){
     alert("La fecha de alta no puede ser menor que la fecha de entrada"); 
     jQuery("#pac_fec_alt").focus();
     return 0
   }
   return 1
     
 }


//insertar datos del formulario
function GuardarHistoriaAnimal(){
   // validar tipo de doc    
   var pac_gen='';
   var pac_eco='';
   var con =0;// variable para saber si esta selecciono genero
    for(i=0;i<document.forms[0].pac_gen.length;i++){//buscar el genero que fue seleccionado
        if(document.forms[0].pac_gen[i].checked){
            pac_gen =  document.forms[0].pac_gen[i].value; 
            con=1;// si selecciono alguno de los 3            
        } 
    }      
    
    var con =0;// variable para saber si esta selecciono genero
    for(i=0;i<document.forms[0].pac_eco.length;i++){//buscar el genero que fue seleccionado
        if(document.forms[0].pac_eco[i].checked){
            pac_eco =  document.forms[0].pac_eco[i].value; 
            con=1;// si selecciono alguno de los 3            
        } 
    } 
    
 
   //validar campos select e input text
 var estadoValid= validarCamposSelect_Text_Form();
//  var VeriCed = ValidarNumID(0); 
 if(estadoValid==0 ){ 
  // ya mostro el mensaje de error asi que no hace nada
  
 }else{  
     
   // enviar para guardar con la especie  
   var pac_tip_esp = document.forms[0].pac_tip_esp.selectedIndex;   
   //texto seleccionado de raza   
   var pac_tip_raz = document.forms[0].pac_tip_raz.selectedIndex;  
   
    jQuery.getJSON("../../clinicaveterinaria/clases/jqgridADMINPACIENTES.php",{guardarAnimal:"guardarAnimal",        
        pac_lp2:document.forms[0].pac_lp2.value,         
        pac_nom:document.forms[0].pac_nom.value, 
        pac_gen:document.forms[0].pac_gen.value,
        pac_fec_ing:document.forms[0].pac_fec_ing.value, 
        pac_mic:document.forms[0].pac_mic.value,
        pac_hxc:document.forms[0].pac_hxc.value,
        pac_tip_esp:document.forms[0].pac_tip_esp.value,
        pac_tip_raz:document.forms[0].pac_tip_raz.value,       
        pac_tip_cir:document.forms[0].pac_tip_cir.value,
        pac_cir_obs:document.forms[0].pac_cir_obs.value,
        pac_fec_cir:document.forms[0].pac_fec_cir.value,
        pac_eco:document.forms[0].pac_eco.value,
        pac_fec_eco:document.forms[0].pac_fec_eco.value,       
        pac_res:document.forms[0].pac_res.value,
        pac_act:document.forms[0].pac_act.value,
        pac_exa:document.forms[0].pac_exa.value,
        pac_fec_exa:document.forms[0].pac_fec_exa.value,
        pac_hos:document.forms[0].pac_hos.value,        
        pac_con:document.forms[0].pac_con.value,
        pac_con_obs:document.forms[0].pac_con_obs.value,
        pac_fec_alt:document.forms[0].pac_fec_alt.value,       
        pac_dia:document.forms[0].pac_dia.value,
        pac_obs:document.forms[0].pac_obs.value,
        pac_est:document.forms[0].pac_est.value});   
        MostrarAnimalInsertado();      
        
   }
}

function MostrarAnimalInsertado(res){
    alert('se ha guardado el registro');
    jQuery("#list").trigger("reloadGrid");
    window.location.reload();
}