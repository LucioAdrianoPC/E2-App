
//ABAS
function abas(id){
    if (id == 1){
        if(!$('#ativos').hasClass('nav-link active')){
            $('#ativos').addClass('active');
            $('#inativos').removeClass('active');
            if(!$('#tabAtivos').hasClass('tab-pane active')){
                $('#tabAtivos').addClass('active');
                $('#tabInativos').removeClass('active');
            }
        }
    }
    if (id == 2){
        if(!$('#inativos').hasClass('nav-link active')){
            $('#inativos').addClass('active');
            $('#ativos').removeClass('active');
            if(!$('#tabInativos').hasClass('tab-pane active')){
                $('#tabInativos').addClass('active');
                $('#tabAtivos').removeClass('active');
            }
        }
    }
}

//NOVO FILHO MODAL
function novoFilho(){ 
    var nc = $('#numCer').text();
    var idc = $('#idc').text();
    var resta = $('#qtdrest').text();
    window.location.href="cadcertificado/"+nc+"?filho=true&idmae="+idc+"&resta="+resta;
};

function pNome(){
    $('#pMenu').html('Nome');
    $("#pesquisaNome").css("display", "block");
    $("#pesquisaNumero").css("display", "none");
};
function pNumero(){
    $('#pMenu').html('Nº Certificado');
    $("#pesquisaNumero").css("display", "block");
    $("#pesquisaNome").css("display", "none");
};

$(document).ready(function(pag){
    var pag_atual = 0;
    if(!pag){
        pag_atual = 1;
    }else{
        pag_atual = pag;
    }
    var url_atual = window.location.origin;
    var popula_cea = '';
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
        url: url_atual + '/api/certificadosa?page='+pag_atual,
        dataType: 'json'
    }).done(function(data){
        
        for(i=0;i<data.data.length;i++){
           popula_cea = popula_cea + "<tr class='edit-certificado'><th style='display:none'>id</th><th scope='row'>"+data.data[i].numeroCertificado+"</th><td>"+data.data[i].qtd+"</td><td style='text-align: center'>"+data.data[i].fornecedor+"</td><td style='text-align: center'><button type='button' class='btn btn-secondary btn-sm'title='Desmembrar Certificado' onclick='desmembrar("+data.data[i].numeroCertificado+','+data.data[i].idCertificado+','+data.data[i].qtd+")'><i class='fa fa-files-o' aria-hidden='true'></i></button></td><td style='text-align: center'><button type='button' class='btn btn-success btn-sm'title='Imprimir Certificado' onclick=\"location.href='printcertificado/"+data.data[i].idCertificado+"'\"><i class='fa fa-print' aria-hidden='true'></i></button></td><td style='text-align: center'><button type='button' class='btn btn-info btn-sm' title='Editar Certificado' onclick='editCertificado("+data.data[i].idCertificado+','+data.data[i].numeroCertificado+','+data.data[i].id_mae+")'><i class='fa fa-pencil' aria-hidden='true'></i></button></td></tr>";
        }
        if(data.current_page == 1){
            pgan = 1;
            habAnterior = 'disabled';
        }else{
            pgan = parseInt(data.current_page) - 1;
            habAnterior = '';
        }
        anterior = "<li class='page-item page-link "+ habAnterior +" paginas' id='anterior' onclick='popCertificadosAtivos("+pgan+")'>Anterior</li>";

        for(i=0;i<parseInt(data.last_page);i++){
            if(data.links.label != "&laquo; Anterior" && data.links.label != "Próximo &raquo;"){
                item = item + 1;
		        itens =	itens + "<li class='page-item page-link paginas' onclick='popCertificadosAtivos("+item+")'>"+item+"</li>";
            }
            
        };
		
        if(data.current_page == data.last_page){
            pgpr = data.last_page;
            habProxima = 'disabled';
        }else{
            pgpr = parseInt(data.current_page) + 1;
            habProxima = '';
        }
        proxima = "<li class='page-item page-link "+habProxima+" paginas' id='proxima' onclick='popCertificadosAtivos("+pgpr+")'>Próximo</li>";

        $("#tb-cea").html(popula_cea);
        $("#paginacao").html(anterior+itens+proxima);
    });
    popCertificadosFinalizados();
});

