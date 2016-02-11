<?php
		function my_error_handler($no, $str, $file, $line)
		{
			switch($no)
				{
					// Erreur fatale
					case E_USER_ERROR:
						echo '<p><strong>Erreur fatale</strong> : '.$str.'</p>';
							exit;//on arrete le script
								break;
					// Avertissement
					case E_USER_WARNING:
						echo '<p><strong>Avertissement</strong> : '.$str.'</p>';
							break;
					// Note
					case E_USER_NOTICE:
						echo '<p><strong>Note</strong> : '.$str.'</p>';
							break;
					// Erreur générée par PHP
					default:
						echo '<p><strong>Erreur inconnue</strong> ['.$no.'] : '.$str.'<br/>';
							echo 'Dans le fichier : "'.$file.'", à la ligne '.$line.'.</p>';
								break;
				}
		}
		
set_error_handler('my_error_handler');

	/*	if(empty($_GET['empty']))
		{
			!trigger_error('Vous devez préciser la valeur de "empty" ou une valeur nulle lui sera imposée.', E_USER_NOTICE);
			$empty = 0;
		}
		if(empty($_GET['div']))
			trigger_error('Vous ne pouvez pas diviser par 0', E_USER_WARNING);
		else
			echo (5/$_GET['div']);
		if(!is_file('non-existing'))
			trigger_error('Un fichier indispensable à l\'exécution du script est manquant.', E_USER_ERROR); */
?> 		
 