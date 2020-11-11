<?php

    include '../functions/headers.php';

    require_once '../classes/models/Filmes.class.php';

    $filmes = new Filmes();

    if(isset($_POST['cadastrar'])) {
        $titulo = $_POST['titulo'];
        $ano = $_POST['ano'];
        $duracao = $_POST['duracao'];
        $torrent = $_POST['torrent'];
        $capa = $_POST['capa'];

        $retorno = $filmes->cadastrar($titulo, $ano, $duracao, $torrent, $capa);
        echo json_encode($retorno);
    }

    if(isset($_GET['listar'])) {
        echo json_encode($filmes->listar());
    }

?>