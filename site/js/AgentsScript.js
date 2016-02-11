		$(document).ready(function(){
			$('#LesAgents').DataTable();
		});
			
			$('#LesAgents').DataTable( {
				language: {
					processing:     "Traitement en cours...",
					search:         "Rechercher&nbsp;:",
					lengthMenu:    "Afficher _MENU_ Agents",
					info:           "Liste des Agents de _START_ &agrave; _END_ sur _TOTAL_ Agents",
					infoEmpty:      "Liste des Agents 0 &agrave; 0 sur 0 Agents",
					infoFiltered:   "(filtr&eacute; de _MAX_ Agents au total)",
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