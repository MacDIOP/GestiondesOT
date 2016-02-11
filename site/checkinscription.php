<?php 
session_start();
include("ConnexionBD.php");
		
	if (isset ($_POST['Matricule']))
	{
		$Mat = $_POST['Matricule'];
		$Verif = $bdd -> query('Select journalequipe.CODEEQUIPE,agent.MATRICULE,agent.NOMAGENT,agent.PRENOMAGENT   
			FROM journalEquipe Natural JOIN agent');
				
					while ($donnees = $Verif -> fetch() )
						{
							if ($_POST['Matricule'] == $donnees["MATRICULE"] ) //Verification du matricule
							{
								$Presence = true;
								$Equipe = $donnees["CodeEquipe"]; //Recuperation de l'equipe
								$VraiNom = $donnees["NOMAGENT"]; // Recuperation du nom et prenom
								$VraiPrenom = $donnees["PRENOMAGENT"];	
							}  
						}					
		$Verif -> closeCursor();
		
		if(isset($Presence))
		{
			if ( isset($_POST['passwdCE']) AND isset($_POST['copasswdCE']) )
				{
					$Mdp = $_POST['passwdCE'];
					$Mdp2 = $_POST['copasswdCE'];
					if ($Mdp == $Mdp2)
					{
						$Inscription = $bdd -> prepare ('Insert into utilisateur (Matricule,statut,password,nom,Prenom)
										 Values (:Matricule,:level,:passwd,:nameuser,:prenomuser)');
									$Inscription -> execute (array ( 
										 'Matricule' => $Mat,
										 'level' => "Chef Equipe",	
										 'passwd' => $Mdp,
										 'nameuser' => $VraiNom,
										 'prenomuser' => $VraiPrenom));
										 
									$Inscription->closeCursor();
									header('Location: index.php');
									
					}else {echo "<script> alert('Mot de passe Non conformes');  </script>";}
				} else {echo "<script> alert('Saisir un mot de passe');  </script>";}
		
		}Else { echo "<script> alert('Vous n\'etes pas chef Equipe');  </script>"; }
		
		
		
	} else
		if(isset ($_POST["Idpilote"]))
		{
			if ( isset($_POST['passwdP']) AND isset($_POST['copasswdP']) )
				{
					$MdpP = $_POST['passwdP'];
					$MdpP2 = $_POST['copasswdP'];
					if ($MdpP == $MdpP2)
					{
						$Inscription = $bdd -> prepare ('Insert into utilisateur (Matricule,statut,password,nom,Prenom)
										 Values (:Matricule,:level,:passwd,:nameuser,:prenomuser)');
									$Inscription -> execute (array ( 
										 'Matricule' => $_POST["Idpilote"],
										 'level' => "Pilote",	
										 'passwd' => $MdpP,
										 'nameuser' => $_POST["Nom"],
										 'prenomuser' => $_POST["Prenom"]));
										 
									$Inscription->closeCursor();
									header('Location: index.php');
									
					}else {echo "<script> alert('Mot de passe Non conformes');  </script>";}
				} else {echo "<script> alert('Saisir un mot de passe');  </script>";}	
		} else
			if(isset($_POST["Edition"]))
				{
		// Verification de l existance des donnees a modifier			
					if (empty($_POST["LID"]) OR ($_POST["LID"] == $_SESSION["Matricule"]) /*OR ($_POST["LID"] = " ")*/ ) 
						{ 
							// Pas de modification de l identifiant
						}else
							{// Modification des donnees de l identifiant par sa variable de session
								$newid = $_POST["LID"];
									if ($newid != $_SESSION["Matricule"])
										{
											$modifier = $bdd -> prepare('UPDATE utilisateur SET Matricule = :M where Matricule = :NM');
												// M = le nouveau Matricule ,OM = L ancien Matricule
											$modifier -> execute(array(
																 'M' => $newid,
																 'NM' => $_SESSION["Matricule"]	
																	));
											$modifier -> closeCursor();	
										}
							}  		
				// Modification du mot de passe		
						if(isset($_POST["pass"]))
							{
								$Modpass = $_POST["pass"]; $Modpass2 = $_POST["pass2"];  
									if ($Modpass != $Modpass2) // Verification des deux MDP
										{
											echo "<script> alert('Les deux mot de passe ne sont pas conformes');  </script>";
										}else 
											{
												$Nouveaupass = $bdd -> prepare('UPDATE utilisateur SET password = :P where Matricule = :I');
												$Nouveaupass -> execute(array('P' => $Modpass,'I' => $_SESSION["Matricule"] ));
												$Nouveaupass -> closeCursor();
											}
							}
				// Le reste des modifications (Nom et Prenom)			
						if ( empty($_POST["lenom"]) OR empty($_POST["prenom"]) )
							{
								//Nom ou prenom Videes
							} else
								{
									$nometprenom = $bdd -> prepare('UPDATE utilisateur Set nom = :NN, Prenom = :NP where Matricule = :F');
									// NN = Le nouveau Nom ,NP = Le nouveau Prenom
									$nometprenom -> execute(array('NN' => $_POST["lenom"],'NP' => $_POST["prenom"],'F' => $_SESSION["Matricule"] ));
									$nometprenom -> closeCursor();
								}
						header('Location: index.php');		
				}else {echo "<script> alert('Choisissez votre statut et Inscrivez vous!');  </script>";}

		?>				
