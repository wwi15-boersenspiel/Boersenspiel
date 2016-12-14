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

    public $password = NULL;
    public $username = NULL;
    public $email = NULL;
    public $securityQuestion = NULL;
    public $securityAnswer = NULL;

    function __construct($password, $username, $email, $securityQuestion, $securityAnswer)
    {
        $this->password = $password;
        $this->username = $username;
        $this->email = $email;
        $this->securityQuestion = $securityQuestion;
        $this->securityAnswer = $securityAnswer;
    }

    public function getByName($name) {
        $sql = "SELECT * FROM `user2` WHERE `name` = '" . $name . "'";
        $result = $this->conn->query($sql);
        return parent::createArray($result);
    }

   public function saveUserToDB($saveMe){
   	$conn = $this->createConn();
   	$status = false;
    	$sql = "INSERT INTO user2 (username, password, email, securityQuestion, securityAnswer)
        VALUES ('" . $this->username . "', '" . $this->password . "', '" . $this->email . "', '" . $this->securityQuestion . "', '" . $this->securityAnswer . "')";
    	if ($this->conn->query($sql) === TRUE) {
    		$status = true;
    	} else {
    		$status = false;
    	}
        $this->closeConn($conn);

    	return $status;

    }



}