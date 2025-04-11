
//ABAS
url_atual = window.location.origin;

function abas(id){
    if (id == 1){
        if(!$('#ativos').hasClass('nav-link active')){
            $('#ativos').addClass('active');
            $('#finalizados').removeClass('active');
            if(!$('#tabAtivos').hasClass('tab-pane active')){
                $('#tabAtivos').addClass('active');
                $('#tabFinalizados').removeClass('active');
            }
        }
    }
    if (id == 2){
        if(!$('#finalizados').hasClass('nav-link active')){
            $('#finalizados').addClass('active');
            $('#ativos').removeClass('active');
            if(!$('#tabFinalizados').hasClass('tab-pane active')){
                $('#tabFinalizados').addClass('active');
                $('#tabAtivos').removeClass('active');
            }
        }
    }
}


function pFormulario(){
    $('#pMenu').html('Nº Formulário');
    $("#pesquisaFormulario").css("display", "block");
    $("#pesquisaCertificado").css("display", "none");
    $("#pesquisaCiclo").css("display", "none");
};
function pCertificado(){
    $('#pMenu').html('Nº Certificado');
    $("#pesquisaCertificado").css("display", "block");
    $("#pesquisaFormulario").css("display", "none");
    $("#pesquisaCiclo").css("display", "none");
};
function pCiclo(){
    $('#pMenu').html('Ciclo');
    $("#pesquisaCertificado").css("display", "none");
    $("#pesquisaFormulario").css("display", "none");
    $("#pesquisaCiclo").css("display", "block");
};

$(document).ready(function(pag){
    var pag_atual = 0;
    if(!pag){
        pag_atual = 1;
    }else{
        pag_atual = pag;
    }
   
    var popula_cc = '';
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
        url: url_atual + '/api/consolidadosa?page='+pag_atual,
        dataType: 'json'
    }).done(function(data){
        console.log(data.data);
        for(i=0;i<data.data.length;i++){
            let marcaUp = data.data[i].marca;
            
            popula_cc = popula_cc + "<tr class='edit-consolidado'><td scope='row'>"+data.data[i].numeroConsolidado+"</td><td>"+data.data[i].sequencia+"</td><td>"+data.data[i].ciclo+"</td><td style='text-align: center'>"+marcaUp.toUpperCase()+"</td><td style='text-align: center'><a type='button' class='btn btn-success btn-sm'title='Imprimir Consolidado' href='printconsolidado/"+data.data[i].idConsolidado+"' target='_blank'><i class='fa fa-print' aria-hidden='true'></i></a></td><td style='text-align: center'><button type='button' class='btn btn-info btn-sm' title='Editar Consolidado' onclick=\"location.href='editconsolidado/"+data.data[i].idConsolidado+"'\"><i class='fa fa-pencil' aria-hidden='true'></i></button></td><td style='text-align: center'><button type='button' class='btn btn-danger btn-sm' title='Excluir Consolidado' onclick='excluiConsolidado("+data.data[i].idConsolidado+")'><i class='fa fa-trash' aria-hidden='true'></i></button></td><td style='text-align: center'><div class='form-check form-switch'><input class='form-check-input' type='checkbox' id='finaliza_"+data.data[i].idConsolidado+"' onclick='status("+data.data[i].idConsolidado+")' checked></div></td></tr>";
            
        }
        if(data.current_page == 1){
            pgan = 1;
            habAnterior = 'disabled';
        }else{
            pgan = parseInt(data.current_page) - 1;
            habAnterior = '';
        }
        anterior = "<li class='page-item page-link "+ habAnterior +" paginas' id='anterior' onclick='popConsolidadosA("+pgan+")'>Anterior</li>";

        for(i=0;i<parseInt(data.last_page);i++){
            if(data.links.label != "&laquo; Anterior" && data.links.label != "Próximo &raquo;"){
                item = item + 1;
		        itens =	itens + "<li class='page-item page-link paginas' onclick='popConsolidadosA("+item+")'>"+item+"</li>";
            }
            
        };
		
        if(data.current_page == data.last_page){
            pgpr = data.last_page;
            habProxima = 'disabled';
        }else{
            pgpr = parseInt(data.current_page) + 1;
            habProxima = '';
        }
        proxima = "<li class='page-item page-link "+habProxima+" paginas' id='proxima' onclick='popConsolidadosA("+pgpr+")'>Próximo</li>";

        $("#tb-cc").html(popula_cc);
        $("#paginacao").html(anterior+itens+proxima);
    });
    popConsolidadosF();
    
});

