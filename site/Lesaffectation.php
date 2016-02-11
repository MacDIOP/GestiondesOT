<?php 
include("ConnexionBD.php");
	
	if(isset($_POST['ChoixTeam']))
		{
						$Teamchosen = $_POST['ChoixTeam'];
						$_SESSION["Team"] = $Teamchosen; 
?>					
					<div class="col-lg-12 box">
		<form method="POST" action="Formerequipe.php">
					<h4> Rapport de l'affectation </h4>
<?php				
				// Les agents de l equipe choisie	
					
						$Sesagents = $bdd -> prepare("Call AgentsdelEquipe(:team)");
							$Sesagents -> execute( array('team' => $Teamchosen ));
?>
						<div class="row MargeSup">
							<h4> Equipe Choisie : <span class="badge pull-right"> <?php echo $Teamchosen; ?> </span>	</h4>
	
							<ul class="list-group">
								<li class="list-group-item box">Agents de L'equipe <span class="badge pull-right"> cocher pour le remplacer... </span> </li>
<?php
						While ( $lesdata = $Sesagents -> fetch() )
						{
?>						
									<li class="list-group-item monbox"> <?php echo $lesdata["NOMAGENT"]." ".$lesdata["PRENOMAGENT"]; ?> 
										
										<input type="checkbox" class="pull-right" name="<?php echo $lesdata["MATRICULE"];?>" />
									</li>	
<?php						
						} $Sesagents -> closeCursor();
						
?>						
							</ul>
						</div>
<?php

			// Debut du traitement des agents

				$verifaffec = $bdd -> query ('Select MATRICULE from agent');
				$Affectees = array ();  //Les agents Cochees, Les elements coches
					while ($donnees = $verifaffec -> fetch() )
						{
							$Compteur = $donnees['MATRICULE'];
								if (isset($_POST[$Compteur]))
									{
										$Affectees[] = $Compteur;
									}
						}
				$verifaffec -> closeCursor();
?>
					<div class="row MargeSup">
							
							<ul class="list-group">
								<li class="list-group-item box">	Les Agents Choisis  </li>
<?php
			if(empty($Affectees))
				{
?>						
								<li class="list-group-item monbox"> Veuillez choisir des Agents SVP! </li>
<?php			}else				
					{	
						foreach ($Affectees as $agent) 
							{
								$a = $agent;
								$NOMAgent = $bdd -> prepare ('select CONCAT_WS(" ",NOMAGENT,PRENOMAGENT) AS NomAgent from agent where MATRICULE = :MAT');
								$NOMAgent -> execute( array ('MAT' => $a ));
								 //
								 
								//$Sesagents = $bdd -> prepare("Call AgentsdelEquipe(:team)");
								//$Sesagents -> execute( array('team' => $Teamchosen ));
									
										While ( $donnees = $NOMAgent -> fetch() )
											{ 
?>						
								<li class="list-group-item monbox" for="agent"> <?php echo $donnees["NomAgent"]; ?> </li>	
<?php												
											}	
						
							} $NOMAgent -> closeCursor();
					}						
?>
								<li class="list-group-item monbox">  
									<span class="badge monbox pull-right"> Fin de l'affectation 
										<input type ="submit" name="FIN" value ="Validation" class="btn btn-success" />
									</span>
								</li>
							</ul>
					</div>
		</form>
		
<?php		
		} ELSEIF(isset($_POST["FIN"]))
						{
?>
				<div class="row MargeSup">			
<?php							
								$CheckSubs = $bdd -> query ('Select MATRICULE from agent');
									$Remplacants = array ();  //Les agents Cochees, Les elements coches
										while ($donnees = $CheckSubs -> fetch() )
											{
												$CompteurRemp = $donnees['MATRICULE'];
													if (isset($_POST[$CompteurRemp]))
														{
															$Remplacants[] = $CompteurRemp;
															$Notreteam = $_POST[$CompteurRemp];
														}
											}
									$CheckSubs -> closeCursor();

								if(empty($Remplacants))
									{
?>
						<div class="alert monbox">
							Pas de Remplacement;	
						</div>	
										
<?php								
									} ELSE
										{ 
											foreach($Remplacants AS $Subs)
												{
													foreach ($Affectees as $a)
														{
									$Affectation = $bdd -> prepare ('CALL INSERTION_AFFECTATIONS(:team,:agent,:rmp,@rmpmessage,@return) ');
									$Affectation -> execute( array ( 
																	'team' => $_SESSION["Team"],
																	'agent' => $a,
																	'rmp' => $Subs	
																		));
														}
									$recupmess = $bdd -> query("Select @rmpmessage");
									$data = $recupmess -> fetch();
											
?>
						<div class="alert monbox">
							<?php  echo $data["@rmpmessage"]; ?>
						</div>	
<?php									$recupmess -> closeCursor();		

												}
										}
						}ELSE 
							{
?>
							<div class="alert box">
								Choisir une equipe avec au max 4 agents
							</div>
<?php			
							}
						
?>						
				</div>
			</div>		
		
					
<?php
						
					
					
					// Appel de la procedure de l'insertion de l'agent	
					/*	foreach ($Affectees as $agent) 
							{
								$a = $agent;
									$Affectation = $bdd -> prepare ('CALL INSERTION_AFFECTATIONS(:Team,:agent,@return) ');
									$Affectation -> execute( array ( 
																	'Team' => $Teamchosen,
																	'agent' => $a	
																		));
					
									$recupmess = $bdd -> query("Select @return");
									$data = $recupmess -> fetch();
											
?>
						<div class="alert box">
							<?php  echo $data["@return"]; ?>
						</div>	
<?php									$recupmess -> closeCursor();		
										$Affectation -> closeCursor();
							}
					*/
?>					
						