function desmembrar(nc, idc, qtdmae){
    var url_atual = window.location.origin;
    var popula_ceaf = '';
    var resta = 0;
    $.ajax({
        type: 'GET',
        url: url_atual + '/api/popfilho/'+nc,
        dataType: 'json'
    }).done(function(data){
        if(data.length > 0){
            for(i=0;i<data.length;i++){
                resta = parseFloat(resta) + parseFloat(data[i].qtd);
                popula_ceaf = popula_ceaf + "<tr class='edit-certificado'><th scope='row'>"+data[i].numeroCertificado+'/'+data[i].numeroFilho+"</th><td>"+data[i].qtd+"</td><td style='text-align: center'>"+data[i].empresa+"</td><td style='text-align: center'><button type='button' class='btn btn-success btn-sm'title='Imprimir Certificado' onclick=\"location.href='printcertificado/"+data[i].idCertificado+"'\"><i class='fa fa-print' aria-hidden='true'></i></button></td><td style='text-align: center'><button type='button' class='btn btn-info btn-sm' title='Editar Certificado' onclick='editCertificado("+data[i].idCertificado+','+data[i].numeroCertificado+','+data[i].id_mae+")'><i class='fa fa-pencil' aria-hidden='true'></i></button></td></tr>";
            }
            $('#qtdrest').html(qtdmae - resta);
        }else{
            popula_ceaf = "<tr><td></td><td></td><td><h5 style='color: #555353'>Ainda não há desmembramento para esse certificado</h5></td><td></td><td></td></tr>"
            $('#qtdrest').html(qtdmae);
        }
        
        $('#tb-ceaf').html(popula_ceaf);
        $('#numCer').html(nc);
        $('#idc').html(idc);
        var totalRes = $('#qtdrest').text();
        
        if (totalRes == 0){
            $('#finalizar').css('display', 'block');
            $('#novo').css('display', 'none');
        }else{
            $('#novo').css('display', 'block');
            $('#finalizar').css('display', 'none');
        }
        $('#modalFilho').modal('show');
    });
}

function editCertificado(idce, nc, idmae){
    if (idmae == 0){
        window.location.href='cadcertificado/'+nc+'?idce='+idce+'&filho=false';
    }else{
        window.location.href='cadcertificado/'+nc+'?idce='+idce+'&idmae='+idmae+'&filho=true&edt=true';
    }
}

function popCertificadosAtivos(pag){
    var pag_atual = 0;
    if(!pag){
        pag_atual = 1;
    }else{
        pag_atual = pag;
    }
    var url_atual = window.location.origin;
    var popula_cea = '';
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
        url: url_atual + '/api/certificadosa?page='+pag_atual,
        dataType: 'json'
    }).done(function(data){
        for(i=0;i<data.data.length;i++){
            popula_cea = popula_cea + "<tr class='edit-certificado'><th style='display:none'>id</th><th scope='row'>"+data.data[i].numeroCertificado+"</th><td>"+data.data[i].qtd+"</td><td style='text-align: center'>"+data.data[i].fornecedor+"</td><td style='text-align: center'><button type='button' class='btn btn-secondary btn-sm'title='Desmembrar Certificado' onclick='desmembrar("+data.data[i].numeroCertificado+','+data.data[i].idCertificado+','+data.data[i].qtd+")'><i class='fa fa-files-o' aria-hidden='true'></i></button></td><td style='text-align: center'><button type='button' class='btn btn-success btn-sm'title='Imprimir Certificado' onclick=\"location.href='printcertificado/"+data.data[i].idCertificado+"'\"><i class='fa fa-print' aria-hidden='true'></i></button></td><td style='text-align: center'><button type='button' class='btn btn-info btn-sm' title='Editar Certificado' onclick='editCertificado("+data.data[i].idCertificado+','+data.data[i].numeroCertificado+','+data.data[i].id_mae+")'><i class='fa fa-pencil' aria-hidden='true'></i></button></td></tr>";
        }
        if(data.current_page == 1){
            pgan = 1;
            habAnterior = 'disabled';
        }else{
            pgan = parseInt(data.current_page) - 1;
            habAnterior = '';
        }
        anterior = "<li class='page-item page-link "+ habAnterior +" paginas' id='anterior' onclick='popCertificadosAtivos("+pgan+")'>Anterior</li>";

        for(i=0;i<parseInt(data.last_page);i++){
            if(data.links.label != "&laquo; Anterior" && data.links.label != "Próximo &raquo;"){
                item = item + 1;
		        itens =	itens + "<li class='page-item page-link paginas' onclick='popCertificadosAtivos("+item+")'>"+item+"</li>";
            }
            
        };
		
        if(data.current_page == data.last_page){
            pgpr = data.last_page;
            habProxima = 'disabled';
        }else{
            pgpr = parseInt(data.current_page) + 1;
            habProxima = '';
        }
        proxima = "<li class='page-item page-link "+habProxima+" paginas' id='proxima' onclick='popCertificadosAtivos("+pgpr+")'>Próximo</li>";

        $("#tb-cea").html(popula_cea).show();
        $("#paginacao").html(anterior+itens+proxima).show();
    });
}

