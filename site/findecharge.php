<?php
		
$nowlareleve = $bdd -> prepare ('select ND from derangement where CodeEquipe = :equip');
		$nowlareleve -> execute(array('equip' => $_SESSION["CODEEQUIPE"]));
				
		
	While ($donnees = $nowlareleve -> fetch() )
		{
			$end = $donnees['ND'];
				if ( empty($_POST[$end]) )
				{
														
				}else 
					{
						//echo $_POST[$end]."</br>"; echo $end; 
						
						$Relever = $bdd ->	prepare('Insert into releve (NUMERORELEVE,ND,DATERELEVE)
															Values (:numrelve,:numdrgt,now())');
						$Relever -> execute (array ( 'numrelve' => $_POST["Dger"],
													 'numdrgt' => $end ));	
						$Relever -> closeCursor();
					}		
		}
?>