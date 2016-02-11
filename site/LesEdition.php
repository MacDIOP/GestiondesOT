<?php 
include("ConnexionBD.php");
			
		if ( isset($_POST["CodeAgent"]) )
			{
					$agent = $_POST["CodeAgent"]; $name = $_POST["Name"]; $prenom =$_POST["lastname"]; 
				
				$rempliragent = $bdd -> prepare ( 'insert into agent (MATRICULE,NOMAGENT,PRENOMAGENT)
																VALUES (:lagent,:sonNom,:SonPrenom) ');
				$rempliragent -> execute ( array ( 'lagent' => $agent,
												   'sonNom' => $name ,
												   'SonPrenom' => $prenom ));
				$rempliragent -> closeCursor();
			} else 

				if (  isset($_POST["Lequip"])  AND isset($_POST["Numagent"])  )
					{
						if ( isset($_POST["chefteam"]) AND isset($_POST["prenom"]) )
						{
							$chef = $bdd -> prepare ('insert into agent (MATRICULE,NOMAGENT,PRENOMAGENT) 		
													VALUES (:code,:agt,:prn) ');
							$chef -> execute ( array ('code' => $_POST["Numagent"],
													  'agt' => $_POST["chefteam"],
													  'prn' => $_POST["prenom"]));
													  
							$chef -> closeCursor();	
						} else {echo '<script> alert("Verifier Le Nom et le Prenom "); </script>';}
						
						$remplirteam = $bdd -> prepare ('insert into journalequipe (CODEEQUIPE,MATRICULE,idPilote,DATEFORMATION)
																			VALUES (:a,:b,:c,now()) ');
						$remplirteam -> execute (array (
															'a' => $_POST["Lequip"],
															'b' => $_POST["Numagent"],
															'c' => $_SESSION["Matricule"]));
						$remplirteam -> closeCursor();
						header('Location: historiquedesteams.php');
					} ELSE {}
?>	