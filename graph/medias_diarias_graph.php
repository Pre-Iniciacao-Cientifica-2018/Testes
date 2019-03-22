
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Medias Diarias</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="js/Chart.min.js"></script>
    <script src="js/jquery.js"></script>
<style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
    </style>
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
            if(Object.keys(values).length!=3){
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
    var media = 0;
        var i;
    for(i=0;true;i++){
        if(values[i]=="end-con"){
            break;
        }
        myChart.data.datasets.forEach((dataset) => {
        dataset.data.push(values[i]);
    });
    media = media + parseFloat(values[i]);
    }
    media = media/i;
    ++i;
    document.getElementById("media_diaria").innerHTML = "A média de concentração de CO2 dentro desse período foi de: "+media.toFixed(2);
    for(var j=i;j<Object.keys(values).length;j++){
        myChart.data.labels.push(values[j]);
    }
    myChart.update();
    }
            }
            else{
                //fiz ele mostrar um texto quando tiver 1 valor somente
                document.getElementById("media_diaria").innerHTML = "Foi encontrada apenas uma média dentro deste período: "+parseFloat(values[0]).toFixed(2)+", no horário/na data "+values[2];
            }
        }    
    });
    
</script>
<body>
    <div>
<canvas id="myChart" width="1000" height="500"></canvas>
<p id = "media_diaria"></p>  
</div>
</body>
</html>