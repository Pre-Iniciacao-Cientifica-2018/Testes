<?php
    require_once "Conexao.php";
    define('DB_HOST'        , "localhost");
    define('DB_USER'        , "sa");
    define('DB_PASSWORD'    , "12345");
    define('DB_NAME'        , "TESTE");
    define('DB_DRIVER'      , "sqlsrv");
    try {
        $Conexao    = Conexao::getConnection();
        $query      = $Conexao->query("SELECT * FROM DADOS");
        $pessoa   = $query->fetchAll();
        
    } catch(Exception $e) {
        echo $e->getMessage();
        exit;
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemplo de gráfico</title>
    <script src="js/Chart.min.js"></script>
    <style>
        .chart-container {
            
        }
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
    </style>
</head>
<body>
<div class="chart-container">
<canvas id="myChart" width="1000" height="500"></canvas>
<script>
var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ["13h", "14h", "15h", "16h", "17h", "18h"],
        datasets: [{
            label: '% de CO2',
            data: [<?php echo $pessoa[0][0]; ?>, <?php echo $pessoa[1][0]; ?>, <?php echo $pessoa[2][0]; ?>, <?php echo $pessoa[3][0]; ?>, <?php echo $pessoa[4][0]; ?>, <?php echo $pessoa[5][0]; ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>
</div>
</body>
</html>