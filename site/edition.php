<!DOCTYPE html>
<html lang="en">
	<?php 
		include("entetehtml.php");
		include('ConnexionBD.php');  	
	?> <!--Entete Html (head) -->

	<body id="page2">
		<div class="extra">
			<div class="main">
<!--==============================header=================================-->
<?php include("EntetePage.php");
		include("LesEdition.php");?> <!--Entete des pages (header) -->

<!--==============================content================================-->
	<section id="content">
				
		<div class="wrapper">
			<h3 class="p1"> EDITION DES DONNEES </h3>
				
			<div class="BoxEdition">
				<div class="padding">
					<div class="aligncenter">
						<h4 class="titlebosteam">Modifier/Creer Une Equipe</h4>
					</div>
					<form style = "position: relative ; left : 80px;" method="get" action="traiterTeam.php">  <input type="search" placeholder="Code de L'Equipe" /> <input type="submit" value = "modifier"/> </form>							
					<div class ="formeditionteam">
						<form id ="#" method ="post" action="edition.php">
							<div  class = "boxdivOT">
									<fieldset>
										<label class = "modiflabel"><span class="text-form1">Code Equipe</span><input type="text" name ="Lequip" required /></label>
										<label class = "modiflabel"><span class="text-form1">Matricule </span><input type="text" name ="Numagent" required /></label>
										<label class = "modiflabel"><span class="text-form1">Pilote </span><input type="text" name ="LePilote" value="<?php echo $_SESSION["Matricule"];?>" required /></label>
										<label class = "modiflabel"><span class="text-form1">Nom </span><input type="text" name ="chefteam"   required /></label>
										<label class = "modiflabel"><span class="text-form1">Prenom</span><input type="text" name ="prenom" required /></label>
									</fieldset>
									
							</div>
							<a class="button-21" href="#" onClick="document.getElementById('#').submit()">valider</a>
									<a class="button-21" href="#" onClick="document.getElementById('#').reset()">Clear</a>
						</form>
					</div>	
				  
				</div>
			</div>
			<div class="BoxEditionAgent">
				<div class="padding">
					<div class="aligncenter">
						<h4 class="titlebosteam">Modifier/Creer un Agent</h4>
					</div>
					<form style = "position: relative ; left : 80px;" method="get" action="traiterTeam.php">  <input type="search" placeholder="Matricule de l'agent" /> <input type="submit" value = "modifier"/> </form>
					<div class ="formeditionteam">
						<form id ="#1" method ="post" action="edition.php">
							<div  class = "boxdivOT">
									<fieldset>
										<label class = "modiflabel"><span class="text-form1">Matricule</span><input type="text" name ="CodeAgent" required /></label>
										<label class = "modiflabel"><span class="text-form1">Nom </span><input type="text" name ="Name" required /></label>
										<label class = "modiflabel"><span class="text-form1">Prenom</span><input type="text" name ="lastname" required /></label>
									</fieldset>
									
							</div>
							<a class="button-21" href="#" onClick="document.getElementById('#1').submit()">valider</a>
									<a class="button-21" href="#" onClick="document.getElementById('#1').reset()">Clear</a>
						</form>
					</div>	
				  
				</div>
			</div>
			<div class="BoxEditionCentre">
				<div class="padding">
					<div class="aligncenter">
						<h4 class="titlebosteam">Edition des centres et zones</h4>
					</div>
					<div class ="formeditionteam">
						<form id ="#2" method ="post" action="centre.php">
							<fieldset>
								<label class = "modiflabel"><span class="text-form1">Code Centre</span><input type="text" name ="CodeCentre" required /></label>
								<label class = "modiflabel"><span class="text-form1">Nom Centre </span><input type="text" name ="Centre" required /></label>
								<label class = "modiflabel"><span class="text-form1">Pilote(Matricule)</span><input type="text" name ="Pilote" value="<?php echo $_SESSION["Matricule"];?>" required /></label>
								<label class = "modiflabel"><span class="text-form1">Nom Zone</span><input type="text" name ="zone" required /></label>
								<label class = "modiflabel"><span class="text-form1">Code SR</span><input type="text" name ="csr" required /></label>
							</fieldset>
									
							
							<a class="button-21" href="#" onClick="document.getElementById('#2').submit()">valider</a>
							<a class="button-21" href="#" onClick="document.getElementById('#2').reset()">Clear</a>
						</form>
					</div>	
				  
				</div>
			</div>
				
		</div>
	</section>
				
				</div>
		</div>
<?php include("footer.php"); ?> <!--Footer--->	
	</body>
</html>