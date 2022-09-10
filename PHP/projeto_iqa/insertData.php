<?php

    include "conexao.php";

    if($_GET) {
        $temperatura = $_GET["t"];
        $insert = $conn->query("INSERT INTO prop_agua (temperatura, data) VALUES ('$temperatura', CURRENT_TIMESTAMP);");
    }

?>

