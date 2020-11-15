var pagina = 1;
var qtd_resultados = 4;
var ordem = 'alfabetica';

listar();

function setListar(set_pagina = null, set_qtd_resultados = null, set_ordem = null) {
    pagina = set_pagina != null ? set_pagina : pagina; 
    qtd_resultados = set_qtd_resultados != null ? set_qtd_resultados : qtd_resultados; 
    ordem = set_ordem != null ? set_ordem : ordem; 

    listar();
}

function listar() {

    busca = $('#pesquisar').val();

    var dados = {
        listar: true,
        busca,
        pagina,
        qtd_resultados,
        ordem
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