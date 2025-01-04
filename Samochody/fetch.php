<?php
    session_start();
    require_once('/home/d20.bylinski.szymon/database_functions.inc');

    $op = $_GET['op'] ?? '';

    switch($op){
        case 'silnik':
            $d = '<h1 class="text-center">Tabela danych niezielonych aut z silnikiem 1,4-1,6</h1>';
            $d .='<table><td>Lp.</td><td>ID auta</td><td>Marka</td><td>Typ</td><td>Rok Produkcji</td><td>Kolor</td><td>Pojemnosc Silnika</td><td>Przebieg</td>';
        $result = $conn->query("SELECT * FROM `samSAMOCHODY` WHERE POJ_SILNIKA BETWEEN 1400 AND 1600 AND (KOLOR <> 'ZIELONY' OR KOLOR <> 'zielony');");
        if($result){
            $lp = 1;
            while($ob = $result->fetch_object()){
                $d .= '<tr>
                <td>' . $lp++ . '</td>
                <td>' . $ob->ID . '</td>
                <td>' . $ob->MARKA . '</td>
                <td>' . $ob->TYP . '</td>
                <td>' . $ob->ROK_PROD . '</td>
                <td>' . $ob->KOLOR . '</td>
                <td>' . $ob->POJ_SILNIKA . '</td>
                <td>' . $ob->PRZEBIEG . '</td>
                </tr>'; 
            }
            $result->close();
        }
        $d .= '</table>';
        echo $d;
        $conn->close();
        break;
        case 'marki':
            $d = '<h1 class="text-center">Lista marek samochodów (nazwy pisane małymi literami)</h1>'; 
        $result = $conn->query("SELECT DISTINCT LOWER(MARKA) as marka FROM `samSAMOCHODY`;");
            $d .= '<ol>';
        if($result){
            while($ob = $result->fetch_object()){
                $d .= '<li>' . $ob->marka . '</li>'; 
            }
            $result->close();
        }
        $d .= '</ol>';
        echo $d;
        $conn->close();
        break;
        case 'ilosciaut':
            $d = '<h1 class="text-center">Tabela zestawiająca ilości aut poszczególnych marek samochodów</h1>'; 
            $d .='<table><td>Lp.</td><td>Marka</td><td>Ilość</td>';
        $result = $conn->query("SELECT MARKA as marka, count(*) as ilosc FROM `samSAMOCHODY` WHERE MARKA IN (MARKA) GROUP BY MARKA; ");
        if($result){
            $lp = 1;
            while($ob = $result->fetch_object()){
                $d .= '<tr>
                        <td>' . $lp++ . '</td>
                        <td>' . $ob->marka . '</td>
                        <td>' . $ob->ilosc . '</td>
                        </tr>'; 
            }
            $result->close();
        }
        $d .= '</table>';
        echo $d;
        $conn->close();
        break;
        case 'dodaj':
            $d = '<h1>Formularz dodawania auta</h1>'; 
        echo $d;
        $conn->close();
        break;
        default: 
            echo 'Mam twoj adres IP!';
    }
?>