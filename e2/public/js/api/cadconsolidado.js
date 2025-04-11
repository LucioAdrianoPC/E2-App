url_atual = window.location.origin;
sequencia = 0;
function carrega(){
    let url_atual = window.location.origin;
    let popula_remetente = '<option value="0">SELECIONE O REMETENTE</option>';
    $.ajax({
        type: 'GET',
        url: url_atual + '/api/popremetente',
        dataType: 'json'
    }).done(function(data){
        let dadosRemetente = data;
        for(i=0;i<dadosRemetente.length ;i++){
            popula_remetente = popula_remetente + "<option value='"+dadosRemetente[i].idEmpresa+"'>" +dadosRemetente[i].empresa + "</option>";
        }
        $("#remetente").append(popula_remetente);
        let cc = 0;
        $.ajax({
            type: "GET",
            url: url_atual +'/api/ctrlconsolidado',
            dataType: 'json',
        }).done(function(ctrl) {
            if(ctrl.length == 0){
                cc = 1;
            }else{
                cc = parseFloat(ctrl[0].ctrlConsolidado) + 1;
            }
            
            $('#ctrlConsolidado').val(cc);
        });
    });
}
function enderecoRemetente(){
    let id = $("#remetente").val();
    $.ajax({
        type: 'GET',
        url: url_atual + '/api/enderecoremetente/'+id,
        dataType: 'json'
    }).done(function(endReme){
        $("#enderecoRemetente").val(endReme[0].empresa+', '+endReme[0].endereco+', '+endReme[0].numero+' - '+endReme[0].bairro+' - '+endReme[0].nomeMunicipio+' - '+endReme[0].ufMunicipio+' - '+endReme[0].pais+' - CEP:'+endReme[0].cep)
    });
}
function popCertificados(){
    let ciclo = $('#ciclo').val();
    let pciclo = ciclo.replace('/', '-');
    let pop_cert = '';
    $.ajax({
        type: 'GET',
        url: url_atual + '/api/popcertificados/'+pciclo,
        dataType: 'json'
    }).done(function(endReme){
        for (i=0; i<endReme.length; i++){
            if(endReme[i].numeroFilho > 0){
                pop_cert = pop_cert + "<option value='"+endReme[i].idCertificado+"'>"+endReme[i].numeroCertificado+" - "+endReme[i].empresa+"</option>"
            }
        }
        $('#certificado').html(pop_cert);
        
    });

}

