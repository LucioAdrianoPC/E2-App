function carrega(){
    var url_atual = window.location.origin;
    var url_string = window.location.href;
    var url1 = new URL(url_string);
    var idce = url1.searchParams.get("idce");
    var filho = url1.searchParams.get("filho");
    var idMae = url1.searchParams.get("idmae");
    var edt = url1.searchParams.get("edt");
    var resta = url1.searchParams.get("resta");
    var idFor = 0;
    var idRem = 0;
    var idEst = 0;
    var op = '';
    let url = window.location.pathname;
    let parts = url.split('/');
    let id = parts.pop() || parts.pop();
    if(filho == 'true'){
        $('#numeroFilho').css('display', 'block');
        $('#numeroCertificado').css('display', 'none');
        $('#cert').html(id);
        $('#id_mae').val(idMae);
        if (!edt){
            $.ajax({
                type: "GET",
                url: url_atual +'/api/geranumerofilho/'+id,
                dataType: 'json',
            }).done(function(data) {
                $('#numeroFilho').val(data[0].numeroFilho + 1);
            });
        }
    }else{
        $('#numeroFilho').css('display', 'none');
        $('#numeroCertificado').css('display', 'block');
        $('#numeroFilho').val(0);
        $('#id_mae').val(0);
    }
    if(idce){
        op = 'editar';
        $("#idCertificado").val(idce);
    }else{
        op = 'novo';
        $("#idCertificado").val(0);
    }
    var popula_unidade = '';
    var popula_destinatario = '<option value="0">SELECIONE UMA EMPRESA</option>';
    var popula_remetente = '<option value="0">SELECIONE UMA EMPRESA</option>';
    var popula_estufa = '<option value="0">SELECIONE UMA EMPRESA</option>';
    var popula_empresa = '';
    var popula_reme_filho = '';
    var idEstufa = 0;
    var idReme = '0';
    if (op === 'novo'){
        setTimeout(() => {
            console.log(id);
            $.ajax({
                type: "GET",
                url: url_atual +'/api/geracertificado/'+id,
                dataType: 'json',
                
            }).done(function(data) {
                console.log(data);
                $('#idEngenheiro').val(data[0].id_engenheiro_2);
                $('#idComunicado').val(data[0].idComunicado);
                $('#numeroCertificado').val(data[0].numeroComunicado);
                $('#numeroComunicado').val(data[0].numeroComunicado);
                $('#pesoBruto').val(0);
                if (data[0].marcas != null){
                    $('#marcas').val(data[0].marcas);
                }
                if ($('#id_mae').val() == 0){
                    $('#qtdVolume').val(data[0].quantidade);
                    $('#dataExpurgo').val(data[0].dataInicio);
                    $('#dataTerminoExpurgo').val(data[0].dataInicio);
                    $('#tempTratamento').val(data[0].temperatura);
                    $('#horaInicio').val(data[0].horaInicio);
                    var hfim = data[0].horaInicio;
                    var hf = hfim.substr(0, 2);
                    var mf = hfim.substr(3, 2);
                    var dura = data[0].duracao.replace(/[^0-9]/g, '');
                    var res = parseInt(mf) + parseInt(dura);
                    var hora = parseInt(hf);
                    var minutos = 0;
                    var horas = 0;
                    if (res > 59){
                        while(res > 59){
                            res = res - 60;
                            hora = hora + 1;
                            if (res > 59){
                                hora = hora + 1;
                                res = res - 60;
                            }
                        }
                    }
                    
                    if(hora <= 9){
                        horas = '0' + hora;
                    }else{
                        horas = hora;
                    }

                    if(res <= 9){
                        minutos = '0' + res;
                    }else{
                        minutos = res;
                    }
                    $('#horaFim').val(horas + ':' + minutos);
                    $('#tempo').val(data[0].duracao);
                }else{
                    $('#qtdVolume').val(resta);
                    $.ajax({
                        type: "GET",
                        url: url_atual +'/api/popcertificado/'+$('#id_mae').val(),
                        dataType: 'json',
                    }).done(function(certFilho) {
                        $('#dataExpurgo').val(certFilho[0].dataExpurgo);
                        $('#dataTerminoExpurgo').val(certFilho[0].dataTerminoExpurgo);
                        $('#tempTratamento').val(certFilho[0].tempTratamento);
                        $('#horaInicio').val(certFilho[0].horaInicio);
                        $('#horaFim').val(certFilho[0].horaFim);
                        $('#tempo').val(certFilho[0].tempoExposicao);
                        $('#temperatura').val(certFilho[0].temperatura);
                    });
                }
                $('#numDescVolumes').val(data[0].numDescVolumes);
                $('#natProduto').val(data[0].numDescVolumes);
                if (data[0].modalidade == 'AR QUENTE FORÇADO'){
                    $('#modalidade').val(data[0].modalidade + ' / HIGH TEMPERATURE (HT)');
                }else{
                    $('#modalidade').val(data[0].modalidade);
                }
                
                nomeFor = data[0].localFumegacao;
                idFor = data[0].id_fornecedor;
                idRem = data[0].id_remetente;
                idEst = data[0].id_estufa;
                
            });
        }, 200);

        $.ajax({
            type: "GET",
            url: url_atual +'/api/unidade',
            dataType: 'json',
        }).done(function(data) {
            for(i=0;i<data.length ;i++){
                if (data[i].abreviacao == 'UN'){ 
                    popula_unidade = popula_unidade + "<option value='"+data[i].abreviacao+"' selected>" +data[i].abreviacao + "</option>";
                }else{
                    popula_unidade = popula_unidade + "<option value='"+data[i].abreviacao+"'>" +data[i].abreviacao + "</option>"; 
                }
            }
            $("#unidadeMedida").html(popula_unidade);
            
            if ($('#id_mae').val() == 0){
                $.ajax({
                    type: "GET",
                    url: url_atual +'/api/selecionaestufa',
                    dataType: 'json',
                }).done(function(dados_empresa) {
                    console.log(dados_empresa);
                    
                    for(i=0;i<dados_empresa.length ;i++){
                        if (dados_empresa[i].fornecedor == 'E2 SERVIÇOS LTDA'){
                            popula_remetente = popula_remetente + "<option value='"+dados_empresa[i].idFornecedor+"'selected>" +dados_empresa[i].fornecedor + "</option>";
                            $('#destino').val('PAPAGAIOS - MG');
                        }else{
                            popula_remetente = popula_remetente + "<option value='"+dados_empresa[i].idFornecedor+"' >" +dados_empresa[i].fornecedor + "</option>";
                        }

                        if (idFor == dados_empresa[i].idFornecedor){
                            popula_destinatario = popula_destinatario + "<option value='"+dados_empresa[i].idFornecedor+"' selected>" +dados_empresa[i].fornecedor + "</option>"; 
                            $('#origem').val(dados_empresa[i].nomeMunicipio+ ' - '+dados_empresa[i].ufMunicipio);
                        }else{
                            popula_destinatario = popula_destinatario + "<option value='"+dados_empresa[i].idFornecedor+"' >" +dados_empresa[i].fornecedor + "</option>";
                        }
                        
                        if (dados_empresa[i].idFornecedor == idEst){
                            popula_estufa = popula_estufa + "<option value='"+dados_empresa[i].idFornecedor+"' selected>" +dados_empresa[i].fornecedor + "</option>"; 
                            $('#localFumigacao').val(dados_empresa[i].nomeMunicipio+ ' - '+dados_empresa[i].ufMunicipio);
                        }else{
                            popula_estufa = popula_estufa + "<option value='"+dados_empresa[i].idFornecedor+"' >" +dados_empresa[i].fornecedor + "</option>";
                        }
                        
                    }
                    $("#destinatario").html(popula_destinatario);
                    $("#remetente").html(popula_remetente);
                    $("#local").html(popula_estufa);
            
                });
            }else{
                $.ajax({
                    type: "GET",
                    url: url_atual +'/api/selecionaestufa',
                    dataType: 'json',
                }).done(function(dados_estufa) {
                    for(i=0;i<dados_estufa.length ;i++){
                        if (idFor == dados_estufa[i].idFornecedor){
                            popula_remetente = popula_remetente + "<option value='"+dados_estufa[i].idFornecedor+"' selected>" +dados_estufa[i].fornecedor + "</option>"; 
                            $('#origem').val(dados_estufa[i].nomeMunicipio+ ' - '+dados_estufa[i].ufMunicipio);
                        }else{
                            popula_remetente = popula_remetente + "<option value='"+dados_estufa[i].idFornecedor+"' >" +dados_estufa[i].fornecedor + "</option>";
                        }
                        if (dados_estufa[i].idFornecedor == idEst){
                            popula_estufa = popula_estufa + "<option value='"+dados_estufa[i].idFornecedor+"' selected>" +dados_estufa[i].fornecedor + "</option>"; 
                            $('#localFumigacao').val(dados_estufa[i].nomeMunicipio+ ' - '+dados_estufa[i].ufMunicipio);
                        }else{
                            popula_estufa = popula_estufa + "<option value='"+dados_estufa[i].idFornecedor+"' >" +dados_estufa[i].fornecedor + "</option>";
                        }
                        
                    }
                    $("#destinatario").html(popula_destinatario);
                    $("#remetente").html(popula_remetente);
                    $("#local").html(popula_estufa);
            
                    let idCer = $('#id_mae').val();
                    $.ajax({
                        type: "GET",
                        url: url_atual +'/api/loteciclo/'+idCer,
                        dataType: 'json',
                    }).done(function(lote) {
                        $('#lote').val(lote[0].lote);
                        $('#ciclo').val(lote[0].ciclo);
                    });
                });
                $.ajax({
                    type: "GET",
                    url: url_atual +'/api/empresas',
                    dataType: 'json',
                }).done(function(data) {
                    var dados_empresa = data;
                    
                    for(i=0;i<dados_empresa.length ;i++){
                        if (idRem == dados_empresa[i].idEmpresa){
                            popula_destinatario = popula_destinatario + "<option value='"+dados_empresa[i].idEmpresa+"'selected>" +dados_empresa[i].empresa + "</option>";
                            $('#destino').val(dados_empresa[i].nomeMunicipio+ ' - '+dados_empresa[i].ufMunicipio);
                        }else{
                            popula_destinatario = popula_destinatario + "<option value='"+dados_empresa[i].idEmpresa+"'>" +dados_empresa[i].empresa + "</option>";
                        }

                        if (idEst == dados_empresa[i].id_estufa){
                            popula_remetente = popula_remetente + "<option value='"+dados_empresa[i].id_+"' selected>" +dados_empresa[i].nome + "</option>"; 
                            $('#origem').val(dados_empresa[i].nomeMunicipio+ ' - '+dados_empresa[i].ufMunicipio);
                        }else{
                            popula_remetente = popula_remetente + "<option value='"+dados_empresa[i].id_+"'>" +dados_empresa[i].nome + "</option>";
                        }
                        
                    }
                    $("#destinatario").html(popula_destinatario);
                    $("#remetente").html(popula_remetente);
                   
                });
            };
        });
    }else{
        setTimeout(() => {
            $.ajax({
                type: "GET",
                url: url_atual +'/api/popcertificado/'+idce,
                dataType: 'json',
                
            }).done(function(data) {
                let emissao = data[0].dataEmissao;
                let emissaoAno = emissao.substring(0, 4);
                let emissaoMes = emissao.substring(5, 7);
                let emissaoDia = emissao.substring(8, 10);
                let dexp = data[0].dataExpurgo;
                let expAno = dexp.substring(0, 4);
                let expMes = dexp.substring(5, 7);
                let expDia = dexp.substring(8, 10);
                let df = data[0].dataTerminoExpurgo;
                let fimAno = df.substring(0, 4);
                let fimMes = df.substring(5, 7);
                let fimDia = df.substring(8, 10);
                idEstufa = data[0].id_estufa;
                idReme = data[0].id_remetente;
                if ($('#id_mae').val() == 0){
                    $('#numeroCertificado').val(data[0].numeroCertificado);
                }else{
                    $('#numeroCertificado').val(data[0].numeroCertificado);
                    $('#cert').html(data[0].numeroCertificado + '/');
                    $('#numeroFilho').val(data[0].numeroFilho);
                }
                $('#numeroComunicado').val(data[0].numeroComunicado);
                $('#lote').val(data[0].lote);
                $('#ciclo').val(data[0].ciclo);
                $('#dataEmissao').val(emissaoAno+'-'+emissaoMes+'-'+emissaoDia);
                $('#unidadeMedida').html("<option value='"+data[0].id_unidade_medida+"' selected>" + data[0].id_unidade_medida + "</option>");
                $('#pesoBruto').val(data[0].pesoBruto);
                $('#origem').val(data[0].origem);
                $('#destino').val(data[0].destino);
                $('#marcas').val(data[0].marca);
                $('#qtdVolume').val(data[0].qtd);
                $('#numeroDosCtrs').val(data[0].numeroDosCtrs);
                $('#natProduto').val(data[0].natProduto);
                $('#navio').val(data[0].navio);
                $('#local').val();
                $('#localFumigacao').val('CARMO DE MINAS - MG');
                $('#modalidade').val(data[0].produtoUtilizado);
                $('#dataExpurgo').val(expAno+'-'+expMes+'-'+expDia);
                $('#dataTerminoExpurgo').val(fimAno+'-'+fimMes+'-'+fimDia);
                $('#tempTratamento').val(data[0].tempTratamento);
                $('#horaInicio').val(data[0].horaInicio);
                $('#horaFim').val(data[0].horaFim);
                $('#temperatura').val(data[0].temperatura);
                $('#tempo').val(data[0].tempoExposicao);
                $('#observacao').val(data[0].observacao);
                $('#idEngenheiro').val(data[0].id_engenheiro);
                
                let idDest = data[0].destinatario;
                let dest_edt = ''; 
                if (data[0].id_mae == 0){
                    $.ajax({
                        type: "GET",
                        url: url_atual +'/api/selecionaestufa',
                        dataType: 'json',
                    }).done(function(dados_estufa) {
                        for(i=0;i<dados_estufa.length ;i++){
                            
                            if (idDest == dados_estufa[i].idFornecedor){
                                dest_edt = dest_edt + "<option value='"+dados_estufa[i].idFornecedor+"' selected>" +dados_estufa[i].fornecedor + "</option>"; 
                            }else{
                                dest_edt = dest_edt + "<option value='"+dados_estufa[i].idFornecedor+"' >" +dados_estufa[i].fornecedor + "</option>";
                            }
                        }
                        $("#destinatario").html(dest_edt);
                    });
                }else{
                    $.ajax({
                        type: "GET",
                        url: url_atual +'/api/popdestinatario/'+ idDest,
                        dataType: 'json',
                    }).done(function(data) {
                        var dest = data;
                        $('#destinatario').html("<option value='"+dest[0].idEmpresa+"' selected>" + dest[0].empresa + "</option>");
                        $.ajax({
                            type: "GET",
                            url: url_atual +'/api/empresas',
                            dataType: 'json',
                        }).done(function(data) {
                            for(i=0;i<data.length ;i++){
                                popula_empresa = popula_empresa + "<option value='"+data[i].idEmpresa+"'>" +data[i].empresa+ "</option>";
                            }
                            $("#destinatario").append(popula_empresa);
                        });
                    });
                }
                

                $.ajax({
                    type: "GET",
                    url: url_atual +'/api/unidade',
                    dataType: 'json',
                }).done(function(data) {
                    var dadosUN = data;
                    for(i=0;i<dadosUN.length ;i++){
                        if (data[i].abreviacao == 'UN'){ 
                            popula_unidade = popula_unidade + "<option value='"+data[i].abreviacao+"' selected>" +data[i].abreviacao + "</option>";
                        }else{
                            popula_unidade = popula_unidade + "<option value='"+data[i].abreviacao+"'>" +data[i].abreviacao + "</option>"; 
                        }
                    }
                    $("#unidadeMedida").append(popula_unidade);
                    
                });

                $.ajax({
                    type: 'GET',
                    url: url_atual + '/api/selecionaestufa',
                    dataType: 'json'
                }).done(function(data){
                    var dadosEstufa = data;
                    var popula_estufa = '';
                    for(i=0;i<dadosEstufa.length ;i++){
                        if (idEstufa == dadosEstufa[i].idFornecedor){
                            popula_estufa = popula_estufa + "<option value='"+dadosEstufa[i].idFornecedor+"' selected>" +dadosEstufa[i].fornecedor + "</option>";
                            $('#localFumigacao').val(dadosEstufa[i].nomeMunicipio+' - '+dadosEstufa[i].ufMunicipio);
                        }else{
                            popula_estufa = popula_estufa + "<option value='"+dadosEstufa[i].idFornecedor+"'>" +dadosEstufa[i].fornecedor + "</option>";
                        }
                        if (idReme == dadosEstufa[i].idFornecedor){
                            popula_reme_filho = popula_reme_filho + "<option value='"+dadosEstufa[i].idFornecedor+"' selected>" +dadosEstufa[i].fornecedor + "</option>";
                            $('#localFumigacao').val(dadosEstufa[i].nomeMunicipio+' - '+dadosEstufa[i].ufMunicipio);
                        }else{
                            popula_reme_filho = popula_reme_filho + "<option value='"+dadosEstufa[i].idFornecedor+"'>" +dadosEstufa[i].fornecedor + "</option>";
                        }
                            
                    }
                    $("#local").html(popula_estufa);
                    $("#remetente").html(popula_reme_filho);
                    
                });

            });
        }, 200);
        
    }
}

