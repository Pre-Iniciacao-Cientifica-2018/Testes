
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Medias Diarias</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="js/Chart.min.js"></script>
    <script src="js/jquery.js"></script>

</head>
<script>
    var tf = false;
        $.ajax({ url: 'atualizar.php',
        data: {action: 'md'},
        type: 'post',
        success: function(output) {
            tf = true;
            var values = new Array();
            values = JSON.parse(output);
            var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        datasets: [{
            label: '% de CO2',
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
if(tf){
        var i;
    for(i=0;true;i++){
        if(values[i]=="end-con"){
            break;
        }
        myChart.data.datasets.forEach((dataset) => {
        dataset.data.push(values[i]);
    });
    }
    for(var j=++i;j<Object.keys(values).length;j++){
        myChart.data.labels.push(values[j]);
    }
    myChart.update();
    }
        }
        
    });
    
</script>
<body>
<canvas id="myChart" width="1000" height="500"></canvas>   
</body>
</html>