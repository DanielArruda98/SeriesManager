var pagina = 1;
var qtd_resultados = 8;

listar(pagina, qtd_resultados);

function listar(pagina, qtd_resultados) {

    busca = $('#pesquisar').val();

    var dados = {
        listar: true,
        busca,
        pagina,
        qtd_resultados
    }
    
    $.get(getApi('Filme'), dados, function (retorno) {  
        var cartazes = "";

        $.each(retorno['catalogo'], function(idx, value) {
            var capa = (value.capa).replace('file/d/', 'uc?id=').replace('/view?usp=sharing', '');
            cartazes += cartazFilme(value.id_filme, value.titulo, capa);
        });

        $('#catalogo_filmes').html(cartazes);

        gerarPaginacao(retorno['qtd_paginas']);
    });
}

// Paginação
$('#pesquisar').keyup(function() {
    listar(pagina, qtd_resultados);
});

function gerarPaginacao(qtd_paginas) {
    var paginacao = linksPaginacao(qtd_paginas);
    $('#paginacao').html(paginacao);
} 

// Visualizar informações do filme
function detalhesFilme(id) {

    var dados = {
        consultar : true,
        id_filme : id
    }

    $.get(getApi('Filme'), dados, function(retorno) {
        generos = "";

        $.each(retorno.genero, function(idx, value) {
            if(value != null) {
                generos += value+". ";
            }
        });

        $('#view_titulo').val(retorno.titulo);
        $('#view_ano_lancamento').val(retorno.ano);
        $('#view_duracao').val(retorno.duracao);
        $('#view_torrent').val(retorno.torrent);
        $('#view_genero').val(generos);

        $('#detalhesFilme').modal('show');
    });   
}