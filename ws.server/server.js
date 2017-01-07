/*var app = require('http').createServer(handler)
var io = require('socket.io')(app);
var fs = require('fs');

app.listen(80);

function handler (req, res) {
  fs.readFile(__dirname + '/index.html',
  function (err, data) {
    if (err) {
      res.writeHead(500);
      return res.end('Error loading index.html');
    }

    res.writeHead(200);
    res.end(data);
  });
}

io.on('connection', function (socket) {
  socket.emit('news', { hello: 'world' });
  socket.on('my other event', function (data) {
    console.log(data);
  });
});*/

var io = require('socket.io')(6001);

io.on('connection', function(socket){
  console.log('New connection!', socket.id);

  //socket.send('Message from server');

  //socket.emit('server-info', {version: .1});

  socket.broadcast.send('New user');
});