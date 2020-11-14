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
                    return [
                        'titulo' => 'Gênero associado ao filme com sucesso!', 
                        'tipo' => 'success'
                    ];
                } else {
                    return [
                        'titulo' => 'Erro ao associar gênero ao filme',
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

    }

?>