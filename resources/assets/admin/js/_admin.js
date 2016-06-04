jQuery(function($){
    // Máscara
    $('input[name="cep"], .mask_cep').mask("99999-999")
    $('input[name="cpf"], input[data-mask="cpf"]').mask('999.999.999-99')
    $('input[name="telefone_2"], input[name="whatsapp"], .mask_tel').focusout(function(){
        var phone, element;
        element = $(this);
        element.unmask();
        phone = element.val().replace(/\D/g, '');
        if(phone.length > 10) {
            element.mask("(99) 99999-999?9");
        } else {
            element.mask("(99) 9999-9999?9");
        }
    }).trigger('focusout');
    
    // Tokenfield
    $('.tokenfield').tokenfield({createTokensOnBlur:true})

    // Editor de texto
    $('.editor').trumbowyg({
        fullscreenable: false,
        removeformatPasted: true,
        lang:'pt',
        btns: ['viewHTML','|', 'formatting','|', 'btnGrp-design','|', 'link','|', 'insertImage','|', 'btnGrp-justify','|', 'btnGrp-lists','|', 'horizontalRule']
    });
    
    // Tooltip 
    $('.btn-acao').tooltip({
        placement: 'right'
    })
    $('*[data-toggle="tooltip"]').tooltip()
    //$('*[data-toggle="collapse"]').collapse()

    // Switch
    function switch_init(){
        $('input[data-toggle="switch"], input[data-toggle="switch-ajax"]').bootstrapSwitch();  
    }
    switch_init()
    function switch_ajax_request(){
       $('input[data-toggle="switch-ajax"]').on('switchChange.bootstrapSwitch', function(event, state) {
            var elemento = $(this);
            var switch_request = $.ajax({
                url: elemento.attr('data-ajax-url'),
                method: "POST",
                data: { _token : elemento.attr('data-token') }, //removido o parametro id, ele vai na url
                dataType: "html"
            });
            switch_request.done(function( status ) {
                elemento.val(status);

                var obj = JSON.parse(status);
                if(obj.status == '200')
                    swal("Opa!", "Status alterado", "success")
                else
                    swal("Erro!", "Status não alterado", "warning")
            });

            switch_request.fail(function( jqXHR, textStatus ) {
                alert( "Request failed: " + textStatus );
            });
        }); 
    } 
    switch_ajax_request()

    // Boostrap Table
    $('table[data-toggle="table"]').on('page-change.bs.table', function (pagination) {
        // Refresh bootstrap switch
        switch_init()
        switch_ajax_request()
    });

    // Autocomptele
    $('#buscar-gente').autocomplete({
        serviceUrl: "/admin/clientes/get_cliente_busca",
        onSelect: function (suggestion) {
            window.location.href = '/admin/clientes/ver/'+ suggestion.id;
        },
        showNoSuggestionNotice:true,
        noSuggestionNotice: 'Humm.. não econtramos ninguém!'
    });
    $('#ticket_fk_cliente').autocomplete({
        serviceUrl: "/admin/clientes/get_cliente_busca",
        onSelect: function (suggestion) {
            $('#ticket_fk_cliente').val(suggestion.value)
        },
        showNoSuggestionNotice:true,
        noSuggestionNotice: 'Humm.. não econtramos ninguém!'
    });
    $('#cliente_dados').autocomplete({
        serviceUrl: "/admin/clientes/get_cliente_busca",
        onSelect: function (suggestion) {
            $('#ticket_fk_cliente').val(suggestion.value)
        },
        showNoSuggestionNotice:true,
        noSuggestionNotice: 'Humm.. não econtramos ninguém!'
    });
});

function validar_upload(id_input, max_size, multiple){

    if(multiple){
        

    }else{ //se for input pra 1 arquivo só

        //check whether browser fully supports all File API
        if (window.File && window.FileReader && window.FileList && window.Blob)
        {
            //get the file size and file type from file input field
            var fsize = $('#'+id_input)[0].files[0].size;
            
            if(fsize > parseInt(max_size)) //do something if file size more than 1 mb (1048576)
            {
                alert(" O arquivo não pode ser enviado pois ultrapassa o limite permitido.");
                return false;
            }
        }else{
            //O browser não suporta a verificação
            //return false;
        }

    }

    return true;

}

// Marcar Todos os checkboxes
function marcar_todos(gatilho_id, filhos_classe){
	marcar = $(gatilho_id).prop('checked');
	$(filhos_classe).prop('checked', marcar);
}

/* ao clicar no checkbox na listagem dos registros, marcar ou não todos: */
function marcar_todos(gatilho_id, filhos_classe){
    marcar = $(gatilho_id).prop('checked');
    $(filhos_classe).prop('checked', marcar);
}

function mostraAba(id, total){
    qual = id.split('link');
    //esconde todas as abas:
    for(aba = 0; aba < total; aba++){
        $('#aba'+aba).css({ 'display':'none'}); //esconde
        $('#link'+aba).attr( 'class', 'inativo');//muda classe
    }

    $('#aba'+qual[1]).css({ 'display':'block'}); //esconde
    $('#link'+qual[1]).attr( 'class', 'ativo');
}
/* ------------------------------------------------------------------------------------- */
function mostraJanelaAba(id, total){
    qual = id.split('janelaLink');
    //esconde todas as abas:
    for(aba = 0; aba < total; aba++){
        $('#janelaAba'+aba).css({ 'display':'none'}); //esconde
        $('#janelaLink'+aba).attr( 'class', '');//muda classe
    }
    $('#janelaAba'+qual[1]).css({ 'display':'block'});
    $('#janelaLink'+qual[1]).attr( 'class', 'janelaAbasAtivo');
}



