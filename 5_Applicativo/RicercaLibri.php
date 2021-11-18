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
  <!--data creazione: 07.10.2021 data ultima modifica: 07.10.2021-->

<script src="myscripts.js"></script>
<link rel="stylesheet" type="text/css" href="./style.css">

</head>

<body>

<?php
    function search() {
        $csv = './db/Libro.csv';
        $csv = readCSV($csv);
        $csv2 = "";

        $searchBy = $_POST['searchBy'];
        $search = $_POST['search'];

        if ($search != null) {
            if ($searchBy == "titolo") {
                searchBook($csv, $search, 1);
            }else {
                searchBook($csv, $search, 2);
            }
        }
    }

    function searchBook($arr, $search, $col) { //metodo che cerca se un elemento è contenuto in una matrice
        $array = array();

        foreach ($arr as $item) { //scorre ogni riga della matrice
            if (strpos(strtolower($item[$col]), strtolower($search)) != false)  { //se lelemento è contenuto ritorna true
                array_push($array, $item); // aggiunge il libro all'array che viene ritornato
            }
        }
        
        $newContent = printBooks($array);

        $string = "";
        $string = preg_replace('/<div class="bookList">(.*?}<\/div>/', $newContent, $string);

        $csv2 = $array;
    }
    
    function readCSV($csv) {
        $file = fopen($csv, 'r');
        while (!feof($file)) {
            $line[] = fgetcsv($file, 1024);
        }
        fclose($file);
        array_shift($line);
        return $line;
    }

    function printBooks($csv) {
        $numLibri = count($csv) - 1;
        $print = "";
        for ($i=0; $i < floor($numLibri/6); $i++) {
            $print = "<tr>";
            for ($j=0; $j<6; $j++) {
                $print .= "<td><div id='" . $i*6+$j . "' + class='libro' onClick='openBook(" . $i*6+$j
                 . ")'><img src='./Copertine/" . $i*6+$j . ".jpg' alt='...' style='width: 100%;'><br><span>"
                 . $csv[1 + $i*6+$j][1] . "</span><br><span><span>" . $csv[1 + $i*6+$j][2] . "</span><br><span><span>"
                 . $csv[1 + $i*6+$j][3] . "</span></div></td>";
            }
            $print .= "</tr>";
        }
        $print .= "<tr>";
        for ($i=0; $i <= floor($numLibri%6); $i++) {
            $idLibro = $numLibri-floor($numLibri%6)+$i;
            $print .= "<td><div id='" . $csv[$idLibro][0] . "' class='libro' onclick='openBook(" . $csv[$idLibro][0]
             . ")'><img src='./Copertine/". $csv[$idLibro][0] .".jpg' alt='...' style='width: 100%;'><br><span><span>"
             . $csv[$idLibro][1] . "</span><br><span><span>" . $csv[$idLibro][2] . "</span><br><span><span>"
             . $csv[$idLibro][3] . "</span></div></td>";
        }
       return $print;
    }
?>

<div>
    <div id="mySidenav" class="sidenav">
        <?php include "./SideNav.php" ?>
    </div>
</div>
<div id="main">
    <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
    <span style="font-size:30px;">Biblioteca SAMT</span>
    <h1>Ricerca libri</h1>

    <form method="post">
        <div>
            <span>Cerca libro per : </span>
            <select id="searchBy" name="searchBy">
                <option value="titolo">titolo</option>
                <option value="autore">autore</option>
            </select>
            <input type="text" id="search" name="search">
            <td> <input type="submit" name="button" />
            
        </div>
    </form>

    <button onclick="top10()" style="margin-left: 30%;">Top 10 libri</button>

    <div class="bookList">
        <table>
        <?php

        $csv = './db/Libro.csv';
        $csv = readCSV($csv);
        
        echo printBooks($csv);

        ?>
        <?php
                if(array_key_exists('button', $_POST)) { // appena viene premuto il bottone submit fa partire la verifica dell'account
                    search();
                }
            ?>
        </tr>
        </table>
    </div>
</div>
</body>
</html>