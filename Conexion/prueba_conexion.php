<?php 
require_once 'Conexion.php';
    $query = 'SELECT *from tb_usuarios';  
     
    try {
        $comando = Conexion::getInstance()->getDb()->prepare($query);
        $comando->execute();
        while ($row = $comando->fetch(PDO::FETCH_ASSOC)) {
                  print_r( $row );     
        } 
    } catch (Exception $e) {
        print_r($e);
    }
    

?>