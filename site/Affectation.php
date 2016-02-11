<!DOCTYPE html>
<?php include("traitementAffectation.php");?>

<html lang="en">
<!--=============Entete HTML========================-->
<?php include("entetehtml.php");?>


	<body id="page2">
		<div class="extra">
			<div class="main">
			
<!--==============================header des pages =================================-->
<?php include("EntetePage.php");?> <!--Entete des pages (header) -->

<!--==============================content================================-->
	<section id="content">
				
		<div class="wrapper">
		     
			 <h4>  FORMATION DES EQUIPES </h4>
					
	<form id ="ERE" method ="post" action ="Affectation.php">
		<div class="Divaffectation">	
			<table class="affectation">
				 <tr>	
					  <th>Matricule</th>
					  <th>Nom</th>
					  <th>Prenom</th>
					  <th>Choix Agent</th>
				 </tr>
<!--==============================Connexion a la base et selection des agents================================-->
<?php 
//include("ConnexionBD.php");
	$LignesParPages = 30;

	$leslignes = $bdd -> query("select COUNT(*) as nblignes from agent natural left join journalequipe 
												Where journalequipe.CodeEquipe IS NULL");
									
		$Donnees = $leslignes -> fetch();
			$Totale = $Donnees["nblignes"];
	$leslignes -> closeCursor();	
		
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
?>			
<?php			// La requête sql pour récupérer les messages de la page actuelle.
				$Retour = $bdd -> prepare('select agent.MATRICULE, agent.NOMAGENT, agent.PRENOMAGENT
											from agent natural left join journalequipe 
												Where journalequipe.CodeEquipe IS NULL
													LIMIT :PE,:MP');
				 $Retour -> bindValue(':PE',$premiereEntree, PDO::PARAM_INT);
				 $Retour -> bindValue(':MP',$LignesParPages, PDO::PARAM_INT);
				$Retour ->execute(); 
				 
				while($donnees = $Retour -> fetch()) // On lit les entrées une à une grâce à une boucle
				{ ?>
							<tr>
								  <td  class ="Mat"> <a style = "text-decoration : none;" href="#">   <?php echo $donnees["MATRICULE"];?> </a>  </td>
								  <td>	  <?php echo $donnees["NOMAGENT"];?>   </td>
								  <td>	  <?php echo $donnees["PRENOMAGENT"];?>   </td>
								  <td class="choice"><input type="checkbox" name="<?php echo $donnees['MATRICULE'];?>"/></td>
							</tr>
				
		<?php	} 				
				$Retour -> closeCursor(); ?>
			</table>
			
		<ul id="pagination">
					<li class="previous-off"> « Précédent </li>
 
<?php		
				for($i=1; $i<=$NombredePages; $i++) //On fait notre boucle
					{ 
						 //On va faire notre condition
						 if($i==$pageActuelle) //Si il s'agit de la page actuelle...
						 { ?>
							  <li class="active"><?php echo $i; ?></li>
		<?php				 }	
						 else //Sinon...
						 { ?>
							<li> <a href="Affectation.php?page=<?php echo $i; ?>">  <?php echo $i; ?>  </a></li>
		<?php			 }
					}	?>
					<li class="pagination-next"> Suivant » </li>
		</ul>
		
		</div>		
							
<!--===AFFECTATION Equipe===-->	

		<div class="divaffectationEquipes">	
		
			<table class="affectation1">
				 <tr>
					  <th>Choix Equipe</th>
					  <th>Code Equipe</th>
					  <th>Chef Equipe</th>
					  <th>Nom et Prenom</th>
				 </tr>

<?php 
	$lesteams = $bdd -> query('Select journalequipe.CODEEQUIPE,agent.MATRICULE, CONCAT_WS(" ",agent.NOMAGENT,agent.PRENOMAGENT) AS ChefEquipe    
								FROM journalequipe INNER JOIN agent 
									ON journalequipe.Matricule = agent.Matricule');
	
	While ( $donnees = $lesteams -> fetch() )
	{
		$valueteam = $donnees["CODEEQUIPE"];
?>				 
				<tr>
					  <td class="choice"><input name="ChoixTeam" type="radio" value= "<?php echo $donnees["CODEEQUIPE"];?>"/></td>
					  <td> <a style = "text-decoration : none;" href="historiquedesteams.php?codeteam=<?php echo $donnees["CODEEQUIPE"];?>"> <?php echo $donnees["CODEEQUIPE"];?> </a>  </td>
					  <td> <?php echo $donnees["MATRICULE"];?>    </td>
					  <td> <?php echo $donnees["ChefEquipe"];?>   </td>
				 </tr>
<?php
    }
  $lesteams -> closeCursor();
?>  


			</table>
		</div>	
		
		
			<div class="lesaffectations">
					<div class="padding">
						<div class="titreEquipe">
							<h4 class="titlebosteam">  </h4>
								<input class="button-21V" type = "submit" name ="validation" value ="valider" />
								<input class="button-21C" type = "reset"  value ="Clear" />
									
						<?php  	if ( empty($Affectees) OR empty($Teamchosen) )
								{ ?>
									<p id="retour" style= "color : red;"> Veuiller choisir les agents et une Equipe </p>
								<?php } ELSE 
								{ ?> 		
									<ul class="listeAgents" style ="margin-top: 20px;">
									<?php  foreach ($Affectees as $agent) 
											{	
											$a = $agent;
			$NOMAgent = $bdd -> prepare ('select CONCAT_WS(" ",NOMAGENT,PRENOMAGENT) AS NomAgent from agent where MATRICULE = :MAT');
			$NOMAgent -> execute( array ('MAT' => $a ));
				 $donnees = $NOMAgent -> fetch(); 									
											?>
										<li class="lesagents"> <?php echo $donnees["NomAgent"]; ?>   </li>
								<?php 	}  ?>	
										<li class="LeTeam" style ="color: red;"> <?php echo $Teamchosen; ?> </li>
								<?php 	 } ?>
									</ul>
						</div>
						 	
					  
					</div>
			</div>
	
					
		  </form>				
		</div>
	</section>

			</div>
		</div>
<?php include("footer.php"); ?> <!--Footer--->
	</body>
</html>