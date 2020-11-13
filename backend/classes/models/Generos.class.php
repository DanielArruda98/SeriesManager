<?php

    require_once '../classes/database/Conexao.class.php';

    class Generos {

        /*======================================================================================*/

        public function listar($id_genero = 0) {
            $conexao = new Conexao();
            $connection = $conexao->conectar();

            try {

                $condicao = $id_genero == 0 ? ">" : "=";

                $sql = "SELECT * FROM generos WHERE id $condicao :id_genero;";

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

    }

?>