<!DOCTYPE html>

<?php
session_start();

if(@$_SESSION['id'] == NULL)
    $_SESSION['id'] = 0;

?>

<html>
    <head>
        <meta charset="UTF-8" />
        <title> Dodawanie ogłoszeń <?php echo $_SESSION['id']; ?> </title>
        <link rel="stylesheet" type="text/css" href="przeglad_ogloszen.css">
    </head>
    <body>
        <div id="naglowek">
            <div class="kontent">
                <div id="logo">
                    <a href="przeglad_ogloszen.php">
                        <img src="xlo.PNG" id="logo2" />
                    </a>
                </div>
                <div id="logowanie2">
                    <button id="zaloguj" onclick="location.href='mojxlo.php';"> 
                    <?php
                    if($_SESSION['id'] == 0)
                        echo "Mój xlo";
                     else
                         echo $_SESSION['imie']." ".$_SESSION['nazwisko'];    
                    ?>
                    </button>
                </div>
            </div>
            <hr>
        </div>
        <div class="potwierdzenie">
            <h1 id="h1potwierdznie"> Twoje ogłoszenie zostało poprawnie dodane. </h1>
            
            <div class="guziczki">
                <button class="guzik" onclick="location.href='przeglad_ogloszen.php';"> Wróć na stronę główną </button>
                <button class="guzik" onclick="location.href='dodawanieogloszen.php';"> Dodaj kolejne ogłoszenie </button>
            </div>
        </div>
    </body>
</html>