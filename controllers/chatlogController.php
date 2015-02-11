<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/baseController.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/models/chatlogModel.php';

class chatlogController extends baseController{
    
    public function initializeChat()
    {
        $db = $this->DBconnect();

        $sql="SELECT chatlog.messagetxt, users.displayname FROM chatlog inner join users on users.userID = chatlog.userID order by chatlog.idchatlog asc;";
        $result = $db->query($sql, array());
        
        $chatlogModel = new chatlogModel();
        return $chatlogModel->initialize($result);
    }
}