/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var http = require('http');
var faye = require('faye');

var server = http.createServer();
var bayeux = new faye.NodeAdapter({mount: '/faye', timeout:45});

bayeux.attach(server);

server.listen(8000);
