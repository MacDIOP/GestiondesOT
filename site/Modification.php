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
				
<?php include("EntetePage.php"); ?>
				<div class="Row MargeSup">
					
					<div class="col-lg-4">
						<h4 class="list-group-item-heading"> Informations du derangement </h4>
								
								<ul class ="list-group">
<?php 
		if ( isset ($_GET['OT']))
		{									
				$Infs = $bdd -> prepare('Select * from derangement where ND = :n');
				$Infs -> execute( array('n' => $_GET['OT']));
						While ($donnees = $Infs -> fetch() )
									{			
?>								 
										<li class="list-group-item monbox"> Numero Derangement	<span class="Pull-right badge"><?php echo $donnees["ND"];?> </span> </li>
										<li class="list-group-item monbox"> SR	<span class="Pull-right badge"> <?php echo $donnees["codesr"];?> </span> </li>
										<li class="list-group-item monbox">	Date Orientation <span class="Pull-right badge"> <?php echo $donnees["DATEORIENTATION"];?> </span> </li>
										<li class="list-group-item monbox">	Equipe <span class="Pull-right badge"> <span class="Pull-right badge"> <?php echo $donnees["CodeEquipe"];?> </span> </li>
										<li class="list-group-item monbox">	Client<span class="Pull-right badge"> <?php echo $donnees["NOMCLIENT"];?> </span> </li>
										<li class="list-group-item monbox">	Contact <span class="Pull-right badge"> <?php echo $donnees["NUMEROCLIENT"];?> </span> </li>
										<li class="list-group-item monbox">	Priorite Signalisation <span class="Pull-right badge"> <?php echo $donnees["PrioriteSignal"];?> </span> </li>
										<li class="list-group-item monbox">	Commentaires <span class="Pull-right badge"> <?php echo $donnees["CommentairesSignal"];?> </span> </li>
										<li class="list-group-item monbox">	Date  <span class="Pull-right badge"> <?php echo $donnees["DateSignalisation"];?> </span> </li>
										<li class="list-group-item monbox">	<abbr title ="Priorite Derangement"> PRD </abbr> <span class="Pull-right badge"> <?php echo $donnees["Prioritedrgt"];?> </span> </li>
										<li class="list-group-item monbox">	Essai <span class="Pull-right badge"> <?php echo $donnees["CommentairesEssai"];?> </span> </li>
										<li class="list-group-item monbox">	Date Essai <span class="Pull-right badge"> <?php echo $donnees["DateEssai"];?> </span> </li>
<?php 									
									}
								$Infs -> closeCursor();	
		} else					{	 
									?><li class="list-group-item monbox"> Selectionner Un numero </li> <?php
									 
								}?>								
								</ul>  
					
					</div>
					
				
					<section class ="col-lg-7 col-xs-7"> <!----Reste 4 colones-------->
					
						<div class="row box">
								<!-----======Titre ++ Numero a modifier========--------->
							<h4 class ="col-lg-5 col-xs-5"> Modifier Un derangement </h4>
							
							<form method="get" action="Modification.php" class="col-lg-7 col-xs-7 form-inline pull-right">
								<div class="form-group">
									<label class="sr-only" for="text"> Numero Derangement </label>
									<input name ="OT" type="search" class="form-control" id="text" placeholder="Numero a modifier">
								</div>
									<button name ="OTWANTED" value ="valider" type="submit" class="btn btn-default">Envoyer</button>
							</form>
						</div>
					
					<div class ="row box"> <!-----======Fentre pour modifier========--------->
