$( document ).ready(function(){
    //POPULA IMPRESSÃO
    var url_atual = window.location.origin;
    let url = window.location.pathname;
    let parts = url.split('/');
    let id = parts.pop() || parts.pop();
    
    $.ajax({
        type: "GET",
        url: url_atual +'/api/editconsolidado/'+id,
        dataType: 'json',
        
    }).done(function(data) {
        var dados = data;
        let emissao = dados[0].dataEmissao;
        let emissaoAno = emissao.substring(0, 4);
        let emissaoMes = emissao.substring(5, 7);
        let emissaoDia = emissao.substring(8, 10);
        let dexp = dados[0].dataExpurgo;
        let expAno = dexp.substring(0, 4);
        let expMes = dexp.substring(5, 7);
        let expDia = dexp.substring(8, 10);
        let df = dados[0].dataTerminoExpurgo;
        let fimAno = df.substring(0, 4);
        let fimMes = df.substring(5, 7);
        let fimDia = df.substring(8, 10);
        let rem = dados[0].remetente.replace('§', '&');
        let dest = dados[0].destinatario.replace('§', '&');
        $('#ciclo').html(dados[0].ciclo);
        $('#numeroCertificado').html(dados[0].numeroConsolidado+'-'+dados[0].sequencia+'C');
        $('#numeroComunicado').html(dados[0].numeroComunicado);
        $('#lote').html(dados[0].lote);
        $('#origem').html(dados[0].origem);
        $('#destino').html(dados[0].destino); 
        $('#pesoBruto').html(dados[0].pesoBruto);
        $('#destino').html(dados[0].destino);
        $('#marcas').html(dados[0].marca);
        $('#qtdVolume').html(dados[0].qtdVolume);
        $('#numeroDosCtrs').html(dados[0].numeroDosCtrs);
        $('#natProduto').html(dados[0].qtd+' - '+dados[0].natProduto);
        $('#localTratamento').html(dados[0].estufa);
        $('#remetente').html(rem);
        $('#destinatario').html(dest);
        $('#navio').html(dados[0].navio);
        $('#modalidade').html(dados[0].produtoUtilizado);
        $('#tempTratamento').html(dados[0].tempTratamento);
        $('#dataExpurgo').html(expDia+'/'+expMes+'/'+expAno);
        $('#dataTerminoExpurgo').html(fimDia+'/'+fimMes+'/'+fimAno);
        $('#horaInicio').html(dados[0].horaInicio);
        $('#horaFim').html(dados[0].horaFim);
        $('#tempoExposicao').html(dados[0].tempoExposicao);
        $('#temperatura').html(dados[0].temperatura);
        $('#dataEmissao').html(emissaoDia+'/'+emissaoMes+'/'+emissaoAno);
        $('#invoice').html('INVOICE: '+dados[0].invoice);
        if(dados[0].observacoes == null || dados[0].observacoes == "" || dados[0].observacoes == 'null'){
            $('#obs').html('');
        }else{
            $('#obs').html(dados[0].observacoes);
        }
            
        let id_eng = dados[0].id_engenheiro;
        //ENGENHEIRO 
        $.ajax({
            type: "GET",
            url: url_atual +'/api/buscaengenheiro/'+id_eng,
            dataType: 'json',
        }).done(function(data) {
            $('#engenheiro').html(data[0].nome);
            $('#formacao').html(data[0].formacao);
            $('#crea').html('CREA: '+data[0].crea);
        });
        
    });
	
});

function imprimir(){
    $("#imprimir").css("display", "none");
    $("body").css("margin-left", 0);
    $("body").css("margin-right", 0);
	window.print();
    window.location='../certificado'
}