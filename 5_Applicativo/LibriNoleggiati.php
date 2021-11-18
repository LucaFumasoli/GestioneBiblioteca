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
  <!--data creazione: 07.10.2021 data ultima modifica: 07.10.2021-->

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

        $csv = './db/Libro.csv';
        $csv = readCSV($csv);

        $nol = './db/Noleggio.csv';
        $nol = readCSV($nol);

        $numLibri = count($nol) - 2;
        for ($i=0; $i < floor($numLibri/6); $i++) {
            echo "<tr>";
            for ($j=0; $j<6; $j++) {
                echo "<td><div id='" . $i*6+$j . "' + class='libro' onClick='openBook(" . $i*6+$j
                 . ")'><img src='./Copertine/" . $i*6+$j . ".jpg' alt='...' style='width: 100%;'><br><span>"
                 . $csv[1 + $i*6+$j][1] . "</span><br><span><span>" . $csv[1 + $i*6+$j][2] . "</span><br><span><span>"
                 . $csv[1 + $i*6+$j][3] . "</span></div></td>";
            }
            echo "</tr>";
        }
        echo "<tr>";
        for ($i=0; $i <= floor($numLibri%6); $i++) {
            $idLibro = $numLibri-floor($numLibri%6)+$i;
            echo "<td><div id='" . $idLibro . "' class='libro'  onclick='openBook(" . $idLibro
             . ")'><img src='./Copertine/". $idLibro .".jpg' alt='...' style='width: 100%;'><br><span><span>"
             . $csv[$idLibro+1][1] . "</span><br><span><span>" . $csv[$idLibro+1][2] . "</span><br><span><span>"
             . $csv[$idLibro+1][3] . "</span></div></td>";
        }
        ?>
        </tr>
        </table>
    </div>
</div>
</body>  
</html>