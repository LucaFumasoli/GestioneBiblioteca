<!DOCTYPE HTML>
<html>
<head>
 
    <title>Login</title>
    <Link rel="shortcut icon" href="I1Cfumluc_fav.ico" type="image/x-icon">
    <Link rel="icon" href="i19fumluc_orario.html" type="image/x-icon">

 	<meta charset="UTF-8">
	<meta name="keywords" content="HTML,CSS,XML,JavaScript">
	<meta name="author" content="Luca Fumasoli I2C">
	<meta name="description" content="">

  <!--Chrome e windows 10-->
  <!--data creazione: 07.10.2021 data ultima modifica: 07.10.2021-->

<script>
    
    function VerificaPassword() {

    	ConfirmStatus = true;

    	if (ConfirmStatus == true) {
        	window.location.replace("./LibriNoleggiati.php");
    	}
    }

</script>
<style>

div {
	width: 400px;
	height: 400px;
	position: absolute;
	top: 35%;
	left: 40%;
	text-align:center;
	margin: 0;
	margin-top: -100px;
	margin-left: -100px;
}

table {
	width: 300px;
	height: 300px;
	margin-left: auto; 
	margin-right: auto;
	border: 1px solid black;
}

button {
    background-color: #008BD3;
    display: block;
    margin: 10px 0;
    padding: 10px;
    width: 100%;
    color: #ffffff;
}

input {
    display: block;
    width: 95%;
}

</style>

</head>

<body>
	<?php
        function readCSV($csv) {
            $file = fopen($csv, 'r');
            while (!feof($file) ) {
                $line[] = fgetcsv($file, 1024);
            }
            fclose($file);
            return $line;
        }

        $csv = './db/Utente.csv';
        $csv = readCSV($csv);


		if(array_key_exists('button', $_POST)) {
            verificaPassword();
        }

		function verificaPassword() {
			$userName = $_POST['nomeUtente'];
			$password = $_POST['password'];

			if (in_array($userName, $csv)) {
	            header('Location: ./LibriNoleggiati.php');
	        }else {
	        	echo "nome utenet sbagliato";
	        }
        }
    ?>

    <form method="post">
		<div>
		<table>
			<tr style="background-color: #ddd;">
				<td style="text-align: center;">
					<h3>Biblioteca SAMT</h3>
				</td>
			</tr>
			<tr>
				<td style="text-align: left;">Nome utente: </td>
			</tr>
			<tr>
				<td><input type="text" name="nomeUtente" id="nomeUtente"></td>
			</tr>
			<tr>
				<td style="text-align: left;">Password: </td>
			</tr>
			<tr>
				<td><input type="text" name="password" id="password"></td>
			</tr>
			<tr>
				<td> <input type="submit" name="button" class="button" />
            </td>
			</tr>
		</table>
		</div>
    </form>

</body>  
</html>