function popDestino(){
    var url_atual = window.location.origin;
    var id = $('#destinatario').val();
    $.ajax({
        type: "GET",
        url: url_atual +'/api/destino/'+id,
        dataType: 'json',
    }).done(function(data) {
        $("#nomeDestinatario").val(data[0].empresa);
        $("#destino").val(data[0].nomeMunicipio + ' - ' + data[0].ufMunicipio);
    });
}

function popOrigem(){
    var url_atual = window.location.origin;
    var id = $('#remetente').val();
    $.ajax({
        type: "GET",
        url: url_atual +'/api/destino/'+id,
        dataType: 'json',
    }).done(function(data) {
        $("#nomeRemetente").val(data[0].empresa);
        $("#origem").val(data[0].nomeMunicipio + ' - ' + data[0].ufMunicipio);
    });
}

function popEstufa(){
    var url_atual = window.location.origin;
    var id = $('#local').val();
    $.ajax({
        type: "GET",
        url: url_atual +'/api/popfornecedor/'+id,
        dataType: 'json',
    }).done(function(data) {
        $("#localFumigacao").val(data[0].nomeMunicipio + ' - ' + data[0].ufMunicipio);
    });
}

function salvar(){
    var url_atual = window.location.origin;
    var id = $("#idCertificado").val();
    var param = "?numeroCertificado="+$('#numeroCertificado').val()+"&numeroFilho="+$('#numeroFilho').val()+"&numeroComunicado="+$('#numeroComunicado').val()+"&dataEmissao="+$('#dataEmissao').val()+"&pesoBruto="+$('#pesoBruto').val()+"&origem="+$('#origem').val()+"&destino="+$('#destino').val()+"&marca="+$('#marcas').val()+"&qtdVolume="+$('#qtdVolume').val()+"&numeroDosCtrs="+$('#numeroDosCtrs').val()+"&natProduto="+$('#natProduto').val()+"&qtd="+$('#qtdVolume').val()+"&destinatario="+$('#destinatario').val()+"&navio="+$('#navio').val()+"&produtoUtilizado="+$('#modalidade').val()+"&dataExpurgo="+$('#dataExpurgo').val()+"&dataTerminoExpurgo="+$('#dataTerminoExpurgo').val()+"&tempTratamento="+$('#tempTratamento').val()+"&tempoExposicao="+$('#tempo').val()+"&horaInicio="+$('#horaInicio').val()+"&horaFim="+$('#horaFim').val()+"&temperatura="+$('#temperatura').val()+"&observacoes="+$('#observacao').val()+"&frase=Only the wooden creates (Pallets) have been trated&flg_status=A&flg_type=M&flg_visivel=S&lote="+$('#lote').val()+"&ciclo="+$('#ciclo').val()+"&id_unidade_medida="+$('#unidadeMedida').val()+"&id_remetente="+$('#remetente').val()+"&id_estufa="+$('#local').val()+"&id_engenheiro="+$('#idEngenheiro').val()+"&id_mae="+$('#id_mae').val()+"&id_filhote=0";

    if (id == 0){
        $.ajax({
            type: "POST",
            url: url_atual +'/api/cadcertificado/'+param,
            timeout: 0,
        }).done(function(data) {
            if ($('#id_mae').val() == 0){
                var id_com = $('#idComunicado').val();
                $.ajax({
                    type: "PUT",
                    url: url_atual +'/api/cadcomunicado/'+id_com+'/?status=C',
                    timeout: 0,
                }).done(function(data) {
                    console.log(data);
                });
            }
            alert("Registro salvo com sucesso!");
            window.location='../certificado';
        });
    }else{
        $.ajax({
            type: "PUT",
            url: url_atual +'/api/cadcertificado/'+id+'/'+param,
            timeout: 0,
        }).done(function(data) {
            alert("Registro editado com sucesso!");
            window.location='../certificado'
        });
    }
}