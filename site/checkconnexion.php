<?php
session_start();
	
include("ConnexionBD.php");

	if ( isset($_POST['iduser']) AND isset($_POST['passwd']) )
	{		
		$Guest = $_POST['iduser'];		$Passwdguest = $_POST['passwd'] ;
		
		 $lesid = $bdd -> query ('select Matricule from utilisateur');
		  while ($donnees = $lesid -> fetch() )
		  {
			  if ( $Guest == $donnees['Matricule'] )
			  {
				$Presence = true;	
			  }
		  }
		  $lesid -> closeCursor();
		  if (isset($Presence)) 
		  {
			  $requeteconnexion = $bdd -> prepare('Select nom,Prenom,statut,password from utilisateur where Matricule=:id');
				$requeteconnexion -> execute ( Array (':id' => $Guest ));
					while ($donnees = $requeteconnexion -> fetch())
						{ 							
								if ( $Passwdguest == $donnees['password'] )
								{
						/*************LES VARIABLES DE SESSIONS***********/
									$_SESSION['Matricule'] = $Guest; //Login
									$_SESSION['Nom'] = $donnees['nom']; //Nom
									$_SESSION['Prenom'] = $donnees['Prenom']; //Prenom
									$_SESSION['Statut'] = $donnees['statut']; //Statut 
									setcookie("utilisateur[login]",$Guest,time()+86400);
									setcookie("utilisateur[Nom]",$donnees['nom'],time()+86400);
									setcookie("utilisateur[Prenom]",$donnees['Prenom'],time()+86400);
									$requeteconnexion -> closeCursor(); 
									if ($_SESSION['Statut']== "Chef Equipe")
									{
									// Redirection des profils vers les pages appropries.
										$recupEquip = $bdd -> prepare('select CODEEQUIPE from journalequipe where Matricule= :M');
											$recupEquip -> execute ( array ('M' => $_SESSION['Matricule'] ));
												$donnees = $recupEquip -> fetch();
													$_SESSION['CODEEQUIPE'] = $donnees["CODEEQUIPE"];	
													$recupEquip -> closeCursor();
										header('Location: OTCE.php');
									}else if ($_SESSION['Statut'] == "Pilote")
									{
										header('Location: Orientation.php');
									}
								} 
									ELSE 
										{ echo "<script> alert('Mot de Passe Incorrect');  </script>";
											//header('Location: index.php');
										}
						}
		  }Else { echo "<script> alert('Votre id n\'existe pas');  </script>"; }
	} ELSE 
	{
			 echo '<script language=javascript> alert("Connectez Vous Maintenant! Session Fermee!"); </script>' ;  
	}

/*
	
  */	
		
	
	?>

