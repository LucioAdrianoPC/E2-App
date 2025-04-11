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
	<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/2.0.0/js/bootstrap-switch.min.js" integrity="sha512-eRI64H/+n22qknZMCMmIRYY/PIVxRdJizYRB+fMHJRT+qkTX0B/no3i2V7945KwxReUScbdICK+ToNslFjZ2ng==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>-->
	<script src="{{ asset('js/api/cadcomunicado.js') }}"></script>

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
							  <h5 class="mb-1">Cadastro de Comunicado</h5>
						  </div>
					  </div>
				  </div>
				  
				  <div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="nav navbar-nav ml-auto">
					  <li >
						  <a class="btn btn-dark" href="../comunicado"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</a>
					  </li>
					</ul>
				  </div>
				</div>
			  </nav>
			<div class="card">
				<div class="card-header">
					Ficha de Comunicado de Tratamento
				</div>
				<div class="card-body">
				  	<div class="card-text">
						<input type="hidden" class="form-control" id="idComunicado">
						<div class="row">
							<div class="form-group col-md-4">
								<label for="numeroComunicado">Número do Comunicado</label>
								<input type="text" class="form-control" id="numeroComunicado" maxlength="100">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-6">
								<label for="nomePrestador">Nome do Prestador</label>
								<input class="form-control" id="nomePrestador" value="E2 SERVIÇOS LTDA" disabled></input>
							</div>
							<div class="form-group col-md-3">
								<label for="cnpj">CNPJ</label>
								<input type="text" class="form-control" id="cnpj" value="07.383.955/0001-14" disabled>
							</div>
							<div class="form-group col-md-3">
								<label for="numCredenciamento">Número do Credenciamento</label>
								<input type="text" class="form-control" id="numCredenciamento" value="BR MG 0196" disabled>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-9">
								<label for="nomeFornecedor">Nome do Tomador do serviço</label>
								<select class="custom-select" id="nomeFornecedor" onchange="cnpjFornecedor()">
								</select>
							</div>
							<div class="form-group col-md-3">
								<label for="cnpjFornecedor">CNPJ</label>
								<input type="text" class="form-control" id="cnpjFornecedor" maxlength="18" disabled>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-12">
								<label for="localTratamento">Local do Tratamento</label>
								<textarea class="form-control" id="localTratamento" maxlength="250" rows="2">
								</textarea>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-4">
								<label for="destino">Destino</label>
								<input type="text" class="form-control" id="destino" maxlength="150" value="NÃO SE ENQUADRA">
							</div>
							<div class="form-group col-md-3">
								<label for="nomePrestador">O Produto deve ser:</label><br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="tratadoDestruido" id="tratado" value="T" checked>
									<label class="form-check-label" for="tratado">Tratado</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="tratadoDestruido" id="destruido" value="D">
									<label class="form-check-label" for="destruido">Destruído</label>
								</div>
							</div>
							<div class="form-group col-md-5">
								<label for="numDescVolumes">Descrição dos Volumes</label>
								<input type="text" class="form-control" id="numDescVolumes" maxlength="150" value="EMBALAGENS DE MADEIRA ESPÉCIE PÍNUS / EUCALÍPTO">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-2">
								<label for="quantidade">Quantidade</label>
								<input type="number" step="0,001"class="form-control" id="quantidade">
							</div>
							<div class="form-group col-md-6">
								<label for="marcas">Marcas Distintivas</label>
								<input type="text" class="form-control" id="marcas" maxlength="250">
							</div>
							<div class="form-group col-md-4">
								<label for="modalidade">Modalidade do Tratamento</label>
								<input type="text" class="form-control" id="modalidade" maxlength="150" value="AR QUENTE FORÇADO">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-3">
								<label for="dataInicio">Data Início do Tratamento</label>
								<input type="date" class="form-control" id="dataInicio">
							</div>
							<div class="form-group col-md-3">
								<label for="horaInicio">Hora Início do Tratamento</label>
								<input type="time" step="00:00" class="form-control" id="horaInicio">
							</div>
							<div class="form-group col-md-3">
								<label for="duracao">Duração do Tratamento</label>
								<input type="text" class="form-control" id="duracao" maxlength="20" value="30 MINUTOS">
							</div>
							<div class="form-group col-md-3">
								<label for="temperatura">Temperatura</label>
								<input type="text" class="form-control" id="temperatura" maxlength="20" value="56ºC">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-4">
							<label for="agrotoxico">Agrotóxico</label>
							<input type="text" class="form-control" id="agrotoxico" maxlength="50" value="NÃO SE ENQUADRA">
						</div>
						<div class="form-group col-md-6">
							<label for="ingredienteAtivo">Ingrediente Ativo</label>
							<input type="text" class="form-control" id="ingredienteAtivo" maxlength="250" value="NÃO SE ENQUADRA">
						</div>
						<div class="form-group col-md-2">
							<label for="dose">Dose</label>
							<input type="text" class="form-control" id="dose" maxlength="10">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="prodComercial">Produto Comercial</label>
							<input type="text" class="form-control" id="prodComercial" maxlength="20" value="NÃO SE ENQUADRA">
						</div>
						<div class="form-group col-md-6">
							<label for="radiacao">Radiação</label>
							<input type="text" class="form-control" id="radiacao" maxlength="20" value="NÃO SE ENQUADRA">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="engenheiro_1">Engenheiro 1</label>
							<div class="input-group-prepend">
								<select class="custom-select" id="engenheiro_1">
								</select>
							</div>
						</div>
						<div class="form-group col-md-6">
							<label for="engenheiro_2">Engenheiro 2</label>
							<div class="input-group-prepend">
								<select class="custom-select" id="engenheiro_2">
								</select>
							</div>
						</div>
					</div>
					<div class="card-footer text-right">
						<button type="button" class="btn btn-outline-danger" onclick="window.location='../comunicado'">Cancelar</button>
						<button type="button" class="btn btn-outline-success" onclick="salvar()">Salvar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
