$( document ).ready(function(){
    //POPULA IMPRESSÃO
    var url_atual = window.location.origin;
    let url = window.location.pathname;
    let parts = url.split('/');
    let id = parts.pop() || parts.pop();
    
    $.ajax({
        type: "GET",
        url: url_atual +'/api/printcertificado/'+id,
        dataType: 'json',
        
    }).done(function(data) {
        console.log(data);
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
        $('#ciclo').html(dados[0].ciclo);
        if (dados[0].numeroFilho){ 
            $('#numeroCertificado').html(dados[0].numeroCertificado+'/'+dados[0].numeroFilho);
        }else{
            $('#numeroCertificado').html(dados[0].numeroCertificado);
        }
        $('#numeroComunicado').html(dados[0].numeroComunicado);
        $('#lote').html(dados[0].lote);
        $('#origem').html(dados[0].origem);
        $('#destino').html(dados[0].destino); 
        $('#pesoBruto').html(dados[0].pesoBruto + ' ' + dados[0].id_unidade_medida);
        $('#destino').html(dados[0].destino);
        $('#marcas').html(dados[0].marca);
        $('#qtdVolume').html(dados[0].qtd+' - '+dados[0].natProduto);
        $('#numeroDosCtrs').html(dados[0].numeroDosCtrs);
        $('#natProduto').html(dados[0].qtd+' - '+dados[0].natProduto);
        $.ajax({
            type: "GET",
            url: url_atual +'/api/local/'+dados[0].numeroComunicado,
            dataType: 'json',
        }).done(function(local) {
            $('#localTratamento').html(local[0].localTratamento);
        });
        let idFor = dados[0].idFornecedor;
        let id_for = dados[0].destinatario;
        if (dados[0].id_mae == 0){
            $('#remetente').html('E2 SERVIÇOS LTDA, RUA GORGULHO, 926, CENTRO, CARMO DE MINAS/MG - BRASIL');
            $.ajax({
                type: "GET",
                url: url_atual +'/api/popestufa/'+id_for,
                dataType: 'json',
            }).done(function(destinatario) {
                $('#destinatario').html(destinatario[0].fornecedor + ' - ' + destinatario[0].endereco + ', '+destinatario[0].numero+' - '+destinatario[0].bairro+' - '+ destinatario[0].nomeMunicipio+'-'+destinatario[0].ufMunicipio+' - '+destinatario[0].pais);
            });
        }else{
            $.ajax({
                type: "GET",
                url: url_atual +'/api/popestufa/'+idFor,
                dataType: 'json',
            }).done(function(remetente) {
                
                $('#remetente').html(remetente[0].fornecedor + ' - ' + remetente[0].endereco + ', '+remetente[0].numero+' - '+remetente[0].bairro+' - '+ remetente[0].nomeMunicipio+'-'+remetente[0].ufMunicipio+' - '+remetente[0].pais);
            });
            $.ajax({
                type: "GET",
                url: url_atual +'/api/buscadestinatario/'+dados[0].destinatario,
                dataType: 'json',
            }).done(function(data) {
                $('#destinatario').html(data[0].empresa + ' - ' + data[0].endereco + ', '+data[0].numero+' - '+data[0].bairro+' - '+ data[0].nomeMunicipio+'-'+data[0].ufMunicipio+' - '+data[0].pais+ ' CONTATO: '+data[0].contato+ ' / '+ data[0].email+ ' TEL.:'+ data[0].telefone1 + ' CNPJ: '+ data[0].cnpj);
            });
        }

        
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