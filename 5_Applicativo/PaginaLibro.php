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
  <!--data creazione: 21.10.2021 data ultima modifica: 25.11.2021-->

<script src="myscripts.js"></script>
<link rel="stylesheet" type="text/css" href="./style.css">
<style>

* {
  box-sizing: border-box;
}

</style>
</head>

<body>
<div>
    <div id="mySidenav" class="sidenav">
        <?php include "./SideNav.php" ?>  <!-- aggiunge la pagina del menu dentro un div coperto -->
    </div>
</div>
<div id="main">
    <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span> <!-- apre il menu quando si preme sopra -->
    <span style="font-size:30px;">Biblioteca SAMT</span>

    <?php
        function readCSV($csv) { // metodo per leggere un file csv
            $file = fopen($csv, 'r');
            while (!feof($file)) {
                $line[] = fgetcsv($file, 1024);
            }
            fclose($file);
            return $line;
        }

        $csv = './db/Libro.csv';
        $csv = readCSV($csv);

        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; //prende l'url e lo slava in una variabile
        $idLibro = substr($url, strpos($url, "=") + 1) + 1; // prende solo la parte in cui c'è l'id della variabile

        function rentBook() {
            $array = array();
            $idUtente = 0;
            $array[0] = $idUtente;
            $array[1] = $idUtente;
			$array[2] = $_POST['dataR'];
            $array[3] = "";
			$array[4] = date('Y-m-d', strtotime($array[2] . "+1 months"));  //aggiunge un mese alla data di ritiro per la consegna
            
            $handle = fopen("./db/Noleggio.csv", "a"); //apre il file di db dei noleggi ed aggiunge il nuovo noleggio
            fputcsv($handle, $array);
            fclose($handle);
        }
   ?>

    <div class="row">
        <div class="column" style="background-color:#aaa;">
            <!-- stampa il titolo e la copertina del libro -->
            <?php echo "<h2>" . $csv[$idLibro][1] . "</h2><img src='./Copertine/" . $idLibro - 1 . ".jpg' alt='...'>"; ?>
        </div>
        <div class="column2" style="background-color:#bbb;">
            <!-- stampa le altre informazioni del libro -->
            <span style="vertical-align: top;">Autore: <?php echo $csv[$idLibro][2] ?></span><br>
            <span style="vertical-align: top;">Anno pubblicazione: <?php echo $csv[$idLibro][3] ?></span><br>
            <span style="vertical-align: top;">Casa editrice: <?php echo $csv[$idLibro][4] ?></span><br>
            <span style="vertical-align: top;">Trama: <?php echo $csv[$idLibro][5] ?></span><br>
            <button class="button" onclick="openForm()">Noleggia libro</button>
        </div>
    </div>
    <!-- torna alla pagina precedente -->
    <button onclick="(goBack())" class="button">Indietro</button>
</div>
<br>
<br>
<br>

<div class="form-popup" id="myForm">
    
    <!-- form per noleggiare un libro -->
    <form  method="post" class="form-container">
    <h1>Noleggia libro</h1>

    <label for="dataR"><b>Data ritiro</b></label><br>
    <input type="date" name="dataR" id="dataR" required><br><br>

    <button type="submit" class="btn" name="btn">Noleggia</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Cancella</button>
    <p style="color: red">
        <?php
            if(array_key_exists('btn', $_POST)) {
                rentBook();
            }
        ?>
    </p>
  </form>
</div>

</body>
</html>