			
			<aside>
					<div class="wrapper">
						<h3 class="p1">Choisir Un Numero </h3>

						<div class="OTWANTED">
								<div class="boxteam">
									<div class="rechercheEquipe">
										<form method="get" action="Historiqueot.php">  <input type="search" placeholder="Numero Derangement" name ="OT" /> <input type="submit" name ="OTWANTED" value ="valider"/> </form>
									</div>
									<div class="aligncenter">
<?php
		if ( isset ($_GET['OT']))
		{ 
			$OTspecifique = $bdd -> prepare ('Select derangement.ND,derangement.CodeEquipe,derangement.Prioritedrgt,derangement.DEBIT,
			TIMEDIFF(releve.DATERELEVE,derangement.DATEORIENTATION) as VR,releve.NUMERORELEVE	
				From derangement NATURAL JOIN releve 
					where derangement.ND = :NumOT');
$OTspecifique -> execute( array('NumOT' => $_GET['OT']));
			$donnees = $OTspecifique -> fetch()
?>   									
										<h4 class="titlebosteam"> <?php echo $_GET['OT']; ?> </h4>
									</div>
									<div class="mybox">
											<div class="apercuOT">
												 <ul>
													<li> ND : <span class = "spanOT"> <?php echo $donnees["ND"];?> </span> </li>
													<li> Equipe : <span class = "spanOT"> <?php echo $donnees["CodeEquipe"];?> </span> </li>
													<li> Numero Releve : <span class = "spanOT"> <?php echo $donnees["NUMERORELEVE"];?> </span> </li>
													<li> Type Abonnement : <span class = "spanOT"> <?php echo $donnees["Prioritedrgt"];?> </span> </li>
													<li> Debit: <span class = "spanOT"> <?php echo $donnees["DEBIT"];?> </span> </li>
													<li> VR : <span class = "spanOT"> <?php echo $donnees["VR"];?> </span> </li>
												 </ul>
											</div>
<?php $OTspecifique -> closeCursor();  
		}else {
				?>
									<h5>  Selectionnez Un Numero </h5>			
			
	<?php 			} 	?>											
									</div>
								</div>
						</div>
					</div>
					
				</aside>