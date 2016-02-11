<!DOCTYPE html>

<!--Traitement de la connexion-->
<?php include("checkconnexion.php") ?>

<html lang="en">
<!------------------------------Entete Html----------------------------->
<?php include("entetehtml.php") ?>	
	<body style ="padding-top : 0px;" id="page1">
		<div class="extra container">
			<div class="main">
<!--------------------------------Entete de la page--------------------->
<?php include("headerIndex.php") ?>
		<script type="text/javascript"> Cufon.now(); </script>
		<script type="text/javascript">
			$(window).load(function() {
				$('.slider')._TMS({
					duration:800,
					easing:'easeOutQuart',
					preset:'simpleFade',
					slideshow:7000,
					banners:false,
					pauseOnHover:true,
					waitBannerAnimation:false,
					prevBu:'.prev',
					nextBu:'.next'
				});
			});
		</script>
			</div>
		</div>
	<?php include("footer.php"); ?> <!--Footer--->
	</body>
</html>