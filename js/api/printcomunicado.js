$( document ).ready(function(){
    //POPULA IMPRESSÃO
    var url_atual = window.location.origin;
    let url = window.location.pathname;
    let parts = url.split('/');
    let id = parts.pop() || parts.pop();
    
    $.ajax({
        type: "GET",
        url: url_atual +'/api/popcomunicado/'+id,
        dataType: 'json',
        
    }).done(function(data) {
        $('#numeroComunicado').html(data[0].numeroComunicado);
        $('#nomePrestador').html(data[0].nomePrestador);
        $('#cnpj').html(data[0].cnpj);
        $('#numCredenciamento').html(data[0].numCredenciamento); 
        $('#localTratamento').html(data[0].localTratamento);
        $('#destino').html(data[0].destino);
        if(data[0].tratadoDestruido == 'T'){
            $('#tratado').html('<i class="fa fa-check-square-o" aria-hidden="true"></i>');
            $('#destruido').html('<i class="fa fa-minus-square-o" aria-hidden="true"></i>');
            $('#tratado2').html('<i class="fa fa-check-square-o" aria-hidden="true"></i>');
            $('#destruido2').html('<i class="fa fa-minus-square-o" aria-hidden="true"></i>');
        }else{
            $('#tratado').html('<i class="fa fa-minus-square-o" aria-hidden="true"></i>');
            $('#destruido').html('<i class="fa fa-check-square-o" aria-hidden="true"></i>');
            $('#tratado2').html('<i class="fa fa-minus-square-o" aria-hidden="true"></i>');
            $('#destruido2').html('<i class="fa fa-check-square-o" aria-hidden="true"></i>');
        }
        let quant = parseInt(data[0].quantidade);
        $('#numDescVolumes').html(quant.toFixed(0)+' - '+data[0].numDescVolumes);
        $('#quantidade').html(quant.toFixed(0)+' - '+data[0].numDescVolumes);
        $('#marcas').html(data[0].marcas);
        $('#modalidade').html(data[0].modalidade);
        let dataProd = data[0].dataInicio;
        let dataAno = dataProd.substring(0, 4);
        let dataMes = dataProd.substring(5, 7);
        let dataDia = dataProd.substring(8, 10);
        $('#dataInicio').html(dataDia+'/'+dataMes+'/'+dataAno);
        $('#horaInicio').html(data[0].horaInicio);
        $('#duracao').html(data[0].duracao);
        $('#temperatura').html(data[0].temperatura);
        $('#agrotoxico').html(data[0].agrotoxico);
        $('#ingredienteAtivo').html(data[0].ingredienteAtivo);
        $('#dose').html(data[0].dose);
        $('#produtoComercial').html(data[0].prodComercial);
        $('#radiacao').html(data[0].radiacao);
        
        var id_pop_eng_1 = data[0].id_engenheiro_1;
        var id_pop_eng_2 = data[0].id_engenheiro_2;
        //FORNECEDOR 
        $('#nomeFornecedor').html(data[0].fornecedor);
        $('#cnpjFornecedor').html(data[0].cnpjfor);
        //ENGENHEIRO 1
        $.ajax({
            type: "GET",
            url: url_atual +'/api/buscaengenheiro/'+id_pop_eng_1,
            dataType: 'json',
        }).done(function(data) {
            $('#engenheiro_1').html(data[0].nome);
            $('#crea_1').html(data[0].crea);
        });
        //ENGENHEIRO 2
        $.ajax({
            type: "GET",
            url: url_atual +'/api/buscaengenheiro/'+id_pop_eng_2,
            dataType: 'json',
        }).done(function(data) {
            $('#engenheiro_2').html(data[0].nome);
            $('#crea_2').html(data[0].crea);
        });
    });
	
});

function imprimir(){
    $("#imprimir").css("display", "none");
    $("body").css("margin-left", 0);
    $("body").css("margin-right", 0);
	window.print();
    window.location='../comunicado'
}