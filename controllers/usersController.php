<?php

/* 
 * This should handle all user related logic
 * 
 * Current files that you have that should have their logic pulled into here are:
 * checkcreation.php
 * checklogin.php
 * 
 */
include 'baseController.php';

class usersController extends baseController{
    public function createUser($myusername, $mypassword,$mydisplayname)
    {
        $DBObj = $this->DBconnect();
        // username and password sent from form
        //TODO: put in Front end checks.  Rather than strip the data out, we should try to detect bad characters and throw an error.
        // To protect MySQL injection (more detail about MySQL injection)
        $myusername = stripslashes($myusername);
        $mypassword = stripslashes($mypassword);
        //$myusername = mysql_real_escape_string($myusername);
        //$mypassword = mysql_real_escape_string($mypassword);

        $sql="SELECT * FROM users WHERE loginname='$myusername' and active='1'";
        $result=mysqli_query($DBObj,$sql);

        // Mysql_num_row is counting table row
        $count = $result->num_rows;

        // There must be no matches

        if($count==0){
            // Add the username and password to the DB, then register the username and display name.
            // Register $myusername, $mypassword and redirect to file "login_success.php"
            $sql="insert into chatroom.users (loginname, password, displayname, active) values ('$myusername', '$mypassword', '$mydisplayname', 1);";
            echo $sql;
            return mysqli_query($DBObj, $sql);
        }
        
        //TODO: wrap things that call controllers in try/catch blocks
        throw Exception("Username already in use");
    }
    
    public function updateUser()
    {
        
    }
    
    private function validateUser($user)
    {
        
    }
    
    public function loginUser($username, $password)
    {
        $DBObj = $this->DBconnect();
        //TODO: put in Front end checks.  Rather than strip the data out, we should try to detect bad characters and throw an error.
        // To protect MySQL injection (more detail about MySQL injection)
        $username = stripslashes($username);
        $password = stripslashes($password);

        $sql="SELECT * FROM users WHERE loginname='".$username."' and password='".$password."' and active='1'";
        $result=mysqli_query($DBObj,$sql);
        
        if($result->num_rows != 1)
            throw new Exception ("Wrong Username or Password");

        return $result->fetch_row();
    }
}