function popConsolidadosA(pag){
    var pag_atual = 0;
    if(!pag){
        pag_atual = 1;
    }else{
        pag_atual = pag;
    }
    var url_atual = window.location.origin;
    var popula_cca = '';
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
        url: url_atual + '/api/consolidadosa?page='+pag_atual,
        dataType: 'json'
    }).done(function(data){
        for(i=0;i<data.data.length;i++){
            let marcaUp = data.data[i].marca;
            popula_cca = popula_cca + "<tr class='edit-consolidado'><td scope='row'>"+data.data[i].numeroConsolidado+"</td><td>"+data.data[i].sequencia+"</td><td>"+data.data[i].ciclo+"</td><td style='text-align: center'>"+marcaUp.toUpperCase()+"</td><td style='text-align: center'><a type='button' class='btn btn-success btn-sm'title='Imprimir Consolidado' href='printconsolidado/"+data.data[i].idConsolidado+"' target='_blank'><i class='fa fa-print' aria-hidden='true'></i></a></td><td style='text-align: center'><button type='button' class='btn btn-info btn-sm' title='Editar Consolidado' onclick=\"location.href='editconsolidado/"+data.data[i].idConsolidado+"'\"><i class='fa fa-pencil' aria-hidden='true'></i></button></td><td style='text-align: center'><button type='button' class='btn btn-danger btn-sm' title='Excluir Consolidado' onclick='excluiConsolidado("+data.data[i].idConsolidado+")'><i class='fa fa-trash' aria-hidden='true'></i></button></td><td style='text-align: center'><div class='form-check form-switch'><input class='form-check-input' type='checkbox' id='finaliza_"+data.data[i].idConsolidado+"' onclick='status("+data.data[i].idConsolidado+")' checked></div></td></tr>";
            
        }
        if(data.current_page == 1){
            pgan = 1;
            habAnterior = 'disabled';
        }else{
            pgan = parseInt(data.current_page) - 1;
            habAnterior = '';
        }
        anterior = "<li class='page-item page-link "+ habAnterior +" paginas' id='anterior' onclick='popConsolidadosA("+pgan+")'>Anterior</li>";

        for(i=0;i<parseInt(data.last_page);i++){
            if(data.links.label != "&laquo; Anterior" && data.links.label != "Próximo &raquo;"){
                item = item + 1;
		        itens =	itens + "<li class='page-item page-link paginas' onclick='popConsolidadosA("+item+")'>"+item+"</li>";
            }
            
        };
		
        if(data.current_page == data.last_page){
            pgpr = data.last_page;
            habProxima = 'disabled';
        }else{
            pgpr = parseInt(data.current_page) + 1;
            habProxima = '';
        }
        proxima = "<li class='page-item page-link "+habProxima+" paginas' id='proxima' onclick='popConsolidadosA("+pgpr+")'>Próximo</li>";

        $("#tb-cc").html(popula_cca);
        $("#paginacao").html(anterior+itens+proxima);
    });
    popConsolidadosF();
}

function popConsolidadosF(pag){
    var pag_atual = 0;
    if(!pag){
        pag_atual = 1;
    }else{
        pag_atual = pag;
    }
    var url_atual = window.location.origin;
    var popula_ccf = '';
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
        url: url_atual + '/api/consolidadosf?page='+pag_atual,
        dataType: 'json'
    }).done(function(data){
        for(i=0;i<data.data.length;i++){
            let marcaUp = data.data[i].marca;
            popula_ccf = popula_ccf + "<tr class='edit-consolidado'><td scope='row'>"+data.data[i].numeroConsolidado+"</td><td>"+data.data[i].sequencia+"</td><td>"+data.data[i].ciclo+"</td><td style='text-align: center'>"+marcaUp.toUpperCase()+"</td><td style='text-align: center'><button type='button' class='btn btn-success btn-sm'title='Imprimir Consolidado' onclick=\"location.href='printconsolidado/"+data.data[i].idConsolidado+"'\"><i class='fa fa-print' aria-hidden='true'></i></button></td><td style='text-align: center'><button type='button' class='btn btn-info btn-sm' title='Editar Consolidado' onclick=\"location.href='editconsolidado/"+data.data[i].idConsolidado+"'\"><i class='fa fa-pencil' aria-hidden='true'></i></button></td><td style='text-align: center'><button type='button' class='btn btn-danger btn-sm' title='Excluir Consolidado' onclick='excluiConsolidado("+data.data[i].idConsolidado+")'><i class='fa fa-trash' aria-hidden='true'></i></button></td><td style='text-align: center'><div class='form-check form-switch'><input class='form-check-input' type='checkbox' id='finaliza_"+data.data[i].idConsolidado+"' onclick='status("+data.data[i].idConsolidado+")'></div></td></tr>";
            
        }
        if(data.current_page == 1){
            pgan = 1;
            habAnterior = 'disabled';
        }else{
            pgan = parseInt(data.current_page) - 1;
            habAnterior = '';
        }
        anterior = "<li class='page-item page-link "+ habAnterior +" paginas' id='anterior' onclick='popConsolidadosF("+pgan+")'>Anterior</li>";

        for(i=0;i<parseInt(data.last_page);i++){
            if(data.links.label != "&laquo; Anterior" && data.links.label != "Próximo &raquo;"){
                item = item + 1;
		        itens =	itens + "<li class='page-item page-link paginas' onclick='popConsolidadosF("+item+")'>"+item+"</li>";
            }
            
        };
		
        if(data.current_page == data.last_page){
            pgpr = data.last_page;
            habProxima = 'disabled';
        }else{
            pgpr = parseInt(data.current_page) + 1;
            habProxima = '';
        }
        proxima = "<li class='page-item page-link "+habProxima+" paginas' id='proxima' onclick='popConsolidadosF("+pgpr+")'>Próximo</li>";

        $("#tb-ccf").html(popula_ccf);
        $("#paginacao").html(anterior+itens+proxima);
    });
}

