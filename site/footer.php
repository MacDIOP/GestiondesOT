<footer>
	<div class="main">
		<div class="footer-bg">
			<p class="prev-indent-bot">Tous droits reservés &copy; tadex.sn.com </p>
			<ul class="list-services">
				<li><a class="tooltips" title="facebook" href="#"></a></li>
				<li class="item-1"><a class="tooltips" title="twitter" href="#"></a></li> 
			</ul>
		</div>
	</div>
</footer>
				<!----------Bootstrap----------->
				<script src="bootstrap-3.3.5-dist/js/jquery.js"></script>
				<script src="bootstrap-3.3.5-dist/js/bootstrap.js"> </script>
				<!-- ChartJs -->		
				<script src="js/Chart.js-master/Chart.min.js" type="text/javascript"></script>
				<script src="js/Chart.js-master/src/Chart.PolarArea.js" type="text/javascript"></script>			
				<!----------Datatables----------->
				<script src="js/Datatables/jquery.dataTables.min.js" type="text/javascript"></script>
				<script src="js/Datatables/datatablesscript.js" type="text/javascript"></script>
				<script src="js/Datatables/datatablereleve.js" type="text/javascript"></script>
				<script src="js/Datatables/datatabletotale.js" type="text/javascript"></script>
				<script src="js/Datatables/OrientesScript.js" type="text/javascript"></script>
				<script src="js/Datatables/RealisesScript.js" type="text/javascript"></script>
				<script src="js/Datatables/AgentsScript.js" type="text/javascript"></script>	
				<!-- Form validator -->
				<script src="js/validator.min.js" type="text/javascript"></script>
				<!-- Les charts -->
				<script src="js/Graphes/Courbederangement.js" type="text/javascript"></script>				

				<script src="js/Graphes/lesuserpolararea.js" type="text/javascript"></script>
				  <!-- PNotify -->
			   <script type="text/javascript" src="js/notify/pnotify.core.js"></script>
			   <script type="text/javascript" src="js/notify/pnotify.buttons.js"></script>
			   <script type="text/javascript" src="js/notify/pnotify.nonblock.js"></script>
<?php $d = 250; ?>			

<script>
					var ctx = document.getElementById("LineDerangement").getContext("2d");
						
						var data = {
							labels: ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"],
							datasets: [
								{
									label: "Les Orientations",
									fillColor: "#fff", //Blanc
									strokeColor: "rgba(220,220,220,1)", 
									pointColor: "rgba(220,220,220,1)",
									pointStrokeColor: "#006400",
									pointHighlightFill: "#006400",
									pointHighlightStroke: "rgba(220,220,220,1)",
									data: [ <?php echo 65; ?>, 59, 80, 81, 56, 0, 0]
								},
								{
									label: "Les Decharges",
									fillColor: "#DADADA", //Gris
									strokeColor: "#337A33", //Vert
									pointColor: "#337A33", //Vert 
									pointStrokeColor: "#006400", //
									pointHighlightFill: "#006400",
									pointHighlightStroke: "rgba(151,187,205,1)",
									data: [28, 48, 40, 19, 86, 0, 0]
								}
							]
						};
					
				var myLineChart = new Chart(ctx).Line(data,{
					responsive: true,
					maintainAspectRatio: true
				});
	

</script>	
	
	
	
	

			