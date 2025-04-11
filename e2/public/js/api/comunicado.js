//ABAS
function abas(id){
    if (id == 1){
        if(!$('#ativos').hasClass('nav-link active')){
            $('#ativos').addClass('active');
            $('#inativos').removeClass('active');
            $('#finalizados').removeClass('active');
            if(!$('#tabAtivos').hasClass('tab-pane active')){
                $('#tabAtivos').addClass('active');
                $('#tabInativos').removeClass('active');
                $('#tabFinalizados').removeClass('active');
            }
        }
    }
    if (id == 2){
        if(!$('#inativos').hasClass('nav-link active')){
            $('#inativos').addClass('active');
            $('#ativos').removeClass('active');
            $('#finalizados').removeClass('active');
            if(!$('#tabInativos').hasClass('tab-pane active')){
                $('#tabInativos').addClass('active');
                $('#tabAtivos').removeClass('active');
                $('#tabFinalizados').removeClass('active');
            }
        }
    }
    if (id == 3){
        if(!$('#finalizados').hasClass('nav-link active')){
            $('#finalizados').addClass('active');
            $('#inativos').removeClass('active');
            $('#ativos').removeClass('active');
            if(!$('#tabFinalizados').hasClass('tab-pane active')){
                $('#tabFinalizados').addClass('active');
                $('#tabInativos').removeClass('active');
                $('#tabAtivos').removeClass('active');
            }
        }
    }
}


function pNome(){
    $('#pMenu').html('Nome');
    $("#pesquisaNome").css("display", "block");
    $("#pesquisaCNPJ").css("display", "none");
};
function pNumero(){
    $('#pMenu').html('Número');
    $("#pesquisaCNPJ").css("display", "block");
    $("#pesquisaNome").css("display", "none");
};

function popComunicadosA(pag){
    var pag_atual = 0;
    if(!pag){
        pag_atual = 1;
    }else{
        pag_atual = pag;
    }
    var url_atual = window.location.origin;
    var popula_ca = '';
    var anterior = '';
    var pgan = 0;
    var pgpr = 0;    
    var itens = '';
    var item = 0;
    var proxima = '';
    var habAnterior = '';
    var habProxima = '';
    
    $.ajax({
        type: 'GET',
        url: url_atual + '/api/comunicadosa?page='+pag_atual,
        dataType: 'json'
    }).done(function(data){

        for(i=0;i<data.data.length;i++){
            popula_ca = popula_ca + "<tr class='edit-empresas'><th scope='row'>"+data.data[i].numeroComunicado+"</th><td>"+data.data[i].fornecedor+"</td><td style='text-align: center'><button type='button' class='btn btn-info btn-sm' title='Editar Comunicado' onclick=\"location.href='cadcom/"+data.data[i].numeroComunicado+"'\"><i class='fa fa-pencil' aria-hidden='true'></i></button></td><td style='text-align: center'><button type='button' class='btn btn-secondary btn-sm' title='Gerar Certificado' onclick=\"location.href='cadcertificado/"+data.data[i].numeroComunicado+"'\"><i class='fa fa-cogs' aria-hidden='true'></i></button></td><td style='text-align: center'><button type='button' class='btn btn-success btn-sm'title='Imprimir Comunicado' onclick=\"location.href='printcomunicado/"+data.data[i].numeroComunicado+"'\"><i class='fa fa-print' aria-hidden='true'></i></button></td><td style='text-align: center'><button type='button' class='btn btn-danger btn-sm' title='Excluir Comunicado' onclick='excluiComunicado("+data.data[i].idComunicado+")'><i class='fa fa-trash' aria-hidden='true'></i></button></td></tr>";
        }
        if(data.current_page == 1){
            pgan = 1;
            habAnterior = 'disabled';
        }else{
            pgan = parseInt(data.current_page) - 1;
            habAnterior = '';
        }
        anterior = "<li class='page-item page-link "+ habAnterior +" paginas' id='anterior' onclick='popComunicadosAtivos("+pgan+")'>Anterior</li>";

        for(i=0;i<parseInt(data.last_page);i++){
            if(data.links.label != "&laquo; Anterior" && data.links.label != "Próximo &raquo;"){
                item = item + 1;
		        itens =	itens + "<li class='page-item page-link paginas' onclick='popComunicadosAtivos("+item+")'>"+item+"</li>";
            }
            
        };
		
        if(data.current_page == data.last_page){
            pgpr = data.last_page;
            habProxima = 'disabled';
        }else{
            pgpr = parseInt(data.current_page) + 1;
            habProxima = '';
        }
        proxima = "<li class='page-item page-link "+habProxima+" paginas' id='proxima' onclick='popComunicadosAtivos("+pgpr+")'>Próximo</li>";

        $("#tb-ca").html(popula_ca);
        $("#paginacao").html(anterior+itens+proxima);
    });
    popComunicadosC();
};

