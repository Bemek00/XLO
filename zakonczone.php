<!DOCTYPE html>

<?php
session_start();

if(@$_SESSION['id'] == NULL)
    $_SESSION['id'] = 0;

?>

<html>
    <head>
        <meta charset="UTF-8" />
        <title> Mój xlo <?php echo $_SESSION['id']; ?> </title>
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
                <div id="logowanie">
                    <form method="post">
                        <button id="wyloguj" name="wyl"> Wyloguj się </button>
                        <button id="dodaj" name="dod"> Dodaj ogłoszenie </button>
                    </form>
                    <?php
                    if(isset($_POST['wyl']))
                    {
                        $_SESSION['id'] = 0;
                        header('Location: przeglad_ogloszen.php');
                    }
                    
                    if(isset($_POST['dod']))
                        header('Location: dodawanieogloszen.php');
                    ?>
                </div>
            </div>
            <hr>
        </div>
        <div id="srodek2">
            <div class="kontent">
                <div class="info">
                    <h2 id="h2ogl"> Twoje ogłoszenia </h2>
                    <p id="pogl"> Twoje aktywne i zakończone ogłoszenia -<br />
                    tutaj możesz nimi zarządać </p>
                </div>
                <div class="zarzogl">
                    <div class="menuogl">
                        <button id="niekliknieteogl" onclick="location.href='mojxlo.php';"> Aktywne </button>
                        <button id="kliknieteogl"> Zakonczone </button>
                        <hr>
                    </div>
                    <div class="menunazwa">
                        Zakończone ogłoszenia
                    </div>
                    
                    <?php
                    if($_SESSION['id'] == 1)
                        $polacz = mysqli_connect('localhost', 'root', '', 'portal ogloszeniowy');
                    else
                        $polacz = mysqli_connect('localhost', 'zalogowany', 'zal', 'portal ogloszeniowy');
                
                    mysqli_set_charset($polacz ,"UTF8" );
                    
                    $iduzytkownika = $_SESSION['id'];
                    
                    $zap1 = mysqli_query($polacz, "SELECT tytul, cena, zdjcie, id_ogloszenia FROM ogloszenia WHERE id_uzytkownika = $iduzytkownika AND stan='zakonczony'");
                    
                    while($w = mysqli_fetch_row($zap1))
                    {
                    echo "<div class='aktogl'>";
                        echo "<div class='zdjogl'>";
                            echo "<img src='$w[2]' class='zdjogloszenia2'>";
                        echo "</div>";
                        echo "<div class='tytulogl'>";
                            echo $w[0];
                        echo "</div>";
                        echo "<div class='cenaogl'>";
                            echo $w[1]." zł";
                        echo "</div>";
                        echo "<div class='guzikogl'>";
                            echo "<form method='post'>";
                                echo "<button name='zakoncz' class='guzaktywuj2'> Aktywuj </button>";
                                echo "<input type='label' name='id' class='infoid' value='$w[3]'>";
                            echo "</form>";
                        echo "</div>";
                     echo "</div> ";
                    }
                    
                    if(isset($_POST['zakoncz']))
                    {
                        $idogloszenia = $_POST['id'];
                        mysqli_query($polacz, "UPDATE ogloszenia SET stan = 'aktywny' WHERE id_ogloszenia = $idogloszenia");
                        header('Location: zakonczone.php');
                    }
                    
                    mysqli_close($polacz);
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>