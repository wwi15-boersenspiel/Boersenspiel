<?php
require_once ('app/view/renderEngine.php');
require_once ('app/model/userModel.php');
require_once ('application.php');
require_once ('app/controller/mainController.php');
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


    public function login($id = null) {

    }

    public function register($id = null) {

    }

    public function pwaendern($id = null) {
        $this->name = "lucas";

    }

    public function create($id = null) {
        $userModel = new userModel();
        if ($userModel->createUser($this->request["name"], password_hash($this->request["pw"], PASSWORD_DEFAULT))) {
            $this->redirectTo($this->getPath("home"), "success: Account erfolgreich angelegt");
        } else {
            $this->redirectTo($this->getPath("user", "register"), "danger: Es ist ein Fehler aufgetreten");
        }

    }

    public function control($id = null) {
        $userModel = new userModel();
        if (password_verify($this->request["pw"], $userModel->getByName($this->request["name"])[0]["password"])) {
            $this->setCurrentUser($userModel->getByName($this->request["name"])[0]["name"]);
            $this->redirectTo($this->getPath("home"), "success: Sie wurden erfolgreich engeloggt");
        } else {
            $this->redirectTo($this->getPath("user", "login"), "warning: Account oder ID falsch");
        }

    }


    public function logout($id = null) {
        $this->setCurrentUser(null);
        $this->redirectTo($this->getPath("home"), "success: Sie wurden ausgeloggt");

    }
}