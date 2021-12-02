<html>
<head>
     
<title>MostraNoleggi</title>
    <Link rel="shortcut icon" href="I1Cfumluc_fav.ico" type="image/x-icon">
    <Link rel="icon" href="i19fumluc_orario.html" type="image/x-icon">

 	<meta charset="UTF-8">
	<meta name="keywords" content="HTML,CSS,XML,JavaScript">
	<meta name="author" content="Luca Fumasoli I2C">
	<meta name="description" content="">

  <!--Chrome e windows 10-->
  <!--data creazione: 02.12.2021 data ultima modifica: 02.12.2021-->

<script src="myscripts.js"></script>
<link rel="stylesheet" type="text/css" href="./style.css">

</head>
<body>

<div>
    <div id="mySidenav" class="sidenav">
        <?php include "./AdminSideNav.php" ?>
    </div>
</div>

<div id="main">
    <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
    <span style="font-size:30px;">Biblioteca SAMT</span>
    <h2>Mostra noleggi</h2>

    <!-- lista degli utenti con bottone cancella e modifica -->
    <div>

        <table border="1">
            <tr style="background-color: #ddd; font-weight: bold;">
                <td>libro</td>
                <td>utente</td>
                <td>dataNoleggio</td>
                <td>dataConsegna</td>
                <td>dataLimteConsegna</td>
            </tr>

            <?php

            function readCSV($csv) {
                $file = fopen($csv, 'r');
                while (!feof($file) ) {
                    $line[] = fgetcsv($file, 1024);
                }
                fclose($file);
                return $line;
            }

            function returnBook() {
                $date = "s";

                $nol = "./db/Noleggio.csv";
                $nol = readCSV($nol);

                $nol = "";
            }

            $nol = "./db/Noleggio.csv";
            $nol = readCSV($nol);

            for ($row = 1; $row < count($nol) - 1; $row++): ?>

                <tr>

                    <form method="POST">

                        <td><p> <?php echo $nol[$row][0]; ?> </p></td>
                        <td><?php echo $nol[$row][1]; ?></td>
                        <td><?php echo $nol[$row][2]; ?></td>
                        <?php if ($nol[$row][3] == "") { ?>
                            <td><input type="submit" value="Libro consegnato"/></td>
                        <?php }else { ?>
                            <td><p> <?php echo $nol[$row][3] ?></p></td>
                        <?php } ?>
                       <td><?php echo $nol[$row][4]; ?></td>

                    </form>

                    <?php
                        if(array_key_exists('button', $_POST)) {
                            returnBook();
                        }
                    ?>
                </tr>

            <?php endfor; ?>
        </table>

    </div>
</div>
</body>
</html>