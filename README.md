# Boersenspiel
Webprojekt 3. Semester Boersenspiel


![alt tag](http://www.unifiliale.de/wp-content/uploads/2013/09/2013_09_10_B%C3%B6rsenspiel1.png)

<!-- Inhaltsverzeichnis -->
<h2>How To</h2>
<h3><a href="#globalmethods">Globale Methoden und Variablen</a></h3>
<h5><a href="#paths">- paths</a></h5>
<h5><a href="#redirectTo">- redirectTo($path, $flashMessage)</a></h5>
<h5><a href="#setCurrentUser">- setCurrentUser($user)</a></h5>
<h5><a href="#getCurrentUser">- getCurrentUser()</a></h5>
<h3><a href="#controllermethods">Methoden im Controller</a></h3>
<h3><a href="#modelmethods">Methoden im Modell</a></h3>
<h3><a href="#viewmethods">Methoden in der View</a></h3>








<a name="globalmethods">
</a>
<h2>Globale Methoden und Variable</h2>



<a name="paths">
</a>
<h4>paths</h4>

<p>Alle Pfade mit denen alle möglichen Controller mit ihren Methoden aufgerufen werden können<br>
müssen in der Klasse "application" als Variable hinterlegt werden. Bsp: </p>

```php
class application
{

...

    //home Controller, beinhaltet alle Starseite bezogenen Seiten
    public static $home_index_path = 'http://localhost/home/index'; //Startseite

    //user Controller, beinhaltet alle User bezogenen Seiten
    public static $user_index_path = 'http://localhost/user/index'; //User Startseite
    public static $user_login_path = 'http://localhost/user/login'; //Login Seite
    public static $user_register_path = 'http://localhost/user/register'; //Registrierungs Seite
...
}
```

<p>Dabei muss beachtet werden, dass zur einfachen Wiedererkennug der Variablennamen folgendermaßen<br>
definiert wird: </p>

```php
    public static $controllername_methodennamen_path = ...;
```
<p>Auf diese Variable kann nun folgendermasen zugegriffen werden:</p>

```php
    parrent:$home_index_path;
```


<p>Diese Variable wird im Controller benötigt um einene User auf eine andere Seite weiterzuleiten:</p>

```php
class user extends mainController
{
...

    public redirect login($id = null) {
        parrent::redirectTo(parrent:$home_index_path);
    }
...
}
```


<p>Oder in eine der Views um eine entweder die Daten einer Form an den richtigen Controller und dessen Methode zu übergeben:</p>

```html
<form action="<?php echo parent::$user_create_path;?>" method="post">
    Name:<br>
    <input type="text" name="name"><br>
    Passwort:<br>
    <input type="text" name="pw">
    <input type="submit" value="Submit">
</form>
```

<p>Oder um bei einem Link die richtige Adresse anzugeben:</p>

```html
<a href="<?php echo parent::$user_register_path;?>">Registrieren</a>
```

<p>Einen Link zu einem Controller und einer Methode sollte nie von Hand geschreiben werden, sondern <br>
es sollte immer auf die path Variablen zurückgegriffen werden um bei Änderungen nur die pfad Variable <br>
in der applikation Klasse anpassen zu müssen</p>

<a name="paths">
</a>
<h4>redirectTo($path, $flashMessage)</h4>