<?php
include('LesFonctions.php');
Include('ConnexionBD.php');
?>
	<div class="col-lg-12 monbox">
		<h4 class="MargeSup"> Rapport de l'importation </h4>
<?php		
		if (!is_file('16dec.csv')) /* le fichier n'existe pas */
			{
?>			
			<div class="alert alert-danger">
				<strong>Echec!</strong> <?php !trigger_error('Le fichier n est pas trouve.', E_USER_ERROR); ?>
			</div>			 
<?php		}		
				else
					 { 
						$lefichier = fopen('16dec.csv','r');	
					 }
		$li = 1;			 
		while ($ligne = fgets($lefichier)) /* Et Hop on importe */
			{
?>
			<div class="row MargeSup">
				<h5 class="col-lg-5 box"> <?php echo "Derangement No: ".$li; ?> </h5> </br>

<?php		
				$liste = explode(";",$ligne);  
			/*	$entete = count($liste);
				echo $entete." Colones dans la ligne </br>"; */
			   
			   /* On assigne les variables */ 
			   $SR = $liste[0];
					//echo $SR. "</br>"; 
			   $ND = $liste[1];
					$lenum = VerifierND($ND);
					//$ND = intval($ND);
					//echo $ND."</br>";
			   $NomClient = $liste[2];
					//echo $NomClient. "</br>";
         	   $Contact = $liste[3];
					$Contact =intval($Contact);
						$numclient = VerifierContact($Contact);
					//if(is_int($Contact)) echo $Contact."</br>";
			   $PRD = $liste[4];
					$LaPRD = Priorite($PRD);
						//echo $LaPRD. "</br>"; 
			   //$PRS = $liste[5];
						//echo $PRS. "</br>";
			   $Etatot = $liste[5];
					$etatfinal = Etat($Etatot);
						//echo  $etatfinal. "</br>";
			   $DateSi = $liste[6];
			   $heureSi = $liste[7];
			   
						$D = ConversionDatesql($DateSi);
						$DateSiComplet =$D." ".$heureSi;
								//echo $DateSiComplet."</br>"; 
				
			   $CommentaireSI = $liste[8];
						//echo $CommentaireSI. "</br>";
			   
			   $DateEss = $liste[9];
				$HeureEss = $liste[10];				
						$DE = ConversionDatesql($DateEss);
							$DateEsscomplet =$DE." ".$HeureEss;
								//echo $DateEsscomplet. "</br>";			
			   
			   $CommsEss = $liste[11];
							//echo $CommsEss. "</br>"; 
			   $Defaut = $liste[12];
								// echo $Defaut. "</br>";	
			   $DateOr = $liste[13];
			   $HeureOr = $liste[14];
						$DO = ConversionDatesql($DateOr);
								$Dateorientcomplet =$DO." ".$HeureOr;
									//echo $Dateorientcomplet. "</br>";
				$Equipe = $liste[15];
						//echo $Equipe. "</br>"; 
				$DatePlan = $liste[16];	
						$DP = ConversionDatesql($DatePlan);
			  			   //echo $DP. "</br></br>"; 
				try
					{
						$NotreRequete = $bdd -> prepare('CALL ImporterCOCC(:drgt,:codeteam,:debit,:numclient,:client,
															:DOR,:sr,:PRDR,:PRSI,:DE,:DPL,:DSI,:COMMSES,:COMSS,:E,:Dft,@Message)');
//A remetrre :PRSI ,:DPL, ,:COMSS,:COMMSES ,						
						$NotreRequete -> execute(array (
														'drgt' => $ND,
														'codeteam' => $Equipe,
														'debit' => "NEANT",
														'numclient' =>$numclient, //$Contact,
														'client' => $NomClient, //$NomClient,
														'DOR' => $Dateorientcomplet,
														'sr'=> $SR,
														'PRDR' => $LaPRD,
														'PRSI' => "NEANT",//$PRS,
														'DE' => $DateEsscomplet,													
														'DPL' => $DP,
														'DSI' => $DateSiComplet, //,
														'COMMSES' => $CommsEss,
														'COMSS' => $CommentaireSI,
														'E'=> $etatfinal,
														'Dft' => $Defaut
												));
						$msg = $bdd -> query ('select @Message');
								$data = $msg -> fetch();
								$sms = $data["@Message"];
								
?>				
				<div class="alert alert-warning">
                    <?php echo $sms; ?>
                </div>
<?php												
	 
					}Catch (Exception $e)
						{
?>
							<div class="alert alert-danger">
								 <?php echo 'Echec de l \'importation :'. $e->getMessage(); ?>
							</div>
<?php					}
				$NotreRequete -> closeCursor(); 
					$li++;
?>
			</div>	
<?php		}     
?>	
				<div class="alert alert-success MargeSup">
                    <strong>NOTE!</strong><?php echo " Fin de l'importation."; ?>
                </div>

	</div> <br/>		
				
<?php				
					 
		 /* Fermeture */ 
		 fclose($lefichier); 

	
	
?>
