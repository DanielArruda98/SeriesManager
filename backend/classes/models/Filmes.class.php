<?php

    require_once '../classes/database/Conexao.class.php';
   
    class Filmes {

        /*======================================================================================*/

        public function cadastrar($titulo, $ano, $duracao, $torrent, $capa) {
            $conexao = new Conexao();
            $connection = $conexao->conectar();

            try {
                $sql = "INSERT INTO filmes 
                        VALUES (null, :titulo, :ano, :duracao, :torrent, :capa)";

                $consulta = $connection->prepare($sql);

                $consulta->bindValue(":titulo", $titulo);
                $consulta->bindValue(":ano", $ano);
                $consulta->bindValue(":duracao", $duracao);
                $consulta->bindValue(":torrent", $torrent);
                $consulta->bindValue(":capa", $capa);

                if ($consulta->execute()) {
                    return [
                        'titulo' => 'Filme cadastrado com sucesso!', 
                        'tipo' => 'success',
                        'id' => $connection->lastInsertId()
                    ];
                } else {
                    return [
                        'titulo' => 'Erro ao cadastrar o filme',
                        'tipo' => 'danger'
                    ];
                }

            } catch (PDOException $e) {
                echo "Erro de cadastrar filme: " . $e->getMessage();
            } catch (Exception $e) {
                echo "Erro: " . $e->getMessage();
            }
        }

        /*======================================================================================*/

        public function listar($busca, $inicio, $qtd_resultados, $ordem) {
            $conexao = new Conexao();
            $connection = $conexao->conectar();

            try {
                $ordem_array = [
                    'alfabetica' => "", 
                    'recente' => "filmes.ano DESC,", 
                    'antigo' => "filmes.ano ASC,"
                ];
                
                $ordem_esc = $ordem_array[$ordem];

                $filtro = "";

                if($busca != null) {
                    $filtro = "WHERE titulo LIKE :filtro";
                }

                $sql = "SELECT * FROM filmes
                        $filtro
                        ORDER BY $ordem_esc filmes.titulo ASC
                        LIMIT $inicio, $qtd_resultados";

                $consulta = $connection->prepare($sql);
                
                if($busca != null) {
                    $consulta->bindValue(":filtro", "%$busca%");
                }

                if($consulta->execute()) {

                    $cont = $consulta->rowCount();

                    if ($cont > 0) {
                        $filmes = $consulta->fetchAll();
                        $i = 0;

                        foreach($filmes as $filme) {
                            if(isset($retorno)) {
                                $i++;   
                            }

                            $generos = $this->consultarGenero($filme['id']);

                            $retorno[$i] = array(
                                'id_filme' => $filme['id'],
                                'titulo' => $filme['titulo'],
                                'ano' => $filme['ano'],
                                'duracao' => $filme['duracao'],
                                'torrent' => $filme['torrent'],
                                'capa' => $filme['capa'],
                                'generos' => $generos
                            );
                        }

                        // Quantidade de Páginas
                        $qtd_paginas = ceil($this->contarFilmes() / $qtd_resultados);

                        return [
                            'catalogo' => $retorno,
                            'qtd_paginas' => $qtd_paginas
                        ];
                    }
                }

            } catch (PDOException $e) {
                echo "Erro de cadastrar filme: " . $e->getMessage();
            } catch (Exception $e) {
                echo "Erro: " . $e->getMessage();
            }
        }

        /*======================================================================================*/

        public function consultar($id_filme) {
            $conexao = new Conexao();
            $connection = $conexao->conectar();

            try {

                $sql = "SELECT filmes.*, generos.descricao AS genero FROM filmes
                        LEFT JOIN generos_filmes ON fk_filme = filmes.id
                        LEFT JOIN generos ON fk_genero = generos.id
                        WHERE filmes.id = :id_filme";

                $consulta = $connection->prepare($sql);
                
                $consulta->bindValue(":id_filme", $id_filme);

                if($consulta->execute()) {

                    $cont = $consulta->rowCount();

                    if ($cont > 0) {
                        $dados = $consulta->fetchAll();
                        $i = 0;

                        foreach($dados as $dado) {
                            $retorno['id_filme'] = $dado['id'];
                            $retorno['titulo'] = $dado['titulo'];
                            $retorno['ano'] = $dado['ano'];
                            $retorno['duracao'] = $dado['duracao'];
                            $retorno['torrent'] = $dado['torrent'];
                            $retorno['capa'] = $dado['capa'];
                            $retorno['genero'][] = $dado['genero'];
                        }

                        return $retorno;
                    }
                }

            } catch (PDOException $e) {
                echo "Erro de cadastrar filme: " . $e->getMessage();
            } catch (Exception $e) {
                echo "Erro: " . $e->getMessage();
            }
        }

        /*======================================================================================*/

        public function contarFilmes() {
            $conexao = new Conexao();
            $connection = $conexao->conectar();

            try {

                $sql = "SELECT COUNT(id) AS num_total FROM filmes";

                $consulta = $connection->prepare($sql);

                if($consulta->execute()) {
                    return $consulta->fetchAll()[0][0];
                } else {
                    return 0;
                }

            } catch (PDOException $e) {
                echo "Erro de cadastrar filme: " . $e->getMessage();
            } catch (Exception $e) {
                echo "Erro: " . $e->getMessage();
            }
        }

        /*======================================================================================*/

        public function consultarGenero($id_filme) {
            $conexao = new Conexao();
            $connection = $conexao->conectar();

            try {

                $sql = "SELECT generos.id, generos.descricao FROM filmes 
                        INNER JOIN generos_filmes ON fk_filme = filmes.id
                        INNER JOIN generos ON fk_genero = generos.id
                        WHERE filmes.id = :id_filme";

                $consulta = $connection->prepare($sql);
                
                $consulta->bindValue(":id_filme", $id_filme);

                if($consulta->execute()) {

                    $cont = $consulta->rowCount();

                    if ($cont > 0) {
                        $generos = $consulta->fetchAll();
                        $i = 0;

                        foreach($generos as $genero) {
                            if(isset($retorno)) {
                                $i++;
                            }

                            $retorno[$i]['id_genero'] = $genero['id'];
                            $retorno[$i]['genero'] = $genero['descricao'];
                        }

                        return $retorno;
                    }
                }

            } catch (PDOException $e) {
                echo "Erro de cadastrar filme: " . $e->getMessage();
            } catch (Exception $e) {
                echo "Erro: " . $e->getMessage();
            }
        }

        /*======================================================================================*/

    }
