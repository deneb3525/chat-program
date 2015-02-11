<?php

/* 
 * This should handle all user related logic
 * 
 */
require_once 'baseController.php';
require_once '../models/usersModel.php';

class usersController extends baseController{
    
    public function createUser($myusername, $mypassword,$mydisplayname)
    {
        $DBObj = $this->DBconnect();
        // username and password sent from form
        //TODO: put in Front end checks.  Rather than strip the data out, we should try to detect bad characters and throw an error.
        // To protect MySQL injection (more detail about MySQL injection)
        if(preg_match("/\W/", $myusername) == 1){
            throw new Exception("Invalid characters in username.");
        }
        $myusername = stripslashes($myusername);
        $mypassword = stripslashes($mypassword);
        //$myusername = mysql_real_escape_string($myusername);
        //$mypassword = mysql_real_escape_string($mypassword);

        $sql="SELECT * FROM users WHERE loginname='%s' and active='1'";
        $result = $DBObj->query($sql, array($myusername));

        // Mysql_num_row is counting table row
        $count = $result->num_rows;

        // There must be no matches

        if($count==0){
            // Add the username and password to the DB, then register the username and display name.
            // Register $myusername, $mypassword and redirect to file "login_success.php"

            $mypasswordhash = password_hash($mypassword, PASSWORD_DEFAULT);
            $sql="insert into chatroom.users (loginname, password, displayname, active) values ('%s', '%s', '%s', 1);";
            $DBObj->query($sql, array($myusername, $mypasswordhash, $mydisplayname));
            $this->loginUser($myusername, $mypassword);
            return true;
        }
        
        throw new Exception("Username already in use");
    }
    
    public function updateUser()
    {
        
    }
    
    private function validateUser($user)
    {
        
    }
	
	
    public function loginUser($username, $password)
    {
        if(preg_match("/\W/", $username) == 1){
            throw new Exception("Invalid characters in username.");
        }
        $this->authenticateUser($username, $password);
    }
    
    private function set_session($userID, $displayname)
    {
        session_start();
        $_SESSION['userID']=$userID;
        $_SESSION['displayname']=$displayname;
    }
	
    private function authenticateUser($username, $password)
    {   
        $DBObj = $this->DBconnect();
        $sql="SELECT * FROM users WHERE loginname='%s' and active='1'";
        $result = $DBObj->query($sql, array($username));
        
        if($result->num_rows != 1)
            throw new Exception ("Cannot find user.");

        $usersModel = new usersModel();
        $usersModel->create(mysqli_fetch_assoc($result));
        if($usersModel->comparePassword($password)){
            $this->set_session($usersModel->userID,$usersModel->displayname);
            return true;
        }
    }
}