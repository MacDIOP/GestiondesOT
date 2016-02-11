<?php
			function ConversionDatesql ($Ladate)
				{
					if (empty($Ladate))
					{
						echo $Ladate." "."Date Non Renseignee </br>";
							$D =" ";
					} 
						else 
							{
							//Conversion de la date
								$Leschamps = explode("/",$Ladate);
									$Jour=$Leschamps[0]; $mois=$Leschamps[1]; $An=$Leschamps[2];  
										$D =$An."-".$mois."-".$Jour;
							}
					return $D;
				}

				function Priorite($leprd)
					{
						switch ($leprd)		
							{
								case 'GPU' : $PRDcomplet = 'Grand Public';
									break;
								case 'AP' : $PRDcomplet = 'Administratif';
									break;
								case 'SANS' : $PRDcomplet = 'Residentiel';
									break;			
								case 'PRO' : $PRDcomplet = 'Professionnel';	
								
								default : $PRDcomplet = 'Residentiel';
							}
								return $PRDcomplet;
					}

				function Etat($Letat)
					{
						switch ($Letat)
							{	
								case 'OR' : $etacomplet = 'Oriente';
									break;
								case 'AA' : $etacomplet = 'Absence Avisee';
									break;	
								case 'ES' : $etacomplet = 'Essai';
									break;
								default : $etacomplet = 'Essai';
							}
								return 	$etacomplet;
					}

				function VerifierND($lenumero)
					{
						if (preg_match("#^338{1}[0-9]{6}#",$lenumero))
							{
								$ND = $lenumero;
							} else				
								{

?>			<div class="alert alert-danger">
				 <?php echo "Le numero du derangement :".$lenumero."  n'est pas correct"?>
			</div>										
<?php							}
						return $lenumero;
					}
					
					
				function VerifierContact($lecontact)
					{
						if(preg_match("#^77[0-9]{7}#",$lecontact))
							{
								return $lecontact;
							} else 
								{
?>
			<div class="alert alert-danger">
				 <p> <strong> Avertissement : </strong> Le contact du client est incorrect : <?php echo $lecontact ?> </p>	
			</div>					
<?php			
							$neant = 000;	
								return $neant;
								}	
					}
				function VerifierNumrelev($lareleve)
					{
						if(preg_match("#[0-9]{3}#",$lareleve))
							{
								return $lareleve;
							} else 
								{
									echo '<script> alert("Votre numero de releve n\'est pas valide"); </script>';
								}
					}
			
			
			/*	function Traitemententdesequipes($CodeEquipe)
					{
						$testequipe =" ";
							switch($CodeEquipe)
								{
									case "TDX3" :
										(preg_match("#TDX3#","$CodeEquipe"))
										{
											echo 'VRAI';
										}
										else
											{
												echo 'FAUX';
											}
								}		
					} */					
?>

	
		