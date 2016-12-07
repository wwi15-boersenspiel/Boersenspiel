<?php
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 07.12.2016
 * Time: 15:23
 */
?>

<form action="<?php echo parent::$user_control_path;?>" method="post">
    Name:<br>
    <input type="text" name="name"><br>
Passwort:<br>
    <input type="text" name="pw">
    <input type="submit" value="Submit">
</form>
