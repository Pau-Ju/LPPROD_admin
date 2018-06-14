$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function commenter(idSerie) {

    $.ajax({
        url: '/ajax/add-comment',
        method: "post",
        data : {'idSerie':idSerie,
            'comment': document.getElementById("textarea").value},
        success: function(data) {
            console.log('Succes commentaire !');
            document.getElementById("textarea").value='';
        },
    })


}