<?php


		if ( isset ($_GET['OT']))
		{ 
				$OTspecifique = $bdd -> prepare ('Select * From derangement where derangement.ND = :NumOT');
					$OTspecifique -> execute( array('NumOT' => $_GET['OT']));
						$donnees = $OTspecifique -> fetch()
?>							
							<!-----======Les champs a modifier======--------->
							<form class ="well form-horizontal monbox">
								<div class="row">
									<div class="form-group">
										<label for="text" class="col-lg-4"> Numero derangement </label>
										<div class="col-lg-6">
											<input type="text" class="form-control" id="ND" placeholder ="<?php echo $donnees["ND"];?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<label for="text" class="col-lg-4"> Sous Repartiteur </label>
										<div class="col-lg-6">
											<input type="text" class="form-control" id="SR" placeholder= "<?php echo $donnees["codesr"];?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<label for="text" class="col-lg-4"> Date Orientation </label>
										<div class="col-lg-6">
											<input type="date" class="form-control" id="DOR" placeholder= "<?php echo $donnees["DATEORIENTATION"];?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<label for="text" class="col-lg-4"> Code Equipe  </label>
										<div class="col-lg-6">
											<input type="text" class="form-control" id="CE" placeholder="<?php echo $donnees["CodeEquipe"];?>">
										</div>
									</div>	
								</div>
								<div class="row">	<!------------Infos du Client------------->
									<div class="form-group">
										<legend class="box">Information du client</legend>
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<label for="text" class="col-lg-4"> Nom du Client </label>
										<div class="col-lg-6">
											<input type="text" class="form-control" id="Client" placeholder="<?php echo $donnees["NOMCLIENT"];?>">
										</div>
									</div>	
								</div>
								<div class="row">
									<div class="form-group">
										<label for="text" class="col-lg-4"> Numero du client  </label>
										<div class="col-lg-6">
											<input type="text" class="form-control" id="num" placeholder="<?php echo $donnees["NUMEROCLIENT"];?>">
										</div>
									</div>	
								</div>
								<div class="row">	<!------------Infos de signalisation------------->
									<div class="form-group">
										<legend class="box">Information de Signalisation</legend>
									</div>
								</div>	
								<div class="row">
									<div class="form-group">
										<label for="text" class="col-lg-4"> Priorite Signalisation  </label>
										<div class="col-lg-6">
											<input type="text" class="form-control" id="text" placeholder="<?php echo $donnees["PrioriteSignal"];?>">
										</div>
									</div>	
								</div>
								<div class="row">
									<div class="form-group">
										<label for="text" class="col-lg-4"> Commentaires Signalisation  </label>
										<div class="col-lg-6">
											<input type="textarea" class="form-control" id="ComS" placeholder="<?php echo $donnees["CommentairesSignal"];?>">
										</div>
									</div>	
								</div>
								<div class="row">
									<div class="form-group">
										<label for="text" class="col-lg-4"> Date Signalisation </label>
										<div class="col-lg-6">
											<input type="date" class="form-control" id="DSI" placeholder= "<?php echo $donnees["DateSignalisation"];?>">
										</div>
									</div>
								</div>
								
								<div class="row">	<!------------Autres infos------------->
									<div class="form-group">
										<legend class="box"> Autres Informations </legend>
									</div>
								</div>	
								<div class="row">
									<div class="form-group">
										<label for="text" class="col-lg-4"> Priorite derangement  </label>
										<div class="col-lg-6">
											<input type="text" class="form-control" id="PRD" placeholder="<?php echo $donnees["Prioritedrgt"];?>">
										</div>
									</div>	
								</div>
								<div class="row">
									<div class="form-group">
										<label for="text" class="col-lg-4"> Commentaires Essai </label>
										<div class="col-lg-6">
											<input type="textarea" class="form-control" id="comsEss" placeholder="<?php echo $donnees["CommentairesEssai"];?>">
										</div>
									</div>	
								</div>
								<div class="row">
									<div class="form-group">
										<label for="text" class="col-lg-4"> Date Essai </label>
										<div class="col-lg-6">
											<input type="date" class="form-control" id="DES" placeholder= "<?php echo $donnees["DateEssai"];?>">
										</div>
									</div>
								</div>								
								
								
								<div class="form-group">
									<button class="btn btn-success col-lg-offset-5"> Valider </button>
								</div>
							</form>
<?php $OTspecifique -> closeCursor();  
		}else {
				?>
									<h5>  Selectionnez Un Numero </h5>			
			
	<?php 			} 	?>											
					</div>
					
					
					</section>			
				</div>
				
<?php include('footer.php');  ?>				
			</div>
		</div>

		
		
	</body>	
			
</html>			