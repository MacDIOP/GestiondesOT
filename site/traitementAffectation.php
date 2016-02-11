<?php 
	include('ConnexionBD.php');
	
		if( isset($_POST['validation']) )
		{
			if ($_POST['validation'] == "valider" )
				{
						$verifaffec = $bdd -> query ('Select MATRICULE from agent');
						$Affectees = array ();
						while ($donnees = $verifaffec -> fetch() )
						{
							
							$Compteur = $donnees['MATRICULE'];
							if ( isset ( $_POST[$Compteur] ) )
							{
								if ( isset($_POST['ChoixTeam']) )
									{
											$Teamchosen = $_POST['ChoixTeam'];
										$Affectation = $bdd -> prepare ('CALL INSERTION_AFFECTATIONS(:Team,:agent) ');
										$Affectation -> execute( array ( 
																		'Team' => $_POST['ChoixTeam'] ,
																		'agent' => $Compteur	
																) );
										$Affectees[] = $Compteur;	
										$Affectation -> closeCursor();
									} ELSE { }
							} 
						}
							
				}
		} 	
/*		
if (empty($_POST['validation']) AND $_POST['validation'] != "valider" )
		{
?>				
			<div class="alert alert-danger">
				<?php echo "NOTE : Vous N'avez pas Valide votre selection! </br>" ; ?>
			</div>
<?php
		} Else
			{
				$verifaffec = $bdd -> query ('Select MATRICULE from agent');
					$Affectees = array ();
						while ($donnees = $verifaffec -> fetch() )
						{
							
								$Compteur = $donnees['MATRICULE'];
							if ( isset ( $_POST[$Compteur] ) )
							{
								if ( isset($_POST['ChoixTeam']) )
									{
											$Teamchosen = $_POST['ChoixTeam'];
										$Affectation = $bdd -> prepare ('CALL INSERTION_AFFECTATIONS(:Team,:agent) ');
										$Affectation -> execute( array ( 
																		'Team' => $_POST['ChoixTeam'] ,
																		'agent' => $Compteur	
																) );
										$Affectees[] = $Compteur;	
										$Affectation -> closeCursor();
									} ELSE { }
							} 
						}
			}
			*/

		
?>