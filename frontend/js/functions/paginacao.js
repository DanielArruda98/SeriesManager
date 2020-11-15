function gerarPaginacao(qtd_paginas) {
    var paginacao = linksPaginacao(qtd_paginas);
    $('#paginacao').html(paginacao);
} 

// Paginação
$('#pesquisar').keyup(function() {
    listar();
});