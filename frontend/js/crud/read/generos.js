listar();

function listar() {

    busca = $('#pesquisar').val();

    var dados = {
        listar: true,
        busca
    }

    $.get(getApi('Genero'), dados, function (retorno) {  
        var lista = "";
        
        $.each(retorno, function(idx, value) {
            lista += listarGeneros(value.id, value.descricao);
        });

        if(lista == "") {
            lista += listarGeneros(null, "Nenhum gênero encontrado"); 
        }

        $('#tbody_generos').html(lista);
    });
}