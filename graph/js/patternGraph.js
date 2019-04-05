function createGraph(isRealTimeGraph){
            var ctx = document.getElementById("myChart");
    myChart = new Chart(ctx, {
    type: 'line',
    data: {
        datasets: [{
            label: '% de CO2',
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
if(isRealTimeGraph){
    $.ajax({ url: 'atualizar.php',
    data: {action: 'top5'},
    type: 'post',
    success: function(output) {
        var values = new Array();
        values = JSON.parse(output);
        var i;
        for(i=0;true;i++){
            if(values[i]=="end-con"){
                break;
            }
            myChart.data.datasets.forEach((dataset) => {
            dataset.data.push(values[i]);
        });
        }
        ++i;
        for(var j=i;j<Object.keys(values).length;j++){
            myChart.data.labels.push(values[j].substring(11,20));
        }                        
    }
});
}
return myChart;
}
