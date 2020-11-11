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
                        'tipo' => 'success'
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

        public function listar() {
            $conexao = new Conexao();
            $connection = $conexao->conectar();

            try {
                $sql = "SELECT filmes.*, generos.descricao as genero FROM filmes
                        LEFT JOIN generos_filmes ON fk_filme = filmes.id
                        LEFT JOIN generos ON fk_genero = generos.id
                        ORDER BY filmes.titulo, generos.descricao";

                $consulta = $connection->prepare($sql);

                if($consulta->execute()) {

                    $cont = $consulta->rowCount();

                    if ($cont > 0) {
                        $filmes = $consulta->fetchAll();
                        $i = 0;

                        foreach($filmes as $filme) {
                            if(isset($retorno) && $retorno[$i]['id_filme'] != $filme['id']) {
                                $i++;   
                            }

                            $retorno[$i] = array(
                                'id_filme' => $filme['id'],
                                'titulo' => $filme['titulo'],
                                'ano' => $filme['ano'],
                                'duracao' => $filme['duracao'],
                                'torrent' => $filme['torrent'],
                                'capa' => $filme['capa']
                            );
                            
                            $retorno[$i]['generos'][] = $filme['genero'];
                        }

                        return $retorno;
                    } else {
                        return ['vazio' => 'Nenhum filme cadastrado'];
                    }
                } else {
                    return ['erro' => 'Erro ao consultar os filmes'];
                }

            } catch (PDOException $e) {
                echo "Erro de cadastrar filme: " . $e->getMessage();
            } catch (Exception $e) {
                echo "Erro: " . $e->getMessage();
            }
        }

        /*======================================================================================*/

    }

?>