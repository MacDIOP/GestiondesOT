<?php
/*
Vous venez de mettre l agent MAT dans l equipe CODE par: 
	if 
	- Remplacement de l agent MAT $_POST["Subs"]
		'agent' => $_POST[Ajout]	
		'agentaremp' => "NON"
	else
	- Simple Ajout. $_POST[Ajout]
		'agentaremp' => "NON";
		'agent' => $_POST[Ajout]	
L agent POST["Suppression"] vient d'etre enlever de l'equipe CODE 
	Redirection automatique vers Uneequipe avec GET[CODEEQUIPE];					
					*/
?>
<!DOCTYPE html>
<html lang="en">
<!--=============Entete HTML========================-->
<?php 
		include("entetehtml.php"); 
		include('ConnexionBD.php'); 		
		include("ScriptGestioErreurs.php");		
?>
<body id="page1">
	<div class="extra container">
		<div class="main">
<?php 
include("EntetePage.php");
?>		
<!-----==================Le corps de la page========================---------->		

			<section class="row MargeSup">
				<h3> Fin de la modification  </h3>

					<div class="monbox col-lg-4">
						<h4> Modification de l' equipe : </h4>
							<ul class="list-group">
								<li class="list-group-item monbox">  Equipe  </li>
<?php
	if (isset($_POST["Fini"]))
		{
			$Recupequipe = $bdd -> prepare('Select journalequipe.CodeEquipe,agent.MATRICULE,CONCAT_WS(" ",agent.NOMAGENT,agent.PRENOMAGENT) AS ChefEquipe   
												FROM journalequipe Natural JOIN agent
												where journalequipe.CodeEquipe= :team');
					$Recupequipe ->	execute(array('team' => $_SESSION["Lequipe"]));
				While($lesdonnees = $Recupequipe -> fetch())
					{
?>								
								<li class="list-group-item"> Code Equipe : <span class="badge pull-right">  <?php echo $lesdonnees["CodeEquipe"]; ?> </span> </li>
								<li class="list-group-item"> Chef Equipe : <span class="badge pull-right">  <?php echo $lesdonnees["ChefEquipe"]; ?> </span> </li>
<?php						
					}
			$Recupequipe -> closeCursor();		
?>
							</ul>
					</div>
					<div class="monbox col-lg-4">
						<h4> Agents Concernes </h4>
<?php	
			if(isset($_POST["Suppression"]))
				{
					$supprimer = $bdd -> prepare('delete from affectation where CodeEquipe= :equipe AND Matricule= :AG');
					$supprimer -> execute(array('equipe' => $_SESSION["Lequipe"],
												'AG' => $_POST["Suppression"] ));	
					$supprimer -> closeCursor();	
?>
							L'agent <span class="badge"> <?php echo $_POST["Suppression"]; ?> </span> vient d'etre enlever de l'equipe. <br/>
							Retour vers la page de l'equipe 
					<a class ="btn btn-info" href="uneequipe.php?codeteam=<?php echo $_SESSION["Lequipe"];?>"> <?php echo $_SESSION["Lequipe"];?> </a>		
<?php
				} else 
					if(isset($_POST["AgentchoisiA"]))
						{
							
							echo "Rien a ajouter";
						} else
							if(isset($_POST["AgentchoisiR"]))
								{
										//Enregistrement definitif de l'operation
							$reqedit = $bdd -> prepare('CALL INSERTION_AFFECTATIONS(:equipe,:agent,:remplacerpar,@mess,@rempmessage)');
							$reqedit -> execute(array(	'agent' => $_POST["Subs"],
														'equipe' => $_SESSION["Lequipe"],
														'remplacerpar' => $_POST["AgentchoisiR"]));
							$Reponse = $bdd -> query("select @rempmessage");
							 $message = $Reponse -> fetch();
								
?>
						<div class="monbox">
							Resultat du remplacement : </br> </br>  <span class="box"> <?php echo $message["@rempmessage"]; ?> </span> </br> </br>
								Voir le resultat a la page  : <a class ="btn btn-info" href="uneequipe.php?codeteam=<?php echo $_SESSION["Lequipe"]; ?>"> de l'equipe </a> 
							</br>		
						</div>
<?php					
							$Reponse -> closeCursor();	
							$reqedit -> closeCursor();	

								} else 
									{
										echo "Aucune Modification n' a ete detectee";
									}	
?>					
						
					</div>
<?php
		} else 
			{}	
?>			
			
			</section>
<?php include ('footer.php');?>		
		</div>
	</div>
	
</body>	
</html>
					