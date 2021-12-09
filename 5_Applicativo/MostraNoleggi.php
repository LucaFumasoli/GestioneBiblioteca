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
        <?php include "./AdminSideNav.php" ?> <!-- aggiunge la pagina del menu dentro un div -->
    </div>
</div>

<div id="main">
    <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span> <!-- apre il menu quando si preme sopra -->
    <span style="font-size:30px;">Biblioteca SAMT</span>
    <h2>Mostra noleggi</h2>

    <!-- lista degli utenti con bottone cancella e modifica -->
    <div>

        <table border="1">
            <tr style="background-color: #ddd; font-weight: bold;">
                <td>Noleggio</td>
                <td>Libro</td>
                <td>Utente</td>
                <td>Data noleggio</td>
                <td>Data consegna</td>
                <td>Data limite consegna</td>
                <td>Valutazione</td>
            </tr>

            <?php

                function readCSV($csv) { // metodo per leggere un file .csv
                    $file = fopen($csv, 'r');
                    while (!feof($file) ) {
                        $line[] = fgetcsv($file, 1024);
                    }
                    fclose($file);
                    return $line;
                }
                
                function writeCSV($mat) {
                    $handle = fopen("./db/Noleggio.csv", "w"); //apre il file di db dei noleggi ed aggiunge il nuovo noleggio
                    array_pop($mat); // rimuove l'ultima riga della matrice

                    foreach ($mat as $row) { //scorre ogni riga della matrice e la salva nel file
                        fputcsv($handle, $row);
                    }

                    fclose($handle);
                }

                function returnBook($nol) {
                    $nol += 1; // aumenta l'id di 1 per saltare la riga dei nomi delle colonne
                    $date = date("d-m-Y");

                    $nolArr = "./db/Noleggio.csv";
                    $nolArr = readCSV($nolArr); // salva il file dei noleggi in una matrice

                    $nolArr[$nol][4] = $date; // aggiunge la data alla colonna delle date
                    $nolArr[$nol][6] = $_POST['rating']; // prende la valutazione e la salva nella colonna delle valutazioni

                    writeCSV($nolArr); // scrive la matrice con i valori del ritiro nel file dei noleggi
                }

            $fileName = "./db/Noleggio.csv";
            $nol = readCSV($fileName); //legge il file dei noleggi e lo salva in una matrice

            for ($row = 1; $row < count($nol) - 1; $row++): ?>
                
                <tr>
                    <form method="POST">
                        
                        <?php $nol = readCSV($fileName); ?> <!-- salva il file dei noleggi in una matrice e mette il contenuto nella tabella-->
                        <?php $idNol = "button" . $nol[$row][0]  ?>
                        <td><p> <?php echo $nol[$row][0]; ?> </p></td>
                        <td><p> <?php echo $nol[$row][1]; ?> </p></td>
                        <td><?php echo $nol[$row][2]; ?></td>
                        <td><?php echo $nol[$row][3]; ?></td>
                        <td><p> <?php echo $nol[$row][4] ?></p></td>
                        <td><?php echo $nol[$row][5]; ?></td>
                        <td>
                        <?php if ($nol[$row][4] == "") { ?> <!-- Controlla se il libro è stato ritornato, se no mostra il select per insaerire la valutazione altrimenti mette la valutazione corretta -->
                            <select id="rating" name="rating">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        <?php }else { ?>
                            <p> <?php echo $nol[$row][6] ?></p>
                        <?php } ?>
                        </td>
                        <?php if ($nol[$row][4] == "") { ?> < <!-- Controlla se il libro è stato ritornato, se non è stato ritornato mostra il bottone per ritornarlo altrimenti non lo mostra -->
				            <td><input type="submit" name="<?php echo $idNol ?>" class="<?php echo $idNol ?>" value="Libro consegnato"/>
                        <?php } ?>

                        <?php
                            if(array_key_exists($idNol, $_POST)) { //se il bottone viene schiacciato fa partire il metodo per marcare il libro come ritornato
                                returnBook($nol[$row][0]);
                                echo '<head><meta http-equiv="refresh" content="0"></head>'; // refresha la pagina in modo da caricare il file dei noleggi modificato
                            }
                        ?>
                    </form>

                </tr>

            <?php endfor; ?>
        </table>

    </div>
</div>
</body>
</html>