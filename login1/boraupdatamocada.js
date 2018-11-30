/*var express = require('express');
var path = require('path');
var bodyParser = require('body-parser');

var Pusher = require('pusher');

var pusher = new Pusher({
  appId: '<your-app-id>',
  key: '<your-app-key>',
  secret: '<your-app-secret>',
  cluster: '<your-app-cluster>',
  encrypted: true
});

var app = express();

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false }));
app.use(express.static(path.join(__dirname, 'public')));

// Error Handler for 404 Pages
app.use(function(req, res, next) {
    var error404 = new Error('Route Not Found');
    error404.status = 404;
    next(error404);
});

module.exports = app;

app.listen(9000, function(){
  console.log('Example app listening on port 9000!')
});
var londonTempData = {
  city: 'London',
  unit: 'celsius',
  dataPoints: [
    {
      time: 1130,
      temperature: 12 
    },
    {
      time: 1200,
      temperature: 13 
    },
    {
      time: 1230,
      temperature: 15 
    },
    {
      time: 1300,
      temperature: 14 
    },
    {
      time: 1330,
      temperature: 15 
    },
    {
      time: 1406,
      temperature: 12 
    },
  ]
}

app.get('/getTemperature', function(req,res){
res.send(londonTempData);
});

app.get('/addTemperature', function(req,res){
  var temp = parseInt(req.query.temperature);
  var time = parseInt(req.query.time);
  if(temp && time && !isNaN(temp) && !isNaN(time)){
    var newDataPoint = {
      temperature: temp,
      time: time
    };
    londonTempData.dataPoints.push(newDataPoint);
    pusher.trigger('london-temp-chart', 'new-temperature', {
      dataPoint: newDataPoint
    });
    res.send({success:true});
  }else{
    res.send({success:false, errorMessage: 'Invalid Query Paramaters, required - temperature & time.'});
  }
});*/
var express = require('express');
var app = express;

app.get('/', function (req, res) {
   
    var sql = require("mssql");

    // config for your database
    var config = {
        user: 'sa',
        password: 'tpn2018',
        server: 'localhost', 
        database: 'TESTE' 
    };

    // connect to your database
    sql.connect(config, function (err) {
    
        if (err) console.log(err);

        // create Request object
        var request = new sql.Request();
           
        // query to the database and get the records
        request.query('select * from PESSOA', function (err, recordset) {
            
            if (err) console.log(err)

            // send records as a response
            res.send(recordset);
            
        });
    });
});

var server = app.listen(5000, function () {
    console.log('Server is running..');
});