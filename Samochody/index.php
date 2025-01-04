<!doctype html>
<html lang="pl">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <style>
    nav{
      margin-left: 10px;
      margin-right: 10px;
      margin-top: 11px;
      -webkit-box-shadow: 0px 5px 30px -3px rgba(66, 68, 90, 1);
-moz-box-shadow: 0px 5px 30px -3px rgba(66, 68, 90, 1);
box-shadow: 0px 5px 30px -3px rgba(66, 68, 90, 1);
    }
    .dol{
      margin: 10px;
    }
    fieldset{
      border: 1px solid black;
    }
    .dol2{
      margin-left: 5px;
    }
    table{
        width: 100%;
        border-collapse: collapse;
    }
    table, th, td{
        border: 1px solid black;
        padding: 0.5em;
    }
    tbody tr:nth-child(odd){
        background-color: #ccc;
    }
    #formularz{
      background-color: #545151;
      border: 1px dashed black;
      width: 400px;
      color: white;
    }
  </style>
  <body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="http://maksik.edu.pl/~d20.bylinski.szymon/BDZadanie/">samSamochody</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
          <a class="nav-link active menu" id="marki" aria-current="page" href="#">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-car-front-fill" viewBox="0 0 16 16">
  <path d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679q.05.242.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.8.8 0 0 0 .381-.404l.792-1.848ZM3 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2m10 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2M6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2zM2.906 5.189a.51.51 0 0 0 .497.731c.91-.073 3.35-.17 4.597-.17s3.688.097 4.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 11.691 3H4.309a.5.5 0 0 0-.447.276L2.906 5.19Z"/>
</svg> Marki</a>
        </li>
        <li class="nav-item">
          <a class="nav-link menu" id="silnik" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box" viewBox="0 0 16 16">
  <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464z"/>
</svg> Niezielone auta z silnikiem 1,4-1,6</a>
        </li>
        <li class="nav-item">
          <a class="nav-link menu" id="ilosciaut" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-graph-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M0 0h1v15h15v1H0zm14.817 11.887a.5.5 0 0 0 .07-.704l-4.5-5.5a.5.5 0 0 0-.74-.037L7.06 8.233 3.404 3.206a.5.5 0 0 0-.808.588l4 5.5a.5.5 0 0 0 .758.06l2.609-2.61 4.15 5.073a.5.5 0 0 0 .704.07"/>
</svg> Ilość aut</a>
        </li>
        <li class="nav-item">
          <a class="nav-link menu" id="dodaj" href="dodaj.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-patch-plus-fill" viewBox="0 0 16 16">
  <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01zM8.5 6v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 1 0"/>
</svg> Dodaj Auto</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Szukaj" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Szukaj</button>
      </form>
    </div>
  </div>
</nav>
    <div class="dol">  
      <fieldset>
        <p class="dol2" id="tresc">
        Wykonać kopię tabeli samSamochody z bazy test. Usunąć kolumnę NR_SAMOCHODU i dodać kolumnę ID, autonumerowaną.<br>
        Napisać aplikację, która zrealizuje następujące zadania:<br>
        1. wyświetl niepowtarzającą się listę wypunktowaną marek samochodów (nazwy pisane małymi literami)<br>
        2. wyświetl tabelę zawierającą wszystkie dane aut o pojemności silnika miedzy 1400 a 1600, które nie są koloru zielonego<br>
        3. wyświetl tabelaryczne zestawienie ilości aut poszczególnych marek samochodów<br>
        4. Stworzyć formularz dodający do bazy kolejny rekord z danymi nowego auta.<br>
        <img width="800px;" class="rounded mx-auto d-block" src="dwadwa.png">
        </p>
    </fieldset>
    </div>  
    <script src="fetch.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>