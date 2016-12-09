<?php

/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 07.12.2016
 * Time: 16:07
 */

class mainController extends application
{
    //Funktion die bei Aufruf auf den übergebenen Pfad weiterleitet und dabei eine Flashmessage ausgibt
    //Sollte nur im Controller und View verwendet werden
    public function redirectTo($path, $flashMessage = null)
    {
        $this->setFlashMessage($flashMessage);
        header("Location: " . $path);
    }
}