<?php

    $CON_HOST = "db4free.net";
    $CON_USUARIO = "dbprojetoiqa";
    $CON_SENHA = "projetoiidb";
    $CON_DB = "projeto_iqa";

    $CON_CONEXAO = "mysql:host=$CON_HOST;dbname=$CON_DB;";

    try{

        $conn = new PDO($CON_CONEXAO, $CON_USUARIO, $CON_SENHA,
            array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_PERSISTENT => false,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            )
        );
        echo "Conectado com sucesso ao Banco de Dados";

    } catch (PDOException $erro){

        echo "Erro: ".$erro->getMessage();
        echo "conexao_erro";
        exit;

    }

?>
