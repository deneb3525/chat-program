<?php

require_once 'baseModel.php';

class usersModel extends baseModel
{
    public $loginname;
    public $userID;
    public $displayname;
    private $password;
    public $active;
    
    /**
     * 
     * @param array $rows, generated from a sql query
     */
    public function create($rows)
    {
        foreach($rows as $k => $v)
        {
            $this->$k = $v;
        }
    }
}