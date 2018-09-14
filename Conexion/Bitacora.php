<?php 
	@session_start();
	require_once 'Conexion.php';

	/**
	* 
	*/
	class Bitacora
	{
		
		function __construct()
		{
			# code...
		}

		
		public static function insertar_bitacoras($fecha_hora,$actividad,$usuario){
					
			$query = "INSERT INTO bitacora(fecha_hora,actividad,usuario)values(?,?,?)";
			$oculto = date ('Yidisus');
			try {
				$comando = Conexion::getInstance()->getDb()->prepare($query);
		        $comando->execute(array($fecha_hora,$actividad,$usuario));
		       
			} catch (Exception $ex) {
				 echo json_encode(array("error" => $ex));
			}


		}



		public static function retornar_bitacoras($la_bestia){
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
                    WHERE p.id = '$la_bestia'
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