<?php 
session_start(); 
if( empty($_SESSION['Matricule']) )
	{
		header('Location: index.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
<?php include("entetehtml.php");?> <!--Entete Html (head) -->


	<body id="page4">
		<div class="extra">
			<div class="main">
			
			<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			
			</nav>
			
			
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
		<!--==============================Choix des menus=================================-->
						<nav>
							<ul class="menu">
								<li><a class="active" href="index.php">Home</a></li>
								<li><a href="Historiqueot.php">Ordre Travail</a></li>
								<li><a href="historiquedesteams.php"> Nos Equipes</a></li>
								<li><a href="#">Nos Agents</a></li>
								<li><a href="edition.php">Edition</a></li>
								<li class="#"><a href="#">Contacts</a></li>
							</ul>
							<ul class="menu1">
								<li><a href="Affectation.php">Former Equipe</a></li>
								<li><a href="#">Les Equipes</a></li>
							</ul>
						</nav>
					
					</div>
				</header>