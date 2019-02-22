
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Medias Diarias</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<script>
        $.ajax({ url: 'atualizar.php',
        data: {action: 'md',data_selecionada:<?php session_start();echo $_SESSION["datapicker"]?>},
        type: 'post',
        success: function(output) {
            Array values = JSON.parse(output);
            var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
    type: 'line',
    data: {
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
        }
    });
    for(int i=0;i<24;i++){
        myChart.datasets[0].data[i] = values[i][0];
    }
</script>
<body>
<canvas id="myChart" width="1000" height="500"></canvas>   
</body>
</html>