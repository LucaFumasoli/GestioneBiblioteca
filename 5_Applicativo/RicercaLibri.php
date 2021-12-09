<!DOCTYPE HTML>
<html>
<head>
 
    <title>Ricerca Libri</title>
    <Link rel="shortcut icon" href="I1Cfumluc_fav.ico" type="image/x-icon">
    <Link rel="icon" href="i19fumluc_orario.html" type="image/x-icon">

    <meta charset="UTF-8">
    <meta name="keywords" content="HTML,CSS,XML,JavaScript">
    <meta name="author" content="Luca Fumasoli I2C">
    <meta name="description" content="">

  <!--Chrome e windows 10-->
  <!--data creazione: 07.10.2021 data ultima modifica: 25.11.2021-->

<script src="myscripts.js"></script>
<link rel="stylesheet" type="text/css" href="./style.css">

</head>

<body>

<?php
    function search() { // metodo per far la ricerca dei libri
        $csv = './db/Libro.csv';
        $csv = readCSV($csv); //legge il file dei libri e lo salva in una matrice

        $searchBy = $_POST['searchBy']; // vede se la ricerca è per titolo o autore
        $search = $_POST['search'];
        if ($search != null) {
            if ($searchBy == "titolo") { // condizione per vedere se cercare per titolo o autore
                searchBook($csv, $search, 1);
            }else {
                searchBook($csv, $search, 2);
            }
        }else {
            echo printBooks($csv); // se non è stato cercato nulla ristampa i libri di prima
        }
    }

    function searchBook($arr, $search, $col) { //metodo che cerca se un elemento è contenuto in una matrice
        $array = array();

        foreach ($arr as $item) { //scorre ogni riga della matrice
            if (strpos(strtolower($item[$col]), strtolower($search)) > 0)  { //se lelemento è contenuto ritorna true
                array_push($array, $item); // aggiunge il libro all'array che viene ritornato
            }
        }
        
        echo printBooks($array); // ritorna i libri trovati da cosa si ha cercato
    }
    
    function readCSV($csv) { // metodo per leggere un file .csv
        $file = fopen($csv, 'r');
        while (!feof($file)) {
            $line[] = fgetcsv($file, 1024);
        }
        fclose($file);
        array_shift($line);
        return $line;
    }

    function printBooks($csv) { // metodo per ritornare una stringa con tutti i libri da stampare
        $numLibri = count($csv) - 1; // conta quanti libri ci sono
        $print = "";
        for ($i=0; $i < floor($numLibri/6); $i++) { // righe da 6 deve stampare prima di non avere abbastanza libri
            $print .= "<tr>";
            for ($j=0; $j<6; $j++) { // aggiunge i 6 libri della riga alla stringa ritornata
                $print .= "<td><div id='" . $i*6+$j . "' + class='libro' onClick='openBook(" . $i*6+$j
                 . ")'><img src='./Copertine/" . $i*6+$j . ".jpg' alt='...' style='width: 100%;'><br><span>"
                 . $csv[$i*6+$j][1] . "</span><br><span><span>" . $csv[$i*6+$j][2] . "</span><br><span><span>"
                 . $csv[$i*6+$j][3] . "</span></div></td>";
            }
            $print .= "</tr>";
        }
        $print .= "<tr>";
        for ($i=0; $i <= floor($numLibri%6); $i++) { // continua a ciclare finchè finiscono i libri
            $idLibro = $numLibri-floor($numLibri%6)+$i;
            $print .= "<td><div id='" . $csv[$idLibro][0] . "' class='libro' onclick='openBook(" . $csv[$idLibro][0]
             . ")'><img src='./Copertine/". $csv[$idLibro][0] .".jpg' alt='...' style='width: 100%;'><br><span><span>"
             . $csv[$idLibro][1] . "</span><br><span><span>" . $csv[$idLibro][2] . "</span><br><span><span>"
             . $csv[$idLibro][3] . "</span></div></td>";
        }
       return $print; // ritorna i libri da stampare
    }
?>

<div>
    <div id="mySidenav" class="sidenav">
        <?php include "./SideNav.php" ?>  <!-- aggiunge la pagina del menu dentro un div -->
    </div>
</div>

<div id="main">
     <div>
        <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span> <!-- apre il menu quando si preme sopra -->
        <span style="font-size:30px;">Biblioteca SAMT</span>
    </div>
    <h1>Ricerca libri</h1>

    <!-- form per la ricerca dei libri -->
    <form method="post">
        <div>
            <span>Cerca libro per : </span>
            <select id="searchBy" name="searchBy">
                <option value="titolo">titolo</option>
                <option value="autore">autore</option>
            </select>
            <input type="text" id="search" name="search">
            <input type="submit" name="button" />
            <button onclick="top10()">Top 10 libri</button>
        </div>
    </form>
    <br>
    <div class="bookList">
        <table>
        <?php

            $csv = './db/Libro.csv'; 
            $csv = readCSV($csv); //legge il file dei libri e lo salva in una matrice
        
            if(array_key_exists('button', $_POST)) { // se viene premuto il bottone submit fa partire la ricerca altrimenti stampa tutti i libri
                search();
            }else {
                echo printBooks($csv);
            }
        ?>
        </tr>
        </table>
    </div>
</div>
</body>
</html>