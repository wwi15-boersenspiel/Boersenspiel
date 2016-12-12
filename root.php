<?php
require_once ("application.php");
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 07.12.2016
 * Time: 13:47
 */


//Dieses Skript wird bei jedem Seitenaufruf aufgerufen



//Ruft die Methode findController in der Klasse application auf und übergibt die eingegebene URL
$application = new application();
$application->findController($_SERVER['REQUEST_URI']);

?>