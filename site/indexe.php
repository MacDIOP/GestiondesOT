<!DOCTYPE html>
<!--Traitement de la connexion-->
<?php include("checkinscription.php"); ?>
<html lang="en">

	<head>
		<title> Gestion des Ordre de Travail</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen">
		<link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
		<link rel="stylesheet" href="css/layout.css" type="text/css" media="screen">
	</head>

	<head>
		<title> Gestion des Ordre de Travail</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen">
		<link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
		<link rel="stylesheet" href="css/layout.css" type="text/css" media="screen">
		<script src="js/jquery-1.6.3.min.js" type="text/javascript"></script>
		<script src="js/cufon-yui.js" type="text/javascript"></script>
		<script src="js/cufon-replace.js" type="text/javascript"></script>
		<script src="js/NewsGoth_BT_400.font.js" type="text/javascript"></script>
		<script src="js/FF-cash.js" type="text/javascript"></script>
		<script src="js/script.js" type="text/javascript"></script>
		<script src="js/jquery.equalheights.js" type="text/javascript"></script>
		<script src="js/jquery.easing.1.3.js" type="text/javascript"></script>
		<script src="js/tms-0.3.js" type="text/javascript"></script>
		<script src="js/tms_presets.js" type="text/javascript"></script>
		<script src="js/easyTooltip.js" type="text/javascript"></script>
		<!--[if lt IE 7]>
		<div style=' clear: both; text-align:center; position: relative;'>
			<a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
				<img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
			</a>
		</div>
		<![endif]-->
		<!--[if lt IE 9]>
			<script type="text/javascript" src="js/html5.js"></script>
			<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen">
		<![endif]-->
	</head>
	<body id="page1">
		<div class="extra">
			<div class="main">
<!--==============================header=================================-->
				<header>
					<div class="indent">
						<div class="row-top">
							<div class="wrapper">
								<h1><a href="index.html">TADEXRESA</a></h1>
								<strong class="support">+221-33-831-03-03</strong>
							</div>
						</div>
					</div>
					<div class="wrapper">
						
				</header>		
						<div class="boxform1">
								<div class="aligncenter">
									<h4>
									<a class="buttonStatut" href="#" onClick="toggle_div(this,'boxInscriptionP')">Pilote</a>
										NOUVEL UTILISATEUR 
									<a class="buttonStatut" href="#" onClick="toggle_div(this,'boxInscriptionCE')">Chef Equipe</a>

									</h4>
								</div>
								<div class="cacherdiv" id="boxInscriptionP">	
									<div class="padding">	
										<form id= "forminscriptionP" method="post" action="indexe.php">
												  <label for="Idpilote">  Matricule (Pilote) </label>  <input type="text" id="IdPilote" name="Idpilote"  required="true"/> <br/>
												  <label for="PasswdP"> Mot de passe </label>  <input type="password" id="PasswdP" name="passwdP" />  
												  <span class="tooltip"></span> <br/> 
												  <label for="copasswdP"> Mot de passe (confirmation) </label>  <input type="password" id="copasswdP" name="copasswdP"/>
												  <span class="tooltip"></span> <br/>
												  <label for="Nom"> Nom </label>  <input type="text" id="Nom" name="Nom"/> <br/>
												  <label for="Prenom"> prenom </label>  <input type="text" id="Prenom" name="Prenom"/> <br/> 
													 <a class="button-2" href="#" onClick="document.getElementById('forminscriptionP').submit()">valider</a>
													 <a class="button-2" href="#" onClick="document.getElementById('forminscriptionP').reset()">Clear</a>											
										</form>
									</div>
								</div>
								<div class="cacherdiv" id="boxInscriptionCE">	
									<div class="padding">	
										<form id= "forminscriptionCE" method="post" action="indexe.php">
											  <label for="Matricule"> Matricule(agent) </label>  <input type="text" id="Matricule" name="Matricule" required/> <br/>
											  <label for="CodeEquipe">  Code Equipe </label>  <input type="text" id="Statut" name="CodeEquipe"  required="true"/> <br/>
											  <label for="Email">  Adresse E-mail </label>  <input type="email" id="Email" name=""/> <br/>											  
											  <label for="PasswdCE"> Mot de passe </label>  <input type="password" id="PasswdCE" name="passwdCE" required/>  
											  <span class="tooltip"></span> <br/> 
											  <label for="copasswdCE"> Mot de passe (confirmation) </label>  <input type="password" id="copasswdCE" name="copasswdCE"/>
											  <span class="tooltip"></span> <br/>
											   
												 <a class="button-2" href="#" onClick="document.getElementById('forminscriptionCE').submit()">valider</a>
												 <a class="button-2" href="#" onClick="document.getElementById('forminscriptionCE').reset()">Clear</a>											
										</form>
									</div>
								</div>
								
						</div>			
					</div>
				
		<script type="text/javascript">
			$(window).load(function() {
				$('.slider')._TMS({
					duration:800,
					easing:'easeOutQuart',
					preset:'simpleFade',
					slideshow:7000,
					banners:false,
					pauseOnHover:true,
					waitBannerAnimation:false,
					prevBu:'.prev',
					nextBu:'.next'
				});
			});
			
			function toggle_div(bouton, id) {
					//on récupère ta div à "toggler"
				var div = document.getElementById(id),
					//on récupère son état à l'instant initial
					//la création d'un nouveau String est nécessaire car son état va être modifié dans la boucle
					previousState = new String(div.style.display),
					//on récupère la liste de tous les éléments soumis à affichage conditionnel
					showElements = document.getElementsByClassName("cacherdiv");
			  
				//pour chacun des élements, on le cache (plutot que de vérifier si l'element était deja affiché)
				for(var i = 0; i < showElements.length; i++) {
					showElements[i].style.display = "none";
				}
			  
				//Si le block n'était précement pas affiché, alors on l'affiche
				//Si avant le clic il etait affiché, alors il reste caché (comportement toggle conservé)
				if(previousState=="none") {
					div.style.display = "block";
				}
			}	
		</script>
	
	</body>			
</html>	