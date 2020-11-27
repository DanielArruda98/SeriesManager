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

        public function listar($id_genero = 0, $busca = null) {
            $conexao = new Conexao();
            $connection = $conexao->conectar();

            try {

                $condicao = $id_genero == 0 ? ">" : "=";

                $filtro = "";

                if($busca != null) {
                    $filtro = "AND descricao LIKE :filtro";
                }

                $sql = "SELECT * FROM generos 
                        WHERE id $condicao :id_genero $filtro
                        ORDER BY descricao;";

                $consulta = $connection->prepare($sql);
                
                $consulta->bindValue(":id_genero", $id_genero);

                if($busca != null) {
                    $consulta->bindValue(":filtro", "%$busca%");
                }

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

        public function consultar($id_genero) {
            $conexao = new Conexao();
            $connection = $conexao->conectar();

            try {

                $sql = "SELECT * FROM generos 
                        WHERE id = :id_genero;";

                $consulta = $connection->prepare($sql);
                
                $consulta->bindValue(":id_genero", $id_genero);

                if($consulta->execute()) {

                    $cont = $consulta->rowCount();

                    if ($cont > 0) {
                        return $consulta->fetchAll()[0];
                    }
                }

            } catch (PDOException $e) {
                echo "Erro de cadastrar filme: " . $e->getMessage();
            } catch (Exception $e) {
                echo "Erro: " . $e->getMessage();
            }
        }

        /*======================================================================================*/

        public function consultarDescricao($genero) {
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

         public function atualizar($id_genero, $descricao) {
            $conexao = new Conexao();
            $connection = $conexao->conectar();

            try {
                $sql = "UPDATE generos
                        SET descricao = :descricao
                        WHERE id = :id_genero";

                $consulta = $connection->prepare($sql);

                $consulta->bindValue(":id_genero", $id_genero);
                $consulta->bindValue(":descricao", $descricao);

                if ($consulta->execute()) {
                    return [
                        'titulo' => 'Gênero atualizado com sucesso!', 
                        'tipo' => 'success'
                    ];
                } else {
                    return [
                        'titulo' => 'Erro ao atualizar gênero',
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