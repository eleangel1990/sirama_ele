<?php 
	@session_start();
	require_once 'Conexion.php';

	/**
	* 
	*/
	class Perfil_AAES
	{
		
		function __construct()
		{
			# code...
		}

		
		public static function retornar_nombre($la_bestia){
			$nombre_ingenio="";
			$sql = "SELECT
						nombre 
					FROM
						asociacion_aaes 
					WHERE
						id = '$la_bestia'";
			try {
				$comando = Conexion::getInstance()->getDb()->prepare($sql);
	            $comando->execute();
	                
	             while ($row = $comando->fetch(PDO::FETCH_ASSOC)) {
	             	$nombre_ingenio = $row[nombre];
	             }

	             return array("1",$nombre_ingenio,$sql);
			} catch (Exception $e) {
				return array("-1",$e->getMessage(),$e->getLine());
			}


		}

		public static function perfil_aaes($la_bestia){
			$html="";
			$sql = "SELECT
						nombre,
						telefono,
						direccion,
						contacto_operador,
						contacto_comercial,
						fax,
						contacto_documentos,
						email,
						estado
					FROM asociacion_aaes
					WHERE
						id = '$la_bestia' ";

			try {
				 	$comando = Conexion::getInstance()->getDb()->prepare($sql);
	                $comando->execute();
	                
	                while ($row = $comando->fetch(PDO::FETCH_ASSOC)) {
	                    $nombre = $row['nombre'];
	                    $telefono = $row['telefono'];
	                    $estado = $row['estado'];
	                    $direccion = $row['direccion'];
	                    $contacto_operativo = $row['contacto_operador'];
	                    $contacto_comercial = $row['contacto_comercial'];
	                    $correo = $row['email'];
	                    $fax = $row['fax'];
	                    $contacto_documentos = $row['contacto_documentos'];


	                }

	                $imagen = 'img/imagenes_mias/logo-asociacion-azucarera.png';

	                $html.='<div class="block-section text-center">
			                    <a data-codigo="'.$codigo_oculto.'" id="cambiar_imagen" href="javascript:void(0)">
			                        <img  src="../../'.$imagen.'" alt="avatar" class="img-circle" id="imagen_perfil">
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
	                            <td class="text-right" style="width: 50%;"><strong>Nombre</strong></td>
	                            <td>'.$nombre.'</td>
	                        </tr>
	                        <tr>
	                            <td class="text-right" style="width: 50%;"><strong>Correo</strong></td>
	                            <td>'.$correo.'</td>
	                        </tr>
	                        <tr>
	                            <td class="text-right" style="width: 50%;"><strong>Telefono</strong></td>
	                            <td>'.$telefono.'</td>
	                        </tr>
	                        <tr>
	                            <td class="text-right" style="width: 50%;"><strong>Fax</strong></td>
	                            <td>'.$fax.'</td>
	                        </tr>
	                        <tr>
	                            <td class="text-right" style="width: 50%;"><strong>Contacto Operativo</strong></td>
	                            <td>'.$contacto_operativo.'</td>
	                        </tr>	                        
	                        <tr>
	                            <td class="text-right" style="width: 50%;"><strong>Contacto Comercial</strong></td>
	                            <td>'.$contacto_comercial.'</td>
	                        </tr>
	                        <tr>
	                            <td class="text-right" style="width: 50%;"><strong>Contacto Documentos</strong></td>
	                            <td>'.$contacto_documentos.'</td>
	                        </tr>';
	            $html.='</tbody>
                </table>';

	         	return array('1',$sql,$html);
	         	
	         } catch (Exception $e) {
	         	return array('-1',$e->getMessage(),$e->getLine());
	         	
	         }
		}



		public static function retornar_contactos($la_bestia){
			$html='';
			$html.='<table id="tabla_telefonos" class="table table-bordered table-striped table-vcenter">
			            <thead>
			                <tr>
			                    
			                    <th class="text-left">Nombre</th>
			                    <th class="text-left">Tipo</th>
			                    <th class="text-left">Número de Teléfono</th>
			                    <th class="text-left">Email</th>
			                    <th class="text-left">Acciones</th>
			                </tr>
			            </thead>
			            <tbody>';
			$labels['0']['class']   = "label-success";
            $labels['0']['text']    = "Available";
            $labels['1']['class']   = "label-danger";
            $labels['1']['text']    = "Out of Stock";

			try {
				$sql = "SELECT 
							i.id,
							i.id_ingenio,
							i.contacto,
							i.telefono,
							i.email,
							i.descripcion,
							i.id_tipo_contactos,
							i.pertenece_a,
							tc.contacto as elcontacto
						FROM
							ingenio_contactos as i
						JOIN tipo_contactos as tc
						ON tc.id = i.id_tipo_contactos
						WHERE
							i.id_ingenio = '$la_bestia'
						AND i.pertenece_a = '3'";

                $comando = Conexion::getInstance()->getDb()->prepare($sql);
                $comando->execute();
                while ($row = $comando->fetch(PDO::FETCH_ASSOC)) {
                	$html.="<tr>";
                    $html.="<td>$row[contacto]</td>";
                    $html.="<td>$row[elcontacto]</td>";
                    $html.="<td>$row[telefono]</td>";
                     $html.="<td>$row[email]</td>";
					$html.="<td class='text-center nowrap'>
                            
                                <a id='a1' class='btn btn-sm btn-primary' data-iid ='$row[id]' data-telefono='$row[telefono]' data-nombre ='$row[nombre]'  data-id ='$row[id]' data-toggle='tooltip' title='Editar' href='javascript:void(0)' data-toggle='modal' ><i class='fa fa-pencil pull-center'></i></a>

                                
                                <a data-correo ='$row[id]' data-iid ='$row[id]' class='btn btn-sm btn-danger' id='btneliminarcontacto' data-toggle='tooltip' href='javascript:void(0)' title='Eliminar' ><i class='fa fa-trash pull-center'></i></a>
                                

                            </div>
                        </td>
                    </tr>";



                }

                $html.='</tbody>
        		</table>';

        		$script="App.datatables();
        		$('#tabla_telefonos').dataTable({
	                columnDefs: [
	                    { type: 'date-custom', targets: [1] },
	                    { orderable: false, targets: [2] }
	                ],
	                order: [[ 0, 'desc' ]],
	                pageLength: 5,
	                lengthMenu: [[5, 20, 30, -1], [5, 20, 30, 'Todo']]
	            });";


               	return array('1',$sql,$html,$script);
			} catch (Exception $e) {
				return array('-1',$e->getMessage(),$e->getLine());
			}
		}



		public static function retornar_firmas($la_bestia){
			$html='';
			$html.='<table id="tabla_firmas" class="table table-bordered table-striped table-vcenter">
			            <thead>
			                <tr>
			                    
			                    <th class="text-left">Nombre</th>
			                    <th class="text-left">Descripción</th>
			                    <th class="text-left">Firma</th>
			                    <th class="text-left">Acciones</th>
			                </tr>
			            </thead>
			            <tbody>';
			$labels['0']['class']   = "label-success";
            $labels['0']['text']    = "Available";
            $labels['1']['class']   = "label-danger";
            $labels['1']['text']    = "Out of Stock";

			try {
				$sql = "SELECT 
                        f.id_firmas,
                        f.la_bestia,
                        p.id,
                        p.descripcion,
                        p.nombre,
                        p.firma
                        
                    FROM
                        firmas_ingenio as p JOIN
                        foranea_firmas_ingenio AS f
                        ON p.id = f.id_firmas
                    WHERE f.la_bestia = '$la_bestia'
                    ORDER BY nombre desc";

                $comando = Conexion::getInstance()->getDb()->prepare($sql);
                $comando->execute();
                while ($row = $comando->fetch(PDO::FETCH_ASSOC)) {
                	$html.="<tr>";
                    $descripcion = wordwrap($row[descripcion], 75, "<br />\n");
                    $html.="<td>$row[nombre]</td>";
                    $html.="<td>$descripcion</td>";
                    $html.='<td class="text-center"><a href="../'.$row[firma].'" data-toggle="lightbox-image">Ver Firma
                        </a></td>';


                    $html.="<td class='text-center nowrap'>
                            	<a id='a1' class='btn btn-sm btn-primary' data-iid ='$row[id]' data-telefono='$row[firma]' data-nombre ='$row[nombre]'  data-id ='$row[id]' data-toggle='tooltip' title='Editar' href='javascript:void(0)' data-toggle='modal' ><i class='fa fa-pencil pull-center'></i></a>
								<a data-firma='$row[firma]' class='btn btn-sm btn-danger' data-correo ='$row[id]' id='btneliminarfirma' data-toggle='tooltip' href='javascript:void(0)' title='Eliminar' ><i class='fa fa-trash pull-center'></i></a>
                         	</td>
                    </tr>";



                }

                $html.='</tbody>
        		</table>';

        		$script="$('#tabla_firmas').dataTable({
	                columnDefs: [
	                    { type: 'date-custom', targets: [1] },
	                    { orderable: false, targets: [2] }
	                ],
	                order: [[ 0, 'desc' ]],
	                pageLength: 5,
	                lengthMenu: [[5, 20, 30, -1], [5, 20, 30, 'Todo']]
	            });";
        		

               	return array('1',$sql,$html,$script);
			} catch (Exception $e) {
				return array('-1',$e->getMessage(),$e->getLine());
			}
		}
	}


?>