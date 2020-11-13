api_sm = "https://api-seriesmanager.000webhostapp.com/controllers/ControllerFilme.php";
// api_sm = "http://localhost/SeriesManager/backend/controllers/ControllerFilme.php";

$('#btn-cadastrar_filme').click(function () {

    var titulo = $('#titulo').val();
    var ano = $('#ano_lancamento').val();
    var duracao = $('#duracao').val();
    var torrent = $('#torrent').val();
    var capa = $('#capa_filme').val();

    var dados = {
        cadastrar: true,
        titulo,
        ano,
        duracao,
        torrent,
        capa
    }

    $.post(api_sm, dados, function (retorno) {
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
    });
});