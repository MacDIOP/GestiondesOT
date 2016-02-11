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

<?php include("EntetePage.php");
		include('findecharge.php');
?>		
		
			<div class="row MargeSup">
				<section class ="col-lg-12">
								
					<h3> 
						Mon  Journal de derangements 
<?php 
		$LastPointage = $bdd -> prepare('select DATE_FORMAT(DatePointage,"%e %M %Y a %H:%i ") as ladate 
											from journalEquipe where CODEEQUIPE=:C ');
			$LastPointage -> execute(array('C'=> $_SESSION["CODEEQUIPE"]));
				$data = $LastPointage -> fetch();
					$DatePointage = $data["ladate"];
			$LastPointage -> closeCursor();		
?>							
					<span class="pull-right"> Dernier Pointage : <?php echo $DatePointage; ?></span>	
					</h3>
									
					<div class="col-lg-4 MargeSup">
						<h4 class="list-group-item-heading"> Mes OT Orientes </h4>
					
						<ul class="list-group">
<?php
			$MesOT = $bdd -> prepare('select ND,codesr from derangement where CodeEquipe = :team AND ETATOT != "REALISEE"');
				$MesOT -> execute(array('team' => $_SESSION["CODEEQUIPE"]));

				While ( $Donnees = $MesOT -> fetch() )
					{				
?>
							<li class="list-group-item monbox">   		  
								<span> <?php echo $Donnees["ND"]." ,".$Donnees["codesr"]; ?> </span>
								<button data-toggle="modal" href="#<?php echo $Donnees["ND"]; ?>" type="button" class="badge"> Decharger </button>
							</li>

							
<!-----Ici la fenetre Modale-------->				
								<div class="modal fade" id="<?php echo $Donnees["ND"]; ?>">   
				
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title"> Feuille de decharge</h4>
											</div>
											
											<div class="modal-body">
												<ul class ="list-group">
<?php 
				$InfosOT = $bdd -> prepare('select ND,TIMEDIFF(NOW(),derangement.DATEORIENTATION) as VR,codesr,DATEORIENTATION from derangement where ND =:num');
					$InfosOT -> execute(array ('num' => $Donnees["ND"]));
						While ( $Lesdata = $InfosOT -> fetch() )
							{
?>
													<li class="list-group-item monbox"> ND  <span class = "badge"> <?php echo $Lesdata["ND"] ?> </span> </li>
													<li class="list-group-item monbox"> Code SR  <span class = "badge"> <?php echo $Lesdata["codesr"] ?> </span> </li>
													<li class="list-group-item monbox"> Date Orientation  <span class = "badge"> <?php echo $Lesdata["DATEORIENTATION"] ?> </span> </li>
													<li class="list-group-item monbox"> VR  <span class = "badge"> <?php echo $Lesdata["VR"]." H" ?> </span> </li>													
<?php						}
					$InfosOT -> closeCursor();
?>					
												</ul>
											<form method ="POST" action ="Decharger.php">
													<div class="input-group">
														<span class="input-group-addon">Num Decharge</span>
														<input type="text" name="Dger" class="form-control">
														<span class="input-group-btn">
															<input type ="submit" name="<?php echo $Donnees["ND"]; ?>" value ="Valider" class="btn btn-default">
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
							
							
							
							
<?php				}
			$MesOT -> closeCursor();
?>	
						</ul>
					</div>			
					<div class="col-lg-6 table-Responsive">
						<h4> Derangements releves </h4>
<?php					
		$finis = $bdd -> prepare('select count(*) as mesdrgt from derangement where CodeEquipe =:Ce AND ETATOT ="REALISEE" ');
		$finis -> execute(array(':Ce'=> $_SESSION["CODEEQUIPE"] ));
			$data = $finis -> fetch();
				$Totale = $data["mesdrgt"]; 
					$finis -> closeCursor();
				
				if (empty($Totale))
					{
?> 	
					<div class ="col-lg-3 col-xs-3 monbox">  
						Aucun Resultat   
					</div>  
<?php				} else
						{	
?>							
						<div class ="col-lg-4 col-xs-4 monbox">  
							Resultats : <span class ="pull-right badge"> <?php echo $Totale; ?> OT  </span> 
						</div> <br/>

					<table class ="table table-Condensed table-bordered monbox">
						 <thead> <!-- En-tête du tableau -->
								<tr>
									<th> <abbr title="Numero derangement"> ND <abbr></th>
									<th><abbr title="Sous Repartiteur"> SR <abbr></th>
									<th>Numero Releve</th>
									<th>Date Releve</th>
									<th>Vitesse Releve</th>
								</tr>
							</thead>
							<tbody>
<?php
include('navigationscript.php');
				try
					{
						$drgtce = $bdd -> prepare('select derangement.ND,derangement.codesr,derangement.Prioritedrgt,derangement.DATEORIENTATION,derangement.CodeEquipe,
													releve.NUMERORELEVE,releve.DATERELEVE,Timestampdiff(HOUR,derangement.DATEORIENTATION,releve.DATERELEVE) as VR
														from derangement inner join releve on derangement.ND = releve.ND
															where derangement.ETATOT = "REALISEE" AND CodeEquipe = :chef
																LIMIT :PE,:MP');
						$drgtce -> bindValue(':PE',$premiereEntree, PDO::PARAM_INT);
						$drgtce -> bindValue(':MP',$LignesParPages, PDO::PARAM_INT);
						$drgtce -> bindValue(':chef',$_SESSION["CODEEQUIPE"], PDO::PARAM_STR);
					
					$drgtce ->execute();
					} catch(Exception $e)
					{
?>
							<div class="alert alert-danger">
								 <?php echo 'Echec : Contacter votre administrateur.'. $e->getMessage(); ?>
							</div>
<?php					}
				WHILE ( $donnees = $drgtce -> fetch() )
					{	?>									
									<tr>
									  <td> <a href="Modification.php?OT=<?php echo $donnees["ND"];?>"> <?php echo $donnees["ND"];?> </a> </td>
									  <td> <?php echo $donnees["codesr"] ;?> </td>
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
					$drgtce -> closeCursor();
?>				
							</tbody>
					</table>							

					
<ul id="pagination" class = "pull-right">
					<li class="previous-off"> Pagination </li>
 
<?php		
				for($i=1; $i<=$NombredePages; $i++) //On fait notre boucle
					{ 
						 //On va faire notre condition
						 if($i==$pageActuelle) //Si il s'agit de la page actuelle...
						 { ?>
							  <li class="active"><?php echo $i; ?></li>
		<?php				 }	
						 else //Sinon...
						 { ?>
							<li> <a href="Decharger.php?page=<?php echo $i; ?>">  <?php echo $i; ?>  </a></li>
		<?php			 }
					}	?>
					<li class="pagination-next"> Suivant » </li>
		</ul>					
<?php 					} ?>							
					</div>
				</section>
			</div>
<?php include ('footer.php'); ?>			
			
		</div>
	</div>

		
</body>	
</html>			
			