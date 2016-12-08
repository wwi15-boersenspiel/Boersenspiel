<?php
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 06.12.2016
 * Time: 19:32
 */



?>
<?php
if (isset($this->parameter["user"])) {
    ?>
    <table>
        <thead>
        <tr>
            <th data-field="id">ID</th>
            <th data-field="name">Name</th>
            <th data-field="password">Password</th>
            <th data-field="name">Link</th>
            <th data-field="name">Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($this->parameter["user"] as $this->parameter["row"]) {
            $this->loadRender("tableRow");
        }
        ?>
        </tbody>
    </table>
    <?php
} else {
    echo "Keine Nutzer gefunden";
}