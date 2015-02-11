<?php
    session_start();

    require_once 'controllers\controllerFactory.php';
	if($_SESSION['userID']==null){
		header("location:main_login.php");
	}

    $chatlogController = controllerFactory::getChatlogController();
    $lines = $chatlogController->initializeChat();
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
    foreach($lines as $v)
    {
        echo $v."\n";
    }
?>
--------------------
</textarea><br>
		
	
		
        <input type="text" id="userinput">
        <button id="send">Send</button>
        <br><a href="logout.php">Log out </a>   
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
        
		
		//set to config
        var client = new Faye.Client('http://localhost:8000/faye');
            
        $('#userinput').keyup(function(e) {
			if (e.keyCode == 13) {
				client.publish('/messages', {text: $('#userinput').val(), userN: userName, userI: userId})
				$('#userinput').val('');
            }
        });
		
		$('#send').click(function(e) {
			client.publish('/messages', {text: $('#userinput').val(), userN: userName, userI: userId})
			$('#userinput').val('');
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
