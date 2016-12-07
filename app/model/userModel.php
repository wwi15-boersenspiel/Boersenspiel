<?php
require_once ('app/model/mainModel.php');

/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 07.12.2016
 * Time: 14:29
 */
class userModel extends mainModel
{
    public $conn = null;

    function __construct()
    {
        $this->conn = parent::createConn();
    }

    public function getByName($name) {

        $sql = "SELECT * FROM `user2` WHERE `name` = '" . $name . "'";
        $result = $this->conn->query($sql);
        return parent::createArray($result);

    }

    public function createUser($username, $pw)
    {
        $sql = "INSERT INTO user2 (name, password)
        VALUES ('" . $username . "', '" . $pw . "')";
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    function __destruct()
    {
        parent::closeConn($this->conn);
    }


}