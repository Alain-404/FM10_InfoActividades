<?php
    function Conectar (){
        $conexion = null;
        $host = '127.0.0.1';
        $db = 'erm_data';
        $user = 'root';
        $pwd = 'admin';
        try {
            $conexion = new PDO('mysql:host='.$host.';dbname='.$db, $user, $pwd);
            //echo "Conectado con exito";
        }
        catch (PDOException $e) {
            echo '<p>ERROR: No se puede comunicar con el servidor!!</p>';
            exit;
        }
        return $conexion;
    }
?>