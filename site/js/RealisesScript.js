			
			$(document).ready(function(){
				$('#LesRealises').DataTable();
			});
			
			
			$('#LesRealises').DataTable( {
				language: {
					processing:     "Traitement en cours...",
					search:         "Rechercher&nbsp;:",
					lengthMenu:    "Afficher _MENU_ derangements",
					info:           "Liste des derangements de _START_ &agrave; _END_ sur _TOTAL_ derangements",
					infoEmpty:      "Liste des derangements 0 &agrave; 0 sur 0 derangements",
					infoFiltered:   "(filtr&eacute; de _MAX_ derangements au total)",
					infoPostFix:    "",
					loadingRecords: "Chargement en cours...",
					zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
					emptyTable:     "Aucune donnée disponible dans le tableau",
					paginate: {
						first:      "Premier",
						previous:   "Pr&eacute;c&eacute;dent",
						next:       "Suivant",
						last:       "Dernier"
					},
					aria: {
						sortAscending:  ": activer pour trier la colonne par ordre croissant",
						sortDescending: ": activer pour trier la colonne par ordre décroissant"
					}
				}
			} );
			
			
