<?php
// On démarre la session
session_start ();
	if( isset($_SESSION['Identifiant']) )
	{
		// On détruit les variables de notre session
		session_unset ();
		// On détruit notre session
		session_destroy ();
		// On redirige le visiteur vers la page d'accueil
		header ('location: index.php');
	} ELSE 
	{
			echo "<script> alert('Session Fermee! Connectez vous!');  </script>";
				header('Location: index.php');
	}

?>