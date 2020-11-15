function listarGeneros(id, descricao) {
    retorno = `
        <tr>
            <td>${descricao}</td>
            <td class="text-right">
            </td>
        </tr>
    `;

    return retorno;
}

/*
<button class="btn btn-primary btn-sm" title="Editar">
    <i class="fas fa-edit"></i>
</button>
<button class="btn btn-primary btn-sm" title="Excluir" onclick="deletarGenero(${id})">
    <i class="fas fa-trash"></i>
</button>
*/