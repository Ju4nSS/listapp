<?php 

function conectarDB() {
    $db = mysqli_connect('localhost', 'root', '', 'listapp');
    
    if (!$db) {
        echo 'Error al conectar a la base de datos';
        exit;
    }

    return $db;
}

?>
