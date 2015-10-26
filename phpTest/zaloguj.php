<?php
session_start();
	

	if ((empty($_POST['paczki'])) || (empty($_POST['grzebieni']))){
		
		header('Location: index.php');                                              // Jesli z posta nie przeszly dane formularza to exit
		exit();
		
	}

require_once("connect.php");

$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
	if($polaczenie->connect_errno!=0)    // Jesli polaczenie uda sie ustanowic to connect_errno = 0;
		{
			echo "Error: " .$polaczenie->connect_errno; // . " Opis: ".$polaczenie->connect_error; Nie uzywac bo widac nazwe usera
			// connect_erno - numer bledu, connect error - opis bledu
		}

$login = $_POST['paczki'];
$haslo = $_POST['grzebieni'];

$baza = $polaczenie->query(sprintf( "SELECT * FROM uzytkownicy WHERE user='%s' and pass='%s'",
			mysqli_real_escape_string($polaczenie,$login),
			mysqli_real_escape_string($polaczenie,$haslo)));

			
if ( $baza->num_rows )
{
	$_SESSION['zalogowany'] = true;
	$wiersz = $baza->fetch_assoc();
	$drewno = $wiersz['drewno'];
	
	echo "Udało ci sie zalogować<br /> Twoje drewno to ".$drewno;
	$baza->free();
}else{
	echo "niepoprawne dane";
}


$polaczenie->close();
?>