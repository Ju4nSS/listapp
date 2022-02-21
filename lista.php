<?php 

$idLista = $_GET['id'];
$idLista = filter_var($idLista, FILTER_VALIDATE_INT);

require 'includes/config/database.php';

// conectar a la db
$db = conectarDB();
// redactar el query
$query = "SELECT * FROM lista WHERE idLista = ${idLista}";
// consultar la db
$resultado = mysqli_query($db, $query);

// echo '<pre>';
// var_dump($id);
// echo '</pre>';

require 'includes/funciones.php'; 
incluir_template('header');

?>

<body class = 'seccion-lista'>

    <header class = 'header'>
        <h1>List<span>App</span></h1>
        <p> <a href="index.php">Inicio</a> > <span class = 'bold'>Mis listas</span></p>
    </header>

    <main>
        <table class = 'table'>
            <thead>
                <tr>
                    <th>
                        Nombre
                        <span class="material-icons-outlined">keyboard_arrow_down</span>
                    </th>
                    <th>
                        Cantidad
                        <span class="material-icons-outlined">keyboard_arrow_down</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php while( $row = mysqli_fetch_assoc($resultado) ) : ?>
                <tr>
                    <td>
                    <?php 
                    echo str_replace('_', ' ', $row['nombre']);
                    ?>
                    </td>
                    <td><?php echo $row['cantidad']?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>

    <div class = 'menu-inferior'>
        <a href="index.php">
            <span class="material-icons-outlined">home</span>
        </a>
        <a href="listas.php">
            <span class="material-icons-outlined">arrow_back_ios</span>
        </a>
    </div>

    <div class = 'menu-inferior apoyo'>
        <a href="#">
            <span class="material-icons-outlined">home</span>
        </a>
    </div>

</body>

<?php

incluir_template('footer');

?>