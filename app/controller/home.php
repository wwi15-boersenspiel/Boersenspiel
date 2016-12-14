<?php
require_once ('app/view/renderEngine.php');
require_once ('app/model/userModel.php');
require_once ('app/controller/mainController.php');
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 07.12.2016
 * Time: 14:02
 */
class home extends mainController
{

    public $request = null;

    public function __construct($request)
    {
        $this->request = $request;
    }


    public function index($id) {

        $userModel = new userModel('diesiszuzukurz', 'chef', 'gehtdichnixan@web.de', 'abc', 'abcd');
		$userModel->saveToDB($userModel);


    }
}