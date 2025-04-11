function carrega(){
    var url_atual = window.location.origin;
    let url = window.location.pathname;
    let parts = url.split('/');
    let id = parts.pop() || parts.pop();
    
    if (id > 0){
        $.ajax({
            type: "GET",
            url: url_atual +'/api/usuario/'+id,
            dataType: 'json',
        }).done(function(data) {
            var dados = data;
            $("#id").val(dados.id);
            $("#nome").val(dados.name);
            $("#email").val(dados.email);
            $("#senha").val(dados.password);
        });
    }else{
        $("#id").val(0);
        $("#nome").val('');
        $("#email").val('');
        $("#senha").val('');
    }
	
}

function salvar(){
    
    var url_atual = window.location.origin;
    var id = $("#id").val();
    var tipo = '';
    var param_comp = '';
    var param = "name="+$('#nome').val()+"&email="+$("#email").val()+"&password="+$("#senha").val();
    if (id == 0){
        param_comp = "?"+param;
        $.ajax({
            type: "POST",
            url: url_atual +'/api/usuario/'+param_comp,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            timeout: 0,
        }).done(function(data) {
            alert("Registro salvo com sucesso!");
            window.location='../usuarios'
        });
    }else{
        param_comp = id+"?"+param;
        $.ajax({
            type: "PUT",
            url: url_atual +'/api/usuario/'+param_comp,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            timeout: 0,
        }).done(function(data) {
            alert("Registro editado com sucesso!");
            window.location='../usuarios'
        });
    }
}