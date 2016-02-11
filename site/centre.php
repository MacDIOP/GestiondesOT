<?php 
session_start();
include("ConnexionBD.php");

	if ( isset($_POST["CodeCentre"]) AND isset($_POST["Centre"]))
			{
				$Pilote = $_SESSION["Matricule"];
					$verifPilote = $bdd -> prepare ('select Idpilote from centre where CODE = :C');
					$verifPilote -> execute (array('C' => $_POST["CodeCentre"]));
						While($Donnees = $verifPilote -> fetch())
						{
							$rep = $Donnees["Idpilote"];
						}
			if (empty($rep))
				{
					$forcentre = $bdd -> prepare ('insert into centre (Code,NomCentre,Idpilote)
													Values (:code,:nom,:id)');
					$forcentre -> execute ( array ( 'code' => $_POST["CodeCentre"],
													'id' => $_SESSION["Matricule"],
													'nom' => $_POST["Centre"] ));
					$forcentre -> closeCursor();
					if ( isset ($_POST["zone"]) )
						{
							$forzone = $bdd -> prepare ('insert into zone (NOMZONE,CODE) values (:lazone,:lecode)');
							$forzone -> execute ( array ('lazone' => $_POST["zone"],
														 'lecode' => $_POST["CodeCentre"]	) );
							$forzone -> closeCursor ();
						}
					$lesr = $bdd -> prepare ('insert into sousrepartiteur (CODESR,NOMZONE) Values (:srf,:e) ');
					$lesr -> execute (array ( 'srf'=> $_POST["csr"], 'e'=> $_POST["zone"] ));
					$lesr -> closeCursor();	
				} else {echo '<script> alert("Le centre a deja un pilote"); </script>';}			
			} ELSE {echo '<script> alert("Verifier si toutes les données de centre sont bien remplies"); </script>';}
			//header('Location: edition.php');
?>			