
// Tableau de memorisation des notes pour chaque liste
var ArrListeEtoile = new Object();
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
//-------------------------------------------------------
// Gestion de la visibilite des etoiles au survol
//-------------------------------------------------------
function GestionHover(idListe, indice, nbEtoile){
	for (i=1; i<= nbEtoile; i++)
	{
		var idoff = "staroff-" + idListe + "-" + i;
		var idon = "staron-" + idListe + "-" + i;
		
		if(indice == -1)
		{
			// Sortie du survol de la liste des etoiles
			if (ArrListeEtoile[idListe] >= i){
				document.getElementById(idoff).style.display ="none";
				document.getElementById(idon).style.display ="block";
			}
			else{
				document.getElementById(idoff).style.display ="block";
				document.getElementById(idon).style.display ="none";
			}
		}
		else
		{
			// Survol de la liste des etoiles
			if(i <= indice){
				document.getElementById(idoff).style.display ="none";
				document.getElementById(idon).style.display ="block";
			}
			else{
				document.getElementById(idoff).style.display ="block";
				document.getElementById(idon).style.display ="none";
			}
		}
	}
}

//-------------------------------------------------------
// Selection d une note pour une liste
//-------------------------------------------------------
function ChoixSelection(idListe, indice, nbEtoile){
	ArrListeEtoile[idListe] = indice;


    var idSerie = idListe;
    idSerie = idSerie.split('-');

    $.ajax({
		url: '/ajax/note',
        method: "post",
		data : {'idSerie':idSerie[1],
				'note': indice},
        success: function(data) {
            console.log('Succes notation !');
        },
	})
}

//-------------------------------------------------------
// Creation d une liste de notation unique
//-------------------------------------------------------
function CreateListeEtoile(idListe, nbEtoile){
	ArrListeEtoile[idListe] = nbEtoile;
	var renduListe = "";
	renduListe += "<div class=\"listeEtoile\" onmouseout=\"GestionHover('" + idListe + "', -1, '" + "5" + "')\">";
	renduListe += "<ul>";
	i=1;

	while( i<=nbEtoile ){
		renduListe += "<li>";
		renduListe += "<a href=\"javascript:ChoixSelection('" + idListe + "', '" + i + "', '" + "5" + "')\" onmouseover=\"GestionHover('" + idListe + "', '" + i + "', '" + "5" + "')\">";
		renduListe += "<img id=\"staroff-" + idListe + "-" + i + "\" src=\"\\images\\notation\\staroff.svg\" border=\"0\" title=\"" + i + "\" style=\"border-width: 0px; display: none;\">";
		renduListe += "<img id=\"staron-" + idListe + "-" + i + "\" src=\"\\images\\notation\\staron.svg\" border=\"0\" title=\"" + i + "\" style=\"border-width: 0px; display: block;e.com\">";
		renduListe += "</a>";
		renduListe += "</li>";
		i++;
	}

    while(i<=5){
        renduListe += "<li>";
        renduListe += "<a href=\"javascript:ChoixSelection('" + idListe + "', '" + i + "', '" + "5" + "')\" onmouseover=\"GestionHover('" + idListe + "', '" + i + "', '" + "5" + "')\">";
        renduListe += "<img id=\"staroff-" + idListe + "-" + i + "\" src=\"\\images\\notation\\staroff.svg\" border=\"0\" title=\"" + i + "\" style=\"border-width: 0px; display: block;\">";
        renduListe += "<img id=\"staron-" + idListe + "-" + i + "\" src=\"\\images\\notation\\staron.svg\" border=\"0\" title=\"" + i + "\" style=\"border-width: 0px; display: none;e.com\">";
        renduListe += "</a>";
        renduListe += "</li>";
        i++;
    }

	
	renduListe += "	</ul>";
	renduListe += "</div>";
	
	document.getElementById(idListe).outerHTML = renduListe;
}
