<html>
<head>
        
<title>AggiungiUtente</title>
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
    <h2>Aggiungi utente</h2>

    <?php
        function readCSV($csv) {
            $file = fopen($csv, 'r');
            while (!feof($file) ) {
                $line[] = fgetcsv($file, 1024);
            }
            fclose($file);
            return $line;
        }

        function aggiungiUtente() {
            $csv = "./db/Utente.csv";
            $csv = readCSV($csv);

            $array = array();
            $array[0] = count($csv)-1;
            $array[1] = $_POST['nome'];
            $array[2] = $_POST['cognome'];
            $array[3] = $_POST['nome'] . "." .$_POST['cognome'];
            $array[4] = $_POST['password'];
            $array[5] = 0;
            $array[6] = $_POST['email'];
            
            if (str_contains($array[6], '@')) {
                $handle = fopen("./db/Utente.csv", "a"); //apre il file di db dei noleggi ed aggiunge il nuovo noleggio
                fputcsv($handle, $array);
                fclose($handle);
            }else {
                echo "email non valida";
            }
        }

    ?>

    <div>
        <form  method="POST">
            <div class="form-group">
                <label>nome</label><br>
                <input type="text" name="nome" value="" required/><br>
                <label>cognome</label><br>
                <input type="text" name="cognome" value="" required/><br>
                <label>password</label><br>
                <input type="password" name="password" value="" required/><br>
                <label>e-mail:</label><br>
                <input type="text" name="email" value="" required/><br>
                <p></p>
                <input type="submit" name="button" value="button"/>
            </div>
        </form>
        <?php
			if(array_key_exists('button', $_POST)) { // appena viene premuto il bottone submit fa partire la verifica dell'account
				aggiungiUtente();
			}
		?>
    </div>
</div>
</body>
</html>