<?php 
	@session_start();
	require_once 'Conexion.php';

	/**
	 * 
	 */
	class Perfil_Empresa  
	{
		
		function __construct($argument)
		{
			# code...
		}

		/****barcos*****/
		public static function retornar_barcos($id_operador){
			$html='';
			$html.='<table id="tabla_barco" class="table table-bordered table-striped table-vcenter">
			            <thead>
			                <tr>
			                    
			                    <th class="text-left">Barco</th>
			                    <th class="text-left">ETA</th>
			                    <th class="text-left">ETD</th>
			                    <th class="text-left">IMO</th>
			                    <th class="text-left">Viaje No.</th>
			                    <th class="text-left">Bandera</th>
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
							id,
							nombre_barco,
							to_char( eta, 'DD/MM/YYYY') as etamodi,
							eta,
							to_char( etd, 'DD/MM/YYYY') as etdmodi,
							etd,
							imo,
							codigo_oculto,bandera,numero_viaje 
						FROM
							barco 
						WHERE
							id_operador = '$id_operador'";

                $comando = Conexion::getInstance()->getDb()->prepare($sql);
                $comando->execute();
                while ($row = $comando->fetch(PDO::FETCH_ASSOC)) {
                	$html.="<tr>";
                    $html.="<td>$row[nombre_barco]</td>";
                    $html.="<td>$row[etamodi]</td>";
                    $html.="<td>$row[etdmodi]</td>";
                    $html.="<td>$row[imo]</td>";
                    $html.="<td>$row[numero_viaje]</td>";
                    $html.='<td class="imagen_cuadrada">  
                                    <a href="../'.$row[bandera].'" class="gallery-link" title="Image Info">
                                        <img class="imagen_bandera" src="../'.$row[bandera].'" alt="image">
                                    </a>
                                 </td>';
                   
					$html.="<td class='text-center nowrap'> 
                            
                                <a id='a1_barco' data-codigo_oculto = '$row[codigo_oculto]' class='btn btn-sm btn-primary' data-numero_viaje='$row[numero_viaje]' data-iid ='$row[id]' data-nombre ='$row[nombre_barco]' data-eta ='$row[etamodi]' data-etd ='$row[etdmodi]' data-imo ='$row[imo]' data-bandera ='$row[bandera]' data-toggle='tooltip' title='Editar dirección' href='javascript:void(0)' data-toggle='modal' ><i class='fa fa-pencil pull-center'></i></a>

                                
                                <a data-iid ='$row[id]' data-imagen ='$row[bandera]'  class='btn btn-sm btn-danger' id='btneliminar_barco' data-toggle='tooltip' href='javascript:void(0)' title='Eliminar' ><i class='fa fa-trash pull-center'></i></a>
                                

                             
                        </td>
                    </tr>";



                }

                $html.='</tbody>
        		</table>';

        		$script="
        		$('#tabla_barco').dataTable({
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

		/****direcciones***/

		public static function retornar_direcciones($id_operador,$pertenece_a){
			$html='';
			$html.='<table id="tabla_direcciones" class="table table-bordered table-striped table-vcenter">
			            <thead>
			                <tr>
			                    
			                    <th class="text-left">Nombre</th>
			                    <th class="text-left">Teléfono</th>
			                    <th class="text-left">Tipo de Dirección</th>
			                    <th class="text-left">Dirección</th>
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
							doo.id,
							doo.id_operador,
							doo.responsable,
							doo.direccion,doo.telefono,doo.tipo_direccion,td.tipo_direccion as tipo
						FROM
							direcciones_operadores as doo
						JOIN tipo_direcciones as td
						ON doo.tipo_direccion = td.id
						WHERE
							doo.id_operador = '$id_operador'
							and doo.pertenece_a='$pertenece_a'";

                $comando = Conexion::getInstance()->getDb()->prepare($sql);
                $comando->execute();
                while ($row = $comando->fetch(PDO::FETCH_ASSOC)) {
                	$html.="<tr>";
                    $html.="<td>$row[responsable]</td>";
                    $html.="<td>$row[telefono]</td>";
                    $html.="<td>$row[tipo]</td>";
                     $html.="<td>$row[direccion]</td>";
					$html.="<td class='text-center nowrap'> 
                            
                                <a id='a1_dir' class='btn btn-sm btn-primary' data-iid ='$row[id]' data-nombre ='$row[responsable]' data-telefono ='$row[telefono]' data-direccion ='$row[direccion]' data-tipo_direccion ='$row[tipo_direccion]' data-toggle='tooltip' title='Editar dirección' href='javascript:void(0)' data-toggle='modal' ><i class='fa fa-pencil pull-center'></i></a>

                                
                                <a data-iid ='$row[id]'  class='btn btn-sm btn-danger' id='btneliminar_dire' data-toggle='tooltip' href='javascript:void(0)' title='Eliminar' ><i class='fa fa-trash pull-center'></i></a>
                                

                             
                        </td>
                    </tr>";



                }

                $html.='</tbody>
        		</table>';

        		$script="
        		$('#tabla_direcciones').dataTable({
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



		public static function perfil_operador($id_operador){
			$html="";
			$sql = "SELECT 
						id,
						nombre,
						credito,
						nit,
						telefono,
						email as correo,
						direccion,
						imagen as laimagen,
						codigo_oculto,
						detalle_cuenta_bancaria_numero,
						detalle_cuenta_bancaria_nombre,
						cheque_nombre_de
					FROM
						empresa 
					WHERE
						id = '$id_operador'";

			try {
				 	$comando = Conexion::getInstance()->getDb()->prepare($sql);
	                $comando->execute();
	                
	                while ($row = $comando->fetch(PDO::FETCH_ASSOC)) {
	                     

		                $html.='<div class="block-section text-center">
				                    <a data-imagen="'.$row[laimagen].'" data-codigo="'.$row[codigo_oculto].'" id="cambiar_imagen" href="javascript:void(0)">
				                        <img  src="../'.$row[laimagen].'" alt="avatar" class="img-circle" id="imagen_perfil">
				                    </a>
				                    <form method="post" accept-charset="utf-8">
				               
				                    	 
				                    </form>
				                    <input data-codigo2="'.$row[codigo_oculto].'"  type="file" class="archivos hidden" id="file_2" name="file_2" />
				                    <h3>
				                        <strong>'.$row[nombre].'</strong><br><small></small>
				                    </h3>
				                </div>';
				        $html.='<table class="table table-borderless table-striped table-vcenter">
	                    		<tbody>';

		                $html.='<tr>
		                            <td class="text-right" style="width: 50%;"><strong>NIT</strong></td>
		                            <td>'.$row[nit].'</td>
		                        </tr>
		                        <tr>
		                            <td class="text-right" style="width: 50%;"><strong>Correo</strong></td>
		                            <td>'.$row[correo].'</td>
		                        </tr>
		                        <tr>
		                            <td class="text-right" style="width: 50%;"><strong>Teléfono</strong></td>
		                            <td>'.$row[telefono].'</td>
		                        </tr>
		                        <tr>
		                            <td class="text-right" style="width: 50%;"><strong>Dirección</strong></td>
		                            <td>'.$row[direccion].'</td>
		                        </tr>
		                        <tr>
		                            <td class="text-right" style="width: 50%;"><strong>Ver datos Bancarios</strong></td>
		                            <td><button id="datos_bancarios" data-codigo="'.$row[codigo_oculto].'" type="button" class="btn btn-alt btn-xs btn-primary">Ver datos</button>
		                            </td>
		                        </tr>';

		            	$html.='</tbody>
	                		</table>';


	                }


	                	 

	         	return array('1',$sql,$html);
	         	
	         } catch (Exception $e) {
	         	return array('-1',$e->getMessage(),$e->getLine());
	         	
	         }
		}
	}

?>