<?php 
include("ConnexionBD.php");

	if(isset($_POST["OK"]))
	{	
		if(empty($_POST["Equipe"]))
		{
			echo '<script> alert("Veuillez Choisir Une Equipe"); </script>';
		}else
			{
				$team = $_POST["Equipe"];
					$orientation = $bdd -> prepare('update derangement set DATEORIENTATION = NOW(), CodeEquipe = :E, ETATOT = "Oriente" where ND = :N ');
						$orientation -> execute(array('E' => $team, 'N'=> $_POST["OT"])); 
						$orientation -> closeCursor();
					echo '<script> alert("Derangement Oriente avec succes"); </script>';
			}
	}	


				
?>				