<?php
    // testuje nowe połączenia z bazą danych do egzaminu zawodowego, których jeszcze nie używałem z różnych powodów.
    $conn = new mysqli('', '', '', '');
    // echo 'php dziala';
    if (isset($_GET['marka'])) {
        $marka = $_GET['marka'];
        
        // zapytanie do bazy zeby pobrac modele dla danej marki
        $sql = "SELECT DISTINCT model FROM `autoKomis` WHERE marka = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $marka);
        $stmt->execute();
        $result = $stmt->get_result();

        $models = array();
        while ($row = $result->fetch_assoc()) {
            $models[] = $row['model'];
        }

        // zwracamy w formacie json
        header('Content-Type: application/json');
        echo json_encode($models);
        exit; // wysyalamy dane json
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Aut 'autoKomis'</title>
    <style>
        li{
            font-size: 150%;
            padding: 5px;
            cursor: pointer;
        }
        li:hover{
            color: red;
            background-color: gray !important;
            /* dalem important zeby nadpisac lightgray z parzystych */
            width: 200px;
        }
        li:nth-child(even){
            background-color: lightgray;
            width: 200px;
        }
        a{
            color: pink;
            font-weight: bold;
            font-size: 30px;
            text-decoration: none;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
        .lewy{
            float: left;
            width: 200px;
            margin-right: 100px;
        }
        .prawy{
            float: left;
        }
        .prawy img{
            max-width: 300px;
            height: auto;
        }
        #models{
            font-size: 120%;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Lista aut tabeli 'autoKomis'</h1>
    <a href="dodaj.php">Dodaj Auto &plus;</a><br>
    <div class="lewy">
        <ol id="car-list">
            <?php
                $conn = new mysqli('', '', '', '');
                // echo 'php dziala';

                $sql = "SELECT DISTINCT marka FROM `autoKomis` ORDER BY marka ASC";
                $result = $conn->query($sql);

                if($result->num_rows > 0){ //sprawdzam czy sa wyniki
                    //wyswietlanie wynikow w formie listy
                    while ($row = $result->fetch_assoc()) {
                        echo "<li onmouseover=\"wyswietlmodele('" . $row['marka'] . "')\">" . $row['marka'] . "</li>";
                    }
                }
                else{
                    echo "Brak marek samochodów w bazie danych.";
                }
            ?>
        </ol>
    </div>

    <div class="prawy">
        <img id="car-image" src="" alt="Zdjęcie samochodu" style="display:none;">
        <div id="models"></div>
    </div>

    <script>
        //zmienia obraz i wyswietla modela
        function wyswietlmodele(marka) {
            const rozszerzenia = ['jpg', 'jpeg', 'png', 'gif', 'jfif'];
            const zdjauta = document.getElementById('car-image');

            //rozszezenia zdjec
            for (const rozszerzenie of rozszerzenia) {
                const sciezka = 'zdjecia/' + marka + '.' + rozszerzenie;

                // objekt obrazu aby sprawdzic czy istnieje
                const img = new Image();
                img.src = sciezka;

                img.onload = function() {
                    //gdy obraz zaladowany aktualizujemy i wyswietlamy
                    zdjauta.src = sciezka;
                    zdjauta.style.display = 'block';
                };

                img.onerror = function() {
                    //jezeli nie istnieje nic sie nie dzieje
                };
            }

            fetch('?marka=' + marka)
                .then(response => response.json())
                .then(data => {
                    const modele = document.getElementById('models');
                    if (data.length > 0) {
                        modele.innerHTML = '<h2>Modele:</h2><ol>' + data.map(model => '<li>' + model + '</li>').join('') + '</ol>';
                    } else {
                        modele.innerHTML = '<p>Uwaga! Brak modeli dla tej marki.</p>';
                    }
                })
                .catch(error => {
                    console.error('Blad podczas pobierania:', error);
                    document.getElementById('models').innerHTML = '<p>błąd</p>';
                });
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>