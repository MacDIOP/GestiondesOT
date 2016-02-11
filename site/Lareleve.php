<?php

if(isset($_POST["Dger"]))	
	{
		if( VerifierNumrelev($_POST["Dger"]) == $_POST["Dger"] )
			{

				$nowonreleve = $bdd -> query ('select ND from derangement where ETATOT= "Oriente"');
					While ($donnees = $nowonreleve -> fetch() )
						{
							$nd = $donnees['ND'];
								 if (empty($_POST[$nd]))
									{

									} else
										{
											//echo $_POST[$nd]."</br>"; echo $nd; 
											
											$Relever = $bdd ->	prepare('Insert into releve (NUMERORELEVE,ND,DATERELEVE,Initiale,CommentairesReleve)
																				Values (:numrelve,:numdrgt,:Comms,:Init,now())');
											$Relever -> execute (array ( 'numrelve' => $_POST["Dger"],
																		 'Comms' => $_POST["CommsReleve"],
																		 'Init' => $_POST["Initiales"],	
																		 'numdrgt' => $nd ));	
											$Relever -> closeCursor();
											
											echo '<script> alert("Derangement Releve avec succes"); </script>';
										}		
						}
			} 
	}Else {}		
?>