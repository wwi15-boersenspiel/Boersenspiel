<?php
require_once('app/model/mainModel.php');

/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 07.12.2016
 * Time: 14:29
 */
class userModel extends mainModel
{

    public $username = NULL;
    public $password = NULL;
    public $email = NULL;
    public $securityQuestion = NULL;
    public $securityAnswer = NULL;

    function __construct($username, $password, $email, $securityQuestion, $securityAnswer)
    {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->securityQuestion = $securityQuestion;
        $this->securityAnswer = $securityAnswer;
    }


    public function getUsername()
    {
        return $this->username;
    }


    public function setUsername($username)
    {
        $this->username = $username;
    }


    public function getPassword()
    {
        return $this->password;
    }


    public function setPassword($password)
    {
        $this->password = $password;
    }


    public function getEmail()
    {
        return $this->email;
    }


    public function setEmail($email)
    {
        $this->email = $email;
    }


    public function getSecurityQuestion()
    {
        return $this->securityQuestion;
    }


    public function setSecurityQuestion($securityQuestion)
    {
        $this->securityQuestion = $securityQuestion;
    }


    public function getSecurityAnswer()
    {
        return $this->securityAnswer;
    }


    public function setSecurityAnswer($securityAnswer)
    {
        $this->securityAnswer = $securityAnswer;
    }


    public static function getByName($name)
    {

        if (!is_null($conn = parent::createConn())) {
            $stmt = $conn->prepare("SELECT * FROM user2 WHERE username = ?");
            $stmt->execute(array($name));
            echo $stmt->rowCount();
            if ($stmt->rowCount() == 1) {
                $row = $stmt->fetch();
                $user = new userModel($row["username"], $row["password"], $row["email"], $row["securityQuestion"], $row["securityAnswer"]);
                $returnValue = $user;
            } elseif ($stmt->num_rows > 1) {
                while ($row = $stmt->fetch()) {
                    $returnValue = array_push($users, new userModel($row["username"], $row["password"], $row["email"], $row["securityQuestion"], $row["securityAnswer"]));
                }
            }

            parent::closeConn($conn);
        }
        return isset($returnValue) ? $returnValue : null;
    }

    public function saveUserToDB()
    {

        if (!is_null($conn = parent::createConn())) {
            $stmt = $conn->prepare("INSERT INTO user2 (username, password, email, securityQuestion, securityAnswer)
                                  VALUES (:username, :password, :email, :securityQuestion, :securityQuestion)");
            $stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':password', $this->password);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':securityQuestion', $this->securityQuestion);
            $stmt->bindParam(':securityQuestion', $this->securityAnswer);


            if ($stmt->execute()) {
                $status = true;
            }

            parent::closeConn($conn);
        }

        return isset($status) ? $status : false;


    }


}