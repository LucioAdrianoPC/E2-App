url_atual = window.location.origin;
function carrega(){
    let url = window.location.pathname;
    let parts = url.split('/');
    let id = parts.pop() || parts.pop();
    $.ajax({
        type: "GET",
        url: url_atual +'/api/editconsolidado/'+id,
        dataType: 'json',
    }).done(function(data) {
        $('#idConsolidado').val(data[0].idConsolidado);
        $('#numeroCertificado').val(data[0].numeroConsolidado);
        $('#numeroConsolidado').val(data[0].sequencia);
        $('#invoice').val(data[0].invoice);
        $('#qtd').val(data[0].qtd);
        $('#dataEmissao').val(data[0].dataEmissao);
        $('#pesoBruto').val(data[0].pesoBruto);
        $('#origem').val(data[0].origem);
        $('#destino').val(data[0].destino);
        $('#marcas').val(data[0].marca);
        $('#qtdVolume').val(data[0].qtdVolume);
        $('#numeroDosCtrs').val(data[0].numeroDosCtrs);
        $('#natProduto').val(data[0].natProduto);
        $('#remetente').val(data[0].remetente);
        $('#destinatario').val(data[0].destinatario);
        $('#navio').val(data[0].navio);
        $('#estufa').val(data[0].estufa);
        $('#modalidade').val(data[0].produtoUtilizado);
        $('#dataExpurgo').val(data[0].dataExpurgo);
        $('#dataTerminoExpurgo').val(data[0].dataTerminoExpurgo);
        $('#tempTratamento').val(data[0].tempTratamento);
        $('#temperatura').val(data[0].temperatura);
        $('#horaInicio').val(data[0].horaInicio);
        $('#horaFim').val(data[0].horaFim);
        $('#tempo').val(data[0].tempoExposicao);
        $('#observacao').val(data[0].observacoes);
    });
}

function editar(){
    let id = $('#idConsolidado').val();
    let param = "?invoice="+$('#invoice').val()+"&qtd="+$('#qtd').val()+"&dataEmissao="+$('#dataEmissao').val()+"&pesoBruto="+$('#pesoBruto').val()+"&origem="+$('#origem').val()+"&destino="+$('#destino').val()+"&marca="+$('#marcas').val()+"&qtdVolume="+$('#qtdVolume').val()+"&numeroDosCtrs="+$('#numeroDosCtrs').val()+"&natProduto="+$('#natProduto').val()+"&remetente="+$('#remetente').val()+"&destinatario="+$('#destinatario').val()+"&navio="+$('#navio').val()+"&estufa="+$('#estufa').val()+"&produtoUtilizado="+$('#modalidade').val()+"&dataExpurgo="+$('#dataExpurgo').val()+"&dataTerminoExpurgo="+$('#dataTerminoExpurgo').val()+"&tempTratamento="+$('#tempTratamento').val()+"&temperatura="+$('#temperatura').val()+"&horaInicio="+$('#horaInicio').val()+"&horaFim="+$('#horaFim').val()+"&tempoExposicao="+$('#tempo').val()+"&observacoes="+$('#observacao').val()+"&sequencia="+$('#numeroConsolidado').val();
    $.ajax({
        type: "PUT",
        url: url_atual +'/api/cadconsolidado/'+id+'/'+param,
        timeout: 0,
    }).done(function(data) {
        alert("Registro editado com sucesso!");
        window.location='../consolidado'
    });
}