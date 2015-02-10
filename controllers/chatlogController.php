<?php

require_once 'baseController.php';

class chatlogController extends baseController{
    
    public function initializeChat()
    {
        $db = $this->DBconnect();

        $sql="SELECT chatlog.messagtxt, users.displayname FROM chatlog inner join users on users.userID = chatlog.userID order by chatlog.idchatlog asc;";
        $result=mysqli_query($db,$sql);
    }
}