<?php
/* 
     * performs functions needed on all views
     */
    session_start();
    $externalPages = array(
        'main_login.php',
        'logout.php');
     
    $internalPages = array(
        'login_success.php',
        'chatroom.php');

    //check what pages is active
    $serverStr = explode('/', $_SERVER['REQUEST_URI']);
    if(in_array('views', $serverStr)){
        include_once '../controllers/renderEngine.php';
    }else{
        include_once 'controllers/renderEngine.php';
    }
    
    $page = end($serverStr);
    //on external page, but logged in
    if(in_array($page, $externalPages)
        && $_SESSION['userID'] != null)
    {
        renderEngine::renderView('chatroom');
    }elseif(in_array($page, $internalPages)
        && $_SESSION['userID'] == null)
    {
        renderEngine::renderView('main_login');
    }
?>