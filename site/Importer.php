<!DOCTYPE html>
<html lang="en">
<!--=============Entete HTML========================-->
<?php 
		include("entetehtml.php"); 
		include('ConnexionBD.php');
		include('ScriptGestioErreurs.php');
set_error_handler('my_error_handler'); 		
?>
<body id="page1">
	<div class="extra container">
		<div class="main">
<?php 
include("EntetePage.php");
?>		
<!-----==================Le corps de la page========================---------->		
	<section class="row MargeSup">
		<h3>Importation des instances </h3>
		
		<div class="col-lg-8 box">
				<h4> Ajout du fichier </h4>
<?php
if(Empty($_GET['File']))
		{
?>			<div class="alert alert-danger">
				 <?php !trigger_error('Vous devevez ajouter le fichier ...', E_USER_NOTICE); ?>
			</div>
			</br> <h4> <a href="Importer.php?File='ajouter'"> <button type="button" class="btn btn-primary">  Ajouter le fichier  </button> </a> </h4>	
<?php	} else				
		{
		include('ImportationScript.php');	
		} 
?>		
		</div>
	</section>


<?php include ('footer.php'); ?>			
			
		</div>
	</div>

		
</body>	
</html>