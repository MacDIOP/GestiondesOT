<?php
	$LignesParPages = 30;

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
