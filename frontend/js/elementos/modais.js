function confirmacaoModal(texto = "") {
    return `
        <div class="modal fade" id="modalConfirmacao" tabindex="-1" role="dialog" aria-labelledby="modalConfirmacaoLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalConfirmacaoLabel">
                            <i class="fas fa-exclamation-triangle"></i> Atenção
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Você têm certeza que deseja excluir?<br>
                        ${texto}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary deletar_confirma">Confimar</button>
                    </div>
                </div>
            </div>
        </div>
    `;
}

function alertCard(tipo, texto) {
    return `
        <div class="alert alert-${tipo}" role="alert">
            ${texto}
        </div>
    `;
}