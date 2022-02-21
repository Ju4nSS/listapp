<?php 

require 'app.php';

function incluir_template($archivo) {
    include TEMPLATES_URL . $archivo . '.php';
}

?>