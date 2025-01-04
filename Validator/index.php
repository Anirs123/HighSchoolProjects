<?php
    $op = $_GET['op'] ?? '';
    switch ($op){
        case 'odbierz':
            // echo 'PHP zglasza gotowosc';
            $postData = file_get_contents('php://input');
            $decodedData = json_decode($postData, true);

            if($decodedData === null){
                http_response_code(400); //blad jezeli nie istnieje czyli ktos sobie recznie wpisal 
                echo json_encode(['error' => 'Nieprawidłowe dane JSON']);
                exit;
            }
            $name = $decodedData['name'];
            $plec = $decodedData['plec'];
            $kolor = $decodedData['kolor'];
            $liczba = $decodedData['liczba'];
            $opinia = $decodedData['opinia'];

            //validacja koloru
            $kolortext = '';
            if(empty($kolor)){
                // echo '<p>Nie wybrano koloru</p>';
                $kolortext = 'white';
            }
            else
                // echo 'kolor: ' . $kolor;
                switch ($kolor){
                    case "kr":
                        $kolortext = "red";
                    break;
                    case "kg":
                        $kolortext = "green";
                    break;
                    case "kb":
                        $kolortext = "blue";
                    break;
                    case "ki":
                        $kolortext = "orange";
                    break;
                    default:
                }
            echo '<p style="color:' . $kolortext .'">Dane Osobowe</p>';
            //validujemy dane
            if($name == '')
                echo '<p>Nie podano imienia</p>';
            else if(!preg_match('/^[A-ZŁŚŻŹĆŃ]{1}[a-ząęółśżźćń]*\s[A-ZŁŚŻŹĆŃ]{1}[a-ząęółśżźćń]*$/', $name))
                echo '<p>Niewłaściwe znaki w imieniu lub nazwisku</p>';
            else
                // echo '<p>Imię i nazwisko są poprawne</p>';
                echo $name;

            //validacja plci
            if($plec == '')
                echo '<p>Nie podano plci</p>';
            else if($plec == 'k' || $plec == 'm'){
                // echo '<p>Poprawne dane płci</p>';
                if($plec == 'k')
                    echo '<p>♀️</p>';
                else
                    echo '<p>♂️</p>';
            }
            else
                echo '<p>Zmanipulowane dane plci</p>';
            //validator liczby
            if($liczba == '')
                echo 'Nie podano wieku';
            else if(!is_numeric($liczba))
                echo '<p>Podano złe dane jako wiek</p>';
            else if($liczba < 1 || $liczba > 130){
                echo '<p>Nie podano liczby z przedziału od 1 do 130</p>';
            }
            else
                // echo 'wiek: ' . $liczba;
                if($liczba < 18 && $plec == 'k')
                        echo '<p>dziewczynka</p>';
                    else if($liczba > 60 && $plec == 'k')
                        echo '<p>Babcia</p>';
                    else if($liczba >= 18 && $plec == 'k')
                        echo '<p>Kobieta</p>';
                if($liczba < 18 && $plec == 'm')
                        echo '<p>chlopczyk</p>';
                    else if($liczba > 60 && $plec == 'm')
                        echo '<p>Dziadek</p>';
                    else if($liczba >= 18 && $plec == 'm')
                        echo '<p>Facet</p>';
            //validator opini
            if(empty($opinia)){
                echo '<p>Nie podano opini</p>';
            }
            else{
                $dlugosc = strlen($opinia);
                if($dlugosc < 10)
                    echo "Błąd! Tekst musi mieć co najmniej 10 znaków.";
                elseif($dlugosc > 100)
                    echo "Błąd! Tekst nie może mieć więcej niż 100 znaków.";
                else
                    echo '<p>Opinia: ' . $opinia . '</p>';
            }
            break;
        default:
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body{
        background-color: #242323;
        color: white;
        box-sizing: border-box;
    }
    .divek{
        width: 400px;
        height: 500px;
        position: fixed;
        top: 50%;
        left: 50%;
        margin-top: -250px;
        margin-left: -200px;
    }
    input, textarea{
        background-color: #242323;
        border: 1px solid white;
        color: white;
    }
    input:hover{
        box-shadow: 1px 1px 2px black, 0 0 10px lightgreen, 0 0 5px white;
    }
    .s1{
        color: red;
    }
    .s2{
        color: green;
    }
    .s3{
        color: blue;
    }
    #liczba::placeholder{
        text-align: right;
    }
    .b1, .b2{
        color: white;
    }
