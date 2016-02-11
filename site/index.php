<!DOCTYPE html>
<html lang="en">
<!--Traitement de la connexion-->
<?php include("checkconnexion.php") ?>
<!--=============Entete HTML========================-->
<?php 
		include("entetehtml.php"); 
		include('ConnexionBD.php'); 		
		include("ScriptGestioErreurs.php");		
?>
<body style ="padding-top : 0px;" id="page1">
	<div class="extra container">
		<div class="main">
				<header>
					<div class="indent">
						<div class="row-top">
							<div class="wrapper">
								<h1><a href="index.html">TADEXRESA</a></h1>
								<strong class="support">+221-33-831-03-03</strong>
							</div>
						</div>
					</div>
				</header>	
<?php 
//include("EntetePage.php");
?>		
<!-----==================Le corps de la page========================---------->		
				<div class="row MargeSup">
					<h3> Bienvenue a votre nouvelle Application pour la Gestion et le suivi des Ordres de Travail de TADEX	</h3>		
						<div class="col-lg-4 col-md-4 col-lg-offset-2 col-md-offset-2">
							<div class="login-panel panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title">Connectez Vous</h3>
								</div>
								<div class="panel-body monbox">
									<form role="form" id="formconnexion" method ="post" action ="index.php">
										<fieldset>
											<div class="form-group">
												<input class="form-control" type="text"  name="iduser" placeholder="Matricule" autofocus required ="true"/>
											</div>
											<div class="form-group">
												<input class="form-control" type="password"  name="passwd" placeholder="Mot de passe" required = "true"/>
											</div>
											<div class="checkbox CheckboxMarge">
												<label>
													<input name="remember" type="checkbox" value="Remember Me">Se souvenir de moi
												</label>
												<span class="pull-right"> <a href="indexe.php"> Nouveau Profil </a> </span>
											</div>
											<!-- Change this to a button or input when using this as a form -->
											<button href="#" onClick="document.getElementById('formconnexion').submit()" class="btn btn-lg btn-info btn-block">Valider</button>
										</fieldset>
									</form>
								</div>
							</div>
						</div>  
						
					</div>
<?php include ('footer.php'); ?>			
			
		</div>
	</div>
	
</body>	
</html>