function popCertificadosFinalizados(pag){
    var pag_atual = 0;
    if(!pag){
        pag_atual = 1;
    }else{
        pag_atual = pag;
    }
    var url_atual = window.location.origin;
    var popula_ei = '';
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
        url: url_atual + '/api/certificadosf?page='+pag_atual,
        dataType: 'json'
    }).done(function(data){
        for(i=0;i<data.data.length;i++){
            popula_ei = popula_ei + "<tr class='edit-certificado'><th style='display:none'>id</th><th scope='row'>"+data.data[i].numeroCertificado+"</th><td>"+data.data[i].qtd+"</td><td style='text-align: center'>"+data.data[i].fornecedor+"</td><td style='text-align: center'><button type='button' class='btn btn-secondary btn-sm'title='Desmembrar Certificado' onclick='desmembrar("+data.data[i].numeroCertificado+','+data.data[i].idCertificado+','+data.data[i].qtd+")'><i class='fa fa-files-o' aria-hidden='true'></i></button></td><td style='text-align: center'><button type='button' class='btn btn-success btn-sm'title='Imprimir Certificado' onclick=\"location.href='printcertificado/"+data.data[i].idCertificado+"'\"><i class='fa fa-print' aria-hidden='true'></i></button></td><td style='text-align: center'><button type='button' class='btn btn-info btn-sm' title='Editar Certificado' onclick='editCertificado("+data.data[i].idCertificado+','+data.data[i].numeroCertificado+','+data.data[i].id_mae+")'><i class='fa fa-pencil' aria-hidden='true'></i></button></td></tr>";
        }
        if(data.current_page == 1){
            pgan = 1;
            habAnterior = 'disabled';
        }else{
            pgan = parseInt(data.current_page) - 1;
            habAnterior = '';
        }
        anterior = "<li class='page-item page-link "+ habAnterior +" paginas' id='anterior' onclick='popCertificadosFinalizados("+pgan+")'>Anterior</li>";

        for(i=0;i<parseInt(data.last_page);i++){
            if(data.links.label != "&laquo; Anterior" && data.links.label != "Próximo &raquo;"){
                item = item + 1;
		        itens =	itens + "<li class='page-item page-link paginas' onclick='popCertificadosFinalizados("+item+")'>"+item+"</li>";
            }
            
        };
		
        if(data.current_page == data.last_page){
            pgpr = data.last_page;
            habProxima = 'disabled';
        }else{
            pgpr = parseInt(data.current_page) + 1;
            habProxima = '';
        }
        proxima = "<li class='page-item page-link "+habProxima+" paginas' id='proxima' onclick='popCertificadosFinalizados("+pgpr+")'>Próximo</li>";

        $("#tb-cef").html(popula_ei);
        $("#paginacaoi").html(anterior+itens+proxima);
    });
}

