function removerGenero(id) {
    $.each(generos_filmes, function (idx, value) {
        if (value[0] == id) {
            generos_filmes[idx] = [null, null];
        }
    });

    $(`#option_genero_esc_${id}`).remove();
    listarOptionsGenero();
}