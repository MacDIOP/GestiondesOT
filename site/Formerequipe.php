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

		<Section class="row MargeSup">
            <h3> Ici Vous Pouvez former les equipes! </h3>

		<form method="POST" action="Formerequipe.php">		
			<div class="col-lg-4 MargeSup">
					<h4 class="list-group-item-heading"> Liste des agents (Ne sont pas des chef Equipes) </h4>
					
<?php
	$lesagents = $bdd -> query("select COUNT(*) as nblignes from agent natural left join journalequipe 
												Where journalequipe.CodeEquipe IS NULL");
									
		$Donnees = $lesagents -> fetch();
			$Totale = $Donnees["nblignes"];
				
				if (empty($Totale))
					{
?> 					<div class ="col-lg-3 col-xs-3 box">  
						Aucun Resultat   
					</div>  
<?php				} else 
						{
?>		 					<div class ="col-lg-6 monbox">  
								Resultats :  
								<button type="button" class="btn btn-xs btn-info pull-right"><?php echo $Totale; ?> agents </button>
							</div> <br/>
							
						<ul class="list-group">
							<li class="list-group-item box">Nom des Agents <span class="pull-right"> Choix</span>   </li>
<?php
include('navigationscript.php');						
	$Retour = $bdd -> prepare('select agent.MATRICULE, agent.NOMAGENT, agent.PRENOMAGENT
											from agent natural left join journalequipe 
												Where journalequipe.CodeEquipe IS NULL
													LIMIT :PE,:MP');
		$Retour -> bindValue(':PE',$premiereEntree, PDO::PARAM_INT);
		$Retour -> bindValue(':MP',$LignesParPages, PDO::PARAM_INT);
			$Retour ->execute(); 
				 
				while($donnees = $Retour -> fetch()) // On lit les entrées une à une grâce à une boucle
				{ ?>
							<li class="list-group-item monbox"> <?php echo $donnees["NOMAGENT"]." ".$donnees["PRENOMAGENT"] ?> 
								<input type="checkbox" class="pull-right" name="<?php echo $donnees['MATRICULE'];?>" />
							</li>
<?php			}
			$Retour -> closeCursor();
?>			
						</ul>
						
<?php 					}
				$lesagents -> closeCursor();
?>				
<!------------Pagination----------->			
		  <ul class="pagination pagination-small">
			<li>
			  <span aria-hidden="true">&laquo;</span>
			</li>
<?php		
	for($i=1; $i<=$NombredePages; $i++) //On fait notre boucle
		{
			//On va faire notre condition
			 if($i==$pageActuelle) //Si il s'agit de la page actuelle...
			 { ?>
				  <li class="active"> <a> <?php echo $i; ?> </a> </li>
<?php				 }	
			 else //Sinon...
			 { ?>
				<li> <a href="Formerequipe.php?page=<?php echo $i; ?>">  <?php echo $i; ?>  </a></li>
<?php			 }
		}	?>
			<li>
				<span aria-hidden="true">&raquo;</span>
			</li>
		  </ul>
			</div>
			
			<div class="col-lg-4 MargeSup">
				<h4> Liste des Equipes </h4>
				
<?php
	$lesequipes = $bdd -> query("select COUNT(*) as lesteams from journalequipe");
									
		$Donnees = $lesequipes -> fetch();
			$Totale = $Donnees["lesteams"];
				
				if (empty($Totale))
					{
?> 					<div class ="col-lg-3 col-xs-3 box">  
						Aucun Resultat   
					</div>  
<?php				} else 
						{
?>		 					<div class ="col-lg-6 monbox">  
								Resultats :  
								<button type="button" class="btn btn-xs btn-info pull-right"><?php echo $Totale; ?> equipes </button>
							</div> <br/>
							
						<ul class="list-group">
							<li class="list-group-item box">Les Equipes <span class="pull-right"> Choix de l'equipe (cocher)</span>   </li>
<?php
include('navigationscript.php');						
	$lesteams = $bdd -> query('Select journalequipe.CODEEQUIPE,agent.MATRICULE, CONCAT_WS(" ",agent.NOMAGENT,agent.PRENOMAGENT) AS ChefEquipe    
								FROM journalequipe INNER JOIN agent 
									ON journalequipe.Matricule = agent.Matricule');
	
				While ( $donnees = $lesteams -> fetch() )
				{
					$valueteam = $donnees["CODEEQUIPE"];
?>
							<li class="list-group-item monbox"> 
								<?php echo $donnees["ChefEquipe"];?>
								<input class="pull-right" name="ChoixTeam" type="radio" value= "<?php echo $donnees["CODEEQUIPE"];?>" />
							</li>
<?php			}
			$lesteams -> closeCursor();
?>			
						</ul>
						
<?php 					}
				$lesequipes -> closeCursor();
?>
			</div>
			
			<div class="col-lg-4">
				<h4> Formation ou Modification de l'equipe </h4>
					<span class="badge monbox"> Valider l'affectation </span>
					<button type="reset" class="btn btn-info">Reinitialiser</button>
					<input type ="submit" name="#" value ="Verification" class="btn btn-info">
<?php include("Lesaffectation.php");?>					
			</div>
			
		</form>
        </section>

<?php include ('footer.php'); ?>			
			
		</div>
	</div>
	
</body>	
</html>