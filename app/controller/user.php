<?php
require_once('app/view/view.php');
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

    public $request = null;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function index($id = null)
    {
        echo "keine Indexseite definiert, siehe User Controller";
    }

    public function login($id = null)
    {
        $userView = new view();
        $userView->loadView("login");


    }

    public function register($id = null)
    {
        $userView = new view();
        $userView->loadView("register");

    }

    public function create($id = null)
    {
        $userModel = new userModel();
        if (is_null($userModel->getByName($this->request["name"]))) {
            if ($userModel->createUser($this->request["name"], password_hash($this->request["pw"], PASSWORD_DEFAULT))) {
                parent::redirectTo(parent::$home_index_path, "success: Account erfolgreich angelegt");
            } else {
                parent::redirectTo(parent::$user_login_path, "danger: Account konnte nicht erstellt werden");
            }
        } else {
            parent::redirectTo(parent::$user_login_path, "warning: Benutzername schon vergeben");
        }


    }

    public function control($id = null)
    {
        $userModel = new userModel();
        if (password_verify($this->request["pw"], $userModel->getByName($this->request["name"])[0]["password"])) {
            parent::setCurrentUser($userModel->getByName($this->request["name"])[0]["name"]);
            parent::redirectTo(parent::$home_index_path, "success: Sie wurden erfolgreich engeloggt");
        } else {
            parent::redirectTo(parent::$user_login_path, "warning: Account oder ID falsch");
        }

    }


    public function logout($id = null)
    {
        parent::setCurrentUser(null);
        parent::redirectTo(parent::$home_index_path, "success: Sie wurden ausgeloggt");

    }

    public function show($id = null)
    {
        $userModel = new userModel();
        $userView = new View();
        if (is_null($id)) {
            $userView->addParameter("user", $userModel->getAll());
            $userView->loadView("show");
        } else {
            $userView->addParameter("user", $userModel->getByName($id));
            $userView->loadView("showID");
        }
    }

    public function search($id = null)
    {

        if (!is_null(parent::getCurrentUser())) {
            $userView = new view();
            $userView->loadView("search");
        } else {
            parent::redirectTo(parent::$home_index_path, "warning: Sie müssen angemeldet Sein um nach Usern suchen zu können");
        }

    }

    public function ajaxShow($id = null)
    {
        $userModel = new userModel();
        $userView = new View();
        $userView->addParameter("user", $userModel->getByFirstChars($id));
        $userView->loadView("show", false);

    }

    public function delete($id = null)
    {
        $userModel = new userModel();
        if ($userModel->deleteUser($id)) {
            parent::redirectTo(parent::$user_show_path, "success: " . $id . " wurde gelöscht");
        } else {
            parent::redirectTo(parent::$user_show_path, "danger: " . $id . " konnte nicht gelöscht werden!");
        }
    }
}