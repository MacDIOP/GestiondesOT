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

			<div class="section">
		
				<div class="row MargeSup">
					<h3 class="page-header">Mon Tableau de bord </h3>
					<div class="col-lg-4 panel panel-default monbox">
					
						<div class="panel panel-heading">
							<h4> Details de mon profil	</h4>
						</div>
						<div class="panel panel-body">
							<ul class="list-group-item">
								<li class="list-group-item-heading monbox">
									Votre Nom <button class="btn btn-md btn-default pull-right"> Mamadou Kane	</button>
								</li>
								<li class="list-group-item box">
									Date Inscription : <button class="btn btn-md pull-right"> la date de l'inscription	</button>
								</li>
								<li class="list-group-item box">
									Mon Centre Actuel : 
									<button title="Le bilan de mon centre" href="#" id="tooltipCentre" data-toggle="tooltip" data-placement="left" class="btn btn-default pull-right" type="button"> 
									Medina <i class="fa fa-eye"> </i> 
									
									</button>
								</li>
								<li class="list-group-item box">
									 Gestion des OT 
									<button id="pop" class="btn btn-default pull-right" data-toggle="popover"
										data-html="true" data-placement="bottom">
										Aller a... <i class="fa fa-arrow-circle-right"> </i>
									</button>	
			<!------Contenu du popover-------->
				<div id="popover-MenuGOT" class="hide">
					<ul class='list-group-item'>
						<li class='list-group-item-heading monbox'> Menu Gestion des OT </li>
						<li class='list-group-item  monbox'> <a href='#' style='color: #FFF; outline:none:'> Orientation </a> </li>
						<li class='list-group-item  monbox'> <a href='#' style='color: #FFF; outline:none:'> Decharge </a> </li>	
						<li class='list-group-item  monbox'> <a href='#' style='color: #FFF; outline:none:'> OT realises </a> </li>
					</ul>
				</div>
										
								</li>
								<li class="list-group-item box">
									Parametre <button class="btn btn-md pull-right" data-toggle="modal" href="#Edit">  Modifier mon profil  <i class="fa fa-gear"> </i> </button>
								</li>	
							</ul>
						</div>
					</div>
					
			<!-----Ici la fenetre Modale de la modification des profils-------->				
					<div class="modal fade" id="Edit">   
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title"> Modifications des donnees de Connexion </h4>
								</div>
								<div class="modal-body monbox">
<?php 
		$Mat = $_SESSION['Matricule'];
				
				$Recupdonnee = $bdd -> prepare('select * from utilisateur where Matricule = :M');
					$Recupdonnee -> execute(array('M' => $Mat));
					
					$Valeurs = $Recupdonnee -> fetch();
?>									
									<form role="form" method="POST" action="checkinscription.php">
										<div class="form-group">
											<label>Votre Identifiant</label>
											<input class="form-control" name="LID" placeholder="<?php echo $Valeurs["Matricule"]; ?>"> <!-----Voici L input------>
										</div>
										<div class="form-group">
											<label>Votre Mot de Passe</label>
											<input class="form-control" type="password" placeholder="<?php echo $Valeurs["password"];  ?>" name="pass"> <!-----Voici L input------>
										</div>
										<div class="form-group">
											<label>Confirmation Mot de Passe</label>
											<input class="form-control" type="password" placeholder="" name="pass2"> <!-----Voici L input------>
										</div>
										<div class="form-group">
											<label>Votre Nom</label>
											<input class="form-control" name="lenom" placeholder="<?php echo $Valeurs["nom"];  ?>"> <!-----Voici L input------>
										</div>
										<div class="form-group">
											<label>Votre Prenom</label>
											<input class="form-control" name="prenom" placeholder="<?php echo $Valeurs["Prenom"];  ?>"> <!-----Voici L input------>
										</div>
										<div class="form-group">
											<label>Fin des Modifications </label>
											<input class="form-control btn btn-success btn-sm" type="Submit"  name="Edition" placeholder="A ne pas oublier"> <!-----Voici L input------>
										</div>	
									</form>
