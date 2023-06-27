<?php

    include "conexao.php";

    $consulta = $conn->query("select * from prop_agua where data between now() - interval 180 day and now() order by 1 desc;");
    $consulta->execute();
    $linhas = "<br/>";
    while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
        $linhas .= "<font color=blue>{$linha['data']} | {$linha['temperatura']} °C | {$linha['ph']} | {$linha['turbidez']} NTU | {$linha['oxigenio_d']} % | {$linha['fosfato']} mg/L | {$linha['nitrato']} mg/L | {$linha['dbo']} mg/L | {$linha['coliformes']} Colonies/100 ml | {$linha['residuo_t']} mg/L</font><br/>";
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
        <h3><b>Propriedades da Água:</b></h3>
        <form>
            <input type="button" value="Atualizar" onClick="history.go(0)">
        </form>
        <br/>
            <strong>----- Data/Hora ----- | Temperatura |   pH   | Turbidez | Ox Dissolvido | Fosfato | Nitrato |  DBO  | Coliformes | Residuo </strong>
        <br/>
        <?php echo $linhas;?>
    </body>
</html>
