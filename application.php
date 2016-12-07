<?php
require_once('app/controller/home.php');
require_once('app/controller/user.php');
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 07.12.2016
 * Time: 13:51
 */
class application
{

    //Alle mögliche Pfade:
    public static $home_index_path = 'http://193.196.168.133/home/index';


    public static $user_index_path = 'http://193.196.168.133/user/index';
    public static $user_login_path = 'http://193.196.168.133/user/login';
    public static $user_register_path = 'http://193.196.168.133/user/register';
    public static $user_logout_path = 'http://193.196.168.133/user/logout';
    public static $user_create_path = 'http://193.196.168.133/user/create';
    public static $user_control_path = 'http://193.196.168.133/user/control';

    public function findController($url) {

        if (!isset($_SESSION)) session_start();
        error_reporting(E_ALL ^ E_NOTICE);

        $request = array_merge($_GET, $_POST);
// Zuerst entfernen wir führende und abschließende Slashes.
        $url = trim(strtolower($url), '/');
// Wir nehmen uns die ersten drei Ebenen der URL und bauen uns somit eine kleine Struktur auf
        list($controller, $action, $id) = explode('/', $url);
//echo $action = substr($action,0,strpos($action,"?"));
        $controller = (strpos($controller, "?") != false) ? substr($controller, 0, strpos($controller, "?")) : $controller;
        $action = (strpos($action, "?") != false) ? substr($action, 0, strpos($action, "?")) : $action;
        $id = (strpos($id, "?") != false) ? substr($id, 0, strpos($id, "?")) : $id;

        // Wir definieren einen standard Controller, falls unsere URL leer ist.
        if (empty($controller)) {
            $controller = 'home';
        }

// Wir definieren eine standard Action, falls unsere URL keine beinhaltet.
        if (empty($action)) {
            $action = 'index';
        }

        if (class_exists($controller)) {
            $controller = new $controller($request);

            if (method_exists($controller, $action)) {
                $controller->$action($id);

            } else {
                $this->trigger_404('Die angeforderte Funktion ist nicht vorhanden');
            }
        } else {
            $this->trigger_404('Der angeforderte Controller ist nicht vorhanden');
        }


    }

    function trigger_404($msg = '')
    {
        header("HTTP/1.0 404 Not Found");
        header("Status: 404 Not Found");
        echo $msg;
    }

    public function redirectTo($path, $flashMessage = null)
    {
        $this->setFlashMessage($flashMessage);
        header("Location: " . $path);
    }

    public function getFlashMessage()
    {
        // If there are any messages in the queue
        if (isset($_SESSION['flash'])) {
            // Fetch the message queue
            $messages = $_SESSION['flash'];

            // Empty out the message queue
            unset($_SESSION['flash']);

            return $messages;
        } else {
            return null;
        }
    }

    public function setFlashMessage($flashMessage)
    {
        list($type, $message) = explode(':', $flashMessage);
        $_SESSION['flash'] = array(type => $type, message => $message);
    }

    public function getCurrentUser() {
        if (isset($_SESSION["userName"])) {
            return $_SESSION["userName"];
        } else {
            return null;
        }
    }

    public function setCurrentUser($userName) {
        if (is_null($userName)) {
            unset($_SESSION["userName"]);
        } else {
            $_SESSION["userName"] = $userName;
        }
    }

}