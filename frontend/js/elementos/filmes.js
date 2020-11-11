function cartazFilme(id, titulo, img) {

    var cartaz = `
        <div class="cartaz">
            <header>
                ${titulo}
            </header>
            <section data-toggle="modal" data-target="#detalhesFilme">
                <img src="frontend/img/capas/filmes/${img}">
            </section>
            <footer>
                <button class="btn btn-info" title="Editar" onclick="editarFilme(${id})">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="btn btn-primary" title="Excluir" onclick="excluirFilme(${id})">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </footer>
        </div>
    `;

    return cartaz;
}