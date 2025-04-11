<!doctype html>
<html lang="pt-BR">
  <head>
  	<title>E2 - Serviços</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/popper.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/2.0.0/js/bootstrap-switch.min.js" integrity="sha512-eRI64H/+n22qknZMCMmIRYY/PIVxRdJizYRB+fMHJRT+qkTX0B/no3i2V7945KwxReUScbdICK+ToNslFjZ2ng==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="{{ asset('js/api/cadfornecedor.js') }}"></script>

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	  	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/2.0.0/css/bootstrap-switch.css" integrity="sha512-RQTlbzuquSshDkFhOYQGKj103GzZtfc7m3sD6vr3sGrxs+V1mgorXZHuXOupYg4Eb0LyoVOxQlLvD8wkVv73AQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<link rel="stylesheet" href="{{ asset('css/style.css') }}">
		<link rel="shortcut icon" href="{{ asset('img/favicon.png') }}" />
		<style>
			input[type=text]{
				text-transform: uppercase;
			}
		</style>
  </head>
<body onload="carrega()">
<div class="content-fluid">	
	<div class="row">
		        <!-- Page Content  -->
		@include('menu')
		
		<div class="col-md-9"  style="padding-right: 40px; padding-top: 10px">
			<nav class="navbar navbar-expand-lg navbar-light bg-warning">
				<div class="container-fluid">
  
				  <div id="pesquisar" class="col-8">
					  <div class="row">
						  <div class="col-md-8">	
							  <h5 class="mb-1">Cadastro de Estufas</h5>
						  </div>
					  </div>
				  </div>
				  
				  <div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="nav navbar-nav ml-auto">
					  <li >
						  <a class="btn btn-dark" href="../fornecedor"><i class="fa fa-arrow-left" aria-hidden="true"></i> voltar</a>
					  </li>
					</ul>
				  </div>
				</div>
			  </nav>
			<div class="card">
				<div class="card-header">
					Ficha de Cadastro de Estufa
				</div>
				<div class="card-body">
				  	<div class="card-text">
						<div class="row">
							<div class="form-group col-md-4">
								<label for="idFornecedor">Código do Fornecedor</label>
								<input type="number" class="form-control" id="idFornecedor" disabled>
							</div>
							<div class="form-group col-md-4">
								<label for="cnpj">CNPJ</label>
								<input type="text" class="form-control" id="cnpj" maxlength="18">
							</div>
							<div class="form-group col-md-4">
								<label for="ie">Inscrição Estadual</label>
								<input type="text" class="form-control" id="ie" maxlength="30">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-12">
								<label for="fornecedor">Razão Social</label>
								<input type="text" class="form-control" id="fornecedor" maxlength="100">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-6">
								<label for="endereco">Endereço</label>
								<input type="text" class="form-control" id="endereco" maxlength="100">
							</div>
							<div class="form-group col-md-2">
								<label for="numero">Número/Compl.</label>
								<input type="text" class="form-control" id="numero" maxlength="50">
							</div>
							<div class="form-group col-md-4">
								<label for="bairro">Bairro</label>
								<input type="text" class="form-control" id="bairro" maxlength="100">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-3">
								<label for="cep">CEP</label>
								<input type="text" class="form-control" id="cep"  maxlength="9">
							</div>
							<div class="form-group col-md-2">
								<label for="estado">Estado</label>
								<select class="custom-select" id="estado">
								</select>
							</div>
							<div class="form-group col-md-7">
								<label for="municipio">Município</label>
								<select class="custom-select" id="municipio">
								</select>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-4">
								<label for="telefone1">Telefone 1</label>
								<input type="text" class="form-control" id="telefone1"  maxlength="14">
							</div>
							<div class="form-group col-md-4">
								<label for="telefone2">Telefone 2</label>
								<input type="text" class="form-control" id="telefone2"  maxlength="14">
							</div>
							<div class="form-group col-md-4">
								<label for="email">Email</label>
								<input type="email" class="form-control" id="email"  maxlength="200">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-4">
								<label for="contato">Contato</label>
								<input type="text" class="form-control" id="contato"  maxlength="50">
							</div>
							<div class="form-group col-md-4">
								<label for="numCredenciamento">Nº Credenciamento</label>
								<input type="text" class="form-control" id="numCredenciamento"  maxlength="150">
							</div>
							<div class="col-md-4">
								<div class='form-check form-switch' style="text-align: center">
									<label for="e2">Usa Estufa E2?</label><br>
									<input class='form-check-input' style="font-size: 20px" type='checkbox' id='pergunta' onclick="check()">
									<input type="hidden" id='e2'>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="form-group col-md-12">
								<label for="observacao">Observação</label>
								<textarea class="form-control" id="observacao" maxlength="250" rows="3">
								</textarea>
							</div>
						</div>
					<div class="card-footer text-right">
						<button type="button" class="btn btn-outline-success" onclick="salvar()">Salvar</button>
						<button type="button" class="btn btn-outline-danger" onclick="window.location='../fornecedor'">Cancelar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
    
</body>
</html>
