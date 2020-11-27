var dados_antigos = [];

function editarFilme(id_filme) {
    var dados = {
        consultar: true,
        id_filme
    }

    $.get(getApi('Filme'), dados, function (retorno) {
        // Trocar Cadastro por Editar
        $('#btn-cadastrar_filme').remove();
        $('#btn-editar_filme').removeClass('d-none');
        $('#modalCadastro').html('Editar Filme');

        // Valores do Modal
        $('#hidden_id').val(id_filme);
        $('#titulo').val(retorno.titulo);
        $('#ano_lancamento').val(retorno.ano);
        $('#duracao').val(retorno.duracao);
        $('#torrent').val(retorno.torrent);
        $('#capa_filme').val(retorno.capa);

        // Estrutura do modal de edição
        generos_filmes = [];
        generos_antigos = [];

        $.each(retorno.genero, function (idx, value) {
            generos_filmes.push([value.id, value.genero]);
            generos_antigos.push([value.id, value.genero]);
        });

        dados_antigos = [retorno.titulo, retorno.ano, retorno.duracao, retorno.torrent, retorno.capa];

        listarOptionsGenero();
        listarSpanGeneros(generos_filmes);

        $('#cadastrarFilme').modal('show');
    });
}

////////////////////////////////// SALVAR //////////////////////////////////
$('#btn-editar_filme').click(function () {
    var id_filme = $('#hidden_id').val();
    var titulo = $('#titulo').val();
    var ano = $('#ano_lancamento').val();
    var duracao = $('#duracao').val();
    var torrent = $('#torrent').val();
    var capa = $('#capa_filme').val();
    var genero = generos_filmes;

    // Verificar alterações
    var dados_novos = [titulo, ano, duracao, torrent, capa];
    var i = 0;
    
    if(genero.length == generos_antigos.length) {
        $.each(genero, function(idx, value) {
            if(value[0] != generos_antigos[idx][0]) {
                i++;
            }
        });
    } else {
        i++;
    }

    if (!checarMudancas(dados_antigos, dados_novos) || i > 0) {
        var dados = {
            atualizar: true,
            id_filme,
            titulo,
            ano,
            duracao,
            torrent,
            capa,
            genero
        }

        $.post(getApi('Filme'), dados, function (retorno) {
            modalResultado(retorno.titulo, retorno.tipo);
            listar();

            $('#cadastrarFilme').modal('hide');
        });
    } else {
        alertaSemMudancas();
    }
});