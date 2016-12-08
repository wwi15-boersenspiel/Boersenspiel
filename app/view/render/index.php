<?php
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 07.12.2016
 * Time: 14:09
 */
?>


<h1>Hallo <?php if(!is_null(parent::getCurrentUser())) {
        echo parent::getCurrentUser();
            } ?></h1>

<h2>
    Was möchten Sie tun?
</h2>

<a href="<?php echo parent::$user_login_path;?>">Einloggen</a>
<br>
<a href="<?php echo parent::$user_logout_path;?>/">Ausloggen</a>
<br>
<a href=<?php echo parent::$user_register_path;?>>Registrieren</a>
