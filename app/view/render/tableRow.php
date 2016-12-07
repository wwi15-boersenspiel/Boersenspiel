<?php
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 06.12.2016
 * Time: 19:44
 */
?>

<tr>
    <?php
    foreach ($this->parameter["row"] as $cell) {
        echo '<td>' . $cell  . '</td>';
    }
    echo '<td><a href="' . parent::$user_show_path . '/' . $this->parameter["row"]["name"] . ' ">Link to: ' . $this->parameter["row"]["name"] . ' </a></td>';
    echo '<td><a href="' . parent::$user_delete_path . '/' . $this->parameter["row"]["name"] . ' ">Delete: ' . $this->parameter["row"]["name"] . ' </a></td>';
    ?>
</tr>
