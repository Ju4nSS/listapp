<?php 

require 'includes/funciones.php'; 
incluir_template('header');

?>

<body class = 'index'>

    <div class = 'error-media'>
        <div class = 'error-mensaje'>
            <p>La visualización en formato horizontal o en dispositivos tablet <br> no se encuentra disponible (ツ)</p>
        </div>
    </div>

    <header class = 'header'>
        <h1>List<span>App</span></h1>
        <p>Crea y consulta tus listas de compra</p>
    </header>

    <main class = 'contenedor-menu'>
        <div class = 'menu'>
            <a href="crear.php">Nueva lista</a>
            <a href="listas.php">Mis listas</a>
        </div>
    </main>

    <footer class = 'footer'>
        <p>Desarrollado por ju_ez</p>
    </footer>

<?php

incluir_template('footer');

?>