<!DOCTYPE html>
<html lang="en">
<?php include("entetehtml.php");?> <!--Entete Html (head) -->
	<body id="page4">
		<div class="extra">
			<div class="main">
<!--==============================header=================================-->
<?php include("EntetePage.php");?> <!--Entete des pages (header) -->
<!--==============================content================================-->
				<section id="content">
					<div class="indent-left1">
						<div class="wrapper">
							<table id="Listedesagents">
								<h3 class="p1">Liste des Agents</h3>
									  <tr>
										  <th> Fiche </th>
										  <th> Matricule </th>
										  <th> Nom </th>
										  <th> Prenom </th>
									 </tr>
<?php
include("ConnexionBD.php");
						 $TeamWanted = $bdd -> prepare('CALL AgentsdelEquipe(:Lefameux)');	
						 $TeamWanted -> execute ( array( 'Lefameux' =>  $_SESSION['CODEEQUIPE'])); 
							While ( $donnees = $TeamWanted -> fetch() )
							{						
						?>												  
												  <tr>
												      <td> <a href="#detailsagents"> Details </td>
													  <td> <?php echo $donnees["MATRICULE"];?></td>
													  <td> <?php echo $donnees["NOMAGENT"];?></td>
													  <td><?php echo $donnees["PRENOMAGENT"];?></td>
												  </tr>
					<?php } 
							$TeamWanted -> closeCursor();
						?>									 
    					 </table>
						 
							<div class="FicheAgent">
									<h5> Fiche de l'Agent  <form class ="formlookfor" method="get" action="">  <input class="lookfor" type="search" placeholder="Matricue"/> <input class="lookfor" type="submit" value ="Rechercher"/> </form>		</h5>
																		
									<div class="boxficheEquipe">
										
										
									</div>
											
							</div>
							
							
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
	</body>
</html>