</style>
<body>
    <div class="divek">
    <form id="dane" method="POST">
        <fieldset>
            <label for="imie">* Imię i Nazwisko:</label><br>
            <input type="text" required placeholder="&nbsp;np. Jan Kowalski" name="imie" id="fName"></input><br><br>
            <label for="liczba">* Wiek:</label><br>
            <input type="text" required placeholder="np. 18  &nbsp;" name="liczba" id="liczba"></input><br><br>
            <label for="plec">* Płeć:</label><br>
            <input type="radio" required name="plec" value="k">Kobieta</input><br>
            <input type="radio" required name="plec" value="m">Mężczyzna</input><br><br>
            <label for="kolor">Kolor:</label><br>
            <input type="checkbox" name="r" value="kr"><span class="s1">Czerwony</span></input><br>
            <input type="checkbox" name="g" value="kg"><span class="s2">Zielony</span></input><br>
            <input type="checkbox" name="b" value="kb"><span class="s3">Niebieski</span></input><br>
            <input type="checkbox" name="i" value="ki">Inny</input><br><br>
            <label for="opinia">Opinia:</label><br>
            <textarea placeholder="min 10 znakow" rows="5" cols="25" minlength="10" maxlength="100" name="opinia" id="opinia"></textarea><br><br>
            <input type="checkbox" required name="w" id="wyr"><span class="w1"></span>Wyrazam zgodę na przetwarzanie moich danych osobowych.</input><br><br>
            <input type="reset" class="b1" value="Wyczyść"></input>
            <input name="akcja" class="b2" id="wyslij" type="submit" value="Wyślij"></input>
        </fieldset>
        </form>
        <div id="error"></div>
    </div>
    <script>
        //KOLOR KONFIGURACJA
            let vKolor = null; //dajemy mu brak wartosci (pustke)
            const oKolor = document.querySelectorAll('input[type="checkbox"]:not(#wyr)'); //wykluczamy ten ostatni checkbox potwierdzajacy formularz za pomoca not(id)
            oKolor.forEach((ch) => {
                // dajemy nasluchiwanie przy zmianie czyli change
                ch.addEventListener('change', function(){
                    //odznaczamy checkbox ktory nie jest zaznaczony juz po kliknieciu innego
                    if(ch.checked){ //sprawdzamy czy klikniety checkbox jest
                        oKolor.forEach((chothers) => {
                            if(chothers !== ch){ //sprawdzanie czy nowy checkbox nie jest tym samym poprzednim checkoxem
                                chothers.checked = false;
                                //odznaczamy tamte poprzednie klikniete
                            }
                        });
                        vKolor = ch; //przypisuje klikniety checkbox do zmiennej vkolor
                    } 
                    else{
                        //Jesli odznaczamy checkboxa trzeba usunac mu wartosc
                        vKolor = null;
                    }
                })
            })
        dane.onsubmit = () => {
            let checkbox = wyr; //tworzymy zmienna checkbox i dajemy jej obiekt wyr
            if(!checkbox.checked){ //sprawdzamy czy nie jest klikniety
                alert("Musisz wyrazić zgodę na przetwarzanie danych osobowych.");
                wyslij.style.border = "1px solid black";
                wyslij.style.color = "gray";
                event.preventDefault(); //zatrzymujemy formularz
            }
            else{ //wykonujemy wszystko jezeli dziala
            event.preventDefault();
            const vName = fName.value ? fName.value: '';
            const oPlec = document.querySelectorAll('[name="plec"]');
            vPlec = '';
            oPlec.forEach((radio) => {
                if(radio.checked)   
                    vPlec = radio.value;
            })
            const vKolorNew = vKolor ? vKolor.value: ''; //dajemy wartosc dla zmiennej vKolorNew z funkcji z vKolor

            // alert(vKolorNew);
            // error.innerHTML = `${vName}, ${vPlec}, ${vKolorNew}`;
            const vLiczba = liczba.value ? liczba.value: '';
            // error.style.display = 'block';
            const vOpinia = opinia.value ? opinia.value: '';
            var dataToSend = {
                name: vName,
                plec: vPlec,
                kolor: vKolorNew,
                liczba: vLiczba,
                opinia: vOpinia
            };
            const requestOptions = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(dataToSend)
            };

            fetch('?op=odbierz', requestOptions)
                .then(response => response.text())
                .then(odpPHP => error.innerHTML = odpPHP)
                .catch(error => console.error('błąd:', error));
        }
    }
    </script>
</body>
</html>
<?php
    } //end switch
?>