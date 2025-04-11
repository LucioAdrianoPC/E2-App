function cnpjFornecedor(){
    var url_atual = window.location.origin;
    var id_for = $('#nomeFornecedor').val();
    
    $.ajax({
        type: 'GET',
        url: url_atual + '/api/popestufa/'+id_for,
        dataType: 'json'
    }).done(function(data){
        $('#cnpjFornecedor').val(data[0].cnpj);
        if (data[0].e2 == 0){
            $('#localTratamento').val(data[0].fornecedor+' / '+data[0].endereco+', '+data[0].numero+', '+data[0].bairro+', '+data[0].nomeMunicipio+' - '+data[0].ufMunicipio+' - '+data[0].cep+' / '+data[0].pais);
        }else{
            $.ajax({
                type: 'GET',
                url: url_atual + '/api/popestufa/'+data[0].e2,
                dataType: 'json'
            }).done(function(dados){
                $('#localTratamento').val(dados[0].fornecedor+' / '+dados[0].endereco+', '+dados[0].numero+', '+dados[0].bairro+', '+dados[0].nomeMunicipio+' - '+dados[0].ufMunicipio+' - '+dados[0].cep+' / '+dados[0].pais);
            }) 
        }
        
    });
    
}
// POPULA SELECTS
function carrega(){
    var url_atual = window.location.origin;
    var popula_engenheiro = '';
    var popula_estufa = "<option value='0'>SELECIONE UM TOMADOR DO SERVIÇO</option>";
    
    //ENGENHEIROS
    $.ajax({
        type: 'GET',
        url: url_atual + '/api/selecionaengenheiro',
        dataType: 'json'
    }).done(function(data){
        var dadosEngenheiro = data;
        for(i=0;i<dadosEngenheiro.length ;i++){
            popula_engenheiro = popula_engenheiro + "<option value='"+dadosEngenheiro[i].idEngenheiro+"'>" +dadosEngenheiro[i].nome + "</option>";
        }
        $("#engenheiro_1").html(popula_engenheiro);
        $("#engenheiro_2").html(popula_engenheiro);
        //ESTUFAS
        $.ajax({
            type: 'GET',
            url: url_atual + '/api/selecionaestufa',
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        }).done(function(data){
            console.log(data);
            var dadosEstufa = data;
            for(i=0;i<dadosEstufa.length ;i++){
                popula_estufa = popula_estufa + "<option value='"+dadosEstufa[i].idFornecedor+"'>" +dadosEstufa[i].fornecedor.toUpperCase() + "</option>";
            }
            $("#nomeFornecedor").html(popula_estufa);
        });
    });
    //POPULA CADASTRO
    let url = window.location.pathname;
    let parts = url.split('/');
    let id = parts.pop() || parts.pop();
    
    if (id > 0){
        setTimeout(() => {
            $.ajax({
                type: "GET",
                url: url_atual +'/api/popcomunicado/'+id,
                dataType: 'json',
            }).done(function(data) {
                $('#idComunicado').val(data[0].idComunicado);
                $('#numeroComunicado').val(data[0].numeroComunicado);
                //ESTUFAS
                var id_for = data[0].id_fornecedor;
                $.ajax({
                    type: 'GET',
                    url: url_atual + '/api/cadfornecedor/'+ id_for,
                    dataType: 'json'
                }).done(function(data){
                    console.log(data.idFornecedor, id_for);
                    var dadosEstufa = data;
                        popula_estufa = popula_estufa + "<option value='"+dadosEstufa.idFornecedor+"' selected>" +dadosEstufa.fornecedor + "</option>";
                        $('#cnpjFornecedor').val(dadosEstufa.cnpj);
                    
                    $("#nomeFornecedor").append(popula_estufa);
                });
                $('#localTratamento').val(data[0].localTratamento);
                $('#destino').val(data[0].destino);
                if(data[0].tratadoDestruido == 'T'){
                    $('#tratado').attr("checked", true);
                    $('#destruido').attr("checked", false);;
                }else if(data[0].tratadoDestruido == 'D'){
                    $('#tratado').attr("checked", false);;
                    $('#destruido').attr("checked", true);;
                }
                $('#numDescVolumes').val(data[0].numDescVolumes);
                $('#quantidade').val(data[0].quantidade);
                $('#marcas').val(data[0].marcas);
                $('#modalidade').val(data[0].modalidade);
                $('#dataInicio').val(data[0].dataInicio);
                $('#horaInicio').val(data[0].horaInicio);
                $('#duracao').val(data[0].duracao);
                $('#temperatura').val(data[0].temperatura);
                $('#agrotoxico').val(data[0].agrotoxico);
                $('#ingredienteAtivo').val(data[0].ingredienteAtivo);
                $('#dose').val(data[0].dose);
                $('#prodComercial').val(data[0].prodComercial);
                $('#radiacao').val(data[0].radiacao);
                
                var id_pop_eng_1 = data[0].id_engenheiro_1;
                var id_pop_eng_2 = data[0].id_engenheiro_2;
                
                //ENGENHEIRO 1
                $.ajax({
                    type: "GET",
                    url: url_atual +'/api/buscaengenheiro/'+id_pop_eng_1,
                    dataType: 'json',
                }).done(function(data) {
                    var pop_eng_1 = "<option value='"+data[0].idEngenheiro+"' selected>" +data[0].nome + "</option>";
                    $('#engenheiro_1').prepend(pop_eng_1);
                });
                //ENGENHEIRO 2
                $.ajax({
                    type: "GET",
                    url: url_atual +'/api/buscaengenheiro/'+id_pop_eng_2,
                    dataType: 'json',
                }).done(function(data) {
                    var pop_eng_2 = "<option value='"+data[0].idEngenheiro+"' selected>" +data[0].nome + "</option>";
                    $('#engenheiro_2').prepend(pop_eng_2);
                });
            });
            
        }, 200);
    }else{
        var nc = 0;
        $.ajax({
            type: "GET",
            url: url_atual +'/api/numerocomunicado',
            dataType: 'json',
        }).done(function(data) {
            if (data.length == 0){
                nc = 1;
            }else{
                nc = parseFloat(data[0].numeroComunicado) + 1;
            }
            $('#numeroComunicado').val(nc);
        });
    }
	
}

