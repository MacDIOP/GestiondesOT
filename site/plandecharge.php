<!DOCTYPE html>
<html lang="en">

<?php include("entetechefEquipe.php");
	  include("ScriptGestioErreurs.php")	?> <!--Entete Html (head) -->
	
	<body id="page2">
		<div class="extra">
			<div class="main">

<?php include("headerCE.php");?> <!--Entete des pages (header) -->
			
				<h3 class="p1" style = "Margin-top : 20px" >Plan de Charge </h3>
	<div class="wrapper">
		
		<table id ="listeOTCEORIENTES">
					<tr>
					  <th> ND </th>
					  <th> Date Orientation </th>
					  <th> Code SR </th>
					  <th> Duree </th>
					  <th> Type </th>
					  <th> Nom Client </th>
					  <th> Numero Client </th>
				   </tr>
				<?php 

				include("ConnexionBD.php");
						$otceorientes = $bdd -> prepare ('Select ND,codesr,DATEORIENTATION,NOMCLIENT,NUMEROCLIENT,Prioritedrgt,
						Timestampdiff(HOUR,DATEORIENTATION,NOW()) as Duree		
						from derangement 
							where ETATOT = "INITIALE" AND CodeEquipe = :CE');
						
						$otceorientes -> execute ( array ( 'CE' => $_SESSION['CODEEQUIPE']));
							While ( $donnees = $otceorientes -> fetch() )
								{
				?>
									<tr>
									  <td> <a href="OTCE.php?OT=<?php echo $donnees["ND"];?>"> <?php echo $donnees["ND"];?> </a> </td>
									  <td> <?php echo $donnees["DATEORIENTATION"];?> </td>
									  <td> <?php echo $donnees["codesr"];?> </td>
									  <td> <?php echo $donnees["Duree"]." Heures"; ?> </td>
									  <td> <?php echo $donnees["Prioritedrgt"];?> </td>
									  <td> <?php echo $donnees["NOMCLIENT"];?> </td>
									  <td> <?php echo $donnees["NUMEROCLIENT"];?> </td>
								   </tr>
				<?php
								}
						$otceorientes -> closeCursor();
				?>			   
								   
		</table>
	</div>
	
	<div class="OTWANTEDCE">
		<div class="boxteam">
			<div class="aligncenter">
				<?php

				set_error_handler('my_error_handler');

						if ( isset ($_GET['OT']) )
						{ 
							$OTspecifique = $bdd -> prepare ('Select derangement.ND,derangement.Prioritedrgt,derangement.DEBIT,
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
						<li> Numero Releve : <span class = "spanOT"> <?php echo $donnees["NUMERORELEVE"];?> </span> </li>
						<li> Type Abonnement : <span class = "spanOT"> <?php echo $donnees["Prioritedrgt"];?> </span> </li>
						<li> Debit: <span class = "spanOT"> <?php echo $donnees["DEBIT"];?> </span> </li>
						<li> VR : <span class = "spanOT"> <?php echo $donnees["VR"];?> </span> </li>
					</ul>
				</div>
<?php $OTspecifique -> closeCursor();  }else { ?> <span class = "spanOT"> <?php !trigger_error('Vous devez Selectionner un numero.', E_USER_NOTICE); ?> </span>
				<?php }?> 												
			</div>
		</div>
	</div>
<?php include("footer.php"); ?> <!--Footer--->
			</div>
		</div>
	</body>
</html>