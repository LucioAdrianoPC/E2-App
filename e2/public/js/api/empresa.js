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


function pNome(){
    $('#pMenu').html('Nome');
    $("#pesquisaNome").css("display", "block");
    $("#pesquisaCNPJ").css("display", "none");
};
function pCNPJ(){
    $('#pMenu').html('CNPJ');
    $("#pesquisaCNPJ").css("display", "block");
    $("#pesquisaNome").css("display", "none");
};
$(document).ready(function(){	
    $("#pesquisaCNPJ").mask("99.999.999/9999-99");
});

function popEmpresasAtivas(pag){
    var pag_atual = 0;
    if(!pag){
        pag_atual = 1;
    }else{
        pag_atual = pag;
    }
    var url_atual = window.location.origin;
    var popula_ea = '';
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
        url: url_atual + '/api/empresasativas?page='+pag_atual,
        dataType: 'json'
    }).done(function(data){
        for(i=0;i<data.data.length;i++){
            popula_ea = popula_ea + "<tr class='edit-empresa'><th scope='row' onclick=\"location.href='cadempresa/"+data.data[i].idEmpresa+"'\">"+data.data[i].idEmpresa+"</th><td  onclick=\"location.href='cadempresa/"+data.data[i].idEmpresa+"'\">"+data.data[i].empresa+"</td><td  onclick=\"location.href='cadempresa/"+data.data[i].idEmpresa+"'\">"+data.data[i].cnpj+"</td><td style='text-align: center'><div class='form-check form-switch'><input class='form-check-input' type='checkbox' id='empresaAtiva_"+data.data[i].idEmpresa+"' onclick='ativaInativa("+data.data[i].idEmpresa+")' checked></div></td></tr>";
        }
        if(data.current_page == 1){
            pgan = 1;
            habAnterior = 'disabled';
        }else{
            pgan = parseInt(data.current_page) - 1;
            habAnterior = '';
        }
        anterior = "<li class='page-item page-link "+ habAnterior +" paginas' id='anterior' onclick='popEmpresasAtivas("+pgan+")'>Anterior</li>";

        for(i=0;i<parseInt(data.last_page);i++){
            if(data.links.label != "&laquo; Anterior" && data.links.label != "Próximo &raquo;"){
                item = item + 1;
		        itens =	itens + "<li class='page-item page-link paginas' onclick='popEmpresasAtivas("+item+")'>"+item+"</li>";
            }
            
        };
		
        if(data.current_page == data.last_page){
            pgpr = data.last_page;
            habProxima = 'disabled';
        }else{
            pgpr = parseInt(data.current_page) + 1;
            habProxima = '';
        }
        proxima = "<li class='page-item page-link "+habProxima+" paginas' id='proxima' onclick='popEmpresasAtivas("+pgpr+")'>Próximo</li>";

        $("#tb-ea").html(popula_ea).show();
        $("#paginacao").html(anterior+itens+proxima).show();
    });
    popEmpresasInativas();
}

function popEmpresasInativas(pag){
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
        url: url_atual + '/api/empresasinativas?page='+pag_atual,
        dataType: 'json'
    }).done(function(data){
        for(i=0;i<data.data.length;i++){
            popula_ei = popula_ei + "<tr class='edit-empresa'><th scope='row' onclick=\"location.href='cadempresa/"+data.data[i].idEmpresa+"'\">"+data.data[i].idEmpresa+"</th><td  onclick=\"location.href='cadempresa/"+data.data[i].idEmpresa+"'\">"+data.data[i].empresa+"</td><td  onclick=\"location.href='cadempresa/"+data.data[i].idEmpresa+"'\">"+data.data[i].cnpj+"</td><td style='text-align: center'><div class='form-check form-switch'><input class='form-check-input' type='checkbox' id='empresaAtiva_"+data.data[i].idEmpresa+"'  onclick='ativaInativa("+data.data[i].idEmpresa+")'></div></td></tr>";
        }
        if(data.current_page == 1){
            pgan = 1;
            habAnterior = 'disabled';
        }else{
            pgan = parseInt(data.current_page) - 1;
            habAnterior = '';
        }
        anterior = "<li class='page-item page-link "+ habAnterior +" paginas' id='anterior' onclick='popEmpresasInativas("+pgan+")'>Anterior</li>";

        for(i=0;i<parseInt(data.last_page);i++){
            if(data.links.label != "&laquo; Anterior" && data.links.label != "Próximo &raquo;"){
                item = item + 1;
		        itens =	itens + "<li class='page-item page-link paginas' onclick='popEmpresasInativas("+item+")'>"+item+"</li>";
            }
            
        };
		
        if(data.current_page == data.last_page){
            pgpr = data.last_page;
            habProxima = 'disabled';
        }else{
            pgpr = parseInt(data.current_page) + 1;
            habProxima = '';
        }
        proxima = "<li class='page-item page-link "+habProxima+" paginas' id='proxima' onclick='popEmpresasInativas("+pgpr+")'>Próximo</li>";

        $("#tb-ei").html(popula_ei).show();
        $("#paginacaoi").html(anterior+itens+proxima).show();
    });
}

