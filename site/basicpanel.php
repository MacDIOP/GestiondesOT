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
			
			 <div class="col-lg-6">
                    <div class="panel panel-default box">
                        <div class="panel-heading monbox">
                            Les derangements de l 'equipe
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a class="monbox" href="#home" data-toggle="tab">Bilan de l'equipe</a>
                                </li>
                                <li><a href="#orientes" class="monbox" data-toggle="tab">derangement orientes</a>
                                </li>
                                <li><a href="#realises" class="monbox" data-toggle="tab">derangement realises</a>
                                </li>								
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="home">
                                    <h4>Bilan</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                </div>
                                <div class="tab-pane fade" id="orientes">
                                    <h4>Orientes</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                </div>
                                <div class="tab-pane fade" id="realises">
                                    <h4>Realises</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                </div>
                                
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
			</div>
				
		</section>		
				
				
			

	<?php include ('footer.php'); ?>			
				
			</div>
		</div>
		
	</body>	
	</html>