function popComunicadosC(pag){
    var pag_atual = 0;
    if(!pag){
        pag_atual = 1;
    }else{
        pag_atual = pag;
    }
    var url_atual = window.location.origin;
    var popula_ca = '';
    var anterior = '';
    var pgan = 0;
    var pgpr = 0;    
    var itens = '';
    var item = 0;
    var proxima = '';
    var habAnterior = '';
    var habProxima = '';
    
    $.ajax({
        type: 'GET',
        url: url_atual + '/api/comunicadosc?page='+pag_atual,
        dataType: 'json'
    }).done(function(data){
        for(i=0;i<data.data.length;i++){
            popula_ca = popula_ca + "<tr class='edit-empresas'><th scope='row'>"+data.data[i].numeroComunicado+"</th><td>"+data.data[i].fornecedor+"</td><td style='text-align: center'><button type='button' class='btn btn-success btn-sm'title='Imprimir Comunicado' onclick=\"location.href='printcomunicado/"+data.data[i].numeroComunicado+"'\"><i class='fa fa-print' aria-hidden='true'></i></button></td></tr>";
        }
        if(data.current_page == 1){
            pgan = 1;
            habAnterior = 'disabled';
        }else{
            pgan = parseInt(data.current_page) - 1;
            habAnterior = '';
        }
        anterior = "<li class='page-item page-link "+ habAnterior +" paginas' id='anterior' onclick='popComunicadosC("+pgan+")'>Anterior</li>";

        for(i=0;i<parseInt(data.last_page);i++){
            if(data.links.label != "&laquo; Anterior" && data.links.label != "Próximo &raquo;"){
                item = item + 1;
		        itens =	itens + "<li class='page-item page-link paginas' onclick='popComunicadosC("+item+")'>"+item+"</li>";
            }
            
        };
		
        if(data.current_page == data.last_page){
            pgpr = data.last_page;
            habProxima = 'disabled';
        }else{
            pgpr = parseInt(data.current_page) + 1;
            habProxima = '';
        }
        proxima = "<li class='page-item page-link "+habProxima+" paginas' id='proxima' onclick='popComunicadosC("+pgpr+")'>Próximo</li>";

        $("#tb-cc").html(popula_ca);
        $("#paginacao").html(anterior+itens+proxima);
    });
    popComunicadosF();
}

