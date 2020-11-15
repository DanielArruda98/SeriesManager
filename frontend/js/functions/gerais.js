// Link api
function getApi(pagina) {
    return `http://localhost/SeriesManager/backend/controllers/Controller${pagina}.php`;
}

// Modal Growl
function modalResultado(titulo, tipo) {
    GrowlNotification.notify({
        title: titulo,
        type: tipo,
        closeTimeout: 3000
    });
}