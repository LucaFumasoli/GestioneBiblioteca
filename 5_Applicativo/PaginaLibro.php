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
<script
    src="https://code.jquery.com/jquery-3.3.1.js"
    integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
    crossorigin="anonymous">
</script>

<script>

    $(function(){
        $("#mySidenav").load("./SideNav.html");
    });

    function goBack(){
        location.href = "./LibriNoleggiati.php";
    }

</script>

<style>

.libro {
    width: 100%; 
    height: 400px;
}

img {
    height: 80%;
}

</style>
</head>

<body>
<div>
    <div id="mySidenav" class="sidenav"></div>
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

    echo "<div id='" . $idLibro . "' class='libro'><h3>" . $csv[$idLibro][1] . "</h3><img src='./Copertine/" . $idLibro - 1 . ".jpg' alt='...'>";
    ?>
    <span style="vertical-align: top;">Autore: <?php echo $csv[$idLibro][2] ?></span><br>
    <span style="vertical-align: top;">Anno pubblicazione: <?php echo $csv[$idLibro][3] ?></span><br>
    <span style="vertical-align: top;">Descrizione: <?php echo $csv[$idLibro][4] ?></span><br>
    <button onclick="(goBack())">Indietro</button>
    </div>
    </div>
</body>  
</html>