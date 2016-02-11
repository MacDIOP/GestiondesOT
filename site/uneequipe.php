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
<?php
		 if (isset ($_GET['codeteam']) )
			{
				$notreteam = $_GET['codeteam'];	
					$_SESSION["Lequipe"] = $notreteam;
?>			
			<h3> Les informations de l'equipe </h3>
			
				<div class="row MargeSup">
				
					<div class="col-lg-3 monbox">
							<div class="row MargeSup">
								<div class="panel panel-default">
										<div class="panel-heading monbox">
											Les agents actuels de l'equipe
										</div>
										<div class="panel-body box">
				
											<div class="alert monbox">
												Remplacer ou Enlever un agent de l'equipe
											</div>
											
											<ul class="list-group">
												<li class="list-group-item monbox">   Edition de l'equipe  </li>
<?php
						$TeamWanted = $bdd -> prepare('CALL agentsdelEquipe(:Lefameux)');	
						 $TeamWanted -> execute (array( 'Lefameux' => $notreteam )); 
							While ( $data = $TeamWanted -> fetch() )
								{
									$Ref = $data["MATRICULE"];
								
?>												  
												<li class="list-group-item"> 
													<span class="badge"> <?php echo $data["NOMAGENT"]." ".$data["PRENOMAGENT"] ;?> </span>   
														<a class="btn btn-xs btn-info" href="modifierequipe.php?subs=<?php echo $Ref; ?>">Remplacer</a>
														<a class="btn btn-xs btn-info" href="modifierequipe.php?delete=<?php echo $Ref; ?>">Enlever</a>
												</li>
<?php 						
								} 
							$TeamWanted -> closeCursor();
?>
											</ul>			
										</div>
										<div class="panel-footer monbox">
											<a href="modifierequipe.php?Ajout=<?php echo $Ref; ?>" class="btn btn-primary btn-small btn-block">Ajouter un ou plusieurs agents </a>
										</div>
								</div>
								
							</div>
							
					</div>
					
					<div class="col-lg-6">
							<div class="panel panel-default box">
								<div class="panel-heading monbox">
									Les derangements de l 'equipe
								</div>
								<!-- /.panel-heading -->
								<div class="panel-body">
									<!-- Nav tabs -->
									<ul class="nav nav-tabs">
										<li class="active"><a class="monbox" href="#home" data-toggle="tab">Bilan de l'equipe</a>
										</li>
										<li><a href="#orientes" class="monbox" data-toggle="tab">derangement orientes</a>
										</li>
										<li><a href="#realises" class="monbox" data-toggle="tab">derangement realises</a>
										</li>								
									</ul>

									<!-- Tab panes -->
									<div class="tab-content">
									
										<div class="tab-pane fade in active" id="home">
											<h4>Bilan</h4>
											<p>
												Cette section sera mise a jour d'ici peu.
											</p>
											</div>
									<!------La Page des dergt Orientes----------->
										<div class="tab-pane fade" id="orientes">
											<h4>Orientes</h4>
											
											<div class ="col-lg-12 col-xs-12 table-responsive">
							
												<table id="Orientes" class ="table table-Condensed table-bordered">
													 <thead> <!-- En-tête du tableau -->
															<tr>
																<th> <strong> <abbr title="Numero derangement"> ND <abbr> </strong> </th>
																<th>Date Orientation</th>
																<th>Type Abonnement</th>
																<th> <abbr title="Sous Repartiteur"> SR </abbr> </th>
																<th>Temps Ecoule</th>
																<th>Vitesse Releve</th>
															</tr>
													</thead>
													<tbody>
<?php

				$reqdrgtequipe = $bdd -> prepare('Select derangement.ND,derangement.codesr,derangement.Prioritedrgt,Timestampdiff(HOUR,derangement.DATEORIENTATION,Now()) as VR,
														TIMEDIFF(NOW(),derangement.DATEORIENTATION) as Duree,derangement.DATEORIENTATION 
													from derangement inner join journalequipe 
															on derangement.codeequipe = journalequipe.CodeEquipe
													where journalequipe.CodeEquipe = :teame AND derangement.ETATOT = "Oriente" ');
					$reqdrgtequipe ->execute(array('teame' => $_SESSION["Lequipe"] ));
				
				WHILE ( $donnees = $reqdrgtequipe -> fetch() )
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
							</tr>
							
<?php       	}	$reqdrgtequipe -> closeCursor(); ?>							
													
													</tbody>
												</table>
											</div>	
										</div>
								<!------La Page des dergt realisees----------->		
										<div class="tab-pane fade" id="realises">
											<h4>Realises</h4>
										
											<div class ="col-lg-12 col-xs-12 table-responsive">
							
												<table id="LesRealises" class ="table table-Condensed table-bordered">
													<thead> <!-- En-tête du tableau -->
															<tr>
																<th> <strong> <abbr title="Numero derangement"> ND </abbr> </strong> </th>
																<th> <abbr title="Sous Repartiteur"> SR </abbr> </th>
																<th> Date Orientation </th>
																<th> Numero Releve </th>
																<th> Date Releve </th>
																<th> <abbr title="Vitesse de Releve"> VR </abbr> </th>
															</tr>
													</thead>
													<tbody>
<?php

				$reqrealises = $bdd -> prepare('Select derangement.ND,derangement.codesr,derangement.DATEORIENTATION,
													releve.NUMERORELEVE,releve.DATERELEVE,Timestampdiff(HOUR,derangement.DATEORIENTATION,releve.DATERELEVE) as VR
														from derangement inner join journalequipe 
															on derangement.codeequipe = journalequipe.CodeEquipe
																natural join releve
														where journalequipe.CodeEquipe = :lequip');
					$reqrealises ->execute(array('lequip' => $_SESSION["Lequipe"] ));
				
				WHILE ( $donnee = $reqrealises -> fetch() )
				{	?>
							<tr>
									<td><?php echo $donnee['ND']; ?></td>
									<td><?php echo $donnee['codesr']; ?></td>
									<td><?php echo $donnee['DATEORIENTATION']; ?></td>
									<td><?php echo $donnee['NUMERORELEVE']; ?></td>
									<td><?php echo $donnee['DATERELEVE']; ?></td>
									<td><?php echo $donnee['VR']." H" ; ?></td>
							</tr>
							
<?php       	}	$reqrealises -> closeCursor(); ?>							
													
													</tbody>
												</table>
											</div>										
										</div>
									</div>
								</div>
								<!-- /.panel-body -->
							</div>
                    <!-- /.panel -->
					</div>
					
					<div class="col-lg-3 box">
						<h4 class="monbox"> Autres informations </h4>
							<div class="row MargeSup">
								<h4> Les pilotes et l'equipe </h4>
							</div>
							
							<div class="row MargeSup">
								<h4> Les plans de charges </h4>
							</div>
					</div>
				</div>
<?php
			} else 
			{
?>
				<div class="alert alert-info">
					Vous n'avez choisi aucune equipe. Merci d'en choisir a la page : <a class ="btn btn-info" href="Gestiondesequipes.php"> Gestion des equipes</a>
				</div>	
<?php		}
?>				
			</section>	

<?php include ('footer.php'); ?>			
			
		</div>
	</div>
	
</body>	
</html>