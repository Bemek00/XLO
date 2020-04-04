<!DOCTYPE html>

<?php
session_start();

if(@$_SESSION['id'] == NULL)
    $_SESSION['id'] = 0;

?>

<html>
    <head>
        <meta charset="UTF-8" />
        <title> Rejestracja <?php echo $_SESSION['id']; ?> </title>
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
                <div id="panellogowania2">
                    <div id="zpasek">
                        <div id="czielony2">
                            
                        </div>
                        <div id="jzielony2">
                            
                        </div>
                    </div>
                    <div id="przyciskil">
                        <button class="przyciskilog" id="p2" onclick="location.href='logowanie.php';"> Zaloguj się </button>
                        <button class="przyciskilog" id="p1"> Rejestracja </button>
                    </div>
                    <div id="boxdane2">
                        <form action="rejestracja.php" method="post">
                            <input type="text" name="imie" placeholder="Imię" class="danelogowania2">
                            <input type="text" name="nazwisko" placeholder="Nazwisko" class="danelogowania2">
                            <input type="text" name="tel" placeholder="Nr. telefonu" class="danelogowania2">
                            <input type="text" name="email" placeholder="E-mail" class="danelogowania2">
                            <input type="password" name="haslo" placeholder="Hasło" class="danelogowania2">
                            <input type="password" name="powtorzhaslo" placeholder="Powtórz hasło" class="danelogowania2">
                            <input type="submit" value="Zarejestruj się" name="zarejestrujsie" id="przyciskloguj">
                        </form>
                        <?php
                        $polacz = mysqli_connect('localhost', 'anonim', 'anonim', 'portal ogloszeniowy');

                        mysqli_set_charset($polacz ,"UTF8" );
                        
                        if(isset($_POST['zarejestrujsie']))
                        {
                            $imie = $_POST['imie'];
                            $nazwisko = $_POST['nazwisko'];
                            $tel = $_POST['tel'];
                            $email = $_POST['email'];
                            $haslo = $_POST['haslo'];
                            $powhaslo = $_POST['powtorzhaslo'];
                            
                            
                            if($imie!="" && $nazwisko!="" && $tel!="" && $email!="" && $haslo!="" && $powhaslo!="")
                            {
                                if(mysqli_num_rows(mysqli_query($polacz, "SELECT email FROM uzytkownik WHERE email='$email'")) ==0)
                                {
                                    if($haslo == $powhaslo)
                                    {
                                        mysqli_query($polacz, "INSERT INTO uzytkownik (imie, nazwisko, email, telefon, haslo) VALUES ('$imie', '$nazwisko', '$email', '$tel', '$haslo')");
                                        
                                        header('Location: logowanie.php');
                                    }
                                    else
                                        echo "<p id='niepoprawnedane'> Hasła nie są takie same <p>"; 
                                }
                                else 
                                    echo "<p id='niepoprawnedane'> Podany e-mail jest już zajęty <p>"; 
                            }
                            else
                                echo "<p id='niepoprawnedane'> Występują puste pola <p>"; 
                        }
                        
                        mysqli_close($polacz);
                        
                        ?>
                        <br />
                        <hr>
                        <p id="regulamin">Przyjmuję do wiadomości, że XLO wykorzystuje moje dane osobowe zgodnie z Polityką prywatności oraz Polityką dotyczącą plików cookie i podobnych technologii. XLO wykorzystuje zautomatyzowane systemy i partnerów do analizowania, w jaki sposób korzystam z usług w celu zapewnienia odpowiedniej funkcjonalności produktu, treści, dostosowanych i opartych na zainteresowaniach reklam, jak również ochrony przed spamem, złośliwym oprogramowaniem i nieuprawnionym korzystaniem z naszych usług.</p>
                    </div>
                </div>
            </div>    
        </div>
    </body>
</html>