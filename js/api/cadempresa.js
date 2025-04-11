//const { head } = require("lodash");

//MASCARAS DE ENTRADA
$(document).ready(function(){	
    $("#cnpj").mask("99.999.999/9999-99");
});

$(document).ready(function(){	
    $('#cep').mask('99999-999');
});

$(document).ready(function(){	
    $('#telefone1').mask('(99)99999-9999');
});

$(document).ready(function(){	
    $('#telefone2').mask('(99)99999-9999');
});

$(document).ready(function(){	
    $('#valor').mask('000.000,00', {reverse: true});
});

//PEGA ALTERAÇÃO SELECT
window.addEventListener("DOMContentLoaded", (event) => {
    var url_atual = window.location.origin;
    const estado = document.getElementById("estado");
    estado.addEventListener("change", function() {
        var param = estado.value;
        var popula_municipio = '';
        $.ajax({
            type: 'GET',
            url: url_atual + '/api/municipios/'+ param,
            dataType: 'json'
        }).done(function(data){
            for(i=0;i<data.length ;i++){
                popula_municipio = popula_municipio + "<option value='"+data[i].idMunicipio+"'>" +data[i].nomeMunicipio + "</option>";
            }

            $("#municipio").html(popula_municipio).show();
        })
    });
});
// POPULA SELECTS
function carrega(){
    var url_atual = window.location.origin;
    var popula_estado = '';
    var popula_engenheiro = '';
    var popula_fechamento = '';
    //ESTADOS
    $.ajax({
        type: 'GET',
        url: url_atual + '/api/estados',
        dataType: 'json'
    }).done(function(data){
        var dadosEstados = data;
        for(i=0;i<data.length ;i++){
            popula_estado = popula_estado + "<option value='"+dadosEstados[i].idEstado+"'>" +dadosEstados[i].uf + "</option>";
        }
        $("#estado").html(popula_estado).show();
        //ENGENHEIROS
        $.ajax({
            type: 'GET',
            url: url_atual + '/api/cadengenheiros',
            dataType: 'json'
        }).done(function(data){
            var dadosEngenheiro = data;
            for(i=0;i<dadosEngenheiro.length ;i++){
                popula_engenheiro = popula_engenheiro + "<option value='"+dadosEngenheiro[i].idEngenheiro+"'>" +dadosEngenheiro[i].nome + "</option>";
            }
            $("#engenheiro").html(popula_engenheiro).show();
            //FECHAMENTO
            $.ajax({
                type: 'GET',
                url: url_atual + '/api/cadunidademedida',
                dataType: 'json'
            }).done(function(data){
                var dadosUM = data;
                for(i=0;i<dadosUM.length ;i++){
                    popula_fechamento = popula_fechamento + "<option value='"+dadosUM[i].idUnidadeMedida+"'>" +dadosUM[i].descricao + "</option>";
                }
                $("#flg_fechamento").html(popula_fechamento).show();
                
            });
        });
    });
    let url = window.location.pathname;
    let parts = url.split('/');
    let id = parts.pop() || parts.pop();
    
    if (id > 0){
        setTimeout(() => {
            $.ajax({
                type: "GET",
                url: url_atual +'/api/popempresa/'+id,
                dataType: 'json',
                
            }).done(function(data) {
                const valorUS = data[0].valor;
                if (valorUS){
                    const valorBR = valorUS.toString().replace(/\./g, ",");
                    $('#valor').val(valorBR);
                }

                $('#idEmpresa').val(data[0].idEmpresa);
                $('#empresa').val(data[0].empresa);
                $('#cnpj').val(data[0].cnpj);
                $('#ie').val(data[0].ie);
                $('#endereco').val(data[0].endereco); 
                $('#numero').val(data[0].numero);
                $('#bairro').val(data[0].bairro);
                $('#cep').val(data[0].cep);
                $('#estado').prepend("<option value='"+data[0].id_estado+"' selected>" +data[0].ufMunicipio + "</option>");
                $('#municipio').prepend("<option value='"+data[0].id_municipio+"' selected>" +data[0].nomeMunicipio + "</option>");
                $('#pais').val(data[0].pais);
                $('#telefone1').val(data[0].telefone1);
                $('#telefone2').val(data[0].telefone2);
                $('#email').val(data[0].email);
                $('#contato').val(data[0].contato);
                $('#observacao').val(data[0].observacao);
                $('#flg_fechamento').prepend("<option value='0' selected>Não Cadastrado</option>"); 
                
                //'engenheiro_id'
            
            });
        }, 200);
    }else{
        $('#idEmpresa').val('0');
    }
	
}

