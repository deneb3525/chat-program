<?php

/* 
 * Only really used for initialization right now
 */
require_once 'baseModel.php';

class chatlogModel extends baseModel
{
    public $lines = array();
    public function initialize($result)
    {
        while($row = mysqli_fetch_assoc($result)) { 
            $this->lines[] = $row["displayname"].": ".$row["messagetxt"];
        }
        
        return $this->lines;
    }
    
}