<?php
$tabext = get_loaded_extensions();
natcasesort($tabext);//tri par ordre alphabétique
//Lecture des extensions
foreach($tabext as $cle=>$valeur)
{
echo "<h3>Extension &nbsp;$valeur </h3> ";
//Tableau contenant le nom des fonctions
$fonct = get_extension_funcs($valeur);
//Tri alphabétique des noms de fonction
sort($fonct);
//Lecture et affichage du nom des fonctions des extensions
for($i=0;$i<count($fonct);$i++)
{
echo $fonct[$i],"&nbsp; &nbsp;&nbsp;\n";
echo "<hr />";
}
}
?>