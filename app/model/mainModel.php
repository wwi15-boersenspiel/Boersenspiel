<?php

/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 07.12.2016
 * Time: 14:28
 */
class mainModel extends application
{

    public static function createConn() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "dhbw";

        try {
            return $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        } catch (PDOException $e) {
            return null;
        }


    }


    public static function closeConn($conn) {
        $conn = null;
    }


}