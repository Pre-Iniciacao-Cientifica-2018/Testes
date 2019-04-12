
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Medias Diarias</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="js/Chart.min.js"></script>
    <script src = "js/patternGraph.js"></script>
    <script src="js/jquery.js"></script>
    <script src = "js/resizeElements.js"></script>

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
           var myChart = createGraph(false);
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
<body onresize = "resizeElements()" onload="resizeElements()">
<div class="chart-container" style="position: relative; height:100%; width:100%;display:flex; flex-direction:column;">
<canvas id="myChart"></canvas>
<p id = "media_diaria"></p>  
</div>
</body>
</html>