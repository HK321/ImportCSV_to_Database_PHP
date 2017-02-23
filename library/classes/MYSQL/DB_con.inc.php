<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/20/17
 * Time: 10:24 PM
 */

namespace MYSQL;


class DB_con
{
    private $con;
    function connect()
    {

        $this->con=new \mysqli('localhost','root','','gitHub');
        return ($this->con);
    }
}