function status(id){
    var resultado = confirm("Deseja mudar o status desse consolidado?");
    var url_atual = window.location.origin;
    var status = '';
    if (resultado == true) {
        $.ajax({
            type: 'GET',
            url: url_atual + '/api/cadconsolidado/'+id,
            dataType: 'json'
        }).done(function(data){
            if(data.flg_status == 'A'){
                status = 'F';
            }else{
                status = 'A';
            };
            $.ajax({
                type: 'PUT',
                url: url_atual + '/api/status/'+id+'/'+status,
                dataType: 'json'
            }).done(function(data){
                $('#pesquisaNome').val('');
                $('#pesquisaCNPJ').val('');
                popConsolidadosA();
            });
        }); 
    }else{
        let checkbox = $('#finaliza_'+id);
        if(checkbox.is(":checked")) {
            $('#finaliza_'+id).prop('checked', false);
        } else {
            $('#finaliza_'+id).prop('checked', true);
        }
    }
    
}

function excluiConsolidado(id){
	var url_atual = window.location.origin;
    if (confirm("Você deseja realmente excluir este item?")) {
        $.ajax({
            type: "DELETE",
            url: url_atual +'/api/cadconsolidado/'+id,
            timeout: 0,
        }).done(function(data) {
            alert("Registro excluído com sucesso!");
            popConsolidadosA();
        });
    }
}

function pesquisaFormulario(){
    $('#carregaPesquisa').css('display', 'block');
    var texto = $('#pesquisaFormulario').val();
    if (texto === ''){
        $('#carregaPesquisa').css('display', 'none');
        popConsolidadosA();
        return false;
    };
    var popula_cca = '';
    var status = '';
    let marcaUp = '';
    $.ajax({
        type: 'GET',
        url: url_atual + '/api/bpformulario/'+texto,
        dataType: 'json'
    }).done(function(data){
        for(i=0;i<data.length;i++){
            if(data[i].flg_status == 'A'){
                status = 'checked';
            }else{
                status = '';
            };
            marcaUp = data[i].marca;
            popula_cca = popula_cca + "<tr class='edit-consolidado'><td scope='row'>"+data[i].numeroConsolidado+"</td><td>"+data[i].sequencia+"</td><td>"+data[i].ciclo+"</td><td style='text-align: center'>"+marcaUp.toUpperCase()+"</td><td style='text-align: center'><a type='button' class='btn btn-success btn-sm'title='Imprimir Consolidado' href='printconsolidado/"+data[i].idConsolidado+"' target='_blank'><i class='fa fa-print' aria-hidden='true'></i></a></td><td style='text-align: center'><button type='button' class='btn btn-info btn-sm' title='Editar Consolidado' onclick=\"location.href='editconsolidado/"+data[i].idConsolidado+"'\"><i class='fa fa-pencil' aria-hidden='true'></i></button></td><td style='text-align: center'><button type='button' class='btn btn-danger btn-sm' title='Excluir Consolidado' onclick='excluiConsolidado("+data[i].idConsolidado+")'><i class='fa fa-trash' aria-hidden='true'></i></button></td><td style='text-align: center'><div class='form-check form-switch'><input class='form-check-input' type='checkbox' id='finaliza_"+data[i].idConsolidado+"' onclick='status("+data[i].idConsolidado+")'"+status+"></div></td></tr>";
        }
        if (popula_cca){
            $("#tb-cc").html(popula_cca);
        }else{
            popula_cca = "<tr><td>,</td><td><h5 style='color: #A9A9A9'>Nenhum registro encontrado!</h5></td>";
            $("#tb-cc").html(popula_cca);
        }
        
        $('#carregaPesquisa').css('display', 'none');
    });
}

