<?php

/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 07.12.2016
 * Time: 14:28
 */
class mainModel extends application
{

    public function createConn() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "dhbw";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            return die("Connection failed: " . $conn->connect_error);
        } else {
            return $conn;
        }


    }

    public function createArray($result) {
        $returnResult = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $returnResult[] = $row;
            }
            return $returnResult;
        } else {
            return null;
        }
    }

    public function closeConn($conn) {
        $conn->close();
    }


}