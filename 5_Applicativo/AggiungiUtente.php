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
        <?php include "./AdminSideNav.php" ?>  <!-- aggiunge la pagina del menu dentro un div -->
    </div>
</div>

<div id="main">
    <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span> <!-- apre il menu quando si preme sopra -->
    <span style="font-size:30px;">Biblioteca SAMT</span>
    <h2>Aggiungi utente</h2>

    <?php
        function readCSV($csv) { // metodo per leggere un file .csv
            $file = fopen($csv, 'r');
            while (!feof($file) ) {
                $line[] = fgetcsv($file, 1024);
            }
            fclose($file);
            return $line;
        }

        function aggiungiUtente() {
            $csv = "./db/Utente.csv";
            $csv = readCSV($csv); //legge il file degli utenti e lo salva in una matrice

            $array = array();
            $array[0] = count($csv)-1; //conta le righe della matrice e sottrae uno per a rida dei nomi delle colonne
            $array[1] = $_POST['nome'];
            $array[2] = $_POST['cognome'];
            $array[3] = $_POST['nome'] . "." .$_POST['cognome']; //mette il nome utente in automatico come il nome e cognome divisi da un punto 
            $array[4] = $_POST['password'];
            $array[5] = 0;
            $array[6] = $_POST['email'];
            
            if (str_contains($array[6], '@')) { // controlla che la mail contiene la @
                $handle = fopen("./db/Utente.csv", "a"); //apre il file di db dei noleggi ed aggiunge il nuovo noleggio
                fputcsv($handle, $array);
                fclose($handle);
            }else { // se la condizione da falso dice che la mail non è valida
                echo "email non valida";
            }
        }

    ?>

    <div>
        <!-- form per inserire le informazioni del nuovo utente -->
        <form  method="POST">
            <div class="form-group">
                <label>nome:</label><br>
                <input type="text" name="nome" value="" required/><br>
                <label>cognome:</label><br>
                <input type="text" name="cognome" value="" required/><br>
                <label>password:</label><br>
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