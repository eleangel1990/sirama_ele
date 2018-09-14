<?php 
	@session_start();
	define('__ROOT__', dirname(dirname(__FILE__))); 
	require_once(__ROOT__.'/Conexion.php');
	/**
	 * 
	 */
	class Instructores 
	{
		
		function __construct($argument)
		{
			# code...
		}


		public static function obtener_instructores(){
			$sql = "SELECT
						tp.id,
						UPPER(tp.nombre) AS nombre,
						UPPER(tp.direccion) AS direccion,
						tp.telefono,
						UPPER(tp.genero) AS genero,
						tp.correo,
						tp.dui,
						tp.nit,
						tp.imagen,
						UPPER(tc.nombre_curso) AS nombre_curso,
						CASE 
							WHEN tp.estado ='1' THEN 'ACTIVO'
							ELSE 'INACTIVO'
						END as estado	
					FROM
						tb_personas AS tp
					JOIN tb_cursos as tc 
					ON tp.id = tc.id_instructor
					WHERE
						tp.tipo = '3'";
			try {
				$comando = Conexion::getInstance()->getDb()->prepare($sql);
				$comando->execute();
				return $comando->fetchAll(PDO::FETCH_ASSOC);
				
			} catch (Exception $e) {
				return array($e->getMessage(),$e->getLine(),$e);
			}

		}
	}


 ?>