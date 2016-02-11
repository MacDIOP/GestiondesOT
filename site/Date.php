<?php 

	function ListerOTParDate($NotreDate)
	{ 
	?>
		<table id="listeOT">
									   <tr>
										  <th> Numero derangement </th>
										  <th> Code Equipe </th>
										  <th> Code SR </th>
										  <th> Date Orientation </th>
										  <th> EtatOT </th>
										  <th> Type Abonnement </th>
										  <th> DEBIT </th>
										  <th> Duree realisation </th>
										  <th> Releve </th>
										  <th> Date Releve </th>
										  <th> Nom Client </th>
										  <th> Numero Client </th>
									   </tr>
									   
		<!--==============================Connexion a la base et selection de l'ot recherche================================-->
		<?php 
		include("ConnexionBD.php");	
				$SelectionDrgt = $bdd -> prepare('Select derangement.ND,derangement.CodeEquipe,derangement.codesr,derangement.DATEORIENTATION,derangement.ETATOT,
				derangement.Prioritedrgt,derangement.DEBIT, releve.NUMERORELEVE, 
					TIMEDIFF(releve.DATERELEVE,derangement.DATEORIENTATION) as VR,
					releve.DATERELEVE,derangement.NOMCLIENT,derangement.NUMEROCLIENT
						from derangement Natural join releve
						where (Date_Format(DATERELEVE,"%d/%m/%Y")=:d) OR (Month(DATERELEVE)=:d) OR (Date_Format(DATERELEVE,"%Y")= :d) OR (DATERELEVE = :d)');
				$SelectionDrgt -> execute(array('d' => $NotreDate));
				
				While ($donnees = $SelectionDrgt -> fetch() )
				{						   
		?>								
										<tr>
										  <td> <?php echo $donnees["ND"] ;?> </td>
										  <td> <?php echo $donnees["CodeEquipe"] ;?> </td>
										  <td> <?php echo $donnees["codesr"] ;?> </td>
										  <td> <?php echo $donnees["DATEORIENTATION"] ;?> </td>
										  <td> <?php echo $donnees["ETATOT"] ;?> </td>
										  <td> <?php echo $donnees["Prioritedrgt"] ;?> </td>
										  <td> <?php echo $donnees["DEBIT"] ;?> </td>
										  <td> <?php echo $donnees["VR"] ;?> </td>
										  <td> <?php echo $donnees["NUMERORELEVE"] ;?> </td>
										  <td> <?php echo $donnees["DATERELEVE"] ;?> </td>
										  <td> <?php echo $donnees["NOMCLIENT"] ;?> </td>
										  <td> <?php echo $donnees["NUMEROCLIENT"] ;?> </td>
									   </tr>
		<?php }
					 $SelectionDrgt -> closeCursor();
				?>			
	</table>
<?php } //Fin de la fonction 

		function LaSemaine($dbutsemaine)
		{ 	
		include("ConnexionBD.php");	
		
		    $NumSemain = $bdd -> prepare('Select WEEK(DATERELEVE) as Semaine from releve where Date_Format(DATERELEVE,"%d/%m/%Y")= :s'); 
				$NumSemain -> execute(array('s' => $dbutsemaine));
					
					while($Donnees = $NumSemain ->fetch())
					{
						$Lasemaine = $Donnees["Semaine"];
					}
							$NumSemain -> closeCursor();		
		if(isset($Lasemaine))
		{
		
			?>
			<h5> Cette Datte correspond a la semaine <?php echo $Lasemaine; ?> de l'annee	</h5>
			
				<table id="listeOT">
						   <tr>
							  <th> Numero derangement </th>
							  <th> Code Equipe </th>
							  <th> Code SR </th>
							  <th> Date Orientation </th>
							  <th> EtatOT </th>
							  <th> Type Abonnement </th>
							  <th> DEBIT </th>
							  <th> Duree realisation </th>
							  <th> Releve </th>
							  <th> Date Releve </th>
							  <th> Nom Client </th>
							  <th> Numero Client </th>
						   </tr>
<?php 
				
				$SelectionDrgt = $bdd -> prepare('Select derangement.ND,derangement.CodeEquipe,derangement.codesr,derangement.DATEORIENTATION,derangement.ETATOT,
				derangement.Prioritedrgt,derangement.DEBIT, Releve.NUMERORELEVE, 
					TIMEDIFF(releve.DATERELEVE,derangement.DATEORIENTATION) as VR,
						releve.DATERELEVE,derangement.NOMCLIENT,derangement.NUMEROCLIENT
							from derangement Natural join releve where WEEK(DATERELEVE) = :d');
				$SelectionDrgt -> execute(array('d' => $Lasemaine));
				
				While ($donnees = $SelectionDrgt -> fetch() )
				{						   
		?>
							<tr>
							  <td> <?php echo $donnees["ND"] ;?> </td>
							  <td> <?php echo $donnees["CodeEquipe"] ;?> </td>
							  <td> <?php echo $donnees["codesr"] ;?> </td>
							  <td> <?php echo $donnees["DATEORIENTATION"] ;?> </td>
							  <td> <?php echo $donnees["ETATOT"] ;?> </td>
							  <td> <?php echo $donnees["Prioritedrgt"] ;?> </td>
							  <td> <?php echo $donnees["DEBIT"] ;?> </td>
							  <td> <?php echo $donnees["VR"] ;?> </td>
							  <td> <?php echo $donnees["NUMERORELEVE"] ;?> </td>
							  <td> <?php echo $donnees["DATERELEVE"] ;?> </td>
							  <td> <?php echo $donnees["NOMCLIENT"] ;?> </td>
							  <td> <?php echo $donnees["NUMEROCLIENT"] ;?> </td>
						   </tr>	
<?php }
					 $SelectionDrgt -> closeCursor();
				?>			
				</table>
<?php 
		} Else { ?>
			<h5>  Aucun Resultat ne correspond a cette date </h5>
<?php 			} //Fin Else  
		}//Fin de la fonction de la Semaine  ?> 				