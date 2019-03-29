<?php include 'atualizar.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $canChangePage  = true;
    if (isset($_POST["datepicker"]) && !empty($_POST["datepicker"])) {
        $_SESSION["datepicker"] = str_replace("-","/",$_POST["datepicker"]);
    }
    else if(isset($_POST["datepickerFrom"]) && !empty($_POST["datepickerFrom"])&&isset($_POST["datepickerTo"]) && !empty($_POST["datepickerTo"])){
        $_SESSION["datepickerFrom"] = str_replace("-","/",$_POST["datepickerFrom"]);
        $_SESSION["datepickerTo"] = str_replace("-","/",$_POST["datepickerTo"]);
    }
    else if(isset($_POST["datepickerSemanal"]) && !empty($_POST["datepickerSemanal"])){
        $_SESSION["datepickerSemanal"] = str_replace("-","/",$_POST["datepickerSemanal"]);
    }
    else if(isset($_POST["datepickerMensal"]) && !empty($_POST["datepickerMensal"])){
        $_SESSION["datepickerMensal"] = str_replace("-","/",$_POST["datepickerMensal"]);
    }
    else{$canChangePage = false;}
    if($canChangePage){
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
    <link rel="stylesheet" href="css/datepicker.css">
    <link rel="stylesheet" href="css/graphPages.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">  
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>   
   <script>
       window.onload = eraseSessionVariables;
       function eraseSessionVariables(){
        $.ajax({ url: 'atualizar.php',
        data: {action: 'del'},
        type: 'post'
    });
        }
      $( function() {
    $( ".datepicker" ).datepicker({
      showButtonPanel: true,
      changeMonth: true,
      changeYear: true,
      dateFormat: "dd/mm/yy",
      dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
        currentText: 'Hoje',
        closeText : 'Fechar'

    });
    } );   
    </script>

</head>
<body>
<div class="chart-container" style="position: relative; height:100%; width:67vw;display:flex; flex-direction:column;">
<h1 class = "titleFontPattern" id="mainTitle"> Área dos gráficos </h1>
<h1 class = "titleFontPattern" id="subTitle1" >Gráfico em tempo real da concentração de CO2 na atmosfera da raia olímpica</h1>
<canvas id="myChart"></canvas>  
<script>
var ctx = document.getElementById("myChart");
Chart.defaults.global.defaultFontColor = 'white';
Chart.defaults.global.defaultFontFamily = "Montserrat-Medium";
Chart.defaults.global.defaultFontSize = 15;
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ["12","13","14","15","16","17"],
        datasets: [{
            label: '% de CO2',
            data: [2,4,1,6,10,9],
            backgroundColor: [
               'rgba(28,153,220,0.7)'
            ],
            borderColor: [
                '#ffffff'
            ],
            borderWidth: 1,

        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true,
                },
            }]

        },
        responsive: true
    }
});
ctx.font

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
var lastCode;
setInterval(function(){ 
    $.ajax({ url: 'atualizar.php',
        data: {action: 'att'},
        type: 'post',
        success: function(output) {
            var retorno = new Array();
            retorno = JSON.parse(output);
            var time = retorno[1]+"";
            if(lastCode!=retorno[2]){
            addData(myChart, time.substring(11,20), retorno[0]);  
            } 
            lastCode = retorno[2];                         
        }
    });
}
, 3000);


</script>
<div id = "content-divs">
<h1 id = "subTitle1" class = "titleFontPattern"  class="subTitle">Ficou curioso para saber as concentrações de CO2 de outros dias?</h1>
<p class="text">Para uma melhor visualização das concentrações de CO2 para você, deixamos um espaço destinado para que possas ver as médias diárias/semanais/mensais/horárias ou até dentro de um período específico escolhido ao seu gosto. Divirta-se! </p>
<form method = "post" >
<h1 id = "subTitle2" class = "titleFontPattern" class="subTitle">Escolha uma das datas para que seja mostrado suas médias horárias:</h1>
<input type="text" name = "datepicker" class="datepicker">
    <input type="submit" text="Exibir gráfico" id="getMediasHorarias"> 
</form>
<form method = "post">
<h1 id = "subTitle2" class = "titleFontPattern" class="subTitle">Escolha duas datas para que seja mostrado as médias diárias dentro do período escolhido</h1>
<input type="text" name = "datepickerFrom" class="datepicker" placeholder="De:">
<input type="text" name = "datepickerTo" class="datepicker" placeholder="Até:">
    <input type="submit" text="Exibir gráfico" id="getMediasDiarias"> 
</form>
<form method = "post">
<h1 id = "subTitle2" class = "titleFontPattern" class="subTitle">Clique no botão abaixo para que seja mostrado as médias desta semana</h1>
<input type="submit" text="Exibir gráfico" name = "datepickerSemanal" id="getMediaSemanal"> 
</form>
<form method = "post">
<h1 id = "subTitle2" class = "titleFontPattern" class="subTitle">Clique no botão abaixo para que seja mostrado as médias deste mês</h1>
<input type="submit" text="Exibir gráfico" name = "datepickerMensal" id="getMediaMensal"> 
</form>
</div>
</div>

</body>
</html>