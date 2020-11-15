// Abrir Modal
function cadastrarFilme() {
    generos_filmes = [];
    listarOptionsGenero();
    $('#cadastrarFilme').modal('show');
}

// Salvar Filme
$('#btn-cadastrar_filme').click(function () {
    var titulo = $('#titulo').val();
    var ano = $('#ano_lancamento').val();
    var duracao = $('#duracao').val();
    var torrent = $('#torrent').val();
    var capa = $('#capa_filme').val();
    var genero = generos_filmes;

    var dados = {
        cadastrar: true,
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

        $('#titulo').val('');
        $('#ano_lancamento').val('');
        $('#duracao').val('');
        $('#torrent').val('');
        $('#capa_filme').val('');
        generos_filmes = [];
    });
});

// Associar Gênero ao Filme
$('#btn-cadastrar_genero_filme').click(function () {
    var id = $('#listagem_generos').val();
    var genero = $('#listagem_generos option:selected').text();
    $('#listagem_generos').val(0);

    if (id > 0) {
        generos_filmes.push([id, genero]);
        listarOptionsGenero();

        var span = "";

        $.each(generos_filmes, function (idx, value) {
            if(value[0] != null) {
                span += listarGenerosEscolhidos(value[0], value[1]);
            }
        });

        $('#tags-filmes').html(span);
    }
});