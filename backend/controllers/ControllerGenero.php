<?php

    include '../functions/headers.php';

    require_once '../classes/models/Generos.class.php';
    require_once '../classes/models/GenerosFilmes.class.php';

    $generos = new Generos();
    $generosfilmes = new GenerosFilmes();

    if(isset($_POST['cadastrar'])) {
        $genero = $_POST['genero'];
    
        if($generos->consultarDescricao($genero)) {
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
        $busca = isset($_GET['busca']) ? $_GET['busca'] : null;

        $retorno = $generos->listar(0, $busca);
        echo json_encode($retorno);
    }

    if(isset($_GET['consultar'])) {
        $id_genero = isset($_GET['id_genero']) ? $_GET['id_genero'] : '';

        echo json_encode($generos->consultar($id_genero));
    }

    if(isset($_POST['deletar'])) {
        $id_genero = $_POST['id_genero'];

        $retorno_1 = $generosfilmes->deletarGenero($id_genero);

        if($retorno_1['tipo'] == 'success') {
            $retorno = $generos->deletar($id_genero);
            echo json_encode($retorno);
        } else {
            echo json_encode($retorno_1);
        }
    }

    if(isset($_POST['atualizar'])) {
        $id_genero = $_POST['id_genero'];
        $descricao = $_POST['descricao'];

        if($generos->consultarDescricao($descricao)) {
            echo json_encode(['titulo' => 'Gênero já cadastrado', 'tipo' => 'warning']);
        } else {
            $retorno = $generos->atualizar($id_genero, $descricao);        
            echo json_encode($retorno);
        }

        
    }
?>