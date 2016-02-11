<?php 
		include("LesFonctions.php");
		include("Lesorientation.php");
	   include("ScriptGestioErreurs.php");	
?>
<!DOCTYPE html>
<html lang="en">
<!--=============Entete HTML========================-->
<?php include("entetehtml.php"); ?>

	<body id="page2">
		<div class="extra container">
			<div class="main">
			
<?php include("EntetePage.php");?>			

<!--==============================content================================-->

		<section class ="row MargeSup">
			
			
			<div class ="row MargSup">
				<div class= "col-lg-12 col-xs-12">
				
					<div class="panel panel-default">		
						<div class="panel-heading monbox">
                            Les Derangements Non Orientes
                        </div>
						<div class="panel-body">
							<div class ="col-lg-9 col-xs-9 table-responsive">
								<table id ="DataTableGOT" class="table table-bordered table-condensed">
									<thead>
										<tr>
											<th> <abbr title="Numero derangement"> ND </abbr> </th>
											<th> <abbr title="Sous Repartiteur"> SR </abbr> </th>
											<th>Date Essai </th>
											<th>Priorite derangement </th>
											<th>Nom Client </th>
											<th> <strong> Orientation </strong></th>
										</tr>
									</thead>
									<tbody>
		<?php
		//include('navigationscript.php');						
				$NonOriente = $bdd -> prepare('select ND,codesr,DATE_FORMAT(DateEssai,"%d/%m/%Y %H:%i:%s") as DateEssai,Prioritedrgt,NOMCLIENT 
												from derangement where ETATOT != "Oriente" 
													');
						// ORDER BY DateEssai DESC  LIMIT :PE,:MP    $NonOriente -> bindValue(':PE',$premiereEntree, PDO::PARAM_INT);
								//$NonOriente -> bindValue(':MP',$LignesParPages, PDO::PARAM_INT);
								$NonOriente -> execute();
								While ($Data = $NonOriente -> fetch() )
									{ 
		?>			
										
											<tr>
												<td> <abbr title="Numero derangement"> <?php echo $Data["ND"]; ?> </abbr> </td>
												<td> <abbr title="Sous Repartiteur"> <?php echo $Data["codesr"]; ?> </abbr> </td>
												<td>  <?php echo $Data["DateEssai"]; ?> </td>
												<td>  <?php echo $Data["Prioritedrgt"]; ?> </td>
												<td> <?php echo $Data["NOMCLIENT"]; ?> </td>
												<td> <button data-toggle="modal" href="#<?php echo $Data["ND"]; ?>" type="button" class ="btn btn-sm btn-outline btn-success"> Oriente a ... </button>	</td>
											</tr>
										
										
			<!-----Ici la fenetre Modale-------->				
							<div class="modal fade" id="<?php echo $Data["ND"]; ?>">   
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title"> Orientation de l OT : <?php echo $Data["ND"]; ?> </h4>
										</div>
										<div class="modal-body">
											<form method="POST" action="Orientation.php">	
												<ul class ="list-group">
		<?php 									
			$LesEquipes = $bdd -> query('Select journalequipe.CodeEquipe,CONCAT_WS(" ",agent.PRENOMAGENT,agent.NOMAGENT) AS ChefEquipe   
														FROM journalequipe Natural JOIN agent');
					While ($donnees = $LesEquipes -> fetch() )
								{			
		?>								 
											<li class="list-group-item monbox">
												<label>
													<input type="radio" name="Equipe" id="<?php echo $donnees["CodeEquipe"] ?>" value="<?php echo $donnees["CodeEquipe"] ?>">
													<input type="hidden" name="OT" value="<?php echo $Data["ND"]; ?>">
													<?php echo $donnees["CodeEquipe"] ?>
												</label>
												<span class="pull right"> <?php echo $donnees["ChefEquipe"] ?> </span>
											</li>			
		<?php 
								}
							$LesEquipes -> closeCursor();	
		?>								
												</ul>	
											<div class="input-group">
												<span class="input-group-btn">
													<input type ="submit" name="OK" value ="Valider" class="btn btn-primary">
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
			<!--------Fin de la fenetre---------->								
										
		<?php						}
				$NonOriente -> closeCursor();						
		?>			
									</tbody>
								</table>
							</div> <!-------Fin de table responsive-------->
						
					
				
<!----------------Formulaire d orientation-------------->

					<div class="col-lg-3 monbox">
						<h4> Enregistrer Un Nouveau derangement </h4>
<?php  include("scriptformulairedrgt.php"); ?>							
							<form role="form" method="POST" action="Orientation.php">
								<div class="form-group">
									<label>Numero Derangement</label>
									<input class="form-control" name="Numdrgt"> <!-----Voici L input------>
								</div>
								<div class="form-group">
									<label>Sous Repartiteur</label>
									<input class="form-control" name="codesr"> <!-----Voici L input------>
									<p class="help-block">Verifier Bien que le SR existe </p>
								</div>
								<div class="panel panel-info">
									<div class="panel-heading box">
										<h4 class="panel-title">
											<a class="accordion-toggle" style ="color : black;" href="#equipe" data-parent="#monaccordeon" data-toggle="collapse"> Choix de l'equipe </a>
										</h4>
									</div>
									<div id="equipe" class="panel-collapse in collapse">
										<div class="panel-body form-group monbox">
											<label>Les Equipes</label>
												<select multiple class="form-control" name="CodeEquipe">
						<?php $CodeEquipe = $bdd -> query ('Select journalequipe.CodeEquipe,CONCAT_WS(" ",agent.PRENOMAGENT,agent.NOMAGENT) AS ChefEquipe   
										FROM journalequipe Natural JOIN agent');
													While ( $donnees = $CodeEquipe -> fetch() )
													{	
													?>
														<option  value="<?php echo $donnees["CodeEquipe"];?>"> <?php echo $donnees["CodeEquipe"].", ".$donnees["ChefEquipe"];?></option>
													<?php	}
													$CodeEquipe -> closeCursor();
													?>	
												</select>
										</div>
									</div>
								</div>
								<div id="affichage"><span class="label labelwarning">"C etait les equipes de Medina !</span></div>
								<div class="form-group">
									<label>Date Signalisation </label>
									<input class="form-control" name="Dsign" type="date"> <!-----Voici L input------>
										<p class="help-block">Au format JJ/MM/AAAA</p>
								</div>
								<div class="form-group">
									<label> Commentaires Signalisation </label>
									<input type="text" name="Csign" class="form-control"> <!-----Voici L input------>
								</div>
								<div class="form-group">
									<label>Date Essai</label>
									<input class="form-control" type="date" name="Dessai"> <!-----Voici L input------>
									<p class="help-block">Au format JJ/MM/AAAA </p>
								</div>
								<div class="form-group">
									<label>Commentaires Essai</label>
									<input type="textarea" class="form-control" name="Cessai"> <!-----Voici L input------>
								</div>
								<div class="form-group">
									<label>Priorite Derangement </label>
									<input type= "text" class="form-control" placeholder="Residentiel" name="PD"> <!-----Voici L input------>
									<p class="help-block">Residentiel sera mis par defaut</p>
								</div>
								<div class="form-group">
									<label>Nom du client</label>
									<input type= "text" class="form-control" name="Nom"> <!-----Voici L input------>
								</div>
								<div class="form-group">
									<label>Numero Client</label>
									<input class="form-control" name="ctct"> <!-----Voici L input------>
								</div>
								
								<button type="reset" class="btn btn-primary">Reinitialiser</button>
								<input type ="submit" name="#" value ="Valider" class="btn btn-success">
							</form>
					</div> <!-------Fin du formulaire d enregistrement-------->
					
						</div> <!-------Fin du Panel body-------->
					</div>  <!-------Fin du panel-------->	
				</div>	<!-------Fin des 12 colones-------->
			</div> <!-------Fin de la ligne-------->	
					
		</section>
<!--==============================footer=================================-->
<?php include ('footer.php'); ?>

	<script>
		function verifnom(champ)
				{var regex = /[a-zA-Z0-9]$/;
				if(!regex.test(champ.value))
				{alert('Verifier le nom'); champ.value="";}
				}
		function verifprix(champ)
			{ var regex = /[0-9]$/;
				if(!regex.test(champ.value))
				{alert('Verifier le Numero'); champ.value="";}
				}
		function verifqte(champ)
			{ var regex = /[0-9]$/;
				if(!regex.test(champ.value))
				{alert('Verifier la quantité'); champ.value="";	}
				}
		function verifdate(champ)
			{ var regex = /^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/;
				if(!regex.test(champ.value))
				{alert('Verifier la  date'); champ.value="";	}
				}	
	</script>

	<script>
		$(function ()
		{
			$("#equipe").on("shown.bs.collapse", function () 
				{
					$("#affichage").html('<span class="label labelwarning">"Les equipes de Medina</span>');
				})
		});
	</script>
	
		
			</div>
		</div>
	</body>
</html>