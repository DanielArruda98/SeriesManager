<?php

    require_once '../classes/database/Conexao.class.php';

    class Generos {

        /*======================================================================================*/

        public function cadastrar($genero) {
            $conexao = new Conexao();
            $connection = $conexao->conectar();

            try {
                $sql = "INSERT INTO generos 
                        VALUES (null, :genero)";

                $consulta = $connection->prepare($sql);

                $consulta->bindValue(":genero", $genero);

                if ($consulta->execute()) {
                    return [
                        'titulo' => 'Gênero cadastrado com sucesso!', 
                        'tipo' => 'success'
                    ];
                } else {
                    return [
                        'titulo' => 'Erro ao cadastrar o gênero',
                        'tipo' => 'danger'
                    ];
                }

            } catch (PDOException $e) {
                echo "Erro de cadastrar gênero: " . $e->getMessage();
            } catch (Exception $e) {
                echo "Erro: " . $e->getMessage();
            }
        }

        /*======================================================================================*/

        public function listar($id_genero = 0) {
            $conexao = new Conexao();
            $connection = $conexao->conectar();

            try {

                $condicao = $id_genero == 0 ? ">" : "=";

                $sql = "SELECT * FROM generos 
                        WHERE id $condicao :id_genero
                        ORDER BY descricao;";

                $consulta = $connection->prepare($sql);
                
                $consulta->bindValue(":id_genero", $id_genero);

                if($consulta->execute()) {

                    $cont = $consulta->rowCount();

                    if ($cont > 0) {
                        $generos = $consulta->fetchAll();
                        
                        return $generos;
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

         public function consultar($genero) {
            $conexao = new Conexao();
            $connection = $conexao->conectar();

            try {

                $sql = "SELECT * FROM generos 
                        WHERE descricao = :genero;";

                $consulta = $connection->prepare($sql);
                
                $consulta->bindValue(":genero", $genero);

                if($consulta->execute()) {

                    $cont = $consulta->rowCount();

                    if ($cont > 0) {
                        $generos = $consulta->fetchAll();
                        
                        return $generos;
                    }
                }

            } catch (PDOException $e) {
                echo "Erro de cadastrar filme: " . $e->getMessage();
            } catch (Exception $e) {
                echo "Erro: " . $e->getMessage();
            }
        }

        /*======================================================================================*/

        public function deletar($id_genero) {
            $conexao = new Conexao();
            $connection = $conexao->conectar();

            try {
                $sql = "DELETE FROM generos
                        WHERE id = :id_genero";

                $consulta = $connection->prepare($sql);

                $consulta->bindValue(":id_genero", $id_genero);

                if ($consulta->execute()) {
                    return [
                        'titulo' => 'Gênero deletado com sucesso!', 
                        'tipo' => 'success'
                    ];
                } else {
                    return [
                        'titulo' => 'Erro ao deletar gênero',
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