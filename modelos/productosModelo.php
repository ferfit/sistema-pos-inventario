<?php

require_once('conexion.php');

class ProductosModelo{

    /*----------------------------------------- */
    /*       Mostrar Productos / Ver Productos  */
    /*----------------------------------------- */
    static public function mdlMostrarProductos($tabla,$item,$valor){

        if($item != null){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();

            
            
            
        } else {
            
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            
            $stmt->execute();
            
            return $stmt->fetchAll();
            
        }
        
        $stmt = null;

    }

}

?>