function estufas(){
    var url_atual = window.location.origin;
    var id_for = $('#nomeFornecedor').val();
    var popula_estufa = '';
    $.ajax({
        type: 'GET',
        url: url_atual + '/api/popestufa/'+ id_for,
        dataType: 'json'
    }).done(function(data){
        var dadosEstufa = data;
        popula_estufa = popula_estufa + "<option value='"+dadosEstufa[0].idFornecedor+"' selected>" +dadosEstufa[0].fornecedor + "</option>";
        $('#cnpjFornecedor').val(dadosEstufa[0].cnpj);
        $('#numCredenciamento').val(dadosEstufa[0].numCredenciamento);
        $('#localTratamento').val(dadosEstufa[0].fornecedor.toUpperCase() +' / '+ dadosEstufa[0].endereco.toUpperCase()+', ' +dadosEstufa[0].numero+', '+ dadosEstufa[0].bairro.toUpperCase()+', '+dadosEstufa[0].nomeMunicipio.toUpperCase()+' - '+dadosEstufa[0].ufMunicipio.toUpperCase()+' - '+ dadosEstufa[0].cep+' / BRASIL');
    });
}
function salvar(){
    var url_atual = window.location.origin;
    var id = $("#idComunicado").val();
    if($("#tratado").is(':checked')){
        var td = 'T';
    } else {
        var td = 'D';
    }

    var param = "?numeroComunicado="+$('#numeroComunicado').val()+"&id_estufa="+$('#nomeFornecedor').val()+"&nomePrestador="+$("#nomePrestador").val()+"&cnpf="+$('#cnpj').val()+"&numCredenciamento="+$('#numCredenciamento').val()+"&id_fornecedor="+$('#nomeFornecedor').val()+"&localTratamento="+$('#localTratamento').val()+"&destino="+$('#destino').val()+"&tratadoDestruido="+td+"&numDescVolumes="+$('#numDescVolumes').val()+"&quantidade="+$('#quantidade').val()+"&marcas="+$('#marcas').val()+"&modalidade="+$('#modalidade').val()+"&dataInicio="+$('#dataInicio').val()+"&horaInicio="+$('#horaInicio').val()+"&duracao="+$('#duracao').val()+"&temperatura="+$('#temperatura').val()+"&agrotoxico="+$('#agrotoxico').val()+"&ingredienteAtivo="+$('#ingredienteAtivo').val()+"&dose="+$('#dose').val()+"&prodComercial="+$('#prodComercial').val()+"&radiacao="+$('#radiacao').val()+"&id_engenheiro_1="+$('#engenheiro_1').val()+"&id_engenheiro_2="+$('#engenheiro_2').val()+"&status=A";

    if (id == 0){
        
        $.ajax({
            type: "POST",
            url: url_atual +'/api/cadcomunicado/'+param,
            timeout: 0,
        }).done(function(data) {
            alert("Registro salvo com sucesso!");
            window.location='../comunicado'
        });
    }else{
        $.ajax({
            type: "PUT",
            url: url_atual +'/api/cadcomunicado/'+id+'/'+param,
            timeout: 0,
        }).done(function(data) {
            alert("Registro editado com sucesso!");
            window.location='../comunicado'
        });
    }
}