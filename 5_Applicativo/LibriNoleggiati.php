<!DOCTYPE HTML>
<html>
<head>
 
    <title>Libri noleggiati</title>
    <Link rel="shortcut icon" href="I1Cfumluc_fav.ico" type="image/x-icon">
    <Link rel="icon" href="i19fumluc_orario.html" type="image/x-icon">

    <meta charset="UTF-8">
    <meta name="keywords" content="HTML,CSS,XML,JavaScript">
    <meta name="author" content="Luca Fumasoli I2C">
    <meta name="description" content="">

  <!--Chrome e windows 10-->
  <!--data creazione: 07.10.2021 data ultima modifica: 25.11.2021-->

<style>

.libro {
    border:1px solid black; 
    width: 200px; 
    height: 400px;
}

</style>

<script src="myscripts.js"></script>
<link rel="stylesheet" type="text/css" href="./style.css">

</head>

<body>
<div>
    <div id="mySidenav" class="sidenav">
        <?php include "./SideNav.php" ?>  <!-- aggiunge la pagina del menu dentro un div -->
    </div>
</div>
<div id="main">
    <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span> <!-- apre il menu quando si preme sopra -->
    <span style="font-size:30px;">Biblioteca SAMT</span>
    <h1>Libri noleggiati</h1>
    <div>

        <table>

        <?php
            function readCSV($csv) { // metodo per leggere un file .csv
                $file = fopen($csv, 'r');
                while (!feof($file) ) {
                    $line[] = fgetcsv($file, 1024);
                }
                fclose($file);
                return $line;
            }

            function getUserID() { // metodo per prendere l'id dell'utente
                $csv = './db/Utente.csv';
                $csv = readCSV($csv); //legge il file degli utenti e lo salva in una matrice

                for ($i=1; $i < count($csv); $i++) { //scorre la matrice
                    if (str_replace(' ', '', $csv[$i][3]) == $_COOKIE['userName']) { //controlla se il nome utente della riga è uguale al nome utente salvato nel cookie
                        return $csv[$i][0]; //ritorna l'id dell'utente
                    }
                }
            }

            function getRentedBooksID($id) { // metodo per prendere tutti i libri noleggiati dall'utente
                $csv = './db/Noleggio.csv';
                $csv = readCSV($csv); //legge il file dei noleggi e lo salva in una matrice

                $arr = array();

                for ($i=1; $i < count($csv) - 1; $i++) { //scorre la matrice
                    if ($csv[$i][2] == $id && $csv[$i][4] == "") { // controlla che l'id sia uguale a quello sulla riga e che il libro non sia già stato ritornato
                        array_push($arr, $csv[$i][1]); // aggiunge il libro all'array
                    }
                }
                
                return $arr; // ritorna l'array
            }

            function getBooks($books) { // metodo che restituisce i libri noleggiati
                $csv = './db/Libro.csv';
                $csv = readCSV($csv); //legge il file dei libri e lo salva in una matrice

                $arr = array();

                for ($i=1; $i < count($csv); $i++) {
                    if (in_array($csv[$i][0], $books)) { // condizione per sapere se l'id del libro è uno di quelli dei libri noleggiati
                        array_push($arr, $csv[$i]); // aggiunge la linea della matrice dei noleggi alla matrice ceh veine ritornata
                    }
                }

                return $arr; //ritorna la matrice
            }

            function printBooks($csv) { // metodo per ritornare una stringa con tutti i libri da stampare
                $numLibri = count($csv) - 1; // conta quanti libri ci sono
                $print = "";
                for ($i=0; $i < floor($numLibri/6); $i++) {// righe da 6 deve stampare prima di non avere abbastanza libri
                    $print = "<tr>";
                    for ($j=0; $j<6; $j++) { // aggiunge i 6 libri della riga alla stringa ritornata
                        $print .= "<td><div id='" . $i*6+$j . "' + class='libro' onClick='openBook(" . $i*6+$j
                         . ")'><img src='./Copertine/" . $i*6+$j . ".jpg' alt='...' style='width: 100%;'><br><span>"
                         . $csv[$i*6+$j][1] . "</span><br><span><span>" . $csv[$i*6+$j][2] . "</span><br><span><span>"
                         . $csv[$i*6+$j][3] . "</span></div></td>";
                    }
                    $print .= "</tr>";
                }
                $print .= "<tr>";
                for ($i=0; $i <= floor($numLibri%6); $i++) {// continua a ciclare finchè finiscono i libri
                    $idLibro = $numLibri-floor($numLibri%6)+$i;
                    $print .= "<td><div id='" . $csv[$idLibro][0] . "' class='libro' onclick='openBook(" . $csv[$idLibro][0]
                     . ")'><img src='./Copertine/". $csv[$idLibro][0] .".jpg' alt='...' style='width: 100%;'><br><span><span>"
                     . $csv[$idLibro][1] . "</span><br><span><span>" . $csv[$idLibro][2] . "</span><br><span><span>"
                     . $csv[$idLibro][3] . "</span></div></td>";
                }

               return $print; // ritorna i libri da stampare
            }

            $id = getUserID(); // prende l'id dell'utente
            $books = getRentedBooksID($id); // prende gli id dei libri noleggiati dall'id dell'utente
            $books = getBooks($books); // prende i libri  noleggiati
            if (empty($books)) { // se l'array è vuoto stampa che non ci sono libri noleggiati altrimenti stampa i libri noleggiati
                echo "Al momento non hai nessun libro noleggiato";
            }else{
                echo printBooks($books);
            }
        ?>
        </tr>
        </table>
    </div>
</div>
</body>
</html>