<?php 

require 'includes/config/database.php';

// conectar a la db
$db = conectarDB();
// redactar el query
$query = "SELECT * FROM listas";
// consultar la db
$resultado = mysqli_query($db, $query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    // ** Eliminar registros de clave foránea a la tabla padre

        // redactar el query
        $query = "DELETE FROM lista WHERE idLista = ${id}";
        // consultar la db
        $resultado2 = mysqli_query($db, $query);

    // ** Eliminar registro de la tabla padre 
    
        // redactar el query
        $query = "DELETE FROM listas WHERE id = ${id}";
        // consultar la db
        $resultado2 = mysqli_query($db, $query);

    header('Location: listas.php');

}

require 'includes/funciones.php'; 
incluir_template('header');

?>

<body class = 'listas'>

    <header class = 'header'>
        <h1>List<span>App</span></h1>
        <p> <a href="index.php">Inicio</a> > <span class = 'bold'>Mis listas</span></p>
    </header>

    <main class = 'contenedor-listas'>
        <?php while( $lista = mysqli_fetch_assoc($resultado) ) : ?>
            <a class = 'lista' href="lista.php?id=<?php echo $lista['id']; ?>">
                <div>
                    <p><?php echo $lista['nombre']?></p>
                    <p>Creado el: <?php echo $lista['creado']?></p>
                </div>
    
                <div class = 'opciones'>
                    <form method = 'POST'>
                        <input hidden type="number" name="id" value = <?php echo $lista['id']?> >
                        <span class="material-icons-outlined borrar">delete</span>
                    </form>
                    <span class="material-icons-outlined ver-mas">more_vert</span>
                </div>
            </a>
        <?php endwhile; ?>
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
    
</body>

<?php 
incluir_template('footer');
?>