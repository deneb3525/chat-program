<?php
    session_start();

    require_once 'BaseDAO.php';

    $goober = new BaseDAO();
    $db = $goober->connect();

    $tbl_name="chatlog"; // Table name

    $sql="SELECT chatlog.messagtxt, users.displayname FROM chatlog inner join users on users.userID = chatlog.userID order by chatlog.idchatlog asc;";
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
		
<textarea name="comments" cols="80" rows="10" id=output readonly>
<?php	
    while($row = mysqli_fetch_assoc($result)) { 
        echo $row["displayname"].": ".$row["messagtxt"];
    }
?>
--------------------
</textarea><br>
		
	
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
        
	
        
		
		
        
        <script>
		
	$(function() {
		
			var textarea = document.getElementById("output");
			if(textarea.selectionStart == textarea.selectionEnd) {
			textarea.scrollTop = textarea.scrollHeight;
			}

        
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
			$('#output').append(message.userN + ': ' + message.text + '\n')
			var textarea = document.getElementById("output");
			if(textarea.selectionStart == textarea.selectionEnd) {
			textarea.scrollTop = textarea.scrollHeight;
			}
		 //$('#output').preappend(message.userN + ': ' + message.text + '<br />' + '\n\n')
                 //$('#prechat').append(message.text + '<br />')
		});
		
        });
        </script>
    </body>
</html>