function existeCNPJ(){
    var url_atual = window.location.origin;
    var texto = $('#cnpj').val();
    texto = texto.replace('/', '_');

    $.ajax({
        type: 'GET',
        url: url_atual + '/api/existecnpj/'+texto,
        dataType: 'json'
    }).done(function(data){
        if (data.length > 0){
            alert("O CNPJ já existe!");
            window.location = "../cadempresa/"+data[0].idEmpresa;
        }else{
            autopre();
        }
    })
}

function autopre(){
    var url_atual = window.location.origin;
    var texto = $('#cnpj').val();
    var noMunic = '';
    texto = texto.replace(/[\.\/\-]/g, '');
    $.ajax({
        type: 'GET',
        url: 'https://receitaws.com.br/v1/cnpj/'+texto,
        headers: {
            'Access-Control-Allow-Origin': '*',
            'Content-Type':'application/json'
        },
        dataType: 'jsonp',
    }).done(function(data){
        console.log(data);
        $('#empresa').val(data.nome);
        $('#endereco').val(data.logradouro); 
        $('#numero').val(data.numero+ ' ' +data.complemento);
        $('#bairro').val(data.bairro);
        $('#cep').val(data.cep);
        $('#pais').val('BRASIL');
        $('#telefone1').val(data.telefone);
        $('#email').val(data.email);
        noMunic = data.municipio;
        $.ajax({
            type: 'GET',
            url: url_atual + '/api/municipioauto/'+noMunic,
            dataType: 'json'
        }).done(function(municipio){
            $('#estado').prepend("<option value='"+municipio[0].id_estado+"' selected>" +municipio[0].ufMunicipio + "</option>");
            $('#municipio').prepend("<option value='"+municipio[0].idMunicipio+"' selected>" +municipio[0].nomeMunicipio + "</option>");
        })
    })
}

function salvar(){
    var url_atual = window.location.origin;
    var id = $("#idEmpresa").val();
    var obs = $('#observacao').val();

    var valorBR = $('#valor').val();
    var valor = valorBR.replace(/\./g, "").replace(/,/g, ".");
    var txt = obs.replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '<br/>');
    var param_comp = '';
        
    var param = "empresa="+$('#empresa').val()+"&cnpj="+$('#cnpj').val()+"&ie="+$('#ie').val()+"&endereco="+$('#endereco').val()+"&numero="+$('#numero').val()+"&bairro="+$('#bairro').val()+"&cep="+$('#cep').val()+"&pais=BRASIL&telefone1="+$('#telefone1').val()+"&telefone2="+$('#telefone2').val()+"&email="+$('#email').val()+"&valor="+valor+"&contato="+$('#contato').val()+"&observacao="+txt+"&flg_status=A&flg_fechamento="+$('#flg_fechamento').val()+"&id_municipio="+$('#municipio').val()+"&engenheiro_id="+$('#engenheiro').val();
    if (id == 0){
        param_comp = "?"+param;
        $.ajax({
            type: "POST",
            url: url_atual +'/api/cadempresas/'+param_comp,
            timeout: 0,
        }).done(function(data) {
            alert("Registro salvo com sucesso!");
            window.location='../empresa'
        });
    }else{
        param_comp = id+"?"+param;
        $.ajax({
            type: "PUT",
            url: url_atual +'/api/cadempresas/'+param_comp,
            timeout: 0,
        }).done(function(data) {
            alert("Registro editado com sucesso!");
            window.location='../empresa'
        });
    }
}