function pesquisaCertificado(){
    $('#carregaPesquisa').css('display', 'block');
    var texto = $('#pesquisaCertificado').val();
    let pcert = texto.replace('/', '-');
    if (texto === ''){
        $('#carregaPesquisa').css('display', 'none');
        popConsolidadosA();
        return false;
    };
    var popula_cca = '';
    var status = '';
    let marcaUp = '';
    $.ajax({
        type: 'GET',
        url: url_atual + '/api/bpcertificado/'+pcert,
        dataType: 'json'
    }).done(function(data){
        for(i=0;i<data.length;i++){
            if(data[i].flg_status == 'A'){
                status = 'checked';
            }else{
                status = '';
            };
            marcaUp = data[i].marca;
            popula_cca = popula_cca + "<tr class='edit-consolidado'><td scope='row'>"+data[i].numeroConsolidado+"</td><td>"+data[i].sequencia+"</td><td>"+data[i].ciclo+"</td><td style='text-align: center'>"+marcaUp.toUpperCase()+"</td><td style='text-align: center'><a type='button' class='btn btn-success btn-sm'title='Imprimir Consolidado' href='printconsolidado/"+data[i].idConsolidado+"' target='_blank'><i class='fa fa-print' aria-hidden='true'></i></a></td><td style='text-align: center'><button type='button' class='btn btn-info btn-sm' title='Editar Consolidado' onclick=\"location.href='editconsolidado/"+data[i].idConsolidado+"'\"><i class='fa fa-pencil' aria-hidden='true'></i></button></td><td style='text-align: center'><button type='button' class='btn btn-danger btn-sm' title='Excluir Consolidado' onclick='excluiConsolidado("+data[i].idConsolidado+")'><i class='fa fa-trash' aria-hidden='true'></i></button></td><td style='text-align: center'><div class='form-check form-switch'><input class='form-check-input' type='checkbox' id='finaliza_"+data[i].idConsolidado+"' onclick='status("+data[i].idConsolidado+")'"+status+"></div></td></tr>";
        }
        if (popula_cca){
            $("#tb-cc").html(popula_cca);
        }else{
            popula_cca = "<tr><td>,</td><td><h5 style='color: #A9A9A9'>Nenhum registro encontrado!</h5></td>";
            $("#tb-cc").html(popula_cca);
        }
        
        $('#carregaPesquisa').css('display', 'none');
    });
}

function pesquisaCiclo(){
    $('#carregaPesquisa').css('display', 'block');
    var texto = $('#pesquisaCiclo').val();
    let pCiclo = texto.replace('/', '-');
    if (texto === ''){
        $('#carregaPesquisa').css('display', 'none');
        popConsolidadosA();
        return false;
    };
    var popula_cca = '';
    var status = '';
    let marcaUp = '';
    $.ajax({
        type: 'GET',
        url: url_atual + '/api/bpciclo/'+pCiclo,
        dataType: 'json'
    }).done(function(data){
        for(i=0;i<data.length;i++){
            if(data[i].flg_status == 'A'){
                status = 'checked';
            }else{
                status = '';
            };

            marcaUp = data[i].marca;
            popula_cca = popula_cca + "<tr class='edit-consolidado'><td scope='row'>"+data[i].numeroConsolidado+"</td><td>"+data[i].sequencia+"</td><td>"+data[i].ciclo+"</td><td style='text-align: center'>"+marcaUp.toUpperCase()+"</td><td style='text-align: center'><a type='button' class='btn btn-success btn-sm'title='Imprimir Consolidado' href='printconsolidado/"+data[i].idConsolidado+"' target='_blank'><i class='fa fa-print' aria-hidden='true'></i></a></td><td style='text-align: center'><button type='button' class='btn btn-info btn-sm' title='Editar Consolidado' onclick=\"location.href='editconsolidado/"+data[i].idConsolidado+"'\"><i class='fa fa-pencil' aria-hidden='true'></i></button></td><td style='text-align: center'><button type='button' class='btn btn-danger btn-sm' title='Excluir Consolidado' onclick='excluiConsolidado("+data[i].idConsolidado+")'><i class='fa fa-trash' aria-hidden='true'></i></button></td><td style='text-align: center'><div class='form-check form-switch'><input class='form-check-input' type='checkbox' id='finaliza_"+data[i].idConsolidado+"' onclick='status("+data[i].idConsolidado+")'"+status+"></div></td></tr>";
        }
        if (popula_cca){
            $("#tb-cc").html(popula_cca);
        }else{
            popula_cca = "<tr><td>,</td><td><h5 style='color: #A9A9A9'>Nenhum registro encontrado!</h5></td>";
            $("#tb-cc").html(popula_cca);
        }
        
        $('#carregaPesquisa').css('display', 'none');
    });
}
