function carrega(){
    var url_atual = window.location.origin;
    let url = window.location.pathname;
    let parts = url.split('/');
    let id = parts.pop() || parts.pop();
    
    if (id > 0){
        $.ajax({
            type: "GET",
            url: url_atual +'/api/popengenheiro/'+id,
            dataType: 'json',
            
        }).done(function(data) {
            $('#idEngenheiro').val(data[0].idEngenheiro);
            $('#nome').val(data[0].nome);
            $('#formacao').val(data[0].formacao);
            $('#crea').val(data[0].crea);
        });
    }else{
        $('#idEngenheiro').val('0');
    }
	
}

function salvar(){
    var url_atual = window.location.origin;
    var id = $("#idEngenheiro").val();
    var param_comp = '';
        
    var param = "nome="+$('#nome').val()+"&formacao="+$('#formacao').val()+"&crea="+$('#crea').val()+"&flg_status=A";
    if (id == 0){
        param_comp = "?"+param;
        $.ajax({
            type: "POST",
            url: url_atual +'/api/cadengenheiro/'+param_comp,
            timeout: 0,
        }).done(function(data) {
            alert("Registro salvo com sucesso!");
            window.location='../engenheiro'
        });
    }else{
        param_comp = id+"?"+param;
        $.ajax({
            type: "PUT",
            url: url_atual +'/api/cadengenheiro/'+param_comp,
            timeout: 0,
        }).done(function(data) {
            alert("Registro editado com sucesso!");
            window.location='../engenheiro'
        });
    }
}