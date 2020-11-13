<?php

    include '../functions/headers.php';

    require_once '../classes/models/Generos.class.php';

    $generos = new Generos();

    if(isset($_POST['cadastrar'])) {
        $genero = $_POST['genero'];
    
        if($generos->consultar($genero)) {
            $retorno = [
                'titulo' => 'Gênero já cadastrado!', 
                'tipo' => 'warning'
            ];

            echo json_encode($retorno);
        } else {
            $retorno = $generos->cadastrar($genero);
            echo json_encode($retorno);
        }
    }

    if(isset($_GET['listar'])) {
        $retorno = $generos->listar();
        echo json_encode($retorno);
    }

?>