<?php
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 07.12.2016
 * Time: 15:02
 */
?>

<form action="<?= $this->getPath("user", "create");?>" method="post">
    Name:<br>
    <input type="text" name="name"><br>
    Passwort:<br>
    <input type="password" name="pw">
    Email:<br>
    <input type="email" name="email"><br>
    Sicherheitsfrage:<br>
    <input type="text" name="question">
    Antwort:<br>
    <input type="text" name="answer">
    <input type="submit" value="Submit">
</form>
