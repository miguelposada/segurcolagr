<?php
session_start();
//validar sesion activa
if(isset($_SESSION['SesionUsuario'])){
    

    ?>

    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title>Clinica Veterinaria - Perla</title>
                  
            <!--CSS del plugin de jqgrid-->
            <link rel="stylesheet" type="text/css" media="screen" href="../../clinicaveterinaria/librerias/pluginsJQuery/jquery.jqGrid-4.2.0/css/ui-lightness/jquery-ui-1.8.2.custom.css" />
            <link rel="stylesheet" type="text/css" media="screen" href="../../clinicaveterinaria/librerias/pluginsJQuery/jquery.jqGrid-4.2.0/css/ui.jqgrid.css" />
            <link rel="stylesheet" type="text/css" media="screen" href="../../clinicaveterinaria/librerias/pluginsJQuery/jquery.jqGrid-4.2.0/css/ui.multiselect.css" />
            <!--posiscionamiento en la pagina-->
            
            <!--<link rel="stylesheet" type="text/css" href="../../clinicaveterinaria/librerias/css/lib_css_principal.css" ></link>--> 

            <!--librerias js del plugin jqgrid-->
            <script src="../../clinicaveterinaria/librerias/pluginsJQuery/jquery.jqGrid-4.2.0/js/jquery-1.5.2.min.js" type="text/javascript"></script>
            <script src="../../clinicaveterinaria/librerias/pluginsJQuery/jquery.jqGrid-4.2.0/js/i18n/grid.locale-es.js" type="text/javascript"></script>
            <script src="../../clinicaveterinaria/librerias/pluginsJQuery/jquery.jqGrid-4.2.0/js/jquery.jqGrid.min.js" type="text/javascript"></script>
    <!--            <script src="../../librerias/pluginsJQuery/jquery.jqGrid-4.2.0/src/ui.multiselect.js" type="text/javascript"></script>-->

            <script src="../../clinicaveterinaria/librerias/pluginsJQuery/jquery.jqGrid-4.2.0/js/jquery-ui-1.8.1.custom.min.js" type="text/javascript"></script>
            <script src="../../clinicaveterinaria/librerias/pluginsJQuery/jquery.jqGrid-4.2.0/js/jquery.layout.js" type="text/javascript"></script>
            <script src="../../clinicaveterinaria/librerias/pluginsJQuery/jquery.jqGrid-4.2.0/js/jquery.tablednd.js" type="text/javascript"></script>
            <script src="../../clinicaveterinaria/librerias/pluginsJQuery/jquery.jqGrid-4.2.0/js/jquery.contextmenu.js" type="text/javascript"></script>
             <script type="text/javascript" src="../../clinicaveterinaria/librerias/js/Lib_Js_index.js"></script>
            <!--librerias parra el manejo de jquery personalizado (OJO: posiblemente crea conflictos con las libr de jGrid si no se manipula cuidadosamente)-->
               
        
            <!--CArgar API y elementos de JSON-->
            <script type="text/javascript">
                $.jgrid.no_legacy_api = true;
                $.jgrid.useJSON = true;
            </script>
            <!--para manejar la insercion y actualizacion de los form de jqGrid-->
            <script type="text/javascript">
                var ant=0;
                var otro=0;                
                    
            </script>
            <!--cargar el jqgrid con los elementos de la base de datos-->
            <script type="text/javascript">
                $(function(){ 
                    $("#list").jqGrid({
                        url:'../../clinicaveterinaria/clases/jqgridADMINPACIENTES.php',
                        datatype: 'json',
                        mtype: 'GET',
                        colNames:['lp2', 'cir_nom', 'cir_gen', 'pac_fec_ing', 'pac_mic', 'pac_hxc',
                                  'pac_tip_esp', 'pac_tip_raz', 'pac_tip_cir', 'pac_obs_cir', 'pac_fec_cir',
                                  'pac_eco_rx',
                                  'pac_fec_rx', 'pac_hos', 'pac_res', 'pac_act', 'pac_exa_lab', 'pac_fec_exa', 
                                  'pac_tip_con', 'pac_fec_con', 'pac_fec_alt', 'pac_dia_hos', 'pac_obs', 'pac_est',
                                  'pac_con_obs'],
                        colModel :[ 
                            { name: "pac_lp2", width: 55  },
                            { name: "pac_nom", width: 90 },
                            { name: "pac_gen", width: 55 },
                            { name: "pac_fec_ing", width: 90 },
                            { name: "pac_mic", width: 55 },
                            { name: "pac_hxc", width: 90, hidden:true },
                            { name: "pac_tip_esp", width: 55, hidden:true },
                            { name: "pac_tip_raz", width: 55, hidden:true },
                            { name: "pac_tip_cir", width: 90, hidden:true },
                            { name: "pac_obs_cir", width: 90, hidden:true },
                            { name: "pac_fec_cir", width: 55, hidden:true },
                            { name: "pac_eco_rx", width: 90, hidden:true },
                            { name: "pac_fec_rx", width: 55, hidden:true },
                            { name: "pac_hos", width: 90, hidden:true },
                            { name: "pac_res", width: 90, hidden:true },
                            { name: "pac_act", width: 55, hidden:true },
                            { name: "pac_exa_lab", width: 90, hidden:true },
                            { name: "pac_fec_exa", width: 55, hidden:true },
                            { name: "pac_tip_con", width: 90, hidden:true },
                            { name: "pac_fec_con", width: 55, hidden:true },
                            { name: "pac_fec_alt", width: 90 },
                            { name: "pac_dia_hos", width: 55},
                            { name: "pac_obs", width: 90, hidden:true },
                            { name: "pac_est", width: 55, hidden:true },
                            { name: "pac_con_obs", width: 90, hidden:true },                         
                        ],
                        pager: '#pager',
                        rowNum:10,
                        rowList:[10,20,30],
                        sortname: 'pac_lp2',
                        viewrecords: true,
                        gridview: true,
                        editurl: '../../clinicaveterinaria/clases/jqgridADMINPACIENTES.php',
                        caption: 'Clinica Veterinaria'    
                    });
               
                    //activar barra de navegacion
                    jQuery("#list").navGrid('#pager', {refresh: true, edit: false, add: false, del : false, search: false ,view: true});
         
                    //editar si esta seleccionado
                    $("#bedata").click(function(){
                        var gr = jQuery("#list").jqGrid('getGridParam','selrow');//seleccionar el usuario a editar
                        var pac = jQuery("#list").jqGrid('getRowData',gr);
                        
                        if( gr != null ){
                           jQuery("#NumID").attr('value', pac.id_paciente); 
                           jQuery("#NumID").attr('disabled','disabled'); 
                           if (pac.id_tipoid=="Cedula de Ciudadania")
                               {
                                   jQuery('input:radio[name=DocId]')[0].checked = true;
                               }else if(pac.id_tipoid=="Cedula de Extranjeria"){
                                 jQuery('input:radio[name=DocId]')[1].checked = true;  
                               }else{
                                 jQuery('input:radio[name=DocId]')[2].checked = true;   
                               }
                           jQuery("#PriNom").attr('value', pac.nombre1_paciente);    
                           jQuery("#SegNom").attr('value', pac.nombre2_paciente); 
                           jQuery("#PriApellido").attr('value', pac.apellido1_paciente);    
                           jQuery("#SegApellido").attr('value', pac.apellido2_paciente ); 
                           jQuery("#CodId").attr('value', pac.codigo_paciente);    
                           jQuery("#fechaNac").attr('value', pac.fnac_paciente); 
                           jQuery("#dir").attr('value', pac.direccion_paciente);    
                           jQuery("#tel").attr('value', pac.telefono_paciente); 
                           jQuery("#tel_mov").attr('value', pac.movil_paciente);    
                           jQuery("#correo").attr('value', pac.email_paciente); 
                           jQuery("#madre").attr('value', pac.madre_paciente);    
                           jQuery("#padre").attr('value', pac.padre_paciente); 
                           
                           jQuery("#pais option[value='" + pac.id_pais + "']").attr("selected","selected");
                           
                           var ciud='<OPTION VALUE="'+pac.id_ciudad+'">'+pac.ciudad+'</OPTION>'; 
                           jQuery("#ciudad").html(ciud);                           
                           
                           var depto='<OPTION VALUE="'+pac.id_dpto+'">'+pac.dpto+'</OPTION>';
                           jQuery("#departamento").html(depto);
                           
                           jQuery("#sexo option[value='" + pac.sexo + "']").attr("selected","selected");
                                                    
                           var prog='<OPTION VALUE="'+pac.id_programa+'">'+pac.nombre_programa+'</OPTION>';
                           jQuery("#programa").html(prog);                                                 
                           //jQuery("#programa option:selected").text(pac.nombre_programa);                           
                           
                           jQuery("#estadoCivil option[value='" + pac.id_ecivil + "']").attr("selected","selected");
                           //jQuery("#estadoCivil option:selected").text(pac.nombre_ecivil); 
                           
                           jQuery("#entidad option[value='" + pac.id_entidad + "']").attr("selected","selected");
                           //jQuery("#entidad option:selected").text(pac.abrevia_entidad); 
                           
                           document.forms[0].Actualizar.disabled= false;
                           
                           jQuery("#guardar").attr('disabled','disabled');
                           jQuery("#CodId").focus();
                            
                       }else{ 
                           alert("Porfavor seleccione\n una fila para actualizar");
                           
                       }
                    });
          
                    //eliminar seleccionado
           
                    $("#Elim").click(function(){ 
                        var gr = jQuery("#list").jqGrid('getGridParam','selrow');
                        if( gr != null){
                            var aBorr = jQuery("#list").jqGrid('getRowData',gr);                            
                            jQuery("#list").delGridRow( aBorr.id_paciente, {msg:"Seguro desea Eliminar el registro: '"+aBorr.id_paciente+"' ?",bSubmit: "Eliminar",
                                bCancel: "Cancelar",caption: "Eliminar",
                                onclickSubmit: function(rp_ge, rowid) {
                                    //enviar registro a eliminar en la base de datos
                                    jQuery.getJSON("../../classes/jqgridADMINPACIENTES.php",{eliminar:"eliminar", id_paciente:aBorr.id_paciente});
                                    alert("El Registro ha Sido Eliminado!");
                                    window.location.reload(); 
                                }
                            });    
                             
                        }else{
                            alert("Selecccione el registro a eliminar");   
                        }
                    });  
          
                    //generar form para buscar datos 
                     
                       $("#Buscar").click(function(){    
                         jQuery("#list").jqGrid('searchGrid', {sopt:['cn','bw','eq','ne','lt','gt','ew'],caption: "Buscar...",
                         Find: "Buscar",
                         Reset: "Recargar" ,showQuery:true
                         }
                           );
                       });
                    
          
                });

            </script>
           
        </head>
        <body onload="cargarEnGridFormIngreso();" class="PrincipalGrids"> 
            <!-- el calendario fue tomado de http://www.tarrget.info/calendar/scw.htm -->
            <script type='text/JavaScript' src='../../clinicaveterinaria/librerias/js/calendar/scw.js'></script>          
            
            <div id="formIngresoAnimal" class="formIngresoAnimal"></div>           
            <div style="width:200px"></div>
            <br></br>
            <table id="list"><tr><td></td></tr></table> 
            <div id="pager"></div> 
            <br></br>
            <div style="margin: auto">
              <div style="margin: auto;width:350px;">  
                <input type="BUTTON" id="bedata" value="Editar Seleccionado" />                
                <input type="BUTTON" id="Elim" value="Eliminar Sele." />
                <input type="BUTTON" id="Buscar" value="Buscar" /> 
              </div>  
            </div>
            <div id="mysearch"></div> 
        </body>
    </html>
   
<?php 
}else{
 
   header( 'Location: ../../clinicaveterinaria/index.php' ) ;  
}

?>