function pesquisaNome(){
    $('#carregaPesquisa').css('display', 'block');
    var url_atual = window.location.origin;
    var texto = $('#pesquisaNome').val();
    if (texto === ''){
        $('#carregaPesquisa').css('display', 'none');
        popCertificadosAtivos();
        return false;
    };
    var popula_ca = '';
    var status = '';
    $.ajax({
        type: 'GET',
        url: url_atual + '/api/pnc/'+texto,
        dataType: 'json'
    }).done(function(data){
        for(i=0;i<data.length;i++){
            popula_ca = popula_ca + "<tr class='edit-certificado'><th style='display:none'>id</th><th scope='row'>"+data[i].numeroCertificado+"</th><td>"+data[i].qtd+"</td><td style='text-align: center'>"+data[i].fornecedor+"</td><td style='text-align: center'><button type='button' class='btn btn-secondary btn-sm'title='Desmembrar Certificado' onclick='desmembrar("+data[i].numeroCertificado+','+data[i].idCertificado+','+data[i].qtd+")'><i class='fa fa-files-o' aria-hidden='true'></i></button></td><td style='text-align: center'><button type='button' class='btn btn-success btn-sm'title='Imprimir Certificado' onclick=\"location.href='printcertificado/"+data[i].idCertificado+"'\"><i class='fa fa-print' aria-hidden='true'></i></button></td><td style='text-align: center'><button type='button' class='btn btn-info btn-sm' title='Editar Certificado' onclick='editCertificado("+data[i].idCertificado+','+data[i].numeroCertificado+','+data[i].id_mae+")'><i class='fa fa-pencil' aria-hidden='true'></i></button></td></tr>";
        }
        if (popula_ca){
            $("#tb-cea").html(popula_ca);
        }else{
            popula_ca = "<tr><td>,</td><td><h5 style='color: #A9A9A9'>Nenhum registro encontrado!</h5></td>";
            $("#tb-cea").html(popula_ca);
        }
        $('#carregaPesquisa').css('display', 'none');
    });
}

function pesquisaNumero(){
    $('#carregaPesquisa').css('display', 'block');
    var url_atual = window.location.origin;
    var texto = $('#pesquisaNumero').val();
    if (texto === ''){
        $('#carregaPesquisa').css('display', 'none');
        popCertificadosAtivos();
        return false;
    };
    var popula_ea = '';
    var status = '';
    $.ajax({
        type: 'GET',
        url: url_atual + '/api/pnumero/'+texto,
        dataType: 'json'
    }).done(function(data){
        
        for(i=0;i<data.length;i++){
            popula_ea = popula_ea + "<tr class='edit-certificado'><th style='display:none'>id</th><th scope='row'>"+data[i].numeroCertificado+"</th><td>"+data[i].qtd+"</td><td style='text-align: center'>"+data[i].fornecedor+"</td><td style='text-align: center'><button type='button' class='btn btn-secondary btn-sm'title='Desmembrar Certificado' onclick='desmembrar("+data[i].numeroCertificado+','+data[i].idCertificado+','+data[i].qtd+")'><i class='fa fa-files-o' aria-hidden='true'></i></button></td><td style='text-align: center'><button type='button' class='btn btn-success btn-sm'title='Imprimir Certificado' onclick=\"location.href='printcertificado/"+data[i].idCertificado+"'\"><i class='fa fa-print' aria-hidden='true'></i></button></td><td style='text-align: center'><button type='button' class='btn btn-info btn-sm' title='Editar Certificado' onclick='editCertificado("+data[i].idCertificado+','+data[i].numeroCertificado+','+data[i].id_mae+")'><i class='fa fa-pencil' aria-hidden='true'></i></button></td></tr>";
        }
        if (popula_ea){
            $("#tb-cea").html(popula_ea);
        }else{
            popula_ea = "<tr><td>,</td><td><h5 style='color: #A9A9A9'>Nenhum registro encontrado!</h5></td>";
            $("#tb-cea").html(popula_ea);
        }
        
        $('#carregaPesquisa').css('display', 'none');
    });
}

function finalizar(){
    var id = $('#idc').text();
    var nc = $('#numCer').text();
    var url_atual = window.location.origin;
    let confirma = confirm("Tem certeza que deseja finalizar esse certificado");
    if(confirma){
        $.ajax({
            type: 'PUT',
            url: url_atual + '/api/cadcertificado/'+id+'/?flg_status=F',
            dataType: 'json'
        }).done(function(data){
           
        });
        
        $.ajax({
            type: 'GET',
            url: url_atual + '/api/lid/'+nc,
            dataType: 'json'
        }).done(function(idcom){
            let idCom = idcom[0].idComunicado;
            
            $.ajax({
                type: "PUT",
                url: url_atual +'/api/cadcomunicado/'+idCom+'/?status=F',
                timeout: 0,
            }).done(function(dados){
                alert("Certificado e Comunicado Finalizados");
                $('#modalFilho').modal('hide');
                popCertificadosAtivos();
            });
        });
        
            
    };
    
    
}

