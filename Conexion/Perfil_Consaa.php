<?php 
	session_start();
	require_once 'Conexion.php';

	/**
	* Clase que construye elementos para el perfil del CONSAA
	*/
	class Perfil_Consaa 
	{
		
		function __construct($argument)
		{
			# code...
		}

		public static function obtener_total(){
			$html=$html1=$html2="";
			$sql="SELECT *FROM datos_consaa()";

			try {
				$comando =Conexion::getInstance()->getDb()->prepare($sql);
				$comando->execute();
				while ($row = $comando->fetch(PDO::FETCH_ASSOC)) {

					$porcentaje_transcurrido = ($row[total_transcurrido]==0) ? '0' : (($row[total_transcurrido]*100)/5);
					$porcentaje_restante = ($row[total_restante]==0) ? '0' : (($row[total_restante]*100)/5);

					$html.='
					<a class="widget widget-hover-effect2 themed-background-muted-light">
	                    <div class="widget-simple">
	                        <div class="widget-icon pull-right themed-background">
	                            <img src="../imagenes/svg/high_five.svg" alt="">
	                        </div>
	                        <h4 class="text-left">
	                            <strong>Total Asignado</strong><br><small>'.number_format($row[asignado],3).' TM</small>
	                        </h4>
	                        <div class="progress progress-striped active">
	                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 100%">100%</div>
	                        </div>
	                    </div>
	                </a>';

	                $html1.='<a class="widget widget-hover-effect2 themed-background-muted-light">
			                    <div class="widget-simple">
			                        <div class="widget-icon pull-right ">
			                            <img src="../imagenes/svg/alarm_clock.svg" alt="">
			                        </div>
			                        <h4 class="text-left text-success">
			                            <strong>Años Transcurridos</strong><br><small>'.$row[total_transcurrido].'</small>
			                        </h4>

			                        <div class="progress progress-striped active">
			                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:'.$porcentaje_transcurrido.'%">'.$porcentaje_transcurrido.'</div>
			                        </div>
			                    </div>
			                </a>';

	                $html2.='<a class="widget widget-hover-effect2 themed-background-muted-light">
			                    <div class="widget-simple">
			                        <div class="widget-icon pull-right ">
			                            <img src="../imagenes/svg/hourglass.svg" alt="">
			                        </div>
			                        <h4 class="text-left text-warning">
			                            <strong>Años Disponibles</strong><br><small>'.$row[total_restante].'</small>
			                        </h4>
			                        <div class="progress progress-striped active">
			                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: '.$porcentaje_restante.'%">'.$porcentaje_restante.'%</div>
			                        </div>
			                    </div>
			                </a>';
				}
				return array($html,$html1,$html2,$sql);
			} catch (Exception $e) {
				return array($e->getMessage(),$e->getLine(),$sql);
			}
		}

		/****retorna el nombre de la asociación 
		como sera solo una almancenada se sacara el dato con maximo id**/
		public static function retornar_nombre(){
			$html="";
			$sql = "SELECT *from consaa where id = (SELECT max(id) from consaa)";

			try {
				 	$comando = Conexion::getInstance()->getDb()->prepare($sql);
	                $comando->execute();
	                
	                while ($row = $comando->fetch(PDO::FETCH_ASSOC)) {
	                    $nombre = $row['nombre'];
	                    $codigo_oculto = $row['codigo_oculto'];
	                    $telefono = $row['telefono'];
	                    $imagen = $row['imagen'];
	                    $email = $row['email'];
	                    $abreviatura = $row['abreviatura'];
	                    $direccion = $row['direccion'];
	                    

	                }

	                $html.='<div class="block-section text-center">
			                    <a data-codigo="'.$codigo_oculto.'" id="cambiar_imagen" href="javascript:void(0)">
			                        <img  src="../'.$imagen.'" alt="avatar" class="img-circle" id="imagen_perfil">
			                    </a>
			                    <form method="post" accept-charset="utf-8">
			               
			                    	 
			                    </form>
			                    <input data-codigo2="'.$codigo_oculto.'"  type="file" class="archivos hidden" id="file_2" name="file_2" />
			                    <h3>
			                        <strong>'.$nombre.'</strong><br><small></small>
			                    </h3>
			                </div>';
			        $html.='<table class="table table-borderless table-striped table-vcenter">
                    		<tbody>';

	                $html.='<tr>
	                            <td class="text-right" style="width: 50%;"><strong>Abreviatura</strong></td>
	                            <td>'.$abreviatura.'</td>
	                        </tr>
	                        
	                        <tr>
	                            <td class="text-right" style="width: 50%;"><strong>Correo Eléctronico</strong></td>
	                            <td>'.$email.'</td>
	                        </tr>
	                        <tr>
	                            <td class="text-right" style="width: 50%;"><strong>Teléfono</strong></td>
	                            <td>'.$telefono.'</td>
	                        </tr>
	                        <tr>
	                            <td class="text-right" style="width: 50%;"><strong>Dirección</strong></td>
	                            <td>'.$direccion.'</td>
	                        </tr>';
	            $html.='</tbody>
                </table>';

	         	return array('1',$sql,$html,$nombre,$codigo_oculto);
	         	
	        } catch (Exception $e) {
	         	return array('-1',$e->getMessage(),$e->getLine());
	         	
	        }
		}


		public static function retornar_modal_editar(){
			$html="";
			$sql="SELECT id,nombre, direccion,telefono,email,imagen,codigo_oculto,abreviatura from consaa where id = (SELECT MAX(id) FROM consaa);";

			try {
				$comando =Conexion::getInstance()->getDb()->prepare($sql);
				$comando->execute();
				while ($row = $comando->fetch(PDO::FETCH_ASSOC)) {
					$html.='<div id="modal_ele_editar_consaa" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
						        <div class="modal-dialog modal-lg">
						            <div class="modal-content">
						                <div class="modal-header">
						                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						                    <h3 class="modal-title">Editar Datos de <strong>'.$row[nombre].'</strong></h3>
						                </div>
						                <form method="post" id="actualizar_consaa" name="actualizar_consaa" class="form-horizontal animation-fadeIn">
						                <div class="modal-body">
						                    
						                    
						                        <input type="hidden" name="actualizar_consaa_h" id="actualizar_consaa_h" value="simon_dale">
						                        <input type="hidden" name="elwhere" id="elwhere" value="'.$row[id].'">
						                        <div class="row ">
						                            <div class="col-md-6">
						                                <div class="block">
						                                    
						                                    <div class="block-title">
						                                         
						                                        <h2><strong>Información</strong> de Cuota</h2>

						                                    </div>
						                                        <div class="row">
						                                            <div class="col-md-8 col-sm-12 col-lg-8">
						                                                <div class="form-group">
						                                                    <div class="col-xs-12">
						                                                        <label for="nombre_consaa">Nombre(*):</label>
						                                                        <input data-toggle="tooltip" title="Este campo solo permite letras mayusculas, minusculas y espacios!" type="text" id="nombre_consaa" name="nombre_consaa" class="form-control" placeholder="Ingrese el nombre completo" value="'.$row[nombre].'" autocomplete="off">  
						                                                    </div>  
						                                                </div>
						                                            </div>
						                                             
						                                                <div class="col-md-4 col-sm-12 col-lg-4">
						                                                    <div class="form-group">
						                                                        <div class="col-xs-12">
						                                                            <label for="abreviatura">Abreviatura(*):</label>
						                                                            <input data-toggle="tooltip" title="Este campo solo permite letras mayusculas, minusculas y espacios!" type="text" id="abreviatura" name="abreviatura" value="'.$row[abreviatura].'" class="form-control" placeholder="Ej: CONSAA" autocomplete="off">  
						                                                        </div>  
						                                                    </div>
						                                                </div>                                            
						                                        </div>

						                                        <div class="row">
						                                            <div class="col-md-6 col-sm-12 col-xs-12 col-xl-6">
						                                                <div class="form-group">
						                                                    <div class="col-xs-12">
						                                                        <label for="email">Correo(*):</label>
						                                                        <input type="email" id="email" onblur="validar(this)" name="email" class="form-control"  value="'.$row[email].'" placeholder="Ingrese el correo">
						                                                    </div>
						                                                </div>
						                                            </div>
						                                            <div class="col-md-6 col-sm-12 col-xs-12 col-xl-6">
						                                                <div class="form-group">
						                                                        <div class="col-xs-12">
						                                                            <label for="telefono">Número de Télefono(*):</label>
						                                                            <input data-toggle="tooltip" title="Este campo solo numeros que empiezen con 6,2 y 7!" type="text" id="telefono" name="telefono" value="'.$row[telefono].'" class="form-control" placeholder="Ingrese el número" autocomplete="off">    
						                                                        </div>    
						                                                </div>
						                                            </div>
						                                        </div>

						                                        
						                                        <div class="form-group">
						                                                <div class="col-xs-12">
						                                                    <label for="direccion">Dirección(*):</label>
						                                                    <textarea id="direccion" name="direccion" rows="1" class="form-control" placeholder="Ingrese la dirección">'.$row[direccion].'</textarea>    
						                                                </div>    
						                                        </div>
						                                                                 
						                                </div>
						                                
						                            </div>

						                            <div class="col-md-6">
						                                <div class="block">
						                                    
						                                    <div class="block-title">
						                     
						                                        <h2><strong>Imagen de </strong>CONSAA</h2>
						                                    </div>
						                                    
						                                        <div class="row">
						                                            <div class="col-md-6 col-xs-6">
						                                               <!--label for="firma1">Imagen(*):</label-->
						                                               <div class="form-group eleimagen" >
						                                                  <img src="../'.$row[imagen].'" style="width: 200px;height: 202px;" id="img_file">
						                                                  <input type="file" class="archivos hidden" id="file_1" name="file_1" />
						                                               </div>
						                                               
						                                               
						                                            </div>
						                                            <div class="col-md-6 col-xs-6">
						                                                <div class="form-group">
						                                                  <h5>La imagen debe de ser formato png o jpg con un peso máximo de 3 MB</h5>
						                                               </div><br><br>
						                                               <div class="form-group">
						                                                  <button type="button" class="btn btn-sm btn-primary" id="btn_subir_img"><i class="icon md-upload" aria-hidden="true"></i> Seleccione Imagen</button>
						                                               </div>
						                                                <div class="form-group">
						                                                  <div id="error_formato1" class="hidden"><span style="color: red;">Formato de archivo invalido. Solo se permiten los formatos JPG y PNG.</span>
						                                                  </div>
						                                                </div>
						                                            </div>   
						                                        </div>
						                                </div>
						                                
						                            </div>
						                             
						                        </div>
						                
						                </div>
						                <div class="modal-footer">
						                    <button type="button"  class="btn btn-sm btn-default" data-dismiss="modal">'.CANCELAR.'</button>
						                    <button type="submit" class="btn btn-alt btn-primary">'.GUARDAR.'</button>
						                </div>

						                </form>
						            </div>
						        </div>
						    </div>';
				}

				return $html;
			}catch(Exception $e) {
				return array($e->getMessage(),$e->getLine(),$sql);
			}
	
		}
	}


?>