<?php
session_start();

define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'admin');
    define('DB_DATABASE', 'chatroom');
    $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
    if ($db->connect_error) {
        die('Connect Error (' . $db->connect_errno . ') '
                . $db->connect_error);
    }

$tbl_name="chatlog"; // Table name

$sql="SELECT chatlog.messagtxt, users.displayname FROM chatlog inner join users on users.userID = chatlog.userID order by chatlog.idchatlog desc;";
$result=mysqli_query($db,$sql);

?>

<!DOCTYPE html>
<html>
    <head>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" 
     		src="http://localhost:8000/faye/client.js">
        	</script>
  
        <link rel="stylesheet" href="styles.css" />
		

    </head>
    <body>
		<a href="logout.php">Log out </a>
        <div id="prechat">TO DO write content<br /></div>
        <input type="text" id="userinput">
        <button id="send">Click me</button>
	   <button id="second">Click here</button>
           
  <div id="chat">
    <script id="chatline" type="text/html">
      <div class='line'><div class='user'>{{ user }}</div>{{ text }}</div>
    </script>
  </div>
        
	
        <div id="output">Old chat</div>
		<?php
		
		while($row = mysqli_fetch_assoc($result)) { ?>
		<?php echo $row["displayname"]; ?>: <?php echo $row["messagtxt"]; ?> <br>
		<?php } ?>
		
        
        <script>
		
	$(function() {
        
		var userName = "<?php echo $_SESSION['displayname'] ?>";
		var userId = "<?php echo $_SESSION['userID']?>";
                    
        var client = new Faye.Client('http://localhost:8000/faye');
            
        $('#userinput').keyup(function(e) {
			if (e.keyCode == 13) {
				client.publish('/messages', {text: $('#userinput').val(), userN: userName, userI: userId})
				$('#userinput').val('');
            }
        });

		 $('#second').click(function(e) {
            client.publish('/messages', { text: 'goodbye from browser'})
        });
		
		client.subscribe('/messages', function(message) {
		 $('#output').prepend(message.userN + ': ' + message.text + '<br />')
                 //$('#prechat').append(message.text + '<br />')
		});
		
        });
        </script>
    </body>
</html>
