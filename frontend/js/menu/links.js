const state = {'page_id' : 0, 'user_id' : 0};
const title = '';

function redirect(event, linha, page, title) {
    
    if(event != null) 
        event.preventDefault();

    document.title = title;
    $("#window-view").load("frontend/"+page);
    selecionarLink(linha);
}

function selecionarLink(classe) {
    $('.sidebar_menu').removeClass('active');
    $(classe).addClass('active');
}

function startPagina(event = null) {
    redirect(event, ".link_home", "home.html", "Series Manager");
    selecionarLink('.link_home');

    window.history.pushState(state, title, 'home');
}

/////////////////////////////////////////////////////////////////////////////////////////

startPagina();

/////////////////////////////////////////////////////////////////////////////////////////

$('.link_home').click(function(event) {
    startPagina(event);
});

$('.link_usuarios').click(function(event) {
    redirect(event, this, "usuarios.html", "Series Manager: Usuários");
    window.history.pushState(state, title, 'usuarios');
});

$('.link_filmes').click(function(event) {
    redirect(event, this, "filmes.html", "Series Manager: Filmes");
    window.history.pushState(state, title, 'filmes');
});

$('.link_series').click(function(event) {
    redirect(event, this, "series.html", "Series Manager: Séries");
    window.history.pushState(state, title, 'series');
});