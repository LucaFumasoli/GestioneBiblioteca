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
        <?php include "./SideNav.php" ?>
    </div>
</div>
<div id="main">
    <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
    <span style="font-size:30px;">Biblioteca SAMT</span>
    <h1>Libri noleggiati</h1>
    <div>

        <script type="text/javascript">
            var array = <?php echo json_encode($csv); ?>;
            console.log[1][1];
        </script>

        <table>

        <?php
            function readCSV($csv) {
                $file = fopen($csv, 'r');
                while (!feof($file) ) {
                    $line[] = fgetcsv($file, 1024);
                }
                fclose($file);
                return $line;
            }

            function getUserID() {
                $csv = './db/Utente.csv';
                $csv = readCSV($csv);

                for ($i=1; $i < count($csv); $i++) {
                    if (str_replace(' ', '', $csv[$i][3]) == $_COOKIE['userName']) {
                        return $csv[$i][0];
                    }
                }
            }

            function getRentedBooksID($id) {
                $csv = './db/Noleggio.csv';
                $csv = readCSV($csv);

                $arr = array();

                for ($i=1; $i < count($csv) - 1; $i++) {
                    if ($csv[$i][1] == $id) {
                        array_push($arr, $csv[$i][0]);
                    }
                }
                
                return $arr;
            }

            function getBooks($books) {
                $csv = './db/Libro.csv';
                $csv = readCSV($csv);

                $arr = array();

                for ($i=1; $i < count($csv); $i++) {
                    if (in_array($csv[$i][0], $books)) {
                        array_push($arr, $csv[$i]);
                    }
                }
                
                return $arr;
            }

            function printBooks($csv) {
                $numLibri = count($csv) - 1;
                $print = "";
                for ($i=0; $i < floor($numLibri/6); $i++) {
                    $print = "<tr>";
                    for ($j=0; $j<6; $j++) {
                        $print .= "<td><div id='" . $i*6+$j . "' + class='libro' onClick='openBook(" . $i*6+$j
                         . ")'><img src='./Copertine/" . $i*6+$j . ".jpg' alt='...' style='width: 100%;'><br><span>"
                         . $csv[$i*6+$j][1] . "</span><br><span><span>" . $csv[$i*6+$j][2] . "</span><br><span><span>"
                         . $csv[$i*6+$j][3] . "</span></div></td>";
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

                if (is_null($print)) {
                    $print = "Al momento non hai nessun libro noleggiato";
                }
                   return $print;
            }

            $id = getUserID();
            $books = getRentedBooksID($id);
            $books = getBooks($books);
            echo printBooks($books);
        ?>
        </tr>
        </table>
    </div>
</div>
</body>
</html>