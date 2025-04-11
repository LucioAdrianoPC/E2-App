function check(){
    var url_atual = window.location.origin;
    $.ajax({
        type: "GET",
        url: url_atual +'/api/estufae2',
        dataType: 'json',
    }).done(function(data) {
        let checkbox = $('#pergunta');
        if(checkbox.is(":checked")) {
            $('#e2').val(data[0].idFornecedor);
        } else {
            $('#e2').val(0);
        }
    });
}
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

    });
    let url = window.location.pathname;
    let parts = url.split('/');
    let id = parts.pop() || parts.pop();
    
    if (id > 0){
        setTimeout(() => {
            $.ajax({
                type: "GET",
                url: url_atual +'/api/popfornecedor/'+id,
                dataType: 'json',
            }).done(function(data) {
                console.log(data);
                $('#idFornecedor').val(data[0].idFornecedor);
                $('#fornecedor').val(data[0].fornecedor);
                $('#cnpj').val(data[0].cnpj);
                $('#ie').val(data[0].ie);
                $('#endereco').val(data[0].endereco); 
                $('#numero').val(data[0].numero);
                $('#bairro').val(data[0].bairro);
                $('#cep').val(data[0].cep);
                $('#estado').prepend("<option value='"+data[0].id_estado+"' selected>" +data[0].ufMunicipio + "</option>");
                $('#municipio').prepend("<option value='"+data[0].idMunicipio+"' selected>" +data[0].nomeMunicipio + "</option>");
                $('#telefone1').val(data[0].telefone1);
                $('#telefone2').val(data[0].telefone2);
                $('#email').val(data[0].email);
                $('#contato').val(data[0].contato);
                $('#numCredenciamento').val(data[0].numCredenciamento);
                if(data[0].e2 == 0){
                    $('#e2').val(0)
                    $('#pergunta').prop('checked', false);
                }else{
                    $('#e2').val(data[0].e2)
                    $('#pergunta').prop('checked', true);
                }
                $('#observacao').val(data[0].observacao);
                //'engenheiro_id'
            
            });
        }, 200);
    }else{
        $('#idFornecedor').val('0');
    }
	
}

function existeCNPJ(){
    var url_atual = window.location.origin;
    var texto = $('#cnpj').val();
    texto = texto.replace('/', '_');

    $.ajax({
        type: 'GET',
        url: url_atual + '/api/existecnpjf/'+texto,
        dataType: 'json'
    }).done(function(data){
        if (data.length > 0){
            alert("O CNPJ já existe!");
            window.location = "../cadfor/"+data[0].idFornecedor;
        }else{
            autopre()
        }
    })
}

function salvar(){
    var url_atual = window.location.origin;
    var id = $("#idFornecedor").val();
    var obs = $('#observacao').val();
    var txt = obs.replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '<br/>');
    var param_comp = '';
    console.log($('#municipio').val());   
    var param = "fornecedor="+$('#fornecedor').val()+"&cnpj="+$('#cnpj').val()+"&ie="+$('#ie').val()+"&endereco="+$('#endereco').val()+"&numero="+$('#numero').val()+"&bairro="+$('#bairro').val()+"&cep="+$('#cep').val()+"&municipio="+$('#municipio').val()+"&telefone1="+$('#telefone1').val()+"&telefone2="+$('#telefone2').val()+"&email="+$('#email').val()+"&contato="+$('#contato').val()+"&numCredenciamento="+$('#numCredenciamento').val()+"&e2="+$('#e2').val()+"&observacao="+txt+"&flg_status=A";
    if (id == 0){
        param_comp = "?"+param;
        console.log(param_comp);
        $.ajax({
            type: "POST",
            url: url_atual +'/api/cadfornecedor/'+param_comp,
            timeout: 0,
        }).done(function(data) {
            alert("Registro salvo com sucesso!");
            window.location='../fornecedor'
        });
    }else{
        param_comp = id+"?"+param;
        $.ajax({
            type: "PUT",
            url: url_atual +'/api/cadfornecedor/'+param_comp,
            timeout: 0,
        }).done(function(data) {
            alert("Registro editado com sucesso!");
            window.location='../fornecedor'
        });
    }
}