<?php 


	$variable = "12/12/2013";
		if ( preg_match ( " #^  $#" , $variable ) )
		{
			echo "La date est valide";
		}else
			{
				echo"Date Non valide";
			}	

?>