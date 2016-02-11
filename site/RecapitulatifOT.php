<?php 
session_start(); 
if( empty($_SESSION['Matricule']) )
	{
		header('Location: index.php');
	}
include("ConnexionBD.php");
include("Date.php");
include("ScriptGestioErreurs.php");
?>
<!DOCTYPE html>
<html lang="en">
<?php include("entetehtml.php");?> <!--Entete Html (head) -->
	<body id="page4">
		<div class="extra">
			<div class="main">
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
								<h4 class="deconnect"> <a style ="color : black; margin-left: 10px;" href="deconnexion.php"> DECONNEXION </a></h4>
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
						</nav>
						
					</div>
				</header>
<!--==============================content================================-->
				<section id="content">
					<div class="indent-left1">
						<div class="wrapper">
							
							<div class="boxRecap">
								<div class="aligncenter">
									<h4>Recaputilatif OT</h4>
								</div>
								<div class="mybox">
									
										<ul class = "monmenu">
											<li><a href="#" onClick="toggle_div(this,'Journalier')">Journalier</a></li>
											<li><a href="#" onClick="toggle_div(this,'Hebdo')">Hebdomadaire</a></li>
											<li><a href="#" onClick="toggle_div(this,'Mensuel')">Mensuel</a></li>
											<li><a href="#" onClick="toggle_div(this,'Annee')">Annuel</a></li>
										</ul>	
								</div>
							</div>
						
							<div id="Lesrecap">
								<h4 style="margin-left : 60px;">Recapitulaif (Choisir dans le menu)</h4>
									<form method="Post" action ="RecapitulatifOT.php">
											<label class="Jour" id="Journalier">
												<span class="SpanRecap">Choisir Une Date (jj/mm/aaaa)</span>
													<input style="margin-top: 15px;" type="text" name ="LaDate"/> 
													<input class ="button-21R" type="submit" value="Valider" /> 
											</label>
									</form>
									<form method="Post" action ="RecapitulatifOT.php">	
											<label class="Jour" id="Hebdo">
												<span style="color : yellow; margin-top : 30px;"> Debut Semaine</span>
													<input style="margin-top: 15px;" type="text" name ="WeekStart" /> 
																											
													<input class ="button-21R" type="submit" value="Valider" /> 
											</label>
									</form>
									<form method="Post" action ="RecapitulatifOT.php">		
											<label class="Jour" id="Mensuel">
												<span style="color : yellow; margin-top : 30px; margin-left: 20px;"> Mois </span>
													<select name="Mois" id="ChoixMois">
														<option value="none"> Choisir un mois  </option>
														<option value="01"> Janvier  </option>
														<option value="02"> Fevrier  </option>
														<option value="03"> Mars  </option>
														<option value="04"> Avril  </option>
														<option value="05"> Mai  </option>
														<option value="06"> Juin  </option>
														<option value="07"> Juillet  </option>
														<option value="08"> Aout  </option>
														<option value="09"> Septembre  </option>
														<option value="10"> Octobre  </option>
														<option value="11"> Novembre  </option>
														<option value="12"> Decembre  </option>
													</select> 
																								
												<input class ="button-21R" type="submit" value="Valider" /> 
											</label>
									</form>
									<form method="Post" action ="RecapitulatifOT.php">		
											<label class="Jour" id="Annee" >
												<span class="SpanRecap">Choisir Une Annee </span>
													<input style="margin-top: 15px;" type="text" name ="Lannee" /> 
													<input class ="button-21R" type="submit" value="Valider" /> 
											</label>
									</form>
							</div>
						</div>
						<div class="wrapper" style="margin-top : 20px;">
							<h4> Resultats </h4>
<?php
if( !empty($_POST["LaDate"]) )
		{
			$ladate = $_POST["LaDate"];
			ListerOTParDate($ladate);
		}
		elseif (!empty($_POST["Mois"]))
			{
				$lemois = $_POST["Mois"];
				ListerOTParDate($lemois);
			} 
			elseif (!empty($_POST["Lannee"]))
				{
					$an = $_POST["Lannee"];
					ListerOTParDate($an);
				} elseif (!empty($_POST["WeekStart"])) 
				{
					$Week = $_POST["WeekStart"];
					LaSemaine($Week);
				} else { ?> <strong><span style="color : red;"> Vous n'avez Pas Choisi de Dates! Verifier SVP! </span> </strong><?php }
?>							
						</div>
					</div>
				</section>
			</div>
		</div>
<!--==============================footer=================================-->
		<footer>
				<div class="main">
					<div class="footer-bg">
						<p class="prev-indent-bot">Tous droits reservés &copy; MaCcorporation  2015 </p>
						<ul class="list-services">
							<li><a class="tooltips" title="facebook" href="#"></a></li>
							<li class="item-1"><a class="tooltips" title="twitter" href="#"></a></li> 
						</ul>
					</div>
				</div>
			</footer>
			
		<script>
		function toggle_div(bouton, id) {
					//on récupère ta div à "toggler"
				var div = document.getElementById(id),
					//on récupère son état à l'instant initial
					//la création d'un nouveau String est nécessaire car son état va être modifié dans la boucle
					previousState = new String(div.style.display),
					//on récupère la liste de tous les éléments soumis à affichage conditionnel
					showElements = document.getElementsByClassName("Jour");
			  
				//pour chacun des élements, on le cache (plutot que de vérifier si l'element était deja affiché)
				for(var i = 0; i < showElements.length; i++) {
					showElements[i].style.display = "none";
				}
			  
				//Si le block n'était précement pas affiché, alors on l'affiche
				//Si avant le clic il etait affiché, alors il reste caché (comportement toggle conservé)
				if(previousState=="none") {
					div.style.display = "inline";
				}
			}
			
		function verifnom(champ)
			{var regex = /[a-zA-Z0-9]$/;
			if(!regex.test(champ.value))
			{alert('Verifier le nom'); champ.value="";}
			}
	function verifprix(champ)
		{ var regex = /[0-9]$/;
			if(!regex.test(champ.value))
			{alert('Verifier le prix'); champ.value="";}
			}
	function verifqte(champ)
		{ var regex = /[0-9]$/;
			if(!regex.test(champ.value))
			{alert('Verifier la quantité'); champ.value="";	}
			}
	function verifdate(champ)
		{ var regex = /^[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}$/;
			if(!regex.test(champ.value))
			{alert('Verifier la  date'); champ.value="";	}
			}	
		
		</script>
	
	</body>
</html>