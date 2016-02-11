			<div class="col-lg-4 MargeSup">
					<h4 class="list-group-item-heading"> Liste des agents (Ne sont pas des chef Equipes) </h4>
					
<?php
	$lesagents = $bdd -> query("select COUNT(*) as nblignes from agent natural left join journalequipe 
												Where journalequipe.CodeEquipe IS NULL");
									
		$Donnees = $lesagents -> fetch();
			$Totale = $Donnees["nblignes"];
				
				if (empty($Totale))
					{
?> 					<div class ="col-lg-3 col-xs-3 box">  
						Aucun Resultat   
					</div>  
<?php				} else 
						{
?>		 					<div class ="col-lg-6 monbox">  
								Resultats :  
								<button type="button" class="btn btn-xs btn-info pull-right"><?php echo $Totale; ?> agents </button>
							</div> <br/>
							
						<ul class="list-group">
							<li class="list-group-item box">Nom des Agents <span class="pull-right"> Choix</span>   </li>
<?php
include('navigationscript.php');						
	$Retour = $bdd -> prepare('select agent.MATRICULE, agent.NOMAGENT, agent.PRENOMAGENT
											from agent natural left join journalequipe 
												Where journalequipe.CodeEquipe IS NULL
													LIMIT :PE,:MP');
		$Retour -> bindValue(':PE',$premiereEntree, PDO::PARAM_INT);
		$Retour -> bindValue(':MP',$LignesParPages, PDO::PARAM_INT);
			$Retour ->execute(); 
				 
				while($donnees = $Retour -> fetch()) // On lit les entrées une à une grâce à une boucle
				{ ?>
							<li class="list-group-item monbox"> <?php echo $donnees["NOMAGENT"]." ".$donnees["PRENOMAGENT"] ?> 
								<input type="radio" class="pull-right" name="lagent" value="<?php echo $donnees['MATRICULE'];?>" />
							</li>
<?php			}
			$Retour -> closeCursor();
?>			
						</ul>
						
<?php 					}
				$lesagents -> closeCursor();
?>				
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
				<li> <a href="Formerequipe.php?page=<?php echo $i; ?>">  <?php echo $i; ?>  </a></li>
<?php			 }
		}	?>
			<li>
				<span aria-hidden="true">&raquo;</span>
			</li>
		  </ul>
			</div>
			