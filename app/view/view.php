<?php
require_once ('C:\xampp\htdocs\application.php');

/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 07.12.2016
 * Time: 14:11
 */
class view extends application
{
    private $defaultTemplate = 'app/view/template/template.php';
    private $parameter = array();

    public function addParameter($key, $value) {
        $this->parameter[$key] = $value;
    }

    public function loadView($render = null, $includeTemplate = true, $showFleshMassages = true) {
        //Fügt Navbar und Footer hinzu und ruft dann loadRender($render) auf
        //$render ist der im Controller->loadView() übergebene Paramneter
        //loadRender() ist dies in dieser Klasse definierte funktion, welche die im Ordner render hinterlegten Dateien einbindet
        if ($includeTemplate) include($this->defaultTemplate);
    }

    public function changeTemplate($template) {
        $this->defaultTemplate = 'app/view/template/' . $template . '.php';
    }

    private function loadRender($render) {
        if ($render != 'null') {
            if (is_array($render)) {
                foreach ($render as &$eachRender) {
                    include('app/view/render/' . $eachRender . '.php');
                }
            } else {
                include('app/view/render/' . $render . '.php');
            }
        }
    }

    private function includeCSS($render) {
        if ($render != 'null') {
            if (is_array($render)) {
                foreach (array_unique($render) as &$eachCSS) {
                    if (file_exists("app/asset/css/" . $eachCSS . ".css")) {
                        echo "<link rel='stylesheet' href='/app/asset/css/" . $eachCSS . ".css'>";
                    }
                }
            } else {
                if (file_exists("app/asset/css/" . $render . ".css")) {
                    echo "<link rel='stylesheet' href='/app/asset/css/" . $render . ".css'>";
                }
            }
        }
    }

    private function includeJS($render) {
        if ($render != 'null') {
            if (is_array($render)) {
                foreach (array_unique($render) as &$eachJS) {
                    if (file_exists("app/asset/javascript/" . $eachJS . ".js")) {
                        echo "<script src='/app/asset/javascript/" . $eachJS . ".js'></script>";
                    }
                }
            } else {
                if (file_exists("app/asset/javascript/" . $render . ".js")) {
                    echo "<script src='/app/asset/javascript/" . $render . ".js'></script>";
                }
            }
        }
    }
}