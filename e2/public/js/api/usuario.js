function cadastrar(id){
    window.location="cadusuario/"+ id;
}

function carrega(){
    var url_atual = window.location.origin;
	$.ajax({
	  type: "GET",
	  url: url_atual +'/api/usuario',
	  dataType: 'json',
  }).done(function(data) {
	  popula(data);
  });
}

function popula(data){
    var dados = data;
	var popula_usuario = '';

	for(i=0;i<dados.length ;i++){
		popula_usuario = popula_usuario + "<tr><th scope='row'>" +dados[i].id+ "</th><td>" +dados[i].name+ "</td><td>" +dados[i].email+ "</td><td><button type='button' class='btn btn-success' onClick='cadastrar(" +dados[i].id+ ")'><i class='fa fa-pencil' aria-hidden='true'> Editar</i></button></td><td><button type='button' class='btn btn-danger' onClick='apagar(" +dados[i].id+ ")'><i class='fa fa-trash' aria-hidden='true'> Excluir</i></button></td></tr>";
	}

	$("#tb_usuarios").html(popula_usuario).show();
}

function apagar(id){
	var url_atual = window.location.origin;
    if (confirm("Você deseja realmente excluir este item?")) {
        $.ajax({
            type: "DELETE",
            url: url_atual +'/api/usuario/'+id,
            timeout: 0,
        }).done(function(data) {
            alert("Registro excluído com sucesso!");
            window.location='../usuarios'
        });
    }
}
