

# Boersenspiel
Webprojekt 3. Semester Boersenspiel


![alt tag](http://www.unifiliale.de/wp-content/uploads/2013/09/2013_09_10_B%C3%B6rsenspiel1.png)

<!-- Inhaltsverzeichnis -->
<h2>How To</h2>
<h3><a href="#globalmethods">Globale Methoden und Variablen</a></h3>
<h5><a href="#paths">- paths</a></h5>
<h5><a href="#setCurrentUser">- setCurrentUser($user)</a></h5>
<h5><a href="#getCurrentUser">- getCurrentUser()</a></h5>
<h3><a href="#controller">Controller</a></h3>
<h4><a href="#howtocontroller">Einen Controller anlegen</a></h4>
<h4><a href="#controllermethods">Methoden</a></h4>
<h5><a href="#redirectTo">- redirectTo($path, $flashMessage)</a></h5>
<h3><a href="#model">Modell</a></h3>
<h4><a href="#howtomodel">Ein Model anlegen</a></h4>
<h4><a href="#modelmethods">Methoden</a></h4>
<h3><a href="#view">View</a></h3>








<a name="globalmethods">
</a>
<h2>Globale Methoden und Variable</h2>

<p>Alle folgenden Methoden und Variablen wurden im der Klasse applikation deklariert,<br>
da alle Controller, Views und Models von dieser Klasse erben lassen sich somit überall in der <br>
Anwendung auf diese Methoden und Variablen zgreifen<p>



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

<a name="controller">
</a>
<h2>Controller</h2>

<a name="howtocontroller">
</a>
<h4>Einen Controller anlegen</h4>

<p>Der Controller ist die Leitzentrale und bildet die Logik ab. <br>
<br>
Vor dem anlegen eines Controllers sollte folgendes beachtet werden:<br>
Der Controller wird später über die URL aufgerufen, daher sollte ein sinnvoller Name gewählt werden <br>
um später leicht lesbare URL zu erhalten<br>


<a name="controllermethods">
</a>
<h4>Methoden</h4>

<a name="redirectTo">
</a>
<h5>redirectTo($path, $flashMessage)</h5>

<p>Durch den Aufruf der Methode redirectTo($pfad, $flashMessage = false) wird der User auf die durch den <br>
Parameter $pfad übergebene Seite geleitet. <br>
Um sicher zu stellen, dass bei Änderung eines Pfades dennoch die richtige Seite aufgerufen wird<br>
sollte daher nur die gobablen Pfade übergeben werden.<br>
<br>
Da sich diese Methode im mainController, von dem alle Controller erben, befindet, kann diese Methode nur in Controllern <br>
verwendet werden. Diese Methode eignet sich bei Methoden die keine View laden, sondern auf eine schon vorhandenen Controller <br>
und methode zurückgreifen. Bsp: </p>

```php
class user extends mainController
{
...

    public redirect checkPW($id = null) {
        //Falls Passwort richtig eingegeben wurde, leite den User auf die Startseite 
        parrent::redirectTo(parrent:$home_index_path);
        //Falls Passwort falsch eingegeben wurde, leite den User auf die LogIn Seite
        parrent::redirectTo(parrent:$user_login_path);
    }
...
}
```

<p> Weiterhin kann optional eine Flash Message übergeben werden, die auf der Seite, auf welche der User weitergeleitet <br>
wird, angezeigt wird. <br>
Jede Flash Message besitzt einen Typ welcher entscheidet in welcher Farbe die Flash Message hinterlegt wird. <br>
Folgende Typen sind vorhanden:<br>
succes->Grüner Hintergrund<br>
warning->Oranger Hintergrund<br>
danger->Roter Hintergrund<br>
info->Blauer Hintergrund<br>
<br>
Eine Flash Message mit ihrem zugeörigem Typ muss folgendermaßen übergeben werden:<br>
"typ:message"<br>
<br>
Bsp: </p>

```php
class user extends mainController
{
...

    public redirect checkPW($id = null) {
        //Falls Passwort richtig eingegeben wurde, leite den User auf die Startseite und gib eine Erfolgmeldung aus
        parrent::redirectTo(parrent:$home_index_path, "success:Sie wurden erfolgreich eingelogt");
        //Falls Passwort falsch eingegeben wurde, leite den User auf die LogIn Seite und gib eine Fehlermeldung aus
        parrent::redirectTo(parrent:$user_login_path, "warning:ID oder Passwort falsch");
    }
...
}
```

