<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodawanie Auta</title>
    <style>
        a{
            color: pink;
            font-weight: bold;
            font-size: 20px;
            text-decoration: none;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
        div{
            margin-bottom: 30px; 
        }
        form{
            display: grid;
            grid-template-columns: 150px 1fr;
            grid-gap: 10px 20px;
            max-width: 400px;
        }

        label{
            text-align: right;
            padding-right: 10px;
        }

        input{
            width: 100%;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <h1>Formularz dodawania auta do tabeli 'autoKomis'</h1>
    <div>
        <a href="index.php">Powrót Do listy aut</a>
    </div>
    <form enctype="multipart/form-data" action="uruchomdodaj.php" method="POST">
        <label for="marka">Marka</label>
        <input name="marka" placeholder="Audi" type="text">

        <label for="model">Model</label>
        <input name="model" placeholder="A4" type="text">

        <label for="rocznik">Rocznik</label>
        <input name="rocznik" placeholder="1999" type="number">

        <label for="typ">Typ</label>
        <input name="typ" placeholder="Hatchback" type="text">

        <label for="drzwi">Drzwi</label>
        <input name="drzwi" placeholder="4" type="number">

        <label for="silnik">Silnik</label>
        <input name="silnik" placeholder="B" type="text">

        <label for="pojemnosc">Pojemnosc</label>
        <input name="pojemnosc" placeholder="1.6" type="number">

        <label for="przebieg">Przebieg</label>
        <input name="przebieg" placeholder="120000" type="number">

        <label for="cena">Cena</label>
        <input name="cena" placeholder="10500" type="number">

        <label for="zdjecie">Zdjęcie (max 2Mb)</label>
        <input name="zdjecie" accept="image/*" type="file">

        <input type="reset" value="Czyść">
        <input type="submit" value="Wyślij">
    </form>
</body>
</html>