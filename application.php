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

    //Alle möglichen Pfade, zu denen ein Controller und eine Methode existiert
    //Alle aufrufbaren Pfade müssen hier hinterlegt werden
    //Jeder neuer Pfad wird folgendermaßen angegenben $controllername_methode_path
    //Müssen auf dem lokalen PC angepasst werden z.B.: aus http://193.196.168.133/... muss http://localhost/.. gemacht werden

    //home Controller, beinhaltet alle Starseite bezogenen Seiten
    public static $home_index_path = 'http://localhost/home/index'; //Startseite

    //user Controller, beinhaltet alle User bezogenen Seiten
    public static $user_index_path = 'http://localhost/user/index'; //User Startseite
    public static $user_login_path = 'http://localhost/user/login'; //Login Seite
    public static $user_register_path = 'http://localhost/user/register'; //Registrierungs Seite
    public static $user_logout_path = 'http://localhost/user/logout'; //Wird beim LogOut aufgerufen, rendert keine View sonderte leitet auf die index Seite weiter
    public static $user_create_path = 'http://localhost/user/create'; //Wird bei der Registrations aufgerufen, rendert keine View sonderte leitet auf die index Seite weiter
    public static $user_control_path = 'http://localhost/user/control'; //Wird beim der LogIn aufgerufen, rendert keine View sonderte leitet auf die index bzw. LogIn Seite weiter

    //Methode die anhand der URL den richtigen Controller und die richtige Methode findet
    //Wird bei jedem Seitenaufruf aufgerufen

    public $defaultRespondAction = true;


    public function findController($url) {

        //Startet Sessions, falls diese noch nicht gestartet wurden
        if (!isset($_SESSION)) session_start();

        //Unterdrückt Fehler, da list() Funktion Fehler wirf falls nur Controller und keine Methode inder URL angegeben wurde
        error_reporting(E_ALL ^ E_NOTICE);


        //fügt zur leichteren Weiterarbeit die $_GET und $_POST Parameter in einem Array zusammen
        $request = array_merge($_GET, $_POST);
        // führende und abschlißende Slashes werden aus der URL entfernt und alles wird kleingeschrieben
        $url = trim(strtolower($url), '/');
        // Bei jedem Slash wird die URL auseinandergeschnitten und entweder der Variable $controller, $method oder $id zugeordnet
        list($controller, $method, $id) = explode('/', $url);
        //unnötige Zeichensätze die bei einem GET aufruf an die URL angehängt werden, werden entfernt
        $controller = (strpos($controller, "?") != false) ? substr($controller, 0, strpos($controller, "?")) : $controller;
        $method = (strpos($method, "?") != false) ? substr($method, 0, strpos($method, "?")) : $method;
        $id = (strpos($id, "?") != false) ? substr($id, 0, strpos($id, "?")) : $id;


        //Falls kein Controller in der URL angegeben wurde, wird home als Standartcontroller definiert
        if (empty($controller)) {
            $controller = 'home';
        }

        //Falls keine Methode in der URL angegeben wurde, wird index als Standartmethode definiert
        if (empty($method)) {
            $method = 'index';
        }

        //Es wird überprüft ob der in der URL angegebene Controller überhaupt existiert
        if (class_exists($controller)) {
            //Falls ja wird ein neues Objekt davon angelegt
            $controller = new $controller($request);
            //Es wird überprüft ob die in der URL angegebene Methode überhaupt existiert
            if (method_exists($controller, $method)) {
                //Falls ja wird Methode ausgeführt
                $controller->$method($id);
                $view = new renderEngine();
                $view->setVariable(get_object_vars($controller));
                if ($this->defaultRespondAction) {
                    $view->loadView($method);
                }

            } else {
                //Ansonsten wird Fehlermeldung ausgegeben
                application::trigger_404('Die angeforderte Funktion ist nicht vorhanden');
            }
        } else {
            //Ansonsten wird Fehlermeldung ausgegeben
            application::trigger_404('Der angeforderte Controller ist nicht vorhanden');
        }


    }

    //Function die Fehlermeldung ausgibt

    private static function trigger_404($msg = '')
    {
        header("HTTP/1.0 404 Not Found");
        header("Status: 404 Not Found");
        echo $msg;
    }


    //Flash Messages:
    //Flash Messages können im View ausgegeben werden, werden aber nach dem ausgeben wieder gelöscht
    //Flash Messages können in folgende Kategorien gegliedert werden:
    //success: werden im View grün hinterlegt
    //warning: werden im View orange hinterlegt
    //info: werden im View blau hinterlegt
    //danger: werden im View rot hinterlegt
    public function getFlashMessage()
    {
        if (isset($_SESSION['flash'])) {

            $messages = $_SESSION['flash'];


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

    //Liefert Username zurück falls User eingeloggt ist, sonst wird null zurückgegeben
    //Kann im View und im Controller verwendet werden

    public function getCurrentUser() {
        if (isset($_SESSION["userName"])) {
            return $_SESSION["userName"];
        } else {
            return null;
        }
    }

    //Loggt den übergegebenen User ein, falls null übergeben wird, wird aktueller User ausgeloggt
    //Kann im View und im Controller verwendet werden

    public function setCurrentUser($userName) {
        if (is_null($userName)) {
            unset($_SESSION["userName"]);
        } else {
            $_SESSION["userName"] = $userName;
        }
    }

}