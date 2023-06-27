<?php

    include "conexao.php";

    $qs = '';
    
    if (false === empty($_SERVER['QUERY_STRING'])) {
       $qs = $_SERVER['QUERY_STRING'] . '&';
    }
    
    //extrai a querystring para uma array/vetor
    parse_str($qs, $output);
    
    //Exibe o resultado
    //print_r($output);
    $y = [];
    $conn->query("SET time_zone = '-03:00';");
    foreach($output as $chave => $valor){
        $y[$chave] = $valor;
        echo "{$chave} => {$valor} ";
        echo "<br />";
    }

    $insert = $conn->query("INSERT INTO prop_agua (temperatura, ph, turbidez, oxigenio_dissolvido, fosfato, nitrogenio, dbo, coliformes_termotolerantes, residuo_total, data) VALUES ('$y[temperatura]','$y[ph]', '$y[turbidez]', '$y[oxigenio_d]', '$y[fosfato]', '$y[nitrato]', '$y[dbo]', '$y[coliformes]', '$y[residuo_t]', CURRENT_TIMESTAMP);");

?>
