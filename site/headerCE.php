<?php 
session_start(); 
if( empty($_SESSION['Matricule']) )
	{
		header('Location: index.php');
	}
?>	
<!--==============================header=================================-->
				<header>
					<div class="indent">
						<div class="row-top">
							<div class="wrapper">
							<div id ="Sign">
									  <span id ="titreclick"> <a id="notrelien" href ="#"> Donnees Session </a>	</span>
										<div id="DetailsID"> 
											<p>
												Nom : <?php  echo $_SESSION['Prenom']."  ".$_SESSION['Nom']; ?> </br>
												Statut : <?php echo $_SESSION['Statut']; ?> </br>
											</p>
										</div>
								<h4 class="deconnect"> <a style ="color : black;" href="deconnexion.php"> DECONNEXION </a></h4>
							</div>
								<strong class="support">+221-33-831-03-03</strong>
							</div>
						</div>
						<nav>
							<ul class="menuCE">
								<li><a class="active" href="AccueilChefEquipe.php">Home</a></li>
								<li><a href="OTCE.php">MES OT</a></li>
								<li><a href="LesAgents.php"> Mes Agents</a></li>
								<li><a href="#">Mon Pilote et Centre</a></li>
								<li class="#"><a href="#">Contacts</a></li>
							</ul>
						</nav>
												
					</div>
				</header>
<!--==============================Script de la connexion=================================-->
	
	<script>
	var seedetails = document.getElementById('titreclick');
	
		seedetails.addEventListener('mouseover', function() {
				mondiv = document.getElementById('DetailsID');
				mondivstyle = getComputedStyle(mondiv, null).display;
				if (mondivstyle == 'none')
				{
					mondiv.style.display = 'inline-block';
				}
			} , false);
		seedetails.addEventListener('mouseout', function() {
				cacher = document.getElementById('DetailsID');
				cacherdisplay = getComputedStyle(cacher, null).display;
					if (cacherdisplay == 'inline-block')
						{
							cacher.style.display = 'none' ;
						}
			}, false ); 		

	</script>