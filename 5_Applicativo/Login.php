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

<body style="color: #191970;">
	<?php
	
		function loginUtente() {
			$userName = $_POST['nomeUtente'];
			$password = $_POST['password'];
			$csv = './db/Utente.csv';
			$users = readCSV($csv);

			if ($userName != null && $password != null) {
				if (verificaUtente($userName, $password, $users) == $password) {
					header('Location: ./LibriNoleggiati.php');
				}else {
					echo "Nome utente o password sbagliata";
				}
			}else {
				echo "Immettere nome utente e/o password";
			}
		}

        function readCSV($csv) { // metodo che legge il file csv passato come parametro
			$arr = array();
			$row = 1;
			if (($handle = fopen($csv, "r")) !== FALSE) {
				while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
					$num = count($data);
					$row++;
					for ($c=0; $c < $num; $c++) {
						$arr[$row][$c] = str_replace(' ', '', $data[$c]); //salva la cella del csv nella matrice togliendo gli spazi
					}
				}
				fclose($handle);
			}
			
			return $arr;
        }

		function verificaUtente($userName, $password, $arr) { //metodo che cerca se un elemento è contenuto in una matrice
			foreach ($arr as $item) { //scorre ogni riga della matrice
				if ($userName == $item[3]) { //se lelemento è contenuto ritorna true
					return $item[4] == $password;
				}
			}

			return false;
		}
    ?>

	<div style="display: hidden">
		<?php include "./SideNav.php" ?>
	</div>

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
		<p style="color: red">
		<?php
			if(array_key_exists('button', $_POST)) { // appena viene premuto il bottone submit fa partire la verifica dell'account
				loginUtente();
			}
		?>
		</p>
		</div>
	</form>
</body>  
</html>