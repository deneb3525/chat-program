/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var Faye = require('faye');

var client = new Faye.Client('http://localhost:8000/faye');

var pub = client.publish('/messages', {
    text: 'how are you'
});

pub.callback(process.exit);
