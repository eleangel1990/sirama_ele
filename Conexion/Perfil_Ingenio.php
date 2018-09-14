<?php 
	@session_start();
	require_once 'Conexion.php';

	/**
	* 
	*/
	class Perfil_Ingenio
	{
		
		function __construct()
		{
			# code...
		}

		
		public static function retornar_nombre($id_ingenio){
			$nombre_ingenio="";
			$sql = "SELECT
						nombre 
					FROM
						ingenio 
					WHERE
						id = '$id_ingenio'";
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

		public static function perfil_ingenio($id_ingenio){
			$html="";
			$sql = "SELECT
						nombre,
						fda as numero_fda,
						direccion,
						telefono,
						email as correo,nit,nrc,fax,
						codigo_oculto,imagen as imagen_ingenio
					FROM ingenio
					WHERE
						id = '$id_ingenio' ";

			try {
				 	$comando = Conexion::getInstance()->getDb()->prepare($sql);
	                $comando->execute();
	                
	                while ($row = $comando->fetch(PDO::FETCH_ASSOC)) {
	                    $nombre = $row['nombre'];
	                    $codigo_oculto = $row['codigo_oculto'];
	                    $numero_fda = $row['numero_fda'];
	                    $direccion = $row['direccion'];
	                     
	                    $correo = $row['correo'];
	                    $nit = $row['nit'];
	                    $nrc = $row['nrc'];
	                    $fax = $row['fax'];
	                    $imagen = $row['imagen_ingenio'];
	                     


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
	                            <td class="text-right" style="width: 50%;"><strong>Nombre</strong></td>
	                            <td>'.$correo.'</td>
	                        </tr>
	                        <tr>
	                            <td class="text-right" style="width: 50%;"><strong>Correo</strong></td>
	                            <td>'.$correo.'</td>
	                        </tr>
	                        <tr>
	                            <td class="text-right" style="width: 50%;"><strong>NIT</strong></td>
	                            <td>'.$nit.'</td>
	                        </tr>
	                        <tr>
	                            <td class="text-right" style="width: 50%;"><strong>NRC</strong></td>
	                            <td>'.$nrc.'</td>
	                        </tr>';
	            $html.='</tbody>
                </table>';

	         	return array('1',$sql,$html);
	         	
	         } catch (Exception $e) {
	         	return array('-1',$e->getMessage(),$e->getLine());
	         	
	         }
		}



		public static function retornar_contactos($id_ingenio){
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
		}



		public static function retornar_firmas($id_ingenio){
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
                        f.id_ingenio,
                        p.id,
                        p.descripcion,
                        p.nombre,
                        p.firma
                        
                    FROM
                        firmas_ingenio as p JOIN
                        foranea_firmas_ingenio AS f
                        ON p.id = f.id_firmas
                    WHERE f.id_ingenio = '$id_ingenio'
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
								<a data-firma='$row[firma]' class='btn btn-sm btn-danger' data-correo ='$row[id]' id='btneliminar' data-toggle='tooltip' href='javascript:void(0)' title='Eliminar' ><i class='fa fa-trash pull-center'></i></a>
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