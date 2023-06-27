<?php

    include "conexao.php";
    
    # Função Interpolação
    function interpolacao($x, $arr, $arr2){
      $interpol = [[0,0], [0,0]];
      $n = count($arr);
      $i = 0;
      while($i<$n){
        if($arr[$i] >= $x){
          $interpol[0][0] = $arr[$i];
          $interpol[0][1] = $arr2[$i];
          break;
        } else if($arr[$i] < $x){
          $interpol[1][0] = $arr[$i];
          $interpol[1][1] = $arr2[$i];
        }
        $i++;
      }
      $y = $interpol[0][1] + ($x - $interpol[0][0]) * ($interpol[1][1] - $interpol[0][1]) / ($interpol[1][0] - $interpol[0][0]);
      return ceil($y);
    }
    
    # DATASETS: Curva de qualidade, relação entre parâmetros e indices (qi)
    # Temp, pH, OD, dbo, std, turbidez, coliformes, nitrato, fosfato.
    # Peso
    $wi = ["temperatura" => 0.10, "ph" => 0.11, "oxigenio_d" => 0.17, "dbo" => 0.11, "residuo_t" => 0.07, "turbidez" => 0.08, "coliformes" => 0.16, "nitrato" => 0.10, "fosfato" => 0.10];
    
    # Parâmetro
    $value = ["temperatura" => [-10, 0, 5, 9.5, 12, 14.5, 21, 30.00001],
              "ph" => [2, 3, 3.5, 4, 4.1, 4.5, 4.8, 5.1, 6.2, 6.8, 7, 7.1, 7.2, 7.4, 7.6, 7.8, 8, 8.9, 9.7, 10, 10.3, 10.7, 10.8, 11, 11.5, 12.00001],
              "oxigenio_d" => [0, 5, 10, 16, 20, 25, 32, 34, 40, 45, 50, 55, 62, 67, 70, 74, 80, 84, 90, 90, 100, 102, 106, 110, 115, 120, 125, 130, 135, 137, 140.00001],
              "dbo" => [-100, 0, 0.5, 1, 1.5, 2.5, 4, 6.5, 8.5, 11, 15, 17.5, 20, 21.5, 25, 27, 30.00001],
              "residuo_t" => [0, 10, 20, 30, 40, 60, 70, 150, 450, 500.00001],
              "turbidez" => [0, 3, 8, 13, 15, 20, 30, 40, 50, 60, 70, 80, 90, 100.00001],
              "coliformes" => [1, 2, 5, 10, 20, 50, 100, 200, 500, 1000, 2000, 10000, 100000],
              "nitrato" => [0, 2, 3, 2.5, 4, 6, 10, 17, 27, 37, 50, 54, 71, 80, 90, 100.00001],
              "fosfato" => [0, 0.2, 0.5, 0.7, 1, 1.3, 1.6, 2, 3.2, 4, 5, 6, 7, 8, 10.00001]];
    
    # Indice de Qualidade
    $valueQI = ["temperatura" => [55, 93, 73, 47, 36, 32, 20, 10],
                "ph" => [2, 4, 6, 9, 10, 15, 20, 30, 60, 83, 88, 90, 92, 93, 92, 90, 84, 52, 26, 20, 15, 11, 10, 8, 5, 3],
                "oxigenio_d" => [2, 5, 7, 10, 12, 17, 20, 22, 30, 37, 44, 51, 60, 70, 75, 80, 87, 90, 95, 98, 99, 99, 99, 98, 96, 93, 90, 87, 84, 81, 80, 78],
                "dbo" => [100, 100, 98, 95, 90, 70, 61, 48, 40, 30, 20, 15, 12, 10, 7, 6, 5],
                "residuo_t" => [79, 82, 84, 84.5, 86, 87, 86, 79, 40, 31],
                "turbidez" => [99, 90, 80, 70, 67, 61, 53, 45, 39, 33, 29, 25, 22, 17],
                "coliformes" => [100, 90, 81, 72, 65, 56, 47, 38, 28, 26, 20, 10, 4],
                "nitrato" => [97, 95, 90, 80, 70, 60, 51, 40, 30, 20, 10, 8, 4.5, 4, 3, 2.5],
                "fosfato" => [100, 92, 60, 50, 40, 34, 30, 27, 20, 17, 13, 10, 8, 7, 7]];
                
    $consulta = $conn->query("select * from prop_agua where data between now() - interval 60 day and now() order by 1 desc;");
    $consulta->execute();
    $linha = $consulta->fetch(PDO::FETCH_ASSOC);
    // print_r($linha);
    $y = [];
    // echo "DADOS <br />";
    foreach($linha as $chave => $valor){
        if($chave == "id" or $chave == "data");
        else{
            $y[$chave] = interpolacao($valor, $value[$chave], $valueQI[$chave]);
            // echo "{$chave} => {$valor} ";
            // echo " | Índice: ";
            // echo $y[$chave];
            // echo "<br />";
        }
    }
    $WQI = 0; 
    foreach($y as $chave => $valor){
        $WQI += $valor * $wi[$chave];
    }
    //echo "<br />Índice de Qualidade da Água: ";
    //echo json_encode($y);
    echo json_encode(ceil($WQI));
?>

