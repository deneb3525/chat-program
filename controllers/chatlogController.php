<?php

require_once 'baseController.php';
require_once 'models/chatlogModel.php';

class chatlogController extends baseController{
    
    public function initializeChat()
    {
        $db = $this->DBconnect();

        $sql="SELECT chatlog.messagetxt, users.displayname FROM chatlog inner join users on users.userID = chatlog.userID order by chatlog.idchatlog asc;";
        $result = mysqli_query($db,$sql);
        
        $chatlogModel = new chatlogModel();
        return $chatlogModel->initialize($result);
    }
}