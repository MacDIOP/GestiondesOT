<!DOCTYPE html>
<html lang="en">
<!--=============Entete HTML========================-->
<?php 
		include("entetehtml.php"); 
		include('ConnexionBD.php'); 
		include('LesFonctions.php');		
		include("ScriptGestioErreurs.php");		
?>
<body id="page1">
	<div class="extra container">
		<div class="main">
<?php 
include("EntetePage.php");
include('Lareleve.php');
?>		
<!-----==================Le corps de la page========================---------->		
			<div class="row MargeSup">
				<section class="col-lg-12">
					
				<div class="panel panel-default">		
						<div class="panel-heading monbox">
                            Les Derangements A Releves
                        </div>
					<div class="panel-body">
					
						<div class ="col-lg-12 col-xs-12 table-responsive">
							
							<table id="Tablereleve" class ="table table-Condensed table-bordered">
							 <thead> <!-- En-tête du tableau -->
									<tr>
										<th> <abbr title="Numero derangement"> ND <abbr></th>
										<th>Date Orientation</th>
										<th>Type Abonnement</th>
										<th>Sous Repartiteur</th>
										<th>Temps Ecoule</th>
										<th>Vitesse Releve</th>
										<th>Code Equipe</th>
										<th>Chef Equipe</th>
										<th>Decharge</th>
									</tr>
							</thead>

								<tbody>		
<?php

				$reqrelv = $bdd -> query('Select derangement.ND,derangement.codesr,derangement.Prioritedrgt,Timestampdiff(HOUR,derangement.DATEORIENTATION,Now()) as VR,TIMEDIFF(NOW(),derangement.DATEORIENTATION) as Duree,
												derangement.DATEORIENTATION,journalequipe.CodeEquipe,journalequipe.Matricule,CONCAT_WS(" ",agent.NOMAGENT,agent.PRENOMAGENT) as ChefEquipe 
													from derangement natural join journalequipe Natural join agent 
														where derangement.ETATOT = "Oriente" ORDER BY derangement.DATEORIENTATION DESC
															');
					$reqrelv ->execute();
				
				WHILE ( $donnees = $reqrelv -> fetch() )
				{	?>
							<tr>
									<td> <?php echo $donnees['ND']; ?></td>
									<td><?php echo $donnees['DATEORIENTATION']; ?></td>
									<td><?php echo $donnees['Prioritedrgt']; ?></td>
									<td><?php echo $donnees['codesr']; ?></td>

	<?php   $Letype = $donnees["Prioritedrgt"];
			$VR = $donnees["VR"];
			if ( ($Letype == "Professionnel") OR ($Letype == "Administratif") OR ($Letype == "Commerciale") )
					{ 
						if ($VR >= 8) 
						{ /* Adopte la couleur rouge si VR Depassee */
							?> <td style="color : red;"> <?php echo $donnees["Duree"] ;?> </td> <?php
						} else 
							{ ?> <td style="color : LightGreen;"> <?php echo $donnees["Duree"] ;?> </td> <?php }
							
					} else if (($Letype == "Residentiel") OR ($Letype == "Grand Public"))
						{
							if ($VR >= 24)
							{
							?> <td style="color : red;"> <?php echo $donnees["Duree"] ;?> </td> <?php
							} else 
							{ ?> <td style="color : LightGreen;"> <?php echo $donnees["Duree"] ;?> </td> <?php  }
						}
	?>								
									
									<td><?php echo $donnees['VR']." H" ; ?></td>
									<td><?php echo $donnees['CodeEquipe']; ?></td>
									<td><?php echo $donnees['ChefEquipe']; ?></td>
									<td> <button data-toggle="modal" href="#<?php echo $donnees["ND"]; ?>" type="button" class ="btn btn-sm btn-primary"> Decharger ici... </button></td>
							</tr>
							
							
<!-----Ici la fenetre Modale-------->				
								<div class="modal fade" id="<?php echo $donnees["ND"]; ?>">   
				
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title"> Feuille de Releve</h4>
											</div>
											
											<div class="modal-body">
												<ul class ="list-group">
													<li class="list-group-item monbox"> ND  <span class = "badge"> <?php echo $donnees["ND"] ?> </span> </li>
													<li class="list-group-item monbox"> Code SR  <span class = "badge"> <?php echo $donnees["codesr"] ?> </span> </li>
													<li class="list-group-item monbox"> Date Orientation  <span class = "badge"> <?php echo $donnees["DATEORIENTATION"] ?> </span> </li>
													<li class="list-group-item monbox"> VR  <span class = "badge"> <?php echo $donnees["VR"]." H" ?> </span> </li>													
												</ul>
												
													<form method ="POST" action ="Releve.php">
															<div class="form-group">
																<label>Commentaires de Releve</label>
																<input type="textarea" class="form-control" name="CommsReleve"> <!-----Voici L input------>
															</div>
															<div class="form-group">
																<label>Initiale du Pilote</label>
																<input type="text" class="form-control" name="Initiales"> <!-----Voici L input------>
															</div>
															<div class="input-group">
																<span class="input-group-addon">Num Releve</span>
																<input type="text" name="Dger" class="form-control">
																<span class="input-group-btn">
																	<input type ="submit" name="<?php echo $donnees["ND"]; ?>" value ="Valider" class="btn btn-sm btn-primary">
																</span>
															</div>
													</form>	
											</div>
											<div class="modal-footer">
												<button class="btn btn-info" data-dismiss="modal">Fermer</button>
											</div>
										</div>
									</div>
								</div>
<?php       	}	$reqrelv -> closeCursor(); ?>												
								</tbody>
							</table>
						</div>
					</div>
				</div>	
				</section>
			</div>
<?php include ('footer.php'); ?>			
			
		</div>
	</div>
	
</body>	
</html>