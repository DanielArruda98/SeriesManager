function linksPaginacao(qtd_paginas) {

    var retorno = "";

    for (var i = 0; i < qtd_paginas; i++) {
        retorno += `
            <button onclick="listar(${i+1}, ${qtd_resultados})" class="btn btn-primary">
                ${i+1}
            </button>
        `;
    }

    return retorno;

}