/* ------------------------------------------------------------------------------------- */
/* funcao usada no controle de permissoes do usuario: */
/* ao clicar no checkbox, marcar automaticamente os submenus que tem o id pai na classe: */
function permissaoClick(menuId,tipo){
    switch(tipo){
        case 'pai':                     
                    if($('#pai-'+menuId).is(":checked")){
                        $('.filho-'+menuId).each(function() {
                            $(this).prop('checked', true);
                            idFilho = $(this).prop('id').split('-');
                            permissaoClick(idFilho[1],'filho');
                        });
                    }else{
                        $('.filho-'+menuId).each(function() {
                            $(this).prop('checked', false);
                            idFilho = $(this).prop('id').split('-');
                            permissaoClick(idFilho[1],'filho');
                        });
                    }
                    break;
        case 'filho':   //pega id do pai se precisar:
                        idPai = $('#filho-'+menuId).prop('class').split('-');
                        idPai = idPai[1];
                        if($('#filho-'+menuId).prop('checked')){
                            $('.neto-'+menuId).prop('checked',true);
                            //checa o pai:
                            $('#pai-'+idPai).prop('checked',true);
                        }else{
                            //desmarca os netos:
                            $('.neto-'+menuId).prop('checked',false);
                            //verifica se tem filhos marcados, senão desmarca o pai tambem:
                            existe = false;
                            $('.filho-'+idPai).each(function() {
                                if($(this).prop('checked')){
                                    existe = true;
                                }
                            });
                            //caso nao tenha filhos marcados, desmarca o pai
                            if(!existe)
                              $('#pai-'+idPai).prop('checked',false);
                            
                            //Novo: desmarca os crus:
                            $('#menu-criar-'+menuId).prop('checked',false);
                            $('#menu-editar-'+menuId).prop('checked',false);
                            $('#menu-excluir-'+menuId).prop('checked',false);
                        }
                        break;

        case 'neto':    //pega id do pai:
                        idPai = $('#neto-'+menuId).prop('class').split('-');
                        idPai = idPai[1];
                        //pega id do avõ:
                        idAvo = $('#filho-'+idPai).prop('class').split('-');
                        idAvo = idAvo[1];
                        if($('#neto-'+menuId).is(":checked")){
                            //marca o pai, caso não esteja:
                            $('#filho-'+idPai).prop('checked',true);
                            //marca o avo
                            $('#pai-'+idAvo).prop('checked',true);
                        }else{
                            //verifica se tem irmãos marcados, senão desmarca o pai tambem:
                            existe = false;
                            $('.neto-'+idPai).each(function() {
                                if($(this).is(":checked")){
                                    existe = true;
                                }
                            });
                            //caso nao tenha filhos marcados, desmarca o pai e avô se necessário
                            if(!existe){
                              $('#filho-'+idPai).prop('checked',false);
                              permissaoClick(idPai,'filho');
                            }
                        }
                        break;
        
        // novo:
        case 'crud':    //se o criar, editar ou excluir estiver check, marca os outros acima:
                        if( $('#menu-criar-'+menuId).is(":checked") || $('#menu-editar-'+menuId).is(":checked") || $('#menu-excluir-'+menuId).is(":checked") ){

                            //marca o pai, caso não esteja:
                            $('#filho-'+ menuId).prop('checked',true);

                            //pega o id do avô:
                            idAvo = $('#filho-'+menuId).prop('class').split('-');
                            idAvo = idAvo[1];
                            $('#pai-'+ idAvo).prop('checked',true);
                        }
                        
                        break;
        
        
    }//fim switch
    
    return true;
}


function dump(obj) {

    var out = '';
    for (var i in obj) {
        out += i + ": " + obj[i] + "\n";
    }

    alert(out);
}

//Defautls das tabelas
$.extend( true, $.fn.bootstrapTable.defaults, {
    'pagination' : true,
    'search' : true,
    'searchAlign':'left',
    'showColumns' : true,
    'clickToSelect': true,
    'sortable':true,
    'selectItemName' : 'registros[]'
});
$.extend( true, $.fn.bootstrapTable.columnDefaults, {
});
$.fn.bootstrapTable.locales['pt-BR'] = {
    formatLoadingMessage: function () {
        return 'Hold your horses...';
    },
    formatRecordsPerPage: function (pageNumber) {
        return pageNumber + 'por página';
    },
    formatShowingRows: function (pageFrom, pageTo, totalRows) {
        return 'Total de ' + totalRows + ' registros';
    },
    formatSearch: function () {
        return 'Buscar';
    },
    formatNoMatches: function () {
        return 'Hmm.. Nada encontrado.';
    },
    formatPaginationSwitch: function () {
        return 'Mostrar/Esconder paginação';
    },
    formatRefresh: function () {
        return 'Recarregar';
    },
    formatToggle: function () {
        return 'Alternar';
    },
    formatColumns: function () {
        return 'Colunas';
    },
    formatAllRows: function () {
        return 'Todos';
    }
};
$.extend($.fn.bootstrapTable.defaults, $.fn.bootstrapTable.locales['pt-BR']);
