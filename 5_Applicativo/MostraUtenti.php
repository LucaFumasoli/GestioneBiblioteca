<html>
<head>
        
<title>MostraUtenti</title>
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
    <h2>Mostra utenti</h2>

    <!-- lista degli utenti con bottone cancella e modifica -->
    <div>

        <table border="1">
            <tr style="background-color: #ddd; font-weight: bold;">
                <td>id</td>
                <td>nome</td>
                <td>cognome</td>
                <td>nome utente</td>
                <td>password</td>
                <td>amministratore</td>
                <td>mail</td>
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

            $users = "./db/Utente.csv";
            $users = readCSV($users);

            for ($row = 1; $row < count($users) - 1; $row++): ?>

                <tr>

                    <form method="POST">

                        <td><input name="id" type="text" value="<?php echo $users[$row][0]; ?>" style="border-style: hidden" readonly></td>
                        <td><input name="nome" type="text" value="<?php echo $users[$row][1]; ?>" style="border-style: hidden"></td>
                        <td><input name="cognome" type="text" value="<?php echo $users[$row][2]; ?>" style="border-style: hidden"></td>
                        <td><input name="nomeutente" type="text" value="<?php echo $users[$row][3]; ?>" style="border-style: hidden"></td>
                        <td><input name="password" type="password" value="<?php echo $users[$row][4]; ?>" style="border-style: hidden"></td>
                        <td><input name="amministratore" type="text" value="<?php echo $users[$row][5]; ?>" style="border-style: hidden"></td>
                        <td><input name="email" type="text" value="<?php echo $users[$row][6]; ?>" style="border-style: hidden"></td>

                    </form>
                </tr>

            <?php endfor; ?>
        </table>

    </div>
</div>
</body>
</html>