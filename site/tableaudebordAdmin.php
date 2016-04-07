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

		<div class="section">
		
			<div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header"> Votre Tableau de bord </h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa  fa-plus-circle fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"> 12 </div>
                                    <div> Demandes Inscriptions! </div>
                                </div>
                            </div>
                        </div>
                        <a href="Gestiondesprofils.php">
                            <div class="panel-footer monbox">
                                <span class="pull-left"> Voir les details </span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-wrench fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">32</div>
                                    <div>Modifications profils!</div>
                                </div>
                            </div>
                        </div>
                        <a href="Gestiondesprofils.php">
                            <div class="panel-footer monbox">
                                <span class="pull-left">Voir les details! </span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
				<div class="col-lg-3 col-md-6">
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-group fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">34</div>
                                    <div>Lites des utilisateurs!</div>
                                </div>
                            </div>
                        </div>
                        <a href="Gestiondesprofils.php">
                            <div class="panel-footer monbox">
                                <span class="pull-left">Voir les details! </span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
				<div class="col-lg-3 col-md-6">
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-upload fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div>Importation COCC!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer monbox">
                                <span class="pull-left"> Importer Ici! </span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
				
			<div class="row">

				<div class="col-lg-8">
                    <div class="panel">
                        <div class="panel-heading monbox">
                            Historique de connexion  
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

						</div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
				<div class="col-lg-4">
                    <div class="panel">
                        <div class="panel-heading monbox">
                            Sessions Ouvertes  
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
            </div>		
				
		</div>
		

<?php include ('footer.php'); ?>			
							<!-- <canvas id="LineDerangement"></canvas> ------> 

				
		</div>
	</div>
	
</body>	
</html>