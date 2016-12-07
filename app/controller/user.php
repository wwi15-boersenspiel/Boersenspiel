<?php
require_once ('app/view/view.php');
require_once ('app/model/userModel.php');
require_once ('application.php');
require_once ('app/controller/mainController.php');
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 07.12.2016
 * Time: 14:59
 */
class user extends application
{

    public $request = null;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function index($id = null) {

    }

    public function login($id = null) {
        $userView = new view();
        $userView->loadView("login");


    }

    public function register($id = null) {
        $userView = new view();
        $userView->loadView("register");

    }

    public function create($id = null) {
        $userModel = new userModel();
        if ($userModel->createUser($this->request["name"], password_hash($this->request["pw"], PASSWORD_DEFAULT))) {
            parent::redirectTo(parent::$home_index_path, "success: Account erfolgreich angelegt");
        } else {
            parent::redirectTo(parent::$home_login_path, "warning: Account oder ID falsch");
        }

    }

    public function control($id = null) {
        $userModel = new userModel();
        if (password_verify($this->request["pw"], $userModel->getByName($this->request["name"])[0]["password"])) {
            $_SESSION["user"] = $userModel->getByName($this->request["name"])[0]["name"];
            parent::redirectTo(parent::$home_index_path, "success: Sie wurden erfolgreich engeloggt");
        }

    }


    public function logout($id = null) {
        parent::setCurentUser(null);
        parent::redirectTo(parent::$home_index_path, "success: Sie wurden ausgeloggt");

    }
}