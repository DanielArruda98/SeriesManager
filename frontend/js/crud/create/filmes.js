// api_sm = "https://api-seriesmanager.000webhostapp.com/controllers/ControllerFilme.php";
api_sm = "http://localhost/SeriesManager/backend/controllers/ControllerFilme.php";

function getApi(pagina) {
    return `http://localhost/SeriesManager/backend/controllers/Controller${pagina}.php`;
}

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

    console.log(dados);

    $.post(getApi('Filme'), dados, function (retorno) {
       console.log(retorno); 
        
        GrowlNotification.notify({
            title: retorno.titulo,
            type: retorno.tipo,
            closeTimeout: 3000
        });

        listar(pagina, qtd_resultados);

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

function listarOptionsGenero() {
    var dados = {
        listar
    };

    $.get(getApi('Genero'), dados, function (retorno) {

        options = listarGenerosSelect(0, "Generos");

        $.each(retorno, function (idx, value) {
            var i = 0;

            $.each(generos_filmes, function (idx_select, value_select) {
                if (value.id == value_select[0])
                    i++;
            });

            if (i == 0)
                options += listarGenerosSelect(value.id, value.descricao);
        })

        $('#listagem_generos').html(options);
    });
}

function removerGenero(id) {

    $.each(generos_filmes, function (idx, value) {
        if (value[0] == id) {
            generos_filmes[idx] = [null, null];
        }
    });

    $(`#option_genero_esc_${id}`).remove();
    listarOptionsGenero();
}