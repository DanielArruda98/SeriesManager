function cartazFilme(id, titulo, img) {
    return `
        <div class="cartaz">
            <header>
                ${titulo}
            </header>
            <section style="cursor: pointer;" onclick="detalhesFilme(${id})">
                <img src="https://docs.google.com/uc?id=1HPq3rBhVcW5H9Xufu804UEiiG8EGBxNj">
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
}

function listarGenerosSelect(id, genero) {
    return `
        <option value="${id}">${genero}</option>
    `;
}

function listarGenerosEscolhidos(id, genero) {
    return `
        <span onclick='removerGenero(${id})' id='option_genero_esc_${id}'>${genero}</span>
    `;
}