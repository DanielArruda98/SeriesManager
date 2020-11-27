function deletarGenero(id_genero) {
    var dados = {
        deletar : true,
        id_genero
    }

    var modal = confirmacaoModal("Os gêneros serão excluídos de todos os filmes que eles foram associados.");
    
    $('#div_modal').html(modal);
    $('#modalConfirmacao').modal('show');
    
    $('.deletar_confirma').click(function() {
        $.post(getApi('Genero'), dados, function(retorno) {
            $('#modalConfirmacao').modal('hide');

            modalResultado(retorno.titulo, retorno.tipo);
            listar();
        });
    });
}