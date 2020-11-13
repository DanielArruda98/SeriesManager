api_sm = "http://api-seriesmanager.000webhostapp.com/controllers/ControllerGenero.php";
// api_sm = "http://localhost/SeriesManager/backend/controllers/ControllerGenero.php";

$('#btn-cadastrar_genero').click(function () {

    var genero = $('#genero').val();
    
    var dados = {
        cadastrar: true,
        genero
    }

    $.post(api_sm, dados, function (retorno) {
        GrowlNotification.notify({
            title: retorno.titulo,
            type: retorno.tipo,
            closeTimeout: 3000
        });

        listar();

        $('#cadastrarGenero').modal('hide');

        $('#genero').val('');  
    });
});