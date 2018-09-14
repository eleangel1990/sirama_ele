<?php 
	@session_start();
	require_once 'Conexion.php';

	/**
	* 
	*/
	class Perfil_Persona
	{
		
		function __construct()
		{
			# code...
		}

		
		public static function retornar_nombre($id_ingenio){
			$nombre_persona=$correo_persona=$usuario = "";
			 

			$sql = "SELECT
						p.nombre,p.correo,u.usuario
					FROM
						personas as p
						JOIN usuarios as u 
						ON u.correo = p.correo
					WHERE
						p.id = '$id_ingenio'";
			try {
				$comando = Conexion::getInstance()->getDb()->prepare($sql);
	            $comando->execute();
	                
	             while ($row = $comando->fetch(PDO::FETCH_ASSOC)) {
	             	$nombre_persona = $row[nombre];
	             	$correo_persona = $row[correo];
	             	$usuario = $row[usuario];
	             }

	             return array("1",$nombre_persona,$correo_persona,$usuario,$sql);
			} catch (Exception $e) {
				return array("-1",$e->getMessage(),$e->getLine());
			}


		}

		public static function perfil_persona($id_ingenio){
			$html="";
			$sql = "SELECT
						id,
						nombre,
						telefono,
						direccion,
						genero,
						nivel,
						correo,
						estado
					FROM personas
					WHERE
						id = '$id_ingenio' ";

			try {
				 	$comando = Conexion::getInstance()->getDb()->prepare($sql);
	                $comando->execute();
	                
	                while ($row = $comando->fetch(PDO::FETCH_ASSOC)) {
	                    $nombre = $row['nombre'];
	                    $telefono = $row['telefono'];
	                    $direccion = $row['direccion'];
	                    $genero = $row['genero'];
	                    $correo = $row['correo'];
	                    $estado = $row['estado'];
	                    $nivel = $row['nivel'];


	                }

	                $html.='<div class="block-section text-center">
			                    <a data-codigo="'.$codigo_oculto.'" id="cambiar_imagen" href="javascript:void(0)">
			                        <img src="../../img/placeholders/avatars/avatar4@2x.jpg" alt="avatar" class="img-circle">
			                    </a>
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
	                            <td class="text-right" style="width: 50%;"><strong>Sexo</strong></td>
	                            <td>'.$genero.'</td>
	                        </tr>';
	            $html.='</tbody>
                </table>';

	         	return array('1',$sql,$html);
	         	
	         } catch (Exception $e) {
	         	return array('-1',$e->getMessage(),$e->getLine(),$sql);
	         	
	         }
		}



		/*public static function retornar_contactos($id_ingenio){
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
							tc.contacto as elcontacto
						FROM
							ingenio_contactos as i
						JOIN tipo_contactos as tc
						ON tc.id = i.id_tipo_contactos
						WHERE
							i.id_ingenio = '$id_ingenio'";

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

                                
                                <a data-correo ='$row[id]' class='btn btn-sm btn-danger' id='btneliminar' data-toggle='tooltip' href='javascript:void(0)' title='Eliminar' ><i class='fa fa-trash pull-center'></i></a>
                                

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
		}*/

		/****funccion que crea tabla bitacoras para usuarios***/

		public static function retornar_vitacoras($id_ingenio){
			$html='';
			$html.='<table id="tabla_bitacora" class="table table-bordered table-striped table-vcenter">
			            <thead>
			                <tr>
			                    
			                    <th class="text-left">Fecha y Hora</th>
			                    <th class="text-left">Actividad</th>
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
                        f.usuario,
                        f.id,
                        f.fecha_hora,
                        f.actividad,
                        p.id as id2,
                        p.nombre,
                        p.correo
                        
                    FROM
                        personas as p JOIN
                        bitacora AS f
                        ON p.correo = f.usuario
                    WHERE p.id = '$id_ingenio'
                    ORDER BY nombre desc";

                $comando = Conexion::getInstance()->getDb()->prepare($sql);
                $comando->execute();
                while ($row = $comando->fetch(PDO::FETCH_ASSOC)) {
                	$html.="<tr>";
                    $descripcion = wordwrap($row[descripcion], 75, "<br />\n");
                    $html.="<td>$row[fecha_hora]</td>";
                    $html.="<td>$row[actividad]</td>";


                    $html.="<td class='text-center nowrap'>
                            	<a id='a1' class='btn btn-sm btn-primary' data-iid ='$row[id]' data-fecha='$row[fecha_hora]' data-actividad ='$row[actividad]'  data-id ='$row[id]' data-toggle='tooltip' title='Editar' href='javascript:void(0)' data-toggle='modal' ><i class='fa fa-pencil pull-center'></i></a>
								<a data-fecha='$row[fecha_hora]' class='btn btn-sm btn-danger' data-correo ='$row[id]' id='btneliminar' data-toggle='tooltip' href='javascript:void(0)' title='Eliminar' ><i class='fa fa-trash pull-center'></i></a>
                         	</td>
                    </tr>";



                }

                $html.='</tbody>
        		</table>';

        		$script="App.datatables();
        			$('#tabla_bitacora').dataTable({
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