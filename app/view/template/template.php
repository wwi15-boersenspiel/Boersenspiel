<?php
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 07.12.2016
 * Time: 14:17
 */
?>
<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Titel</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Compiled and minified Materialize CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">
    <link rel="stylesheet" href="app/asset/css/application.css">
    <?php $this->includeCSS($render); ?>
    <!-- Latest compiled and minified jQuery JavaScript -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
    <!-- Compiled and minified Materialize JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
    <script src="app/asset/javascript/application.js"></script>
    <?php $this->includeJS($render); ?>
</head>
<body>
<nav>
    <div class="nav-wrapper">
        <a href="#" class="brand-logo">Logo</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="sass.html">Sass</a></li>
            <li><a href="badges.html">Components</a></li>
            <li><a href="collapsible.html">JavaScript</a></li>
        </ul>
    </div>
</nav>
<?php

if ($showFleshMassages) {
    $flashMessage = parent::getFlashMessage();
    switch ($flashMessage[type]) {
        case success:
            echo '<div class="alert alert-success" role="alert">' . $flashMessage[message] . '</div>';
            break;
        case info:
            echo '<div class="alert alert-info" role="alert">' . $flashMessage[message] . '</div>' ;
            break;
        case warning:
            echo '<div class="alert alert-warning" role="alert">' . $flashMessage[message] . '</div>';
            break;
        case danger:
            echo '<div class="alert alert-warning" role="alert">' . $flashMessage[message] . '</div>';
            break;
    }
}


$this->loadRender($render);
?>
<h1>FOOTER</h1>
</body>
</html>
