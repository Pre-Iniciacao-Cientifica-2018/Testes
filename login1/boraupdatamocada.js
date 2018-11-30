var http = require("http"),
    util = require("util"),
    url = require("url"),
    qs = require("querystring");
    var ITEMS_BACKLOG = 20;

var urlMap = {
  '/real_time_feed' : function (req, res) {
    var since = parseInt(qs.parse(url.parse(req.url).query).since, 10);
    feed.query(since, function (data) {
      res.simpleJSON(200, data);
    });
  },
  '/send_feed_item' : function (req, res, json) {
    feed.appendMessage( json );
    res.simpleJSON(200, {});
  }
}

//# Send request to node.js on port 8001
//location ~* ^(/real_time_feed|/send_feed_item)$
//{
//  proxy_pass http://localhost:8001;
//}

http.createServer(function (req, res) {
    // Get the url and associate the function to the handler
    // or
    // Trigger the 404
    handler  = urlMap[url.parse(req.url).pathname] || notFound;
  
    var json = "";
  
    if(req.method === "POST"){
      // We need to process the post but we need to wait until the request's body is available to get the field/value pairs.
      req.body = '';
  
      req.addListener('data', function (chunk) {
        // Build the body from the chunks sent in the post.
          req.body = req.body + chunk;
        })
        .addListener('end', function () {
          json = JSON.stringify(qs.parse(req.body));
            handler(req, res, json);
        });
    }else{
      handler(req, res);
    }
  
    res.simpleJSON = function (code, obj) {
      var body = JSON.stringify(obj);
      res.writeHead(code, {
        "Content-Type": "text/json",
        "Content-Length": body.length
      });
      res.end(body);
    };
  
  }).listen(8001);

  // Handles the feed push and querying.
var feed = new function () {
    var real_time_items = [],
        callbacks = [];
  
    this.appendMessage = function (json) {
      // Append the new item.
      real_time_items.push( json );
  
      // Log it to the console
      sys.puts(new Date() + ": " + JSON.parse(json).type + " pushed");
  
      // As soon as something is pushed, call the query callback
      while (callbacks.length > 0)
        callbacks.shift().callback([JSON.parse(json)]);
  
      // Make sur we don't flood the server
      while (real_time_items.length > ITEMS_BACKLOG)
        real_time_items.shift();
    };
  
    this.query = function (since, callback) {
      var matching = [];
  
      for (var i = 0; i < real_time_items.length; i++) {
            var real_time_item = real_time_items[i];
            if (real_time_item.timestamp > since)
              matching.push(real_time_item)
      }
  
      if (matching.length != 0) {
        callback(matching);
      } else {
        callbacks.push({ timestamp: new Date(), callback: callback });
      }
    };
  };
  function longPoll_feed () {
    //make another request
    $.ajax({
      cache: false,
      dataType: 'json',
      type: "GET",
      url: "/real_time_feed",
      error: function () {
        //don't flood the servers on error, wait 10 seconds before retrying
        setTimeout(longPoll_feed, 10*1000);
      },
      success: function (json) {
        display_event(json);
  
        //if everything went well, begin another request immediately
        //the server will take a long time to respond
        //how long? well, it will wait until there is another message
        //and then it will return it to us and close the connection.
        //since the connection is closed when we get data, we longPoll again
        longPoll_feed();
      }
  });
  }