<?php
require_once ('app/controller/mainController.php'); //wird benötigt
require_once ('app/view/view.php'); //wird benötigt falls Views verwendet werden
require_once ('app/model/modelname.php'); //name muss angepasst werden, wird benötigt falls Models verwendet wird
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 07.12.2016
 * Time: 20:27
 */

//Folgender Controller soll jeglich als bauplan verwendet werden
class controllername extends mainController //name des Controller der später durch die URL aufgerufen werden soll, muss von mainController erben
{

    //$request beinhaltet die per POST oder GET an den Controller üergebenen Paramter Bsp:
    //<form method="post">
    //First name:<br>
    //<input type="text" name="name"><br>
    //Last name:<br>
    //<input type="text" name="pw">
    //</form>
    //auf diese Daten kann dann in der Methode per $this->request["name"] oder $this->request["pw"] zugegriffen werden
    public $request = null;

    public function __construct($request)
    {
        $this->request = $request;
    }

    //Jeder Controller muss die Index Methode besitzen, da dies die Dafault Methode ist, welche aufgerufen wird falls keine Methode in der URL angegeben wurde
    public function index($id = null) {
        //Folgende Schritte werden in der Regel durchlaufen:
        //1. Model instanzieren, falls Daten aus der DB abgerufen werden oder gespeichert werden sollen Bsp: $userModel = new userModel();
        //2. Falls bei dem Controller Aufruf Daten per POST oder GET übertragen wurden können diese mit $this->request[key] zugegriffen werden (siehe oben)
        //3. Logik abbilden Bsp: Passwärter vergleichen bei einem LogIn
        //4. Falls eine Seite ausgegeben werden soll, muss eine View instanziert werden Bsp: $userView = new view();
        //5. Muss in der View auf Daten zurückgegriffen werden, müssen diese an die View folgendermaßen übergeben werden: $userView->addParameter(key, value)
        //6. Danach muss die View geladen werden dazu muss folgende Funktion mit der zu ladenden Seite aufgerufen werden: $userView->loadView(filename)
        //7. Falls eine Seite angezeigt werden soll, welche schon durch einen anderen Controller und Methode definiert wurde muss dieser durch folgenden Funktionsaufruf
        //   dahin geleitet werden: parent::redirectTo(parent::$controllername_methodname_path, Flashmessage);
    }

}