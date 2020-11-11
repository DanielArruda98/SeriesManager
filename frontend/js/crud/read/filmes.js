listar();

function listar() {

    var dados = {
        listar: true
    }

    $.get(api_sm, dados, function (retorno) {
        
        var cartazes = "";

        $.each(retorno, function(idx, value) {
            cartazes += cartazFilme(value.id_filme, value.titulo, 'opdm.jpg');
        });

        $('#catalogo_filmes').html(cartazes);

    });
}