<?php include 'atualizar.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["datepicker"]) && !empty($_POST["datepicker"])) {
        $_SESSION["datepicker"] = str_replace("-","/",$_POST["datepicker"]);
        header("location: medias_diarias_graph.php");
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemplo de gráfico</title>
    <script src="js/Chart.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>   
   <script>
      $( function() {
    $( "#datepicker" ).datepicker({
      showButtonPanel: true,
      changeMonth: true,
      changeYear: true,
      dateFormat: "dd/mm/yy"
    });
    } );   
    </script>
    <style>
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
<p>Se quiserem ver o gráfico das médias diárias func, coloca dia 23 ai</p>
<p>Se quiserem ver o gráfico em tempo real, abram a página <a href = "insert_data.html">insert_data.html</a></p>
<script>
var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ["12","13","14","15","16","17"],
        datasets: [{
            label: '% de CO2',
            data: [2,4,1,6,10,9],
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

function addData(chart, label, data) {

    chart.data.labels.push(label);
    chart.data.datasets.forEach((dataset) => {
        dataset.data.push(data);
    });
    chart.update();

    chart.data.labels.splice(0, 1);
    chart.data.datasets.forEach((dataset) => {
        dataset.data.splice(0, 1);
    });
    chart.update();
}

setInterval(function(){ 
    $.ajax({ url: 'atualizar.php',
        data: {action: 'att'},
        type: 'post',
        success: function(output) {
            var retorno = new Array();
            retorno = JSON.parse(output);
            var time = retorno[1]+"";
            addData(myChart, time.substring(11,20), retorno[0]);          
        }
    });
}
, 3000);


</script>
</div>
<form method = "post">
<input type="text" name = "datepicker" id="datepicker">
    <input type="submit" text="Exibir gráfico" id="getMediasHorarias"> 
</form>
</body>
</html>