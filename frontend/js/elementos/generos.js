function listarGeneros(id, descricao) {
    
    var botao = "";

    if(id != null) {
        var botao = `
            <button class="btn btn-secondary btn-sm" title="Editar" onclick="editarGenero(${id})">
                <i class="fas fa-edit"></i>
            </button>
            <button class="btn btn-primary btn-sm" title="Excluir" onclick="deletarGenero(${id})">
                <i class="fas fa-trash"></i>
            </button>
        `;
    }

    retorno = `
        <tr>
            <td>${descricao}</td>
            <td class="text-right">
                ${botao}
            </td>
        </tr>
    `;

    return retorno;
}