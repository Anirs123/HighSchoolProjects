<?php
    session_start();
    require_once('db.inc');
    if(isSet($_GET['mim'])) //skr.php?mim=wyswietl
        $mim = $_GET['mim']; //mim to skrot od marki i modele :)
    else
        $mim = '';
    $info = '';
    $info2 = '';
    switch($mim){
        case 'wyswietl':
            $info = '<h1>MARKI I MODELE W KOLEJNOŚCI ALFABETYCZNEJ</h1>';

            $query = "SELECT komMarki.Nazwa AS Marka, GROUP_CONCAT(komModele.Nazwa ORDER BY komModele.Nazwa SEPARATOR '<br>- ') AS Modele
            FROM komMarki
            INNER JOIN komModele ON komMarki.Kod = komModele.Marka_Kod
            GROUP BY komMarki.Nazwa
            ORDER BY komMarki.Nazwa;";
            // echo $query;
            $result = $conn -> query($query);
            if($result){
                $info .= '<ol>';
                while($ob = $result -> fetch_object()){
                    $info .= '<li>' . $ob -> Marka . '</li>';
                    $info .= '- ' . $ob -> Modele;
                }
                $info .= '</ol>';
                $result -> close();
            }
            else{
                $info .= '<p style="color: red;">Brak Danych...</p>';
            }
            $conn -> close();
            break;
        case 'formularz':
            if (isset($_POST['nazwa'])){
                $nazwa = $_POST['nazwa'];
                //Zabezpieczamy zmienną przed atakami SQL Injection
                $nazwa = $conn->real_escape_string($nazwa);

                $query = "SELECT komMarki.Nazwa AS Marka, komModele.Nazwa AS Model
                        FROM komMarki
                        INNER JOIN komModele ON komMarki.Kod = komModele.Marka_Kod
                        WHERE komMarki.Nazwa = '$nazwa'
                        ORDER BY komModele.Nazwa;";
                // echo $query;
                $result = $conn->query($query);
                $info2 .= '<br><p class="sr">Modele:</p>';
                if ($result){
                    $info2 .= '<ol>';
                    while ($ob = $result->fetch_object()) {
                        $info2 .= '- ' . $ob->Model;
                        $info2 .= '<br>';
                    }
                    $info2 .= '</ol>';
                    $result->close();
                }
            }else{
                $info2 .= '<p style="color: red;">Brak Modeli...</p>';
            }
            $conn -> close();
            break;
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Marki i Modele Aut</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
<a href="index.php" style="display: flex; justify-content: center;">POWRÓT</a>
    <div class="divek">
        <a href="?mim=wyswietl">1. Wyświetl Marki i Modele</a>
        <div><?=$info?></div>
    </div>
    <div class="divek">
        <a>2. Formularz Wyszukiwania</a>
        <form method="POST" action="?mim=formularz">
        <fieldset>
            <legend>Wyszukiwarka Modeli</legend>
            <label for="nazwa">Nazwa Marki:</label>
            <input type="text" placeholder="np. BMW" id="nazwa" name="nazwa" required>
            <input class="zapisz" type="submit" value="Wyszukaj">
        </fieldset>
    </form>
        <div><?=$info2?></div>
    </div>
</body>
</html>