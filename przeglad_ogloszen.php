<!DOCTYPE html>

<?php
session_start();

if(@$_SESSION['szukanie'] == NULL)
    $_SESSION['szukanie'] = "%%";

if(@$_SESSION['kategoria'] == NULL)
    $_SESSION['kategoria'] = "Wszystko";

if(@$_SESSION['sortowanie'] == NULL)
    $_SESSION['sortowanie'] = "data_dodania desc";

if(@$_SESSION['id'] == NULL)
    $_SESSION['id'] = 0;

?>

<html>
    <head>
        <meta charset="UTF-8" />
        <title> Portal ogłoszeniowy <?php echo $_SESSION['id']; ?> </title>
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
                        <button id="zaloguj" name="mojoxlprzycisk"> 
                        <?php
                        if($_SESSION['id'] == 0)
                            echo "Mój xlo";
                        else
                            echo $_SESSION['imie']." ".$_SESSION['nazwisko'];    
                        ?>
                        </button>
                        <button id="dodaj" name="dodajoglprzycisk"> Dodaj ogłoszenie </button>
                    </form>
                        
                    <?php
                    if(isset($_POST["mojoxlprzycisk"]))
                    {
                        if($_SESSION['id'] == 0)
                        {
                            header('Location: logowanie.php');
                            $_SESSION['strona'] = 'mojxlo.php';
                        }
                        else
                        {
                            header('Location: mojxlo.php');
                        }
                    }
                    
                    if(isset($_POST["dodajoglprzycisk"]))
                    {
                        if($_SESSION['id'] == 0)
                        {
                            header('Location: logowanie.php');
                            $_SESSION['strona'] = 'dodawanieogloszen.php';
                        }
                        else
                            header('Location: dodawanieogloszen.php');
                    }
                    ?>
                </div>
            </div>
        </div>
        <div id="wyszukiwanie">
            <div class="kontent">
                <div id="niebieskiblok">
                    <form action="przeglad_ogloszen.php" method="post">
                        <input type="text" placeholder="Czego szukasz?" id="czoszukasz" name="szukanie">
                        <select name="kategoria" id="listarozwijana">
                            <option>Wszystko</option>
                            <option>Motoryzacja</option>
                            <option>Elektronika</option>
                            <option>Praca</option>
                            <option>Moda</option>
                            <option>Zwierzęta</option>
                            <option>Sport</option>
                        </select>
                        <input type="submit" value="SZUKAJ" id="szukaj" name="szukaj">
                    </form>
                </div>
            </div>
        </div>
        <div id="srodek">
            <div class="kontent">
                <div class="sortowanie" align="right">
                    <form method="post">
                        Sortuj: <button name="guz1" class="guz"> Najnowsze </button> 
                        <button name="guz2" class="guz"> Najtańsze </button> 
                        <button name="guz3" class="guz"> Najdroższe </button>
                    </form>
                </div>
                <?php
                
                if(isset($_POST['szukaj']))
                {
                    if(!isset($_POST["kategoria"]))
                        $_SESSION['kategoria'] = "Wszystko";
                    else
                        $_SESSION['kategoria'] = $_POST["kategoria"];

                    if(!isset($_POST["szukanie"]))
                        $_SESSION['szukanie'] = "%%";
                    else
                    {
                        $_SESSION['szukanie'] = $_POST["szukanie"];
                        if($_SESSION['szukanie'] == "")
                            $_SESSION['szukanie'] = "%%";
                        else
                            $_SESSION['szukanie'] = "%".$_SESSION['szukanie']."%";
                    }
                }
                
                if(isset($_POST["guz1"]))
                    $_SESSION['sortowanie'] = "data_dodania desc";
                else if(isset($_POST["guz2"]))
                    $_SESSION['sortowanie'] = "cena";
                else if(isset($_POST["guz3"]))
                    $_SESSION['sortowanie'] = "cena desc";
                
                $szu = $_SESSION['szukanie'];
                $kat = $_SESSION['kategoria'];
                $sor = $_SESSION['sortowanie'];
                
                if($_SESSION['id'] == 0)
                    $polacz = mysqli_connect('localhost', 'anonim', 'anonim', 'portal ogloszeniowy');
                else if($_SESSION['id'] == 1)
                    $polacz = mysqli_connect('localhost', 'root', '', 'portal ogloszeniowy');
                else
                    $polacz = mysqli_connect('localhost', 'zalogowany', 'zal', 'portal ogloszeniowy');
                
                mysqli_set_charset($polacz ,"UTF8" );
                
                if($kat == "Wszystko")
                    $zap1 = mysqli_query($polacz, "SELECT tytul, opis, cena, zdjcie, data_dodania, id_uzytkownika FROM ogloszenia WHERE tytul LIKE '$szu' AND stan='aktywny' OR opis LIKE '$szu' AND stan='aktywny' ORDER BY $sor");
                else
                    $zap1 = mysqli_query($polacz, "SELECT tytul, opis, cena, zdjcie, data_dodania, id_uzytkownika FROM ogloszenia WHERE kategoria='$kat' AND tytul LIKE '$szu' AND stan='aktywny' OR kategoria='$kat' AND opis LIKE '$szu' AND stan='aktywny' ORDER BY $sor");
                
                while($w = mysqli_fetch_row($zap1))
                {
                    $zap2 = mysqli_query($polacz, "SELECT telefon, email FROM uzytkownik WHERE id_uzytkownika=$w[5]");
                    $q = mysqli_fetch_row($zap2);
                    
                    echo "<div class='ogloszenia'>";
                        echo "<div class='zdjecie'>";
                            echo "<img src='$w[3]' class='zdjogloszenia' align='middle'>";
                        echo "</div>";
                        echo "<div class='kontentogloszenia'>";
                            echo "<div class='tytul'>";
                                echo $w[0];
                            echo "</div>";
                            echo "<div class='opis'>";
                                echo $w[1];
                            echo "</div>";
                            echo "<div class='telefon'>";
                                echo "tel: ".$q[0]."   e-mail: ".$q[1];
                            echo "</div>";
                        echo "</div>";
                        echo "<div class='pozostaleinfo'>";
                            echo "<div class='cena'>";
                                echo $w[2]." zł";
                            echo "</div>";
                            echo "<div class='datadodania'>";
                                echo $w[4];
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
                }
                
                mysqli_close($polacz);
                ?>
            </div>
        </div>
        <div id="stopka">
            <div class="kontent">
                
            </div>
        </div>
    </body>
</html>