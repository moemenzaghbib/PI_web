function select_internOrder() {
    var x = document.getElementById("id_emp").value;
    var y = document.getElementById("value").value;

    $.ajax({
        url : "{{ path('recherche_par_nom_taha') }}",
        method: "GET",
        data: {
            id: x,
            id_resp: y,
        },
        success: function (data) {
            if(data){
                $('#t tbody#search').empty();
                     for (i = 0; i < data.length; i++) {
                            equipe = data[i];
                         $('#t tbody#all').hide();
                         $('#t tbody#search').append('' +
                             '<tr><td> '+equipe.numEquipe+'</td>' +
                             '<td> '+equipe.nbreEmp+' </td>' +
                             '<td>'+equipe.service+' </td>' +
                             '<td>' +
                             '<ahref="Equipe/'+obj.idEquipe+'">show</a> </br>' +
                             '<ahref="'+equipe.idEquipe+'/edit">edit</a>' +
                             '<ahref="'+obj.idEquipe+'/AffecterService">Affecter Au Service</a>' +
                             '</td></tr>');
                     }
            }
            else
            {
                $('#t tbody#all').show();
                $('#t tbody#search').empty();
                $('#t tbody#search').fadeIn('fast');
            }
        },
    });
}

function select_internOrder() {
    var x = document.getElementById("entity").value;
    var y = document.getElementById("responsable").value;

    $.ajax({
        url: "/Ajax/internOrder",
        method: "GET",
        data: {
            id: x,
            id_resp: y,
        },
        success: function (data) {
            $("#interorder").html("");
            var e = $("<option>--choisir l'ordre interne--</option>");
            $("#interorder").append(e);

            for (i = 0; i < data.length; i++) {
                internorder = data[i];

                var e = $("	<option>" + internorder["label"] + " </option>");

                $("#interorder").append(e);
            }
        },
    });
}














