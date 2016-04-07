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
		
		<div class="row">
				
			<div class="col-lg-7 col-md-6 col-xs-12 panel">
              
                <div class="panel panel-heading">
                  <h3> <i class="fa fa-plus-circle"></i> Valider Inscriptions </h3>
                </div>
				
                <div class="panel panel-body">
					<!-- start accordion  Panel Body -->
					
                  <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel">
                      <a class="panel-heading box" role="tab"  data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <h4 class="panel-title">LES SUPERVISEURS PILOTES</h4>
                      </a>
                      <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                          <table class="table table-bordered monbox">
                            <thead>
                              <tr>
                                <th>Matricule</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Adresse Email</th>
                                <th>Profil</th>								
								<th>Traitement</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <th scope="row">S342</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>MarkOtto@tadex.sn</td>
                                <td>Pilote</td>
								<td> 
			<button type="button" class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-sm">  <span> <i class="fa fa-gear"></i> </span>  Gerer </button>
								</td>	
                              </tr>
							  
			<!------La fenetre modal------->
                <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2"> Validation Inscription </h4>
                      </div>
                      <div class="modal-body">
                        <ul class="list-group">
							<li class="list-group-item-heading"> Nom et Prenom <span class="badge pull-right"> Demba Diouf </span>	</li>						
							<li class="list-group-item"> Identifiant Genere : <span class="badge pull-right">Pilot-321 </span>	</li>
							<li class="list-group-item"> Privileges <span class="badge pull-right">123 </span>	</li>						
						</ul>
					  </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        <button type="button" class="btn btn-primary">Enregistrer</button>
                      </div>

                    </div>
                  </div>
                </div>				  
							  
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="panel">
                      <a class="panel-heading collapsed box" role="tab" id="headingTwo" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <h4 class="panel-title">LES PILOTES</h4>
                      </a>
                      <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                        <div class="panel-body">
                          <table class="table table-bordered monbox">
                            <thead>
                              <tr>
                                <th>Matricule</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Adresse Email</th>
								<th>Profil</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <th scope="row">S342</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>MarkOtto@tadex.sn</td>
                                <td>
									 <button data-toggle="modal" href="#Add" type="button" class ="btn btn-sm btn-outline btn-success"> Gerer... </button>	
								</td>								
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="panel panel-default">
                      <a class="panel-heading collapsed box" role="tab" id="headingThree" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <h4 class="panel-title">LES CHEF D'EQUIPES</h4>
                      </a>
                      <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                        <div class="panel-body">
                          <h4> Les Nouveaux chefs d'equipes </h4>
						  
							<table class="table table-bordered monbox">
                            <thead>
                              <tr>
                                <th>Identifiant</th>
                                <th>Nom Agent</th>
                                <th>Matricule Agent</th>
                                <th> L'equipe</th>
								<th> Ancien chef de l'equipe </th>
								<th> Centre de L'equipe</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>CE-345</td>
                                <td>le Nom de l'Agent</td>
                                <td>Son  Matricule </td>
                                <td> Code de L'equipe</td>
								<td> Nom et prenom </td>
								<td> Le nom diu centre</td>
							  </tr>
                            </tbody>
                          </table>
                        </div>
                      </di,mv>
                    </div>
                  </div>
                  <!-- end of accordion -->
				</div>   <!-- end of panel body BIG -->
			</div>
				<div class="col-lg-5 panel">
				
					<div class="panel panel-heading">
					  <h3> <i class="fa fa-wrench"></i> Les Modifications de donnees Personnelles </h3>
					</div>
					<div class="panel-body monbox">
						<div class="list-group">
							<a href="#" class="list-group-item-heading monbox">
								<i class="fa fa-user fa-fw"></i>
									Utilisateur Demba Diallo 
								<span class="pull-right text-muted small"><em>4 minutes ago</em>
								</span>
							</a>
							<a href="#" class="list-group-item">
								<i class="fa fa-user fa-fw"></i>
									L'utilisateur Camilo Sene 
								<span class="pull-right text-muted small"><em>12 minutes ago</em>
								</span>
							</a>
							<a href="#" class="list-group-item">
								<i class="fa fa-user fa-fw"></i>
									L'utilisateur Camilo Sene
								<span class="pull-right text-muted small"><em>10:57 AM</em>
								</span>
							</a>
							<a href="#" class="list-group-item">
								<i class="fa fa-user fa-fw"></i>
									L'utilisateur Vermon Sene
								<span class="pull-right text-muted small"><em>9:49 AM</em>
								</span>
							</a>
						</div>
                    </div>
				</div> <!----Panel Modifications------>
		</div> <!-------Fin de la ligne----->
	</div>	
	<div class="row section MargeSup">
		<div class="panel panel-default">
			<div class="panel panel-heading">
				<h3> <i class="fa fa-align-left"></i> Liste des utilisateurs </h3>
			</div>
			<div class="panel panel-body">
				
                    <ul class="nav nav-tabs tabs-left col-lg-2 list-group-item">
                      <li class="list-group-item active"><a class="monbox" href="#home" data-toggle="tab"> Totale Utlisateurs </a>
                      </li>
                      <li class="list-group-item"><a class="monbox" href="#SuperPilot" data-toggle="tab">Superviseurs Pilotes</a>
                      </li>
                      <li class="list-group-item"><a class="monbox" href="#Pilot" data-toggle="tab">Pilotes</a>
                      </li>
                      <li class="list-group-item"><a class="monbox" href="#Chefteam" data-toggle="tab">Chef Equipes</a>
                      </li>
                    </ul>
                  

                  <div class="col-lg-6">
                    <!-- Tab panes -->
                    <div class="tab-content">
                      <div class="tab-pane active" id="home">
                        <p class="lead">Vue globale</p>
							<canvas id="TotalUsers"></canvas>	
                      </div>
                      <div class="tab-pane" id="SuperPilot">	
						<ul class="list-group-item monbox">	
							<li class="list-group-item-heading"> Les superviseurs </li>
							<li class="list-group-item box"> 
								<i class="fa fa-user fa-fw"></i>
									Demba Fall 
								<a class="btn btn-xs btn-default" href="#"> SUP-321</a>
								<a class="btn btn-xs btn-default" href="#"> Medina </a>
								<a class="btn btn-xs btn-default" href="#"> Modifier</a>
							</li>
						</ul>		
					  
					  </div>
                      <div class="tab-pane" id="Pilot"> 
							
					  
					  </div>
                      <div class="tab-pane" id="Chefteam">Les chef d'equipes</div>
                    </div>
                  </div>
				  
				<div class="list-group col-lg-4">
					
					<h3 class="list-group-item-heading "> Activites des utilisateurs </h3>
					<a href="#" class="list-group-item">
						<i class="fa fa-user fa-fw"></i>
							Utilisateur Demba Diallo 
						<span class="pull-right text-muted small"><em>4 minutes ago</em>
						</span>
					</a>
					<a href="#" class="list-group-item">
						<i class="fa fa-user fa-fw"></i>
							L'utilisateur Camilo Sene 
						<span class="pull-right text-muted small"><em>12 minutes ago</em>
						</span>
					</a>
					<a href="#" class="list-group-item">
						<i class="fa fa-user fa-fw"></i>
							L'utilisateur Camilo Sene
						<span class="pull-right text-muted small"><em>10:57 AM</em>
						</span>
					</a>
					<a href="#" class="list-group-item">
						<i class="fa fa-user fa-fw"></i>
							L'utilisateur Vermon Sene
						<span class="pull-right text-muted small"><em>9:49 AM</em>
						</span>
					</a>
				</div>
				
			</div>
		</div>
	</div>
	
<?php include ('footer.php'); ?>			



			
		</div>
	</div>
	
</body>	
</html>