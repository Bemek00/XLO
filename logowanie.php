<!DOCTYPE html>

<?php
session_start();

if(@$_SESSION['id'] == NULL)
    $_SESSION['id'] = 0;

?>

<html>
    <head>
        <meta charset="UTF-8" />
        <title> Logowanie <?php echo $_SESSION['id']; ?> </title>
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
                    <button id="zaloguj" onclick="location.href='logowanie.php';"> Mój xlo </button>
                    <button id="dodaj"> Dodaj ogłoszenie </button>
                </div>
            </div>
            <hr>
        </div>
        <div id="srodek2">
            <div class="kontent">
                <div id="panellogowania">
                    <div id="zpasek">
                        <div id="jzielony">
                            
                        </div>
                        <div id="czielony">
                            
                        </div>
                    </div>
                    <div id="przyciskil">
                        <button class="przyciskilog" id="p1"> Zaloguj się </button>
                        <button class="przyciskilog" id="p2" onclick="location.href='rejestracja.php';"> Rejestracja </button>
                    </div>
                    <div id="boxdane">
                        <form action="logowanie.php" method="post">
                            <input type="text" name="email" placeholder="E-mail" class="danelogowania">
                            <input type="password" name="haslo" placeholder="Hasło" class="danelogowania">
                            <input type="submit" value="Zaloguj się" name="zalogujsie" id="przyciskloguj">
                        </form>
                        <?php
                        $polacz = mysqli_connect('localhost', 'anonim', 'anonim', 'portal ogloszeniowy');
                        
                        mysqli_set_charset($polacz ,"UTF8" );
                        
                        if(isset($_POST['zalogujsie']))
                        {
                            $email = $_POST["email"];
                            $haslo = $_POST["haslo"];
                            
                            if(mysqli_num_rows(mysqli_query($polacz, "SELECT email, haslo FROM uzytkownik WHERE email='$email' AND haslo='$haslo'")) > 0)
                            {
                                $w = mysqli_fetch_row(mysqli_query($polacz, "SELECT id_uzytkownika, imie, nazwisko FROM uzytkownik WHERE email='$email' AND haslo='$haslo'"));
                                
                                $_SESSION['id'] = $w[0];
                                $_SESSION['imie'] = $w[1];
                                $_SESSION['nazwisko'] = $w[2];
                                $strona = $_SESSION['strona'];
                                
                                echo $_SESSION['id'];
                                
                                header("Location: $strona");
                            }
                            else
                                echo "<p id='niepoprawnedane'> Błędny e-mail lub hasło <p>"; 
                        }
                        
                        mysqli_close($polacz);
                        
                        ?>
                        <br />
                        <hr>
                        <p id="regulamin">Zalogowanie oznacza akceptację Regulaminu serwisu XOL.pl w aktualnym brzmieniu. Jeśli nie akceptujesz warunków zmienionego Regulaminu serwisu WLO.pl, wyślij oświadczenie o rozwiązaniu Umowy w trybie przewidzianym w Regulaminie.</p>
                    </div>
                </div>
            </div>    
        </div>
    </body>
</html>