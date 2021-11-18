<!DOCTYPE HTML>
<html>
<head>
 
    <title>Libro</title>
    <Link rel="shortcut icon" href="I1Cfumluc_fav.ico" type="image/x-icon">
    <Link rel="icon" href="i19fumluc_orario.html" type="image/x-icon">

    <meta charset="UTF-8">
    <meta name="keywords" content="HTML,CSS,XML,JavaScript">
    <meta name="author" content="Luca Fumasoli I2C">
    <meta name="description" content="">

  <!--Chrome e windows 10-->
  <!--data creazione: 21.10.2021 data ultima modifica: 21.10.2021-->

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

    <?php
        function readCSV($csv) {
            $file = fopen($csv, 'r');
            while (!feof($file)) {
                $line[] = fgetcsv($file, 1024);
            }
            fclose($file);
            return $line;
        }

        $csv = './db/Libro.csv';
        $csv = readCSV($csv);

        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $idLibro = substr($url, strpos($url, "=") + 1) + 1;

        echo "<div id='" . $idLibro . "' class='libro1'><h3>" . $csv[$idLibro][1] . "</h3><img src='./Copertine/" . $idLibro - 1 . ".jpg' alt='...'>";
    ?>
    <br>
    <span style="vertical-align: top;">Autore: <?php echo $csv[$idLibro][2] ?></span><br>
    <span style="vertical-align: top;">Anno pubblicazione: <?php echo $csv[$idLibro][3] ?></span><br>
    <span style="vertical-align: top;">Descrizione: <?php echo $csv[$idLibro][4] ?></span><br>
    <button onclick="(goBack())" class="button">Indietro</button>
</div>
</body>
</html>