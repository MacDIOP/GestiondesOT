
<!DOCTYPE html>
<html lang="en">
<?php include("entetehtml.php");?> <!--Entete Html (head) -->


	<body id="page4">
		<div class="extra">
			<div class="main">
			
<!--==============================header=================================-->
<?php include("EntetePage.php");?> <!--Entete des pages (header) -->

<!--==============================content================================-->
		<section class ="row MargeSup">
						<h3 class="p1">Historique des Equipes   <span style = "float : right;"> Apercu des Equipes (Les agents)  </span></h3>
						
							<div class="col-lg-6 table-responsive">
								<table class ="table table-bordered table-condensed monbox">
									<thead>
										<tr>
										  <th> Code Equipe </th>
										  <th> Chef Equipe </th>
										  <th> Nom et Prenom </th>
										  <th> Date Formation </th>
										</tr>
									</thead> 
									<tbody> 
	<!--==============================Connexion a la base et selection des Equipes================================-->
<?php 
include('ConnexionBD.php');	


	$LignesParPages = 10;

	$nbredelignes = $bdd -> query('Select Count(*) AS NbLignes from journalequipe');
		$Donnees = $nbredelignes -> fetch();
			$Totale = $Donnees["NbLignes"];
	$nbredelignes -> closeCursor();	
		
			$NombredePages = ceil($Totale/$LignesParPages);
			
		if(isset($_GET['page'])) // Si la variable $_GET['page'] existe...
			{
				 $pageActuelle=intval($_GET['page']);
			 
				 if($pageActuelle>$NombredePages) // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nombreDePages...
				 {
					  $pageActuelle=$NombredePages;
				 }
			}
			else // Sinon
			{
				 $pageActuelle=1; // La page actuelle est la n°1    
			}
			
			$premiereEntree=($pageActuelle-1)*$LignesParPages; // On calcul la première entrée à lire
			
			$Retour = $bdd -> prepare('Select journalequipe.CodeEquipe,agent.MATRICULE, CONCAT_WS(" ",agent.NOMAGENT,agent.PRENOMAGENT) AS ChefEquipe,journalequipe.DateFormation   
										FROM journalequipe Natural JOIN agent
													LIMIT :PE,:MP');
				 $Retour -> bindValue(':PE',$premiereEntree, PDO::PARAM_INT);
				 $Retour -> bindValue(':MP',$LignesParPages, PDO::PARAM_INT);
				$Retour ->execute();
	
		
		While ($donnees = $Retour -> fetch() )
		{						   
?>															  
									  <tr>
										  <td> <a href="historiquedesteams.php?codeteam=<?php echo $donnees["CodeEquipe"];?>"> <?php echo $donnees["CodeEquipe"];?> </a> </td>
										  <td> <?php echo $donnees["MATRICULE"];?> </td>
										  <td> <?php echo $donnees["ChefEquipe"];?> </td>
										  <td> <?php echo $donnees["DateFormation"];?> </td>
<?php   } 
		$Retour -> closeCursor(); 		
?>
									</tr>
									</tbody>
								</table>  
			<!------------Pagination----------->			
					  <ul class="pagination pagination-small">
						<li>
						  <span aria-hidden="true">&laquo;</span>
						</li>
<?php		
				for($i=1; $i<=$NombredePages; $i++) //On fait notre boucle
					{
						//On va faire notre condition
						 if($i==$pageActuelle) //Si il s'agit de la page actuelle...
						 { ?>
							  <li class="active"> <a> <?php echo $i; ?> </a> </li>
		<?php				 }	
						 else //Sinon...
						 { ?>
							<li> <a href="historiquedesteams.php?page=<?php echo $i; ?>">  <?php echo $i; ?>  </a></li>
		<?php			 }
					}	?>
						<li>
							<span aria-hidden="true">&raquo;</span>
						</li>
					  </ul>
					  
							</div>
						
							<div class="col-lg-6 table-responsive">
<?php
						 if (isset ($_GET['codeteam']) )
						 {
							$Titre = $bdd -> prepare('Select journalequipe.CODEEQUIPE,agent.MATRICULE, CONCAT_WS(" ",agent.NOMAGENT,agent.PRENOMAGENT) AS ChefEquipe,journalequipe.DateFormation   
															FROM journalequipe Natural JOIN agent 
																WHERE journalequipe.CODEEQUIPE= :leteam');	
							 $Titre -> execute ( array( 'leteam' => $_GET["codeteam"] )); 
								While ( $donnees = $Titre -> fetch() )
								{			
							?>	<h4> <?php echo $donnees["CODEEQUIPE"];?> <?php echo $donnees["MATRICULE"];?> <?php echo $donnees["ChefEquipe"];?></h4>
<?php 							} 
							$Titre -> closeCursor();
						 
							?>														
											<table class="table table-bordered table-condensed monbox">
												 <tr>
													  <th>Matricule</th>
													  <th>Nom </th>
													  <th>Prenom </th>
												  </tr>
<?php
						
						 $TeamWanted = $bdd -> prepare('CALL agentsdelEquipe(:Lefameux)');	
						 $TeamWanted -> execute ( array( 'Lefameux' => $_GET['codeteam'] )); 
							While ( $donnees = $TeamWanted -> fetch() )
							{						
						?>												  
												  <tr>
													  <td> <?php echo $donnees["MATRICULE"];?></td>
													  <td> <?php echo $donnees["NOMAGENT"];?></td>
													  <td><?php echo $donnees["PRENOMAGENT"];?></td>
												  </tr>
							<?php } 
							$TeamWanted -> closeCursor();
							
							?>
											  </table>	
										 
				<?php }else {} ?>	
							
							</div>
							
		
		
		</section>
<?php include("footer.php"); ?> <!--Footer--->		
		
		

		
			</div>
		</div>

	</body>
</html>