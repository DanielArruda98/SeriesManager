<?php

    include '../functions/headers.php';

    require_once '../classes/models/Filmes.class.php';
    require_once '../classes/models/GenerosFilmes.class.php';

    $filmes = new Filmes();
    $generosfilmes = new GenerosFilmes();

    if(isset($_POST['cadastrar'])) {
        $titulo = $_POST['titulo'];
        $ano = $_POST['ano'];
        $duracao = $_POST['duracao'];
        $torrent = $_POST['torrent'];
        $capa = $_POST['capa'];
        $generos = $_POST['genero'];

        $retorno = $filmes->cadastrar($titulo, $ano, $duracao, $torrent, $capa);

        $id_filme = $retorno['id'];

        foreach($generos as $genero) {
            if($genero[0] != null) {
                $generosfilmes->cadastrar($genero[0], $id_filme);
            }
        }

        echo json_encode($retorno);
    }

    if(isset($_GET['listar'])) {
        $busca = isset($_GET['busca']) ? $_GET['busca'] : null;
        $pagina = $_GET['pagina'];
        $qtd_resultados = $_GET['qtd_resultados'];
        $ordem = $_GET['ordem'];

        $inicio = ($pagina * $qtd_resultados) - $qtd_resultados;

        echo json_encode($filmes->listar($busca, $inicio, $qtd_resultados, $ordem));
    }

    if(isset($_GET['consultar'])) {
        $id_filme = isset($_GET['id_filme']) ? $_GET['id_filme'] : '';

        echo json_encode($filmes->consultar($id_filme));
    }

    if(isset($_POST['deletar'])) {
        $id_filme = $_POST['id_filme'];

        $retorno = $filmes->deletar($id_filme);
        echo json_encode($retorno);
    }

    if(isset($_POST['atualizar'])) {
        $id_filme = $_POST['id_filme'];
        $titulo = $_POST['titulo'];
        $ano = $_POST['ano'];
        $duracao = $_POST['duracao'];
        $torrent = $_POST['torrent'];
        $capa = $_POST['capa'];
        $generos = $_POST['genero'];

        $retorno = $filmes->atualizar($id_filme, $titulo, $ano, $duracao, $torrent, $capa);
        $generosfilmes->deletarFilme($id_filme);

        foreach($generos as $genero) {
            if($genero[0] != null) {
                $generosfilmes->cadastrar($genero[0], $id_filme);
            }
        }
        
        echo json_encode($retorno);
    }

?>