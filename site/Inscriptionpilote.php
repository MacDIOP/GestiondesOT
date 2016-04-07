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
	</nav>
				<header>
			
					<div class="row row-top">
						<div class="wrapper">
													
						</div>
					</div>
		<!--==============================Choix des menus=================================-->
				</header>

<!-----==================Le corps de la page========================---------->		

		<div class="row section" style="padding-top: 30px;">
		
				<div class="panel panel-default monbox col-lg-8 col-lg-offset-2 MargeSup">
					<div class="panel-heading">
						<h4> Inscription Pilote ou Superviseur Pilote </h4>					
					</div>
					<div class="panel-body">
						<form class="form-horizontal" id="forminscriptionP" role="form" data-toggle="validator">
							<fieldset>
							<!-- Form Name -->
							<legend class="monbox">Formulaire d'inscription</legend>
							<!-- Text input-->
							<div class="form-group">
							  <label class="col-lg-4 control-label" for="textinput">Votre Matricule</label>  
							  <div class="col-lg-6">
								<input id="" name="textinput" placeholder="" class="form-control input-md" data-error="Votre matricule nous permet de vous identifier" type="text" required>
								  <span class="help-block with-errors">Votre Matricule Salaire</span>  
							  </div>
							</div>

							<!-- Text input-->
							<div class="form-group">
							  <label class="col-lg-4 control-label" for="">Votre Nom</label>  
								  <div class="col-lg-6">
									<input id="lenom" name="" placeholder="" data-minlength="2" data-error="Votre nom doit avoir minimum 2 lettres" class="form-control input-md"  type="text" required>
									<span class="help-block with-errors"></span>
								  </div>
							</div>

							<!-- Text input-->
							<div class="form-group">
							  <label class="col-md-4 control-label" for="">Votre prenom</label>  
							  <div class="col-md-6">
								<input id="leprenom" name="" placeholder="" data-minlength="2" data-error="Votre Prenom doit avoir minimum 2 lettres" class="form-control input-md"  type="text" required>
								<span class="help-block with-errors"></span>
							  </div>
							</div>

							<!-- Text input-->
							<div class="form-group">
							  <label class="col-lg-4 control-label" for="mail">Votre adresse E-mail</label>  
							  <div class="col-lg-6">
							  <input id="mail" name="mail" placeholder="" class="form-control input-md" type="email" data-error="Votre Adresse e-mail est Invalide" required>
							  <span class="help-block with-errors">adresse@tadex.sn par example</span>  
							  </div>
							</div>
							
							<div class="form-group">
								<label for="inputPassword" class="control-label">Votre mot de passe </label>
								<div class="form-group col-lg-4">
								  <input type="password" data-minlength="6" class="form-control" id="inputPassword" placeholder="Mot de passe" required>
								  <div class="help-block with-errors">4 caracteres au minimum</div>
								</div>
								<div class="form-group col-lg-4 col-lg-offset-2">
								  <input type="password" class="form-control" id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="Mot de passe non conformes" placeholder="Confirmer" required>
								  <div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-offset-2" class="control-label"> Vous etes :</label>
									<p>
									  Pilote:
									  <input type="radio" class="flat" name="gender" id="genderM" value="M" checked="" required /> ou  Superviseur:
									  <input type="radio" class="flat" name="gender" id="genderF" value="F" />
									</p>
							</div>
								<!-- Prepended text-->
							<div class="form-group">
							  <label class="col-md-4 control-label" for="Num">Votre telephone</label>
							  <div class="col-md-6">
								<div class="input-group">
								  <span class="input-group-addon">00221</span>
								  <input id="Num" name="Num" class="form-control" placeholder="" type="tel" data-minlength="9" data-error="Numero Invalide" required>
									<span class="help-block with-errors"></span>
								</div>
								
							  </div>
							</div>
						</div>
						<div class="panel-footer monbox">
							<!-- Button (Double) -->
							<div class="form-group">
							  <label class="col-md-4 control-label" for="">Soumettre les donnees</label>
							  <div class="col-md-6">
								<button type="submit" name="" class="btn btn-success">Envoyer</button>
								<button type="refresh" name="" class="btn btn-danger">Actualiser</button>
							  </div>
							</div>
						</div>
							</fieldset>
						</form>
					
					
				</div>
			</div>
		

<?php include ('footer.php'); ?>			

			<script>
				$('#forminscriptionP').validator().on('submit', function (e) {
				  if (e.isDefaultPrevented()) {
					  //attr('disabled', 'disabled'); 
					// handle the invalid form...
				  } else {
					  removeAttr('disabled','disabled');
					// everything looks good!
				  }
				})
			</script>
		</div>
	</div>
	
</body>	
</html>