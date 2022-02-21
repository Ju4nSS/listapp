<?php 

require 'includes/config/database.php';

// conectar a la db
$db = conectarDB();
// redactar el query
$query = "SELECT * FROM frutasverduras";
// consultar la db
$resultado = mysqli_query($db, $query);

$campo_vacio = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombreLista = ucfirst($_POST['nombreLista']);
    $nombreLista = mysqli_real_escape_string( $db, $nombreLista );
    $creado = date('Y/m/d');

    // 1.- CREAR NUEVA LISTA

        // redactar el query
        $query = "INSERT INTO listas (nombre, creado) VALUES ('$nombreLista', '$creado')";
        // insertar registro
        mysqli_query($db, $query);

    // 2.- CREAR Y ANEXAR LA LISTA CON PRODUCTOS

        // redactar el query para seleccionar el último id de la lista madre
        $query = "SELECT id FROM listas ORDER BY id DESC LIMIT 1";
        // consultar la db
        $resultado = mysqli_query($db, $query);

        // generar el idLista
        $idLista = mysqli_real_escape_string($db, mysqli_fetch_assoc($resultado)['id']);

        // redactar el query
        foreach( $_POST as $clave => $valor ) {

            if ($clave != 'nombreLista') { // filtramos el primer elemento del POST dejando únicamente los productos

                if ($valor == '') {
                    $valor = 0;
                }

                $clave = mysqli_real_escape_string( $db, $clave ); // nombre del producto
                $valor = mysqli_real_escape_string($db, $valor); // cantidad de producto(s)

                $query = "INSERT INTO lista (nombre, cantidad, idLista) VALUES ('$clave', '$valor', '$idLista')";

                // insertar registro
                mysqli_query($db, $query);

            }

        }

    if ($resultado) {
        header('Location: index.php');
    }

}

require 'includes/funciones.php'; 
incluir_template('header');

?>

<body class = 'crear'>

    <div class = 'error-media'>
        <div class = 'error-mensaje'>
            <p>La visualización en formato horizontal o en dispositivos tablet <br> no se encuentra disponible (ツ)</p>
        </div>
    </div>

    <header class = 'header'>
        <h1>List<span>App</span></h1>
        <p> <a href="index.php">Inicio</a> > <span class = 'bold'>Nueva lista</span></p>
    </header>

    <main class = 'contenedor-formulario'>
        <form class = 'formulario' method = 'POST'>

            <p class = 'campo-vacio'>Debes ingresar un nombre para la lista</p>
            <p class = 'lista-vacia'>Debes seleccionar mínimo un producto</p>

            <label for="">Nombre de la lista:</label>
            <input class = 'nombre-lista' name = 'nombreLista' type="text">
            
            <?php while($producto = mysqli_fetch_assoc($resultado)) : ?>
                <div class = 'producto'>
                    <p> <?php echo $producto['nombre']; ?> </p>
                    <label>Cantidad:</label>
                    <input disabled type="number" name = '<?php echo $producto['nombre']; ?>' value = 0>
                </div>
            <?php endwhile; ?>

            <input class = 'crear-lista' type="submit" value = 'Crear'>
        </form>
    </main>

    <div class = 'menu-inferior'>
        <a href="index.php">
            <span class="material-icons-outlined">home</span>
        </a>
    </div>

    <div class = 'menu-inferior apoyo'>
        <a href="#">
            <span class="material-icons-outlined">home</span>
        </a>
    </div>

<?php

incluir_template('footer');

?>