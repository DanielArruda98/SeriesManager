<?php

    require_once '../classes/database/Conexao.class.php';

    class GenerosFilmes {

        /*======================================================================================*/

        public function cadastrar($genero, $filme) {
            $conexao = new Conexao();
            $connection = $conexao->conectar();

            try {
                $sql = "INSERT INTO generos_filmes 
                        VALUES (null, :genero, :filme)";

                $consulta = $connection->prepare($sql);

                $consulta->bindValue(":genero", $genero);
                $consulta->bindValue(":filme", $filme);

                if ($consulta->execute()) {
                    return true;
                }

            } catch (PDOException $e) {
                echo "Erro de cadastrar gênero: " . $e->getMessage();
            } catch (Exception $e) {
                echo "Erro: " . $e->getMessage();
            }
        }

        /*======================================================================================*/

        public function deletarFilme($id_filme) {
            $conexao = new Conexao();
            $connection = $conexao->conectar();

            try {
                $sql = "DELETE FROM generos_filmes
                        WHERE fk_filme = :id_filme";

                $consulta = $connection->prepare($sql);

                $consulta->bindValue(":id_filme", $id_filme);

                if ($consulta->execute()) {
                    return true;
                }

            } catch (PDOException $e) {
                echo "Erro de cadastrar filme: " . $e->getMessage();
            } catch (Exception $e) {
                echo "Erro: " . $e->getMessage();
            }
        }

        /*======================================================================================*/

        public function deletarGenero($id_genero) {
            $conexao = new Conexao();
            $connection = $conexao->conectar();

            try {
                $sql = "DELETE FROM generos_filmes
                        WHERE fk_genero = :id_genero";

                $consulta = $connection->prepare($sql);

                $consulta->bindValue(":id_genero", $id_genero);

                if ($consulta->execute()) {
                    return [
                        'titulo' => 'Genero removido com sucesso!',
                        'tipo' => 'success'
                    ];
                } else {
                    return [
                        'titulo' => 'Erro ao remover gênero',
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

    }

?>