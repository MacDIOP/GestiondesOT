<?php   $Letype = $donnees["Prioritedrgt"];
		$VR = $donnees["duree"];
		if ( ($Letype == "Professionnel") OR ($Letype == "Administratif") OR ($Letype == "Commerciale") )
				{ 
					if ($VR >= 8) 
					{ /* Adopte la couleur rouge si VR Depassee */
						?> <td style="color : red;"> <?php echo $donnees["duree"] ;?> </td> <?php
					} else 
						{ ?> <td style="color : LightGreen;"> <?php echo $donnees["duree"] ;?> </td> <?php }
						
				} else if (($Letype == "Residentiel") OR ($Letype == "Grand Public"))
					{
						if ($VR >= 24)
						{
						?> <td style="color : red;"> <?php echo $donnees["duree"] ;?> </td> <?php
						} else 
						{ ?> <td style="color : LightGreen;"> <?php echo $donnees["duree"] ;?> </td> <?php  }
					} 
?>