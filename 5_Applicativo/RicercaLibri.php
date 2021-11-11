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


<script>

    function openBook(id){
        var libroID = id;

        var params = new URLSearchParams();
        params.append("libroID", libroID);

        var url = "./PaginaLibro.php?" + params.toString();
        location.href = url;
    }

    function top10(){
      //  location.href = "./LibriNoleggiati.php";
    }

    
</script>

<style>

.libro {
    border:1px solid black; 
    width: 200px; 
    height: 400px;
}

img {
    height: 80%;
}

</style>
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
    <h1>Ricerca libri</h1>

    <div>
        <span>Cerca titolo libro: </span>
        <input type="search" id="gsearch">
        <button onclick="search()">Cerca</button>
        <button onclick="top10()" style="margin-left: 30%;">Top 10 libri</button>
    </div>
    
    <div>
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

        $numLibri = 9;
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