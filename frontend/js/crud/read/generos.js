listar();

function listar() {

    var dados = {
        listar: true
    }

    $.get(getApi('Genero'), dados, function (retorno) {  
        var lista = "";
        
        $.each(retorno, function(idx, value) {
            lista += listarGeneros(value.id, value.descricao);
        });

        $('#tbody_generos').html(lista);
    });
}