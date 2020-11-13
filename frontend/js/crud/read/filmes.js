var pagina = 1;
var qtd_resultados = 4;

listar(pagina, qtd_resultados);

function listar(pagina, qtd_resultados) {

    busca = $('#pesquisar').val();

    var dados = {
        listar: true,
        busca,
        pagina,
        qtd_resultados
    }

    $.get(api_sm, dados, function (retorno) {  
        var cartazes = "";

        $.each(retorno['catalogo'], function(idx, value) {
            cartazes += cartazFilme(value.id_filme, value.titulo, 'opdm.jpg');
        });

        $('#catalogo_filmes').html(cartazes);

        gerarPaginacao(retorno['qtd_paginas']);
    });
}

$('#pesquisar').keyup(function() {
    listar(pagina, qtd_resultados);
});

function gerarPaginacao(qtd_paginas) {
    var paginacao = linksPaginacao(qtd_paginas);
    $('#paginacao').html(paginacao);
}