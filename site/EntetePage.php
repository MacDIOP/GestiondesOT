<?php 
session_start(); 
if( empty($_SESSION['Matricule']) )
	{
		header('Location: index.php');
	}
?>	
<!--==============================header=================================-->

	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
					<div class="navbar-header">
						<a class="navbar-brand" href="#"> Gestion des Ordres de travail </a>
					</div>
					
					<ul class="nav navbar-right top-nav">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <span class="glyphicon glyphicon-user"></span> <strong> <?php echo $_SESSION['Nom']. " ".$_SESSION['Prenom']  ?> </strong> <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li>
									<a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['Statut']; ?> </a>
								</li>
								<li>
									<a href="#"><i class="fa fa-fw fa-envelope"></i> Notifications</a>
								</li>
								<li>
									<a data-toggle="modal" href="#Edit" ><i class="fa fa-fw fa-gear"></i> Parametres </a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="deconnexion.php"><i class="fa fa-fw fa-power-off"></i> Deconnecter</a>
								</li>
							</ul>
						</li>
					</ul>
	</nav>
				<header>
			
			<div class="row-top">
				<div class="wrapper">
											
				</div>
			</div>
		<!--==============================Choix des menus=================================-->
				
<?php  if ($_SESSION['Statut'] == "Pilote" )
			{?>						
				<div class="navbar navbar-inverse">
					<div class="navbar-header headernav">
						<a class="navbar-brand" href="#">Navigation Principale </a>
					</div>
					<ul class="nav navbar-nav LemunGeneral">
						<li class="active"> <a href="index.php"> Home </a>  </li>
						<li class="dropdown">  <!----=====Menu deroulant ====---->
							<a data-toggle="dropdown" href="#">Gestion des OT<b class="caret"></b></a>
							<ul class="dropdown-menu MenuDropdown">
								<li><a href="Orientation.php">Orientation des OT</a> </li>
								<li><a href="Releve.php">Decharge des OT</a></li>
								<li><a href="Historiqueot.php">Liste des Ot realises</a></li>
								<li class="divider"></li>
								<li><a href="importer.php"> Importation COCC </a></li>
							</ul>
						</li>
						<li> 
							<a href="Gestiondesequipes.php"> Gestion des Equipes </a>
					<!--		<ul class="dropdown-menu">
								<li>
									<a href="historiquedesteams.php"> Les Equipes </a>
								</li>
								<li>
									<a href="Affectation.php"> Former Une Equipe  </a>
								</li>

							</ul> --->
						</li>
						<li role="presentation" class="disabled"><a href="#">Nos Agents</a> </li>
						<li role="presentation" class="disabled"><a href="#">Nos Centres</a> </li>
						<li><a href="Modification.php" style= "color : #D9534F;" class="pull-right">Editer Un Numero</a> </li>
					</ul>
				</div>
	<?php  } Else 
		if	($_SESSION['Statut'] == "Chef Equipe" )
		{ ?>
				<div class="navbar navbar-inverse">
					<div class="navbar-header headernav">
						<a class="navbar-brand" href="#">Navigation Principale </a>
					</div>
					<ul class="nav navbar-nav LemunGeneral">
						<li class="active"> <a href="#"> Home </a>  </li>
						<li><a href="Decharger.php"> Mes OT </a> </li>
						<li><a href="#">Mes Agents</a> </li>
						<li><a href="Modification.php" style= "color : #D9534F;" class="pull-right">Rechercher Un Numero</a> </li>
					</ul>
				</div>
	<?php }  ?>					

				</header>

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
				