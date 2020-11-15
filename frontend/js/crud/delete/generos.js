function deletarGenero(id_genero) {
    var dados = {
        deletar : true,
        id_genero
    }

    $.post(getApi('Genero'), dados, function(retorno) {
        modalResultado(retorno.titulo, retorno.tipo);
        listar();
    });
}