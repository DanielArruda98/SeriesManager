function linksPaginacao(qtd_paginas) {

    var retorno = "";

    if(qtd_paginas > 1) {
        for (var i = 0; i < qtd_paginas; i++) {
            retorno += `
                <button onclick="setListar(${i+1})" class="btn btn-primary">
                    ${i+1}
                </button>
            `;
        }
    }

    return retorno;

}