<?php
	
	if (empty ($_POST["Pointe"]))
		{
?> 			
			<div class ="row">
				<div class="col-lg-6 col-xs-6 col-lg-offset-2 alert alert-danger"> <!---Note Pour les Agents------->
						<strong> Veuiller Valider Votre Plan de Charge SVP! </strong> 
				</div>
			</div>
<?php	} Else	
			{
					$validerpointage = $bdd -> prepare('UPDATE journalequipe SET DatePointage = NOW() where CODEEQUIPE = :team');
						$validerpointage -> Execute(array ('team' => $_SESSION["CODEEQUIPE"] ));
																
							$validerpointage -> closeCursor();
					
					//header('Location: Decharger.php');
								
			} ?> 