function popComunicadosF(pag){
    var pag_atual = 0;
    if(!pag){
        pag_atual = 1;
    }else{
        pag_atual = pag;
    }
    var url_atual = window.location.origin;
    var popula_ca = '';
    var anterior = '';
    var pgan = 0;
    var pgpr = 0;    
    var itens = '';
    var item = 0;
    var proxima = '';
    var habAnterior = '';
    var habProxima = '';
    
    $.ajax({
        type: 'GET',
        url: url_atual + '/api/comunicadosf?page='+pag_atual,
        dataType: 'json'
    }).done(function(data){
        for(i=0;i<data.data.length;i++){
            popula_ca = popula_ca + "<tr class='edit-empresas'><th scope='row'>"+data.data[i].numeroComunicado+"</th><td>"+data.data[i].fornecedor+"</td><td style='text-align: center'><button type='button' class='btn btn-success btn-sm'title='Imprimir Comunicado' onclick=\"location.href='printcomunicado/"+data.data[i].numeroComunicado+"'\"><i class='fa fa-print' aria-hidden='true'></i></button></td></tr>";
        }
        if(data.current_page == 1){
            pgan = 1;
            habAnterior = 'disabled';
        }else{
            pgan = parseInt(data.current_page) - 1;
            habAnterior = '';
        }
        anterior = "<li class='page-item page-link "+ habAnterior +" paginas' id='anterior' onclick='popComunicadosF("+pgan+")'>Anterior</li>";

        for(i=0;i<parseInt(data.last_page);i++){
            if(data.links.label != "&laquo; Anterior" && data.links.label != "Próximo &raquo;"){
                item = item + 1;
		        itens =	itens + "<li class='page-item page-link paginas' onclick='popComunicadosF("+item+")'>"+item+"</li>";
            }
            
        };
		
        if(data.current_page == data.last_page){
            pgpr = data.last_page;
            habProxima = 'disabled';
        }else{
            pgpr = parseInt(data.current_page) + 1;
            habProxima = '';
        }
        proxima = "<li class='page-item page-link "+habProxima+" paginas' id='proxima' onclick='popComunicadosF("+pgpr+")'>Próximo</li>";

        $("#tb-cf").html(popula_ca).show();
        $("#paginacao").html(anterior+itens+proxima).show();
    });
}

function pesquisaNome(){
    $('#carregaPesquisa').css('display', 'block');
    var url_atual = window.location.origin;
    var texto = $('#pesquisaNome').val();
    if (texto === ''){
        $('#carregaPesquisa').css('display', 'none');
        popComunicadosA();
        return false;
    };
    var popula_ea = '';
    $.ajax({
        type: 'GET',
        url: url_atual + '/api/pncom/'+texto,
        dataType: 'json'
    }).done(function(data){
        for(i=0;i<data.length;i++){
            if(data[i].status == 'A'){
                popula_ea = popula_ea + "<tr class='edit-empresas'><th scope='row'>"+data[i].numeroComunicado+"</th><td>"+data[i].fornecedor+"</td><td style='text-align: center'><button type='button' class='btn btn-info btn-sm' title='Editar Comunicado' onclick=\"location.href='cadcom/"+data[i].numeroComunicado+"'\"><i class='fa fa-pencil' aria-hidden='true'></i></button></td><td style='text-align: center'><button type='button' class='btn btn-secondary btn-sm' title='Gerar Certificado' onclick=\"location.href='cadcertificado/"+data[i].numeroComunicado+"'\"><i class='fa fa-cogs' aria-hidden='true'></i></button></td><td style='text-align: center'><button type='button' class='btn btn-success btn-sm'title='Imprimir Comunicado' onclick=\"location.href='printcomunicado/"+data[i].numeroComunicado+"'\"><i class='fa fa-print' aria-hidden='true'></i></button></td><td style='text-align: center'><button type='button' class='btn btn-danger btn-sm' title='Excluir Comunicado' onclick='excluiComunicado("+data[i].idComunicado+")'><i class='fa fa-trash' aria-hidden='true'></i></button></td></tr>";
            }else{
                popula_ea = popula_ea + "<tr class='edit-empresas'><th scope='row'>"+data[i].numeroComunicado+"</th><td>"+data[i].fornecedor+"</td><td style='text-align: center'><button type='button' class='btn btn-info btn-sm' title='Editar Comunicado' onclick=\"location.href='cadcom/"+data[i].numeroComunicado+"'\" disabled><i class='fa fa-pencil' aria-hidden='true'></i></button></td><td style='text-align: center'><button type='button' class='btn btn-secondary btn-sm' title='Gerar Certificado' onclick=\"location.href='cadcertificado/"+data[i].numeroComunicado+"'\" disabled><i class='fa fa-cogs' aria-hidden='true'></i></button></td><td style='text-align: center'><button type='button' class='btn btn-success btn-sm'title='Imprimir Comunicado' onclick=\"location.href='printcomunicado/"+data[i].numeroComunicado+"'\"><i class='fa fa-print' aria-hidden='true'></i></button></td><td style='text-align: center'><button type='button' class='btn btn-danger btn-sm' title='Excluir Comunicado' disabled><i class='fa fa-trash' aria-hidden='true'></i></button></td></tr>";
            };
            
        }
        if (popula_ea){
            $("#tb-ca").html(popula_ea);
        }else{
            popula_ea = "<tr><td>,</td><td><h5 style='color: #A9A9A9'>Nenhum registro encontrado!</h5></td>";
            $("#tb-ca").html(popula_ea);
        }
        $('#carregaPesquisa').css('display', 'none');
    });
}

