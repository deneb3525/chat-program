// connect to the chat DB
var mysql = require('mysql');
var connection = mysql.createConnection({
	host : 'localhost',
	user : 'root',
	password : 'admin',
	database : 'chatroom'
})
connection.connect();

// connect to faye
var faye = require('faye');
var client = new faye.Client('http://localhost:8000/faye');



// listen for new messages from faye
client.subscribe('/messages', function(message) {
	
	// escape the recieved message, display it and add it to the chat database
	message.text = mysql_real_escape_string(message.text);
	var tempstring = 'INSERT INTO chatlog (userID, messagtxt) VALUES (\'' + message.userI + '\', \'' + message.text + '\');';
    console.log(tempstring);
	
	connection.query('INSERT INTO chatlog (userID, messagtxt) VALUES (\'' + message.userI + '\', \'' + message.text + '\');',
		function(err, rows, fields){
			if (err) throw err;
		}
	); 
    
});

//Escapes special characters
function mysql_real_escape_string (str) {
    return str.replace(/[\0\x08\x09\x1a\n\r"'\\\%]/g, function (char) {
        switch (char) {
            case "\0":
                return "\\0";
            case "\x08":
                return "\\b";
            case "\x09":
                return "\\t";
            case "\x1a":
                return "\\z";
            case "\n":
                return "\\n";
            case "\r":
                return "\\r";
            case "\"":
            case "'":
            case "\\":
            case "%":
                return "\\"+char; // prepends a backslash to backslash, percent,
                                  // and double/single quotes
        }
    });
}


