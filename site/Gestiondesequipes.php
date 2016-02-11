<!DOCTYPE html>
<html lang="en">
<!--=============Entete HTML========================-->
<?php 
		include("entetehtml.php"); 
		include('ConnexionBD.php'); 		
		include("ScriptGestioErreurs.php");		
?>
<body id="page1">
	<div class="extra container">
		<div class="main">
<?php 
include("EntetePage.php");
?>		
<!-----==================Le corps de la page========================---------->		

            <section class="row MargeSup">
				<h3> Gestion des equipes de TADEX </h3>
				<div class="panel panel-default">
					<div class="panel-heading monbox">
						Les Equipes du centre de 
<?php
				$infocentre = $bdd -> query('select centre.CODE,centre.NOMCENTRE,count(*) as EquipesMedina 
												from journalequipe natural join centre 
													where centre.code="ACM" ');
				While ($Data = $infocentre -> fetch())
					{
?>
						<button type="button" class="btn btn-success btn-xs"> <?php echo $Data["NOMCENTRE"] ?> </button>
						<button type="button" class="btn btn-success btn-xs"> (<?php echo $Data["CODE"] ?>) </button> 
						<button type="button" class="btn btn-success btn-xs">  <?php echo $Data["EquipesMedina"] ?> Equipes </button>	
<?php				}
				$infocentre -> closeCursor();
?>						
						
						<button type="button" data-toggle="modal" href="#NewEquipe" class="btn btn-success btn-sm pull-right"> Ajouter Une Equipe </button>
					<!-----Ici la fenetre Modale-------->				
							<div class="modal fade" id="NewEquipe">   
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title monbox"> Nouvelle Equipe </h4>
										</div>
										<div class="modal-body">
											
											
										</div>
										<div class="modal-footer">
											<button class="btn btn-info" data-dismiss="modal">Fermer</button>
										</div>
									</div>
								</div>
							</div>
					</div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							Toutes les equipes du centre :
							<p>
<?php 
					$recupteam = $bdd -> prepare('Select journalequipe.CodeEquipe,agent.MATRICULE, CONCAT_WS(" ",agent.NOMAGENT,agent.PRENOMAGENT) AS ChefEquipe,journalequipe.DateFormation   
										FROM journalequipe Natural JOIN agent
													');
					$recupteam ->execute();
						While ($donnees = $recupteam -> fetch() )
								{						   
?>
									
										<div class="col-lg-4 monbox">
										  <a style="color:white;" class="btn btn-sm btn-success" href="uneequipe.php?codeteam=<?php echo $donnees["CodeEquipe"];?>"> <?php echo $donnees["CodeEquipe"] ;?>  </a>
										  <?php //echo $donnees["MATRICULE"];?>
										  <?php echo $donnees["ChefEquipe"];?>
										  <?php echo $donnees["DateFormation"];?>
										</div>  
										
<?php   						} 
						$recupteam -> closeCursor();
	
?>								
							</p>
						</div>
				</div>		
			</section>
<?php include ('footer.php'); ?>			
			
		</div>
	</div>
	
</body>	
</html>