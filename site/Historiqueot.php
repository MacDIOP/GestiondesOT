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
				
			<div class="panel panel-default">		
					<div class="panel-heading monbox">
							Les Derangements Realises
					</div>
				<div class="panel-body">
					<div class="col-lg-8 table-responsive">
						<table id="datatableRealise" class ="table table-Condensed table-bordered">
							 <thead> <!-- En-tête du tableau -->
									<tr>
										<th> <abbr title="Numero derangement"> ND <abbr></th>
										<th><abbr title="Sous Repartiteur"> SR <abbr></th>
										<th>Date Orientation</th>
										<th>Code Equipe</th>
										<th>Numero Releve</th>
										<th>Date Releve</th>
										<th>Vitesse Releve</th>
									</tr>
								</thead>

								<tbody>		
<?php
					$ttle = $bdd -> query('select derangement.ND,derangement.codesr,derangement.Prioritedrgt,derangement.DATEORIENTATION,derangement.CodeEquipe,
												releve.NUMERORELEVE,releve.DATERELEVE,Timestampdiff(HOUR,derangement.DATEORIENTATION,releve.DATERELEVE) as VR
													from derangement inner join releve on derangement.ND = releve.ND
														where derangement.ETATOT = "REALISEE" 
															');
					$ttle ->execute();
				
				WHILE ( $donnees = $ttle -> fetch() )
					{	?>									
									<tr>
									  <td> <a href="Modification.php?OT=<?php echo $donnees["ND"];?>"> <?php echo $donnees["ND"];?> </a> </td>
									  <td> <?php echo $donnees["codesr"] ;?> </td>
									  <td> <?php echo $donnees["DATEORIENTATION"] ;?> </td>
									  <td> 
										<?php 
											$team = $donnees["CodeEquipe"];
											if(empty($team) OR $team ==" ")
												echo "NEANT";
													else 
											echo $donnees["CodeEquipe"] ;	
										?> 
									  </td>
									  
									  
									  <td> <?php echo $donnees["NUMERORELEVE"] ;?> </td>
									  <td> <?php echo $donnees["DATERELEVE"] ;?> </td>
	<?php
			  $Letype = $donnees["Prioritedrgt"];
				$VR = $donnees["VR"];
				if ( ($Letype == "Professionnel") OR ($Letype == "Administratif") OR ($Letype == "Commerciale") )
						{ 
							if ($VR >= 8) 
							{ /* Adopte la couleur rouge si VR Depassee */
								?> <td style="color : red;"> <?php echo $donnees["VR"]  ;?> </td> <?php
							} else 
								{ ?> <td style="color : LightGreen;"> <?php echo $donnees["VR"] ;?> </td> <?php }
								
						} else if (($Letype == "Residentiel") OR ($Letype == "Grand Public"))
							{
								if ($VR >= 24)
								{
								?> <td style="color : red;"> <?php echo $donnees["VR"] ;?> </td> <?php
								} else 
								{ ?> <td style="color : LightGreen;"> <?php echo $donnees["VR"] ;?> </td> <?php  }
							}
		?>
									</tr>
<?php
					} 
					$ttle -> closeCursor();
?>				
								</tbody>
						</table>
					</div>
				</div>
			</div>
						
			</section>


<?php include('footer.php'); ?>			
			
		</div>
	</div>

		
	</body>	
</html>