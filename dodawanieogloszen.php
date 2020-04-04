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
        <div id="srodek2">
            <div class="kontent2">
                <h3> Zaczynamy! </h3>
                <hr>
                
                <form action="dodawanieogloszen.php" method="post" enctype="multipart/form-data">
                    <table id="dodawanieogloszentable">
                        <tr>
                            <td class="teksttable"> Wpisz tytuł: </td>
                            <td> <input type="text" class="dodoglinput" name="tytul"> </td>
                        </tr>
                        <tr>
                            <td class="teksttable"> Wybierz kategorię: </td>
                            <td>
                                <select name="kategoria" id="listarozwijana2">
                                    <option>-Wybierz kategorię-</option>
                                    <option>Motoryzacja</option>
                                    <option>Elektronika</option>
                                    <option>Praca</option>
                                    <option>Moda</option>
                                    <option>Zwierzęta</option>
                                    <option>Sport</option>
                                </select> 
                            </td>
                        </tr>
                        <tr>
                            <td class="teksttable"> Cena: </td>
                            <td> <input type="text" class="dodoglinput" name="cena"> </td>
                        </tr>
                        <tr>
                            <td class="teksttable"> Opis: </td>
                            <td> 
                                <textarea name="opis" cols="1" rows="1" wrap="virtual" id="opis"></textarea> 
                            </td>
                        </tr>
                        <tr>
                            <td class="teksttable"> Dodaj zdjęcie: </td>
                            <td> <input name="plik" type="file" id="plikuzytkownika"> </td>
                        </tr>
                    </table>
                    <hr>
                    <input type="submit" name="dodaj" value="Dodaj ogłoszenie" id="dodajogloszenie">
                </form>
                <?php
                if($_SESSION['id'] == 1)
                    $polacz = mysqli_connect('localhost', 'root', '', 'portal ogloszeniowy');
                else if($_SESSION['id'] > 1)
                    $polacz = mysqli_connect('localhost', 'zalogowany', 'zal', 'portal ogloszeniowy');
                
                mysqli_set_charset($polacz ,"UTF8" );
                
                $uploaddir = 'C:\\xampp\\htdocs\\bemek\\portal ogloszeniowy\\zdjecia\\';

                if(isset($_POST["dodaj"]))
                {
                    $tytul = htmlspecialchars($_POST["tytul"]);
                    $kat = $_POST["kategoria"];
                    $cena = htmlspecialchars($_POST["cena"]);
                    $opis = htmlspecialchars($_POST["opis"]);
                    $uploadfile = $uploaddir . basename($_FILES['plik']['name']);
                    $obraz = "zdjecia/".$_FILES['plik']['name'];
                    $data = date('Y-m-d');
                    $id_uzytkownika = $_SESSION['id'];
                    
                    if($tytul!="" && $kat!="-Wybierz kategorię-" && $cena!="" && $opis!="")
                    {
                        move_uploaded_file($_FILES['plik']['tmp_name'], $uploadfile);
                        mysqli_query($polacz, "INSERT INTO ogloszenia (id_uzytkownika, tytul, opis, cena, zdjcie, typ, data_dodania, kategoria, stan) VALUES ('$id_uzytkownika', '$tytul', '$opis', '$cena', '$obraz', 'sprzedaz', '$data', '$kat', 'aktywny')");
                        
                        header('Location: potwierdzenie.php');
                    }
                    else
                    {
                        echo "<p id='niepoprawnedane2'> Występują miejsca puste <p>";
                    }
                }
                
                mysqli_close($polacz);
                ?>
            </div>
        </div>
    </body>
</html>