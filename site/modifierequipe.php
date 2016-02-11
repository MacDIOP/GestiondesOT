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
				<div class="col-lg-12">
						<h3> Edition des Equipes </h3>
								
					<aside class="col-lg-4">
				<form method="POST" action="#">	
						<div class="panel panel-default">
							<div class="panel-heading monbox">
								Rapport de l'edition <span class="badge pull-right"> Choix => </span>
							</div>
							<div class="panel-body">
<?php

		if(isset($_GET["subs"]))  //S'il sagit d'un remplacement
			{
				$AgentaRemplacer = $_GET["subs"];
					$_SESSION["Aremplacer"] = $_GET["subs"];
			// Creation d une variable de session pour l agent a remplacer
?>
				
				<div class="monbox">
					<ul class="list-group box">
						<li class="list-group-item monbox">
							Equipe : <span class="badge pull-right"> <?php echo $_SESSION["Lequipe"]; ?> </span>
						</li>
<?php 						
		$NomPrenom = $bdd -> prepare('select CONCAT_WS(" ",agent.NOMAGENT,agent.PRENOMAGENT) AS NotreAgent from agent where MATRICULE = :Agt');
		$NomPrenom -> execute(array('Agt' => $AgentaRemplacer ));
			$Recup = $NomPrenom -> fetch();
?>			
						<li class="list-group-item">
							AGENT : <span class="badge pull-right"> <?php echo $Recup["NotreAgent"]; ?> </span>
						</li>
<?php
				
		$NomPrenom -> closeCursor();			
?>
					</ul>
			<!--		<input type="hidden" name="Subs" value="<?php //echo $AgentaRemplacer; ?>" />	 
					-----  Champs Caches pour l agent a remplacer (POST[Subs])------------>
				</div>
<?php		}
				else if(isset($_GET["Ajout"])) // S'il Sagit d'un ajout
					{
						$AgentaAjouter = $_GET["Ajout"];
?>
				<div class="monbox">
					<ul class="list-group box">
						<li class="list-group-item monbox">
							Equipe : <span class="badge pull-right"> <?php echo $_SESSION["Lequipe"]; ?> </span>
						</li>
<?php 						
		$NomPrenom = $bdd -> prepare('select CONCAT_WS(" ",agent.NOMAGENT,agent.PRENOMAGENT) AS NotreAgent from agent where MATRICULE = :Agt');
		$NomPrenom -> execute(array('Agt' => $AgentaAjouter ));
			$Recup = $NomPrenom -> fetch();
?>			
						<li class="list-group-item">
							AGENT : <span class="badge pull-right"> <?php echo $Recup["NotreAgent"]; ?> </span>
						</li>
<?php
				
		$NomPrenom -> closeCursor();			
?>
					</ul>
			<!--		<input type="hidden" name="Ajout" value="<?php //echo $AgentaAjouter; ?>" />	 
					-----  Champs Caches pour l agent a ajouter (POST[Ajout])------------>						
				</div>						
<?php										
					} else if(isset($_GET["delete"])) // En cas de suppression.
						{
					//Ici la suppression.
							$Supprimer = $_GET["delete"];
?>							
							<div class="monbox">
								<ul class="list-group box">
									<li class="list-group-item monbox">
										L'agent <?php echo $Supprimer; ?> sera enlever de l'equipe. Valider en bas de la page.
										<input class ="btn btn-danger pull-right" type="hidden" name="Suppression" value="<?php echo $Supprimer; ?>" href="uneequipe.php"/>  
									<!-------------POST Valider sera creer = Matricule de l agent a supprimer POST["Suppression"]---------->
									</li>
								</ul>
							</div>							
<?php								
						}	
							else
								{
?>
							<div class="monbox">
								<ul class="list-group box">
									<li class="list-group-item monbox">
										Vous n'avez pas choisi une operation. 
										<a class ="btn btn-info pull-right" href="uneequipe.php"> Choisir Ici SVP! </a>
									</li>
								</ul>
							</div>		
<?php			
								}	
?>								
							</div>
						</div>		
					</aside>
			<!----------La liste des agents ------------------->		
						<div class="panel panel-default col-lg-8">		
									<div class="panel-heading monbox">
										Listes des agents simples
									</div>
							<div class="panel-body">
									<div class="table-responsive">
										<table id ="LesAgents" class="table table-bordered table-condensed">
											<thead>
												<tr>  
												  <th>Matricule</th>
												  <th>Nom </th>
												  <th>Prenom </th>
<?php
			if(isset($AgentaRemplacer))
				{
?>												  
												  <th> Remplacer </th>	
<?php					//Remplacer
				}else
					if(isset($AgentaAjouter))
						{
?>												
												  <th> Ajouter </th>
<?php										  //Ajouter
						} else
							{}
?>												  
												</tr>  
											</thead>
											<tbody>
<?php   
					$Lesagents = $bdd -> query('select agent.MATRICULE, agent.NOMAGENT, agent.PRENOMAGENT
													from agent natural left join JournalEquipe 
														Where JournalEquipe.CodeEquipe IS NULL');
						While( $Agents = $Lesagents -> fetch() )
							{
?>									  
												<tr>	
													<td> <?php echo $Agents["MATRICULE"]; ?> </td>
													<td> <?php echo $Agents["NOMAGENT"]; ?> </td>
													<td> <?php echo $Agents["PRENOMAGENT"]; ?> </td>
													 
<?php
			if(isset($AgentaRemplacer))
				{
?>
													<td>	
														<label class="btn btn-success">
															<input type="radio" name="AgentchoisiR" value="<?php echo $Agents["MATRICULE"];?> "/> Remplacement
														</label>
													</td>
<?php					//Remplacer
				}else
					if(isset($AgentaAjouter))
						{
?>
													<td> 
														<label class="btn btn-success">
															<input type="radio" name="AgentchoisiA" value="<?php echo $Agents["MATRICULE"]; ?>" /> Ajout
														</label>
													</td>
<?php		//Ajouter
						}else
							
						{
							//Juste les agents pas de choix
						}
?>													
												</tr>
<?php
							}	
					$Lesagents ->closeCursor();	

?>								
											</tbody>
										
										</table>
									</div> <!---Le Div table responsive--->
							</div> <!---Le Panel body--->
							<div class="panel-footer monbox">
								<p>	
									NB :  </br>
									- L'agent sera remplace par celui selectionne ci-haut. </br>
									- L'agent selectionne sera ajoute a l'equipe en cas d'ajout. </br>
									- L'agent choisi va etre enlever de l'equipe. </br>
								</p>
								<input type="submit" name="Fini" value="Finir Votre operation" class="btn btn-primary btn-lg pull-right"/> 
							</div>
						</div>	<!---Le Panel --->
				</form>
				</div> <!-- Fin de la ligne-------->
			</section>	

<?php include ('footer.php'); 


?>			
			
		</div>
	</div>
	
</body>	
</html>











