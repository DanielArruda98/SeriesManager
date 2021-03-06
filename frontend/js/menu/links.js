function redirect(event, linha, page, title) {
    
    if(event != null) 
        event.preventDefault();

    document.title = title;
    $("#window-view").load("frontend/pages/"+page);
    selecionarLink(linha);
}

function selecionarLink(classe) {
    $('.sidebar_menu').removeClass('active');
    $(classe).addClass('active');
}

function startPagina(event = null) {
    redirect(event, ".link_home", "home.html", "Series Manager");
    selecionarLink('.link_home');

    // window.history.pushState({}, null, 'home');
}

////////////////////////////////////////////////////////////////////////////////////////
startPagina();

$('.link_home').click(function(event) {
    startPagina(event);
});

$('.link_generos').click(function(event) {
    redirect(event, this, "generos.html", "Series Manager: Gêneros");
    // window.history.pushState({}, null, 'generos');
});

$('.link_filmes').click(function(event) {
    redirect(event, this, "filmes.html", "Series Manager: Filmes");
    // window.history.pushState({}, null, 'filmes');
});

$('.link_series').click(function(event) {
    redirect(event, this, "series.html", "Series Manager: Séries");
    // window.history.pushState({}, null, 'series');
});