function pesquisaNumero(){
    console.log('aqui');
    $('#carregaPesquisa').css('display', 'block');
    var url_atual = window.location.origin;
    var texto = $('#pesquisaCNPJ').val();
    if (texto === ''){
        $('#carregaPesquisa').css('display', 'none');
        popComunicadosA();
        return false;
    };
    var popula_ea = '';
    $.ajax({
        type: 'GET',
        url: url_atual + '/api/pnumerocom/'+texto,
        dataType: 'json'
    }).done(function(data){
        console.log(data);
        for(i=0;i<data.length;i++){
            if(data[i].status == 'A'){
                popula_ea = popula_ea + "<tr class='edit-empresas'><th scope='row'>"+data[i].numeroComunicado+"</th><td>"+data[i].fornecedor+"</td><td style='text-align: center'><button type='button' class='btn btn-info btn-sm' title='Editar Comunicado' onclick=\"location.href='cadcom/"+data[i].numeroComunicado+"'\"><i class='fa fa-pencil' aria-hidden='true'></i></button></td><td style='text-align: center'><button type='button' class='btn btn-secondary btn-sm' title='Gerar Certificado' onclick=\"location.href='cadcertificado/"+data[i].numeroComunicado+"'\"><i class='fa fa-cogs' aria-hidden='true'></i></button></td><td style='text-align: center'><button type='button' class='btn btn-success btn-sm'title='Imprimir Comunicado' onclick=\"location.href='printcomunicado/"+data[i].numeroComunicado+"'\"><i class='fa fa-print' aria-hidden='true'></i></button></td><td style='text-align: center'><button type='button' class='btn btn-danger btn-sm' title='Excluir Comunicado' onclick='excluiComunicado("+data[i].idComunicado+")'><i class='fa fa-trash' aria-hidden='true'></i></button></td></tr>";
            }else{
                popula_ea = popula_ea + "<tr class='edit-empresas'><th scope='row'>"+data[i].numeroComunicado+"</th><td>"+data[i].fornecedor+"</td><td style='text-align: center'><button type='button' class='btn btn-info btn-sm' title='Editar Comunicado' onclick=\"location.href='cadcom/"+data[i].numeroComunicado+"'\" disabled><i class='fa fa-pencil' aria-hidden='true'></i></button></td><td style='text-align: center'><button type='button' class='btn btn-secondary btn-sm' title='Gerar Certificado' onclick=\"location.href='cadcertificado/"+data[i].numeroComunicado+"'\" disabled><i class='fa fa-cogs' aria-hidden='true'></i></button></td><td style='text-align: center'><button type='button' class='btn btn-success btn-sm'title='Imprimir Comunicado' onclick=\"location.href='printcomunicado/"+data[i].numeroComunicado+"'\"><i class='fa fa-print' aria-hidden='true'></i></button></td><td style='text-align: center'><button type='button' class='btn btn-danger btn-sm' title='Excluir Comunicado' disabled><i class='fa fa-trash' aria-hidden='true'></i></button></td></tr>";
            };
            
        }
        if (popula_ea){
            $("#tb-ca").html(popula_ea);
        }else{
            popula_ea = "<tr><td>,</td><td><h5 style='color: #A9A9A9'>Nenhum registro encontrado!</h5></td>";
            $("#tb-ca").html(popula_ea);
        }
        
        $('#carregaPesquisa').css('display', 'none');
    });
}

function excluiComunicado(id){
	var url_atual = window.location.origin;
    if (confirm("Você deseja realmente excluir o Comunicado?")) {
        $.ajax({
            type: "DELETE",
            url: url_atual +'/api/cadcomunicado/'+id,
            timeout: 0,
        }).done(function(data) {
            alert("Registro excluído com sucesso!");
            popComunicadosA();
        });
    }
}