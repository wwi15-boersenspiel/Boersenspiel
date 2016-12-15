<?php
require_once('app/view/renderEngine.php');
require_once('app/model/userModel.php');
require_once('application.php');
require_once('app/controller/mainController.php');

/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 07.12.2016
 * Time: 14:59
 */
class user extends mainController
{

    private $request = null;


    public function __construct($request)
    {
        $this->request = $request;
    }

    public function index($id = null){
        
    }
    
    public function login($id = null)
    {

    }

    public function register($id = null)
    {

    }

    public function pwaendern($id = null)
    {

    }

    public function create($id = null)
    {
        $username = $this->request["name"];
        $password = password_hash($this->request["pw"], PASSWORD_DEFAULT);
        $email = $this->request["email"];
        $question = $this->request["question"];
        $answer = $this->request["answer"];
        $user = new userModel($username, $password, $email, $question, $answer);
        if ($user->saveUserToDB()) {
            $this->redirectTo($this->getPath("home"), "success: Account erfolgreich angelegt");
        } else {
            $this->redirectTo($this->getPath("user", "register"), "danger: Es ist ein technischer Fehler aufgetreten");
        }

    }

    public function control($id = null)
    {
        $user = userModel::getByName($this->request["name"]);
        if (!is_null($user)) {
            if (password_verify($this->request["pw"], $user->getPassword())) {
                $this->setCurrentUser($user->getUsername());
                $this->redirectTo($this->getPath("home"), "success: Sie wurden erfolgreich engeloggt");
            } else {
                $this->redirectTo($this->getPath("user", "login"), "warning: PW Falsch");
            }
        } else {
            $this->redirectTo($this->getPath("user", "login"), "warning: Account nicht vorhanden");
        }
    }


    public function logout($id = null)
    {
        $this->setCurrentUser(null);
        $this->redirectTo($this->getPath("home"), "success: Sie wurden ausgeloggt");

    }
}