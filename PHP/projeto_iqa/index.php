<?php

    include "conexao.php";

    $consulta = $conn->query("select * from prop_agua where data between now() - interval 6 day and now() order by 1 desc;");
    $temperaturas = "<br/>";
    $ultimaTemp = 0;

    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        if($ultimaTemp == 0){
            $ultimaTemp = $linha['temperatura'];
        }

        if($linha['temperatura'] >= 25){
            $temperaturas .= "<font color=red>{$linha['data']} | {$linha['temperatura']} C</font><br/>";
        }else{
            $temperaturas .= "<font color=blue>{$linha['data']} | {$linha['temperatura']} C</font><br/>";
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Índice de Qualidade da Água</title>
    </head>
    <body>
        <h3><b>Temperatura:</b></h3>
        <form>
            <input type="button" value="Atualizar" onClick="history.go(0)">
        </form>
        <br/>
            <strong>----- Data/Hora ----- | Temperatura</strong>
        <br/>
        <?php
            echo $temperaturas;
        ?>
    </body>
</html>