function pesquisaNome(){
    $('#carregaPesquisa').css('display', 'block');
    var url_atual = window.location.origin;
    var texto = $('#pesquisaNome').val();
    if (texto === ''){
        $('#carregaPesquisa').css('display', 'none');
        popEmpresasAtivas();
        return false;
    };
    var popula_ea = '';
    var status = '';
    $.ajax({
        type: 'GET',
        url: url_atual + '/api/pnome/'+texto,
        dataType: 'json'
    }).done(function(data){
        for(i=0;i<data.length;i++){
            if(data[i].flg_status == 'A'){
                status = 'checked';
            }else{
                status = '';
            };
            popula_ea = popula_ea + "<tr class='edit-empresa'><th scope='row' onclick=\"location.href='cadempresa/"+data[i].idEmpresa+"'\">"+data[i].idEmpresa+"</th><td  onclick=\"location.href='cadempresa/"+data[i].idEmpresa+"'\">"+data[i].empresa+"</td><td  onclick=\"location.href='cadempresa/"+data[i].idEmpresa+"'\">"+data[i].cnpj+"</td><td style='text-align: center'><div class='form-check form-switch'><input class='form-check-input' type='checkbox' id='empresaAtiva_"+data[i].idEmpresa+"'  onclick='ativaInativa("+data[i].idEmpresa+")' "+status+"></div></td></tr>";
        }
        if (popula_ea){
            $("#tb-ea").html(popula_ea).show();
        }else{
            popula_ea = "<tr><td>,</td><td><h5 style='color: #A9A9A9'>Nenhum registro encontrado!</h5></td>";
            $("#tb-ea").html(popula_ea).show();
        }
        $('#carregaPesquisa').css('display', 'none');
    });
}

function pesquisaCNPJ(){
    $('#carregaPesquisa').css('display', 'block');
    var url_atual = window.location.origin;
    var texto = $('#pesquisaCNPJ').val();
    if (texto === ''){
        $('#carregaPesquisa').css('display', 'none');
        popEmpresasAtivas();
        return false;
    };
    var popula_ea = '';
    var status = '';
    $.ajax({
        type: 'GET',
        url: url_atual + '/api/pcnpj/'+texto,
        dataType: 'json'
    }).done(function(data){
        for(i=0;i<data.length;i++){
            if(data[i].flg_status == 'A'){
                status = 'checked';
            }else{
                status = '';
            };
            popula_ea = popula_ea + "<tr class='edit-empresa'><th scope='row' onclick=\"location.href='cadempresa/"+data[i].idEmpresa+"'\">"+data[i].idEmpresa+"</th><td  onclick=\"location.href='cadempresa/"+data[i].idEmpresa+"'\">"+data[i].empresa+"</td><td  onclick=\"location.href='cadempresa/"+data[i].idEmpresa+"'\">"+data[i].cnpj+"</td><td style='text-align: center'><div class='form-check form-switch'><input class='form-check-input' type='checkbox' id='empresaAtiva_"+data[i].idEmpresa+"'  onclick='ativaInativa("+data[i].idEmpresa+")' "+status+"></div></td></tr>";
        }
        if (popula_ea){
            $("#tb-ea").html(popula_ea).show();
        }else{
            popula_ea = "<tr><td>,</td><td><h5 style='color: #A9A9A9'>Nenhum registro encontrado!</h5></td>";
            $("#tb-ea").html(popula_ea).show();
        }
        
        $('#carregaPesquisa').css('display', 'none');
    });
}

function ativaInativa(id){
    var resultado = confirm("Deseja alterar o status da empresa?");
    var url_atual = window.location.origin;
    var status = '';
    if (resultado == true) {
        $.ajax({
            type: 'GET',
            url: url_atual + '/api/cadempresas/'+id,
            dataType: 'json'
        }).done(function(data){
            if(data.flg_status == 'A'){
                status = 'I';
            }else{
                status = 'A';
            };
            $.ajax({
                type: 'PUT',
                url: url_atual + '/api/ai/'+id+'/'+status,
                dataType: 'json'
            }).done(function(data){
                $('#pesquisaNome').val('');
                $('#pesquisaCNPJ').val('');
                popEmpresasAtivas();
            });
        }); 
    }else{
        let checkbox = $('#empresaAtiva_'+id);
        if(checkbox.is(":checked")) {
            $('#empresaAtiva_'+id).prop('checked', false);
        } else {
            $('#empresaAtiva_'+id).prop('checked', true);
        }
    }
    
}