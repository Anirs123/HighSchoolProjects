<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>LOTTO</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<?php
    $liczbypokaz = '';
    $liczby = array();
    $koniec = '';
    if(isSet($_GET['lotto'])) //skr.php?lotto=wygeneruj
        $lotto = $_GET['lotto'];
    else
        $lotto = '';
    switch($lotto){
        case 'wygeneruj':
            $liczby = [];
            while(count($liczby) < 6){ //6 razy bo mozesz podac w lotto tylko 6 cyfr
                //while poniewaz nie chcemy zeby cyfra sie powtrorzyla
                $WygenerowanaLiczba = mt_rand(1, 49); //mt rand bo lepszy był | 49 bo lotto ma 49 cyfr łącznie
                if(!in_array($WygenerowanaLiczba, $liczby)){
                    array_push($liczby, $WygenerowanaLiczba);
                }
            }
            // echo '<pre>';
            //     print_r($liczby);
            // echo '</pre>';
            $liczbypokaz = implode(", ", $liczby);
        break;
        case 'cyfry':
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST["text"])) {
                    $liczby = $_POST["text"];
                    
                    //Sprawdzenie czy wszystkie liczby są od 1 do 49
                    $czyPoprawneLiczby = true;
                    $tablica_cyfr = explode(",", $liczby); //robimy tablice z liczbami
        
                    foreach ($tablica_cyfr as $cyfra){
                        if(!is_numeric($cyfra) || $cyfra < 1 || $cyfra > 49){
                                $czyPoprawneLiczby = false; 
                            break; //zeby kod nie iterowal dalej po cyfrach poniewaz juz jest niepoprawny
                        }
                    }
                    //Sprawdzenie czy liczba cyfr podanych jest rowna 6 i czy sa poprawne jest prawdą
                    if($czyPoprawneLiczby && count($tablica_cyfr) == 6){
                        $liczbypokaz = implode(", ", $tablica_cyfr);
                    }
                    else{
                        $liczbypokaz = 'Błąd - wprowadź dokładnie 6 liczb od 1 do 49.';
                    }
                }
                else{
                    $liczbypokaz = 'Błąd formularza';
                }
            }
            break;
            case 'sprawdz':
                //Sprawdzanie czy zmienna $_GET['cyfry'] istnieje
                if(isset($_GET['cyfry'])){
                    $liczbypokaz = urldecode($_GET['cyfry']);
                    $liczbypokazmoje = explode(",", $liczbypokaz); //Zmienia na tablicę
                    
                    $liczbywygrywajace = [];
                    while(count($liczbywygrywajace) < 6){
                        $WygenerowanaLiczba = mt_rand(1, 49);
                        if(!in_array($WygenerowanaLiczba, $liczbywygrywajace)){
                            array_push($liczbywygrywajace, $WygenerowanaLiczba);
                        }
                    }

                    $LiczbyPokazKomputer = implode(", ", $liczbywygrywajace); //Zmienia na tekst
                    //Sprawdzenie trafień
                    $trafione = array();
                    foreach ($liczbywygrywajace as $wygrywajaca) {
                        if(in_array($wygrywajaca, $liczbypokazmoje)) {
                            array_push($trafione, $wygrywajaca);
                        }
                    }
                    $koniec = '<p>Liczby które wygrywają losowanie to:</p><br><span class="spany">' . $LiczbyPokazKomputer . '</span><br> <p>A twoje liczby to:</p><br><span class="spany">' . $liczbypokaz . '</span><br><p>Ilość trafionych liczb: ' . count($trafione) . ' | ' . implode(", ", $trafione) . '</p>';
                } else {
                    echo 'Błąd pobierania cyfr, spróbuj ponownie podać!';
                }
                break;
        default:
    }
?>
<body>
    <div>
        <h1>GRA LOTTO</h1>
        <span class="spany">Brak pomysłu?</span>
        <p class="wbrak">Wygeneruj losowe liczby do Lotto!</p><br>
        <p class="wygeneruj"><a href="?lotto=wygeneruj">WYGENERUJ</a></p>
        <span class="spany">Wolisz własnoręcznie podać czyfry?</span>
        <p>Wpisz liczby: </p>
        <form method="POST" action="?lotto=cyfry">
            <input name="text" id="text" type="text" maxlength="22" placeholder="np. 1, 12, 3, 5, 48, 13">
            <input id="przeslij" value="POTWIERDŹ" type="submit"><br>
        </form>
        <p>Twoje liczby: 
            <span class="spanliczby"><?=$liczbypokaz;?></span>
        </p><br>
        <!-- implode nam wypisuje z tablicy -->
        <p class="sprawdz"><a href="?lotto=sprawdz&cyfry=<?=urlencode($liczbypokaz)?>">Sprawdź czy wygrałeś!</a></p>
        <!-- zapisujemy do linku nasza zmienna cyfry i dajemy jej wartosci zeby ja pobrac zaraz -->
        <?=$koniec?>
    </div>
</body>
</html>