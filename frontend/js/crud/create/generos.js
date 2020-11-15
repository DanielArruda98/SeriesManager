$('#btn-cadastrar_genero').click(function () {

    var genero = $('#genero').val();
    
    var dados = {
        cadastrar: true,
        genero
    }

    $.post(getApi('Genero'), dados, function (retorno) {
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