<?php  $Recupdonnee -> closeCursor(); ?>									
								</div>
								<div class="modal-footer">
									<button class="btn btn-info" data-dismiss="modal">Fermer</button>
								</div>
							</div>
						</div>
					</div>
					
		<!------Fin Details de mon profil------------------>			
					<div class="panel panel-default col-lg-8">
						<div class="panel panel-heading">
							<h4> Mon travail et mes Activites </h4>
						</div>
						<div class="panel panel-body">
							<ul role="tablist" class="nav nav-tabs bar_tabs" id="myTab">
							  <li class="active" role="presentation">
								<a aria-expanded="false" data-toggle="tab" role="tab" href="#Accueil">
									Bilan Global de mes OT
								</a>
							  </li>
							  <li class="" role="presentation">
								  <a aria-expanded="false" data-toggle="tab" role="tab" href="#Orientations">
									Mes orientations
								  </a>
							  </li>
							  <li class="" role="presentation">
								  <a aria-expanded="true" data-toggle="tab" role="tab" href="#Decharges">
									Mes decharges
								  </a>
							  </li>
							  <li class="" role="presentation">
								  <a aria-expanded="true" data-toggle="tab" role="tab" href="#Activites">
									Mes activites 
								  </a>
							  </li>
							</ul>
							<div class="tab-content" id="myTabContent">
							  <div aria-labelledby="home-tab" id="Accueil" class="tab-pane fade active in" role="tabpanel">
									<div class="col-lg-12">
										<h4> <i class="fa fa-pie-chart"> Graphe de mes OT (Orientations et Decharges)  </i> </h4>
										<canvas id="LineDerangement"></canvas>
									</div>	
							  </div>
							  <div aria-labelledby="profile-tab" id="Orientations" class="tab-pane fade" role="tabpanel">
									
									<h4> Toutes mes orientations </h4>
										<div class="col-lg-8 monbox">
										
											<table class="table table-borderer">
												<thead>
												  <tr>
													<th>ND</th>
													<th>SR</th>
													<th>Code Equipe</th>
													<th>Date Orientation</th>
													<th>Details</th>
												  </tr>
												</thead>
												<tbody>
												  <tr>
													<td> 338653245 </td>
													<td>B00</td>
													<td> TDX-M# </td>
													<td> la date Ici </td>
													<td>
														<button data-toggle="modal" href="#Infoscompletes"  id="numero" type="button" class ="btn btn-sm btn-outline btn-success"
																data-html ="true">
															voir les details <i class="fa fa-eye"></i> 
														</button>
													</td>								
												  </tr>	
					<!-----Ici la fenetre Modale-------->				
						<div class="modal fade modal-md" id="Infoscompletes">   
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header monbox">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
										</button>
										<h4 class="modal-title" id="myModalLabel2"> Informations de l'OT </h4>
									</div>
									<div class="modal-body">
										<li class="list-group-item-heading monbox"> Numero Derangement	<span class="pull-right badge">338762345 </span> </li>
										<li class="list-group-item monbox"> SR	<span class="Pull-right badge"> B12</span> </li>
										<li class="list-group-item monbox">	Date Orientation <span class="Pull-right badge"> La date ICI </span> </li>
										<li class="list-group-item monbox">	Equipe <span class="Pull-right badge"> TDX-M3 </span> </li>
										<li class="list-group-item monbox">	Client<span class="Pull-right badge"> Madame Dieng </span> </li>
										<li class="list-group-item monbox">	Contact <span class="Pull-right badge"> 775432387 </span> </li>
										<li class="list-group-item monbox">	Priorite Signalisation <span class="Pull-right badge">  </span> </li>
										<li class="list-group-item monbox">	Commentaires <span class="Pull-right badge">  </span> </li>
										<li class="list-group-item monbox">	Date  <span class="Pull-right badge">  </span> </li>
										<li class="list-group-item monbox">	<abbr title ="Priorite Derangement"> PRD </abbr> <span class="Pull-right badge"> Residentiel </span> </li>
										<li class="list-group-item monbox">	Essai <span class="Pull-right badge">  </span> </li>
										<li class="list-group-item monbox">	Date Essai <span class="Pull-right badge"> Une date ici </span> </li>
									</div>
								</div>
							</div>
						</div>								
												</tbody>  
											</table>
										</div>
									</div>
							  <div aria-labelledby="profile-tab" id="Decharges" class="tab-pane fade" role="tabpanel">
									
									<h4> Toutes mes orientations </h4>
										<div class="monbox">
										
											<table class="table table-borderer">
												<thead>
												  <tr>
													<th>ND</th>
													<th>SR</th>
													<th>Code Equipe</th>
													<th>Date Orientation</th>
													<th>Numero decharge</th>
													<th>Date decharge</th>
													<th>Details</th>
												  </tr>
												</thead>
												<tbody>
												  <tr>
													<td> 338653245 </td>
													<td>B00</td>
													<td> TDX-M# </td>
													<td> la date Ici </td>
													<td> 653 </td>
													<td> la date Ici </td>
													<td>
														<button data-toggle="modal" href="#InfoscompletesDecharges"  id="#" type="button" class ="btn btn-sm btn-outline btn-success"
																data-html ="true">
															voir les details <i class="fa fa-eye"></i> 
														</button>
													</td>								
												  </tr>	
					<!-----Ici la fenetre Modale-------->				
						<div class="modal fade modal-md" id="InfoscompletesDecharges">   
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header monbox">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
										</button>
										<h4 class="modal-title" id="myModalLabel2"> Informations de l'OT </h4>
									</div>
									<div class="modal-body">
										<li class="list-group-item-heading monbox"> Numero Derangement	<span class="pull-right badge">338762345 </span> </li>
										<li class="list-group-item monbox"> SR	<span class="Pull-right badge"> B12</span> </li>
										<li class="list-group-item monbox">	Date Orientation <span class="Pull-right badge"> La date ICI </span> </li>
										<li class="list-group-item monbox">	Numero Decharge <span class="Pull-right badge"> 432 </span> </li>
										<li class="list-group-item monbox">	Date Decharge <span class="Pull-right badge"> La date ICI </span> </li>
										<li class="list-group-item monbox">	Equipe <span class="Pull-right badge"> TDX-M3 </span> </li>
										<li class="list-group-item monbox">	Client<span class="Pull-right badge"> Madame Dieng </span> </li>
										<li class="list-group-item monbox">	Contact <span class="Pull-right badge"> 775432387 </span> </li>
										<li class="list-group-item monbox">	Priorite Signalisation <span class="Pull-right badge">  </span> </li>
										<li class="list-group-item monbox">	Commentaires <span class="Pull-right badge">  </span> </li>
										<li class="list-group-item monbox">	Date  <span class="Pull-right badge">  </span> </li>
										<li class="list-group-item monbox">	<abbr title ="Priorite Derangement"> PRD </abbr> <span class="Pull-right badge"> Residentiel </span> </li>
										<li class="list-group-item monbox">	Essai <span class="Pull-right badge">  </span> </li>
										<li class="list-group-item monbox">	Date Essai <span class="Pull-right badge"> Une date ici </span> </li>
									</div>
								</div>
							</div>
						</div>								
												</tbody>  
											</table>
										</div>
							  </div>
							  <div aria-labelledby="profile-tab" id="Activites" class="tab-pane fade" role="tabpanel">
									<h4> Toutes mes actions  </h4>
										<p>
											Cette section concerne toutes les actions que le pilote a effectue (Connexion,Orientation,affectations) <br/>
											Elle Sera developpee pendant le developpemnt de "L'historisation des evenements.
										</p>
										
							  </div>
							</div>
						</div>
					</div>
				</div>

<?php include ('footer.php'); ?>			

	<script>
		$("[data-toggle=popover]").popover({
			html: true, 
			content: function() {
				  return $('#popover-MenuGOT').html();
				}
		});
		
		$(function (){
			$('#tooltipCentre').tooltip();
			})
	</script>	
	
	
	
			</div>
		</div>
	
</body>	
</html>