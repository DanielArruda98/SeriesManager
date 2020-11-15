function removerGenero(id) {
    $.each(generos_filmes, function (idx, value) {
        if (value[0] == id) {
            generos_filmes[idx] = [null, null];
        }
    });

    $(`#option_genero_esc_${id}`).remove();
    listarOptionsGenero();
}

function deletarFilme(id_filme) {
    var dados = {
        deletar : true,
        id_filme
    }

    $.post(getApi('Filme'), dados, function(retorno) {
        modalResultado(retorno.titulo, retorno.tipo);
        listar();
    });
}