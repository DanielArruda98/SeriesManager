function editarGenero(id_genero) {
    var dados = {
        consultar: true,
        id_genero
    }

    $.get(getApi('Genero'), dados, function (retorno) {
        // Trocar Cadastro por Editar
        $('#btn-cadastrar_genero').remove();
        $('#btn-editar_genero').removeClass('d-none');
        $('#modalCadastro').html('Editar Gênero');

        // Valores do Modal
        $('#hidden_id').val(id_genero);
        $('#genero').val(retorno.descricao);

        $('#cadastrarGenero').modal('show');

        ////////////////////////////////// SALVAR //////////////////////////////////
        $('#btn-editar_genero').click(function () {
            
            var id_genero = $('#hidden_id').val();
            var descricao = $('#genero').val();

            // Verificar alterações
            var dados_antigos = [retorno.descricao];
            var dados_novos = [descricao];

            if(!checarMudancas(dados_antigos, dados_novos)) {
                var dados = {
                    atualizar: true,
                    id_genero,
                    descricao
                }
    
                $.post(getApi('Genero'), dados, function (retorno) {
                    modalResultado(retorno.titulo, retorno.tipo);
                    listar();
    
                    $('#cadastrarGenero').modal('hide');
                });
            } else {
                alertaSemMudancas();
            }
        });
    });
}