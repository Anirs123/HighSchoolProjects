<?php
    echo "Przesłano formularz<br>";

    //ustawienia limitów rozmiaru plików
    ini_set('upload_max_filesize', '2M');
    ini_set('post_max_size', '2M');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //pobieranie wartosci z formularza
        $marka = $_POST['marka'];

        //sprawdzanie czy brak bledow
        if (isset($_FILES['zdjecie'])) {
            $fileSize = $_FILES['zdjecie']['size'];
            if ($fileSize > 2 * 1024 * 1024) { // 2 MB
                echo "Plik jest zbyt duży. Maksymalny rozmiar to 2MB.";
            } else {
                if ($_FILES['zdjecie']['error'] === UPLOAD_ERR_OK) {
                    $fileTmpPath = $_FILES['zdjecie']['tmp_name'];//Gdy plik jest przesyłany przez formularz serwer tworzy tymczasowy plik w którym przechowuje zawartość pliku przed przeniesieniem go do docelowej lokalizacji
                    $fileName = $_FILES['zdjecie']['name'];
                    $fileType = $_FILES['zdjecie']['type'];
                    $fileNameCmps = explode(".", $fileName);//zmienna przechowuje tablicę zawierającą komponenty (części) nazwy pliku które są oddzielone kropką (.) w oryginalnej nazwie pliku przesyłanego przez użytkownika
                    $rozszezenie = strtolower(end($fileNameCmps));
        
                    //dozwolone rozszerzenia plików
                    $dozwoloneRoz = array('jpg', 'jpeg', 'png', 'gif');
        
                    if (in_array($rozszezenie, $dozwoloneRoz)) {
                        //sciezka docelowa dla zdjęcia
                        $sciezka = 'zdjecia/';
                        $nowaNazwa = $marka . '.' . $rozszezenie; //zdjęcie zostanie nazwane marka auta
                        $dest_path = $sciezka . $nowaNazwa; //pelna sciezka do pliku który ma być zapisany na serwerze
        
                        //przenoszenie pliku do folderu 'zdjecia/'
                        if (move_uploaded_file($fileTmpPath, $dest_path)) {
                            echo "Plik został przesłany poprawnie!";
                        } else {
                            echo "Wystąpił błąd podczas przenoszenia pliku do katalogu";
                        }
                    } else {
                        echo "Niedozwolony format pliku, Dozwolone formaty: " . implode(', ', $dozwoloneRoz);
                    }
                } else {
                    echo "Nie udało się przesłać pliku. Błąd: " . $_FILES['zdjecie']['error'];
                }
            }
        } else {
            echo "Nie udało się przesłać pliku";
        }
    }
// 
// // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // 
// 
    $marka = $_POST['marka'];
    $model = $_POST['model'];
    $rocznik = $_POST['rocznik'];
    $typ = $_POST['typ'];
    $drzwi = $_POST['drzwi'];
    $silnik = $_POST['silnik'];
    $pojemnosc = $_POST['pojemnosc'];
    $przebieg = $_POST['przebieg'];
    $cena = $_POST['cena'];

    $conn = new mysqli('', '', '', '');

    $sql = "INSERT INTO autoKomis (marka, model, rocznik, typ, drzwi, silnik, pojemnosc, przebieg, cenas) VALUES('$marka','$model','$rocznik','$typ','$drzwi','$silnik','$pojemnosc','$przebieg','$cena')";
    // echo $sql;

    $result = $conn->query($sql);
    echo "<br>Pomyślnie dodano dane do bazy";

    $conn ->close();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>koniec</title>
    <style>
        a{
            color: pink;
            font-weight: bold;
            font-size: 20px;
            text-decoration: none;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
    </style>
</head>
<body>
    <div>
        <a href="index.php">Powrót Do listy aut</a>
    </div>
</body>
</html>