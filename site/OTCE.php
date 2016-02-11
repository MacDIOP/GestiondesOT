<!DOCTYPE html>
<html lang="en">

<?php include("entetechefEquipe.php");
	  include("ScriptGestioErreurs.php");	
?> <!--Entete Html (head) -->
	
	<body id="page2">
		<div class="extra container">
			<div class="main">

<?php 
include("ConnexionBD.php");
include("EntetePage.php");
?> <!--Entete des pages (header) -->

<!--============================================CONTENT==================================================-->

				<div class="row Margesup">
					<?php include('Pointage.php');?>

				<div class="col-lg-6 col-xs-6">
					<h3>  <!-----Recuperation du nom et prenom du chef----->
								Plan de charge de
									<?php
										try
										{
											$reqtitre = $bdd -> prepare('Select NOMAGENT,PRENOMAGENT 
																			from agent natural Join journalequipe 
																				where (CodeEquipe = :team) AND (agent.Matricule =:Mat) ');
											$reqtitre -> execute(array('team' => $_SESSION['CODEEQUIPE'],
																		'Mat' => $_SESSION['Matricule']));

												while ($donnees = $reqtitre -> fetch())
													{
														$Leprenom = $donnees['PRENOMAGENT']; $Lenom = $donnees['NOMAGENT'];    
													}
											$reqtitre -> closeCursor();		
										} Catch (Exception $e)
										{
											echo 'Nom et Prenom Non disponible :'.$e-> getMessage();
										}	
										echo $Leprenom.' '.$Lenom;
									?>	 
							</h3>
							
							<div class="table-responsive">
								<table class="table table-bordered monbox">
									<thead>
										<tr>
											<th> <abbr title="Numero derangement"> ND </abbr> </th>
											<th> <abbr title="Sous Repartiteur"> SR </abbr> </th>
											<th>Date Orientation </th>
											<th> <abbr title="Vitesse de Releve"> VR </abbr> </th>
										</tr>
									</thead>
									<?php
										try
											{
												$plan= $bdd -> prepare ('Select ND,codesr,DATEORIENTATION,TIMEDIFF(NOW(),derangement.DATEORIENTATION) as Duree
																			from derangement where CodeEquipe= :Lateam AND ETATOT="ORIENTE"');
													$plan -> execute(array('Lateam' => $_SESSION['CODEEQUIPE']));	
														
												while($Donnees = $plan -> fetch())
													{
									?> 
									<tbody>
										<tr>
											<td> <?php echo $Donnees['ND'] ?>  </td>
											<td> <?php echo $Donnees['codesr'] ?> </td>
											<td> <?php echo $Donnees['DATEORIENTATION'] ?> </td>
											<td> <?php echo $Donnees['Duree'] ?> </td>
										</tr>
									</tbody>	
									<?php				
													}
												$plan -> closeCursor();	
											} catch (Exception $e)
											{
												echo 'Echec Lors de la recuperation des donnes :'.$e -> getMessage();
											}
									?>
								</table>
							</div>
					</div>
					<div class="col-lg-6 col-xs-6" style="margin-top :20px"> <!---choix des agents---->
								<h3 class="list-group-item-heading">Mes Agents actuels</h3>
								<div class="list-group">
									<!----======Recuperation des Agents Actuels========----->
								<?php
									try
										{
											$Lesagents = $bdd -> prepare('CALL AgentsdelEquipe(:Lefameux)');	
											 $Lesagents -> execute ( array( 'Lefameux' => $_SESSION['CODEEQUIPE'])); 
												While ($donnees = $Lesagents -> fetch())
												{
								?>
									<li class="list-group-item monbox"> <?php echo $donnees['NOMAGENT']." ".$donnees['PRENOMAGENT'];?> </li>
								<?php			}
										} catch (Exception $e)
										{
											echo 'Echec de la recuperation des Agents :'. $e -> getMessage();
										}
								?>	
									
									<li class="list-group-item box" style ="color : #186B3C;">Choisir mes agents 
										<button type="button" class="btn btn-sm btn-default pull-right"> +Agents</button>
									</li>
								</div>
					</div>
				</div>
				<div class ="row">
					<div class="col-lg-6 col-xs-6 monbox alert alert-default"> <!---Note Pour les Agents------->
						<strong>NOTE :</strong> Ces Informations Seront transmis a votre Pilote.
					</div>
					
					<!--------------Formulaire de piontage----------------->
					<form id ="lepointage" method ="POST" action="OTCE.php">	
						<input type="submit" value = "Valider" name="Pointe"  class="btn btn-lg btn-success col-lg-offset-1"> 
					</form>
		
				</div>	
<?php	 
		include("footer.php"); 
?> <!--Footer--->			
			</div>
		</div>

	</body>
</html>			
