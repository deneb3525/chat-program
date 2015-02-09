/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var faye = require('faye');

var client = new faye.Client('http://localhost:8000/faye');

client.subscribe('/messages', function(message) {
    console.log('Got: ' + message.text);
    
});
