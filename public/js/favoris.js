// Tableau de memorisation des favoris
var ArrCoeur = new Object();
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

//-------------------------------------------------------
// Gestion de la visibilite des etoiles au survol
//-------------------------------------------------------
function GestionHoverF(idCoeur, indice, exit){

        var idoff = "heartoff-" + idCoeur + "-" + indice;
        var idon = "hearton-" + idCoeur + "-" + indice;

        if(exit == 1)
        {
            // Sortie du survol de la liste des etoiles
            if (ArrCoeur[idCoeur] == 1){
                document.getElementById(idoff).style.display ="none";
                document.getElementById(idon).style.display ="block";
            }else{
                document.getElementById(idoff).style.display ="block";
                document.getElementById(idon).style.display ="none";
            }
        }
        else
        {
            // Survol de la liste des etoiles
            if( indice == 0){
                document.getElementById(idoff).style.display ="none";
                document.getElementById(idon).style.display ="block";
            }else{
                document.getElementById(idoff).style.display ="block";
                document.getElementById(idon).style.display ="none";
            }
        }

}
//-------------------------------------------------------
// Selection d une note pour une liste
//-------------------------------------------------------
function ChoixSelectionF(idCoeur){

    var  idSerie = idCoeur.split('-');
    if(ArrCoeur[idCoeur]==1){
        ArrCoeur[idCoeur]=0;
    }else{
        ArrCoeur[idCoeur]=1;
    }

    $.ajax({
        url: '/ajax/favorites',
        method: "post",
        data : {'idSerie':idSerie[1],
            'state': ArrCoeur[idCoeur] },
        success: function(data) {
            console.log('Succes favoris !');
        },
    })
}

//-------------------------------------------------------
// Creation d un coeur de favoris unique
//-------------------------------------------------------
function CreateFavorites(idCoeur){

    var renduListe = "";


    var idSerie = idCoeur.split('-');
    $.ajax({method: "POST",
            url:'/ajax/get-favorites',
            data:{"id":idSerie[1]}
        }).done(function(data) {
            renduListe += "<div class=\"coeur\" onmouseout=\"GestionHoverF('" + idCoeur + "', 2)\">";
                    if (data == 1) {
                        renduListe += "<div class=\"coeur\" onmouseout=\"GestionHoverF('" + idCoeur + "', 1, 1)\">";
                        renduListe += "<a href=\"javascript:ChoixSelectionF('" + idCoeur + "')\" onmouseover=\"GestionHoverF('" + idCoeur
                            + "', '" + 1 + "')\">"
                        renduListe += "<img id=\"heartoff-" + idCoeur + "-1\" src=\"\\images\\favorites\\heartoff.svg\" border=\"0\"  style=\"border-width: 0px; display: none;\">";
                        renduListe += "<img id=\"hearton-" + idCoeur + "-1\" src=\"\\images\\favorites\\hearton.svg\" border=\"0\" style=\"border-width: 0px; display: block;e.com\">";
                        renduListe += "</a>";
                        ArrCoeur[idCoeur] = 1;
                    } else {
                        renduListe += "<div class=\"coeur\" onmouseout=\"GestionHoverF('" + idCoeur + "', 0, 1)\">";
                        renduListe += "<a href=\"javascript:ChoixSelectionF('" + idCoeur + "')\" onmouseover=\"GestionHoverF('" + idCoeur
                            + "', '" + 0 + "')\">"
                        renduListe += "<img id=\"heartoff-" + idCoeur + "-0\" src=\"\\images\\favorites\\heartoff.svg\" border=\"0\"  style=\"border-width: 0px; display: block;e.com\">";
                        renduListe += "<img id=\"hearton-" + idCoeur + "-0\" src=\"\\images\\favorites\\hearton.svg\" border=\"0\"  style=\"border-width: 0px; display: none;\">";
                        renduListe += "</a>";
                        ArrCoeur[idCoeur] = 0;
                    }
            document.getElementById(idCoeur).outerHTML = renduListe;
        });
}

function Supprimer(idSerie){
    $.ajax({method: "DELETE",
        url:'/ajax/del-favorites',
        data:{"id":idSerie}
    }).done(function(data) {
        var list = document.getElementById("self-"+idSerie);
        list.remove();
    });
}