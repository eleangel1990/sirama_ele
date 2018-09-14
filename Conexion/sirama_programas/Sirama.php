<?php 
	@session_start();
	define('__ROOT__', dirname(dirname(__FILE__))); 
	require_once(__ROOT__.'/Conexion.php');

	/**
	 * 
	 */
	class Sirama
	{
		
		function __construct($Eargument)
		{
			# code...
		}

		public static function obtener_cursos(){
			$sql = "SELECT
					tc.id,
					tc.id_instructor,
					tc.id_aulas_laboratorios,
					DATE_FORMAT(tc.fecha_inicio,'%d/%m/%Y') as fecha_inicio,
					DATE_FORMAT(tc.fecha_fin,'%d/%m/%Y') as fecha_fin,
					tc.cupo_maximo,
					tc.cupo_minimo,
					tc.material,
					tc.costo,
					tc.matricula,
					tc.id_centro_formacion,
					tp.nombre,
					tc.nombre_curso
				FROM
					tb_cursos as tc
				JOIN tb_personas as tp
				ON tc.id_instructor = tp.id";
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