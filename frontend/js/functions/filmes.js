function mudarExibicao(view) {

    if(view == 'grid') {
        $('#exibir-lista').fadeOut('slow');
        $('#exibir-grid').show('slow');

        $('.icone_exibicao').attr('onclick', "mudarExibicao('lista')");
        $('.icone_exibicao').html("<i class='icon-list-1'></i>");
    } else {
        $('#exibir-grid').fadeOut('slow');
        $('#exibir-lista').show('slow');

        $('.icone_exibicao').attr('onclick', "mudarExibicao('grid')");
        $('.icone_exibicao').html("<i class='icon-grid'></i>");
    }

}