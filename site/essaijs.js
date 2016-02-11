<script>

var chefEquipe = getElementById('ChoixTeam')

chefEquipe.addEventListener('change', function() {
				alert(chefEquipe.options[chefEquipe.selectedIndex].innerHTML);
			} , false);


</script>