<?php
require_once ("application.php");
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 07.12.2016
 * Time: 13:47
 */

$application = new application();
$application->findController($_SERVER['REQUEST_URI']);

?>