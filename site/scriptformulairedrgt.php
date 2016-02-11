<?php
	if (  isset($_POST["Numdrgt"])  AND isset($_POST["codesr"])  AND isset( $_POST["CodeEquipe"]) )
				{
							$NewPRD = Priorite($_POST["PD"]);
							$sr = $_POST["codesr"];
							$verifsr = $bdd -> prepare ('select * from sousrepartiteur where CODESR = :csr');
							$verifsr -> execute (array('csr' => $sr));
							
							while ($donnees = $verifsr -> fetch() )
							{
								if ($donnees["CODESR"] == $sr)
								{
									$Presence = true;
								}
							}
							$verifsr -> closeCursor();
							if (isset($Presence))
							{
								$drgt = $_POST["Numdrgt"] ;  $team =  $_POST["CodeEquipe"];
								
								$derangement = $bdd -> prepare ('CALL ImporterCOCC(:drgt,:codeteam,:debit,:numclient,:client,
													now(),:sr,:PRDR,:PRSI,:DE,now(),:DSI,:COMMSES,:COMSS,"Oriente","NEANT",@Message)'); 
								$derangement -> execute (array (
																'drgt' => $_POST["Numdrgt"],
																'codeteam' => $_POST["CodeEquipe"],
																'debit' => "Bas Debit",
																'numclient' => $_POST["ctct"],
																'client' => $_POST["Nom"],
																'sr'=> $_POST["codesr"],
																'PRDR' => $NewPRD,
																'PRSI' => "NEANT",
																'DE' => $_POST["Dessai"],
																'DSI'=> $_POST["Dsign"],
																'COMMSES' => $_POST["Cessai"],
																'COMSS' => $_POST["Csign"]	));
								
								$mess = $bdd -> query ('select @Message');
									$data = $mess -> fetch();
										$message = $data["@Message"];
								
								$derangement -> closeCursor();
?>								
					<div class="alert alert-success">
						<?php echo "Rapport :  </br>";
							  if(isset($message))
								{
									echo $message;
								} else { echo "Pas de problemes rencontres lors de l'enregistrement!";}
						?>
					</div>
<?php								//echo '<script> alert("ENREGISTREMENT DERANGEMENT REUSSI"); </script>';
							}else {echo '<script> alert("Veillez Enregistrer Ce Code SR"); </script>';}
				} ELSE 
				{
?>				
					<div class="alert box">
						<?php echo "NOTE : Numero Derangement, Sous Repartiteur, Code Equipe sont obligatoires! </br>" ; ?>
					</div>
<?php			
				}  
?>