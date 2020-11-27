// Link api
function getApi(pagina) {
    return `http://api-seriesmanager.000webhostapp.com/backend/controllers/Controller${pagina}.php`;
    // return `http://localhost/SeriesManager/backend/controllers/Controller${pagina}.php`;
}

// Modal Growl
function modalResultado(titulo, tipo) {
    GrowlNotification.notify({
        title: titulo,
        type: tipo,
        closeTimeout: 3000
    });
}

function checarMudancas(a, b) {
    a = Array.isArray(a) ? a : [];
    b = Array.isArray(b) ? b : [];
    return a.length === b.length && a.every(el => b.includes(el));
}

function alertaSemMudancas() {
    $('#div_alerta').html(alertCard("dark", "Nenhuma mudança encontrada"));
    $('#div_alerta').show("fast");

    setTimeout(function() {
        $('#div_alerta').fadeOut("slow");
    }, 2000);
}