function adicionar(){
    if ($('#invoice').val() == ''){
        alert("O campo INVOICE deve ser preenchido!");
        $('#invoice').addClass('is-invalid');
        return false;
    }else{
        $('#invoice').removeClass('is-invalid');
    }
    if ($('#dataEmissao').val() == ''){
        alert("O campo DATA DE EMISSÃO deve ser preenchido!");
        $('#dataEmissao').addClass('is-invalid');
        return false;
    }else{
        $('#dataEmissao').removeClass('is-invalid');
    }
    if ($('#pesoBruto').val() == ''){
        alert("O campo PESO BRUTO deve ser preenchido!");
        $('#pesoBruto').addClass('is-invalid');
        return false;
    }else{
        $('#pesoBruto').removeClass('is-invalid');
    }
    if ($('#embarque').val() == ''){
        alert("O campo PORTO DE EMBARQUE deve ser preenchido!");
        $('#embarque').addClass('is-invalid');
        return false;
    }else{
        $('#embarque').removeClass('is-invalid');
    } 
    if ($('#desembarque').val() == ''){
        alert("O campo PORTO DE DESTINO deve ser preenchido!");
        $('#desembarque').addClass('is-invalid');
        return false;
    }else{
        $('#desembarque').removeClass('is-invalid');
    } 
    if ($('#marcas').val() == ''){
        alert("O campo MARCAS deve ser preenchido!");
        $('#marcas').addClass('is-invalid');
        return false;
    }else{
        $('#marcas').removeClass('is-invalid');
    }
    if ($('#qtdVolume').val() == ''){
        alert("O campo QUANTIDADE VOLUME deve ser preenchido!");
        $('#qtdVolume').addClass('is-invalid');
        return false;
    }else{
        $('#qtdVolume').removeClass('is-invalid');
    }    
    if ($('#numeroDosCtrs').val() == ''){
        alert("O campo NÚMERO DOS CONTÊINERES deve ser preenchido!");
        $('#numeroDosCtrs').addClass('is-invalid');
        return false;
    }else{
        $('#numeroDosCtrs').removeClass('is-invalid');
    } 
    if ($('#natProduto').val() == ''){
        alert("O campo NATUREZA DO PRODUTO deve ser preenchido!");
        $('#natProduto').addClass('is-invalid');
        return false;
    }else{
        $('#natProduto').removeClass('is-invalid');
    }   
    if ($('#enderecoRemetente').val() == ''){
        alert("O campo REMETENTE deve ser preenchido!");
        $('#enderecoRemetente').addClass('is-invalid');
        return false;
    }else{
        $('#endercoRemetente').removeClass('is-invalid');
    }   
    if ($('#enderecoDestinatario').val() == ''){
        alert("O campo DESTINATÁRIO deve ser preenchido!");
        $('#enderecoDestinatario').addClass('is-invalid');
        return false;
    }else{
        $('#enderecoDestinatario').removeClass('is-invalid');
    }    
    if ($('#transporte').val() == ''){
        alert("O campo MEIO DE TRANSPORTE deve ser preenchido!");
        $('#transporte').addClass('is-invalid');
        return false;
    }else{
        $('#transporte').removeClass('is-invalid');
    } 
    if ($('#qtd').val() == ''){
        alert("O campo QUANTIDADE deve ser preenchido!");
        $('#qtd').addClass('is-invalid');
        return false;
    }else{
        $('#qtd').removeClass('is-invalid');
    }   
       
    $('#carrega').css('display', 'block');
    let idCert = $('#certificado').val();
    $.ajax({
        type: 'GET',
        url: url_atual + '/api/popconsolidado/'+idCert,
        dataType: 'json'
    }).done(function(consolidado){
        var parametro = '';
        if(consolidado[0].numeroFilho == 0){
            parametro = consolidado[0].numeroCertificado;
        }else{
            parametro = consolidado[0].numeroCertificado+'-'+consolidado[0].numeroFilho;
        }
        $.ajax({
            type: 'GET',
            url: url_atual + '/api/nc/'+parametro,
            dataType: 'json'
        }).done(function(seq){ 
            if(seq.length == 0){
                sequencia = 1;
            }else{
                sequencia = seq[0].sequencia +1;
            }
            $('#sequencia').val(sequencia);
        });
        if (consolidado[0].numeroFilho == 0){
            numCom = consolidado[0].numeroCertificado;
        }else{
            numCom = consolidado[0].numeroCertificado+"/"+consolidado[0].numeroFilho;
        }
        setTimeout(() => {
        let destinatario = $('#enderecoDestinatario').val().replace('&', '§');
        let remetente = $('#enderecoRemetente').val().replace('&', '§');
        let param = "?numeroConsolidado="+numCom+"&invoice="+$('#invoice').val()+"&numeroComunicado="+consolidado[0].numeroComunicado+"&dataEmissao="+$('#dataEmissao').val()+"&pesoBruto="+$('#pesoBruto').val()+"&origem="+$('#embarque').val()+"&destino="+$('#desembarque').val()+"&marca="+$('#marcas').val()+"&qtdVolume="+$('#qtdVolume').val()+"&numeroDosCtrs="+$('#numeroDosCtrs').val()+"&natProduto="+$('#natProduto').val()+"&qtd="+$('#qtd').val()+"&destinatario="+destinatario+"&navio="+$('#transporte').val()+"&produtoUtilizado="+consolidado[0].produtoUtilizado+"&dataExpurgo="+consolidado[0].dataExpurgo+"&dataTerminoExpurgo="+consolidado[0].dataTerminoExpurgo+"&tempTratamento="+consolidado[0].tempTratamento+"&tempoExposicao="+consolidado[0].tempoExposicao+"&horaInicio="+consolidado[0].horaInicio+"&horaFim="+consolidado[0].horaFim+"&temperatura="+consolidado[0].temperatura+"&observacoes="+consolidado[0].observacoes+"&frase=Only the wooden creates (Pallets) have been trated&flg_status=A&flg_type=M&flg_visivel=S&lote="+consolidado[0].lote+"&ciclo="+consolidado[0].ciclo+"&remetente="+remetente+"&estufa="+consolidado[0].localTratamento+"&id_engenheiro="+consolidado[0].id_engenheiro+"&id_mae="+consolidado[0].id_mae+"&ctrlConsolidado="+$('#ctrlConsolidado').val()+"&sequencia="+$('#sequencia').val();
        
            $.ajax({
                type: "POST",
                url: url_atual +'/api/cadconsolidado/'+param,
                timeout: 0,
            }).done(function(grava) {
                lista();
            });
        },500);
    });
    
}
function lista(){
    let pop_consolidado = '';
    let ctc = $('#ctrlConsolidado').val()
    $.ajax({
        type: "GET",
        url: url_atual +'/api/adiciona/'+ctc,
        timeout: 0,
    }).done(function(popadicao) {
        for(i=0; i<popadicao.length; i++){
            pop_consolidado = pop_consolidado +"<tr><td style='text-align: center'>"+popadicao[i].ciclo+"</td><td>"+popadicao[i].numeroConsolidado+'-'+popadicao[i].sequencia+'C'+"</td><td style='text-align: center'>"+popadicao[i].qtd+"</td><td style='text-align: center'><a type='button' class='btn btn-success btn-sm' title='Imprimir Consolidado' href='../printconsolidado/"+popadicao[i].idConsolidado+"' target='_blank'><i class='fa fa-print' aria-hidden='true'></i></a></td><td style='text-align: center'><button type='button' class='btn btn-danger btn-sm' title='Excluir Consolidado' onclick='excluiConsolidado("+popadicao[i].idConsolidado+")'><i class='fa fa-trash' aria-hidden='true'></i></button></td></tr>";
        }
        $('#tb-ca').html(pop_consolidado);
    });
    $('#carrega').css('display', 'none');
}

function populaCadastro(){
    let ctc = $('#ctrlConsolidado').val()
    $.ajax({
        type: "GET",
        url: url_atual +'/api/populacadastro/'+ctc,
        timeout: 0,
    }).done(function(data) {
        $('#invoice').val(data[0].invoice);
        $('#dataEmissao').val(data[0].dataEmissao);
        $('#pesoBruto').val(data[0].pesoBruto);
        $('#embarque').val(data[0].origem);
        $('#desembarque').val(data[0].destino);
        $('#marcas').val(data[0].marca);
        $('#qtdVolume').val(data[0].qtdVolume);
        $('#numeroDosCtrs').val(data[0].numeroDosCtrs);
        $('#natProduto').val(data[0].natProduto);
        $('#enderecoRemetente').val(data[0].remetente);
        $('#enderecoDestinatario').val(data[0].destinatario);
        $('#transporte').val(data[0].navio);
        lista();
    });
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
            lista();
        });
    }
}
