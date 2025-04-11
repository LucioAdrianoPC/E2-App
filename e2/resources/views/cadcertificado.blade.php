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
	<script src="{{ asset('js/api/cadcertificado.js') }}"></script>

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	  	<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">-->
	  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/2.0.0/css/bootstrap-switch.css" integrity="sha512-RQTlbzuquSshDkFhOYQGKj103GzZtfc7m3sD6vr3sGrxs+V1mgorXZHuXOupYg4Eb0LyoVOxQlLvD8wkVv73AQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		  <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
		<link rel="stylesheet" href="{{ asset('css/style.css') }}">
		<link rel="shortcut icon" href="{{ asset('img/favicon.png') }}" />
		<style>
			input[type=text]{
				text-transform: uppercase;
			}
			#numeroFilho{
				display: none;
			}
		</style>
  </head>
  <!--onload="carrega()"-->
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
							  <h5 class="mb-1">Cadastro de Certificado</h5>
						  </div>
					  </div>
				  </div>
				  
				  <div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="nav navbar-nav ml-auto">
					  <li >
						  <a class="btn btn-dark" href="../certificado"><i class="fa fa-arrow-left" aria-hidden="true"></i> voltar</a>
					  </li>
					</ul>
				  </div>
				</div>
			  </nav>
			  
			<div class="card">
				<div class="card-header">
					Ficha de Cadastro de Certificado
				</div>
				<div class="card-body">
				  	<div class="card-text">
						<input type="hidden" class="form-control" id="idComunicado">
						<input type="hidden" class="form-control" id="idCertificado">
						<input type="hidden" class="form-control" id="idEngenheiro">
						<input type="hidden" class="form-control" id="id_mae">
						<div class="row">
							
							<div class="form-group col-md-3">
								<label for="numeroCertificado">Nº do Certificado</label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="cert"></span>
									</div>
									<input type="text" class="form-control" id="numeroFilho" aria-describedby="cert">
									<input type="text" class="form-control" id="numeroCertificado" aria-describedby="cert">
								</div>
							</div>
							<div class="form-group col-md-2">
								<label for="numeroComunicado">Nº Comunicado</label>
								<input type="text" class="form-control" id="numeroComunicado" disabled>
							</div>
							<div class="form-group col-md-2">
								<label for="lote">Nº do Lote</label>
								<input type="text" class="form-control" id="lote" maxlength="100">
							</div>
							<div class="form-group col-md-2">
								<label for="ciclo">Nº do Ciclo</label>
								<input type="text" class="form-control" id="ciclo" maxlength="100">
							</div>
							<div class="form-group col-md-3">
								<label for="dataEmissao">Emissão</label>
								<input type="date" class="form-control" id="dataEmissao">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-2">
								<label for="unidadeMedida">Un. Medida</label>
								<select class="custom-select" id="unidadeMedida">
								</select>
							</div>
							<div class="form-group col-md-2">
								<label for="pesoBruto">Peso/UN</label>
								<input type="text" class="form-control" id="pesoBruto">
							</div>
							<div class="form-group col-md-4">
								<label for="origem">Origem</label>
								<input type="text" class="form-control" id="origem" maxlength="150">
							</div>
							<div class="form-group col-md-4">
								<label for="destino">Destino</label>
								<input type="text" class="form-control" id="destino" maxlength="150">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-8">
								<label for="marcas">Marcas</label>
								<input type="text" class="form-control" id="marcas" value="NIHIL">
							</div>
							<div class="form-group col-md-4">
								<label for="qtdVolume">Qtd. Volume</label>
								<input type="number" class="form-control" id="qtdVolume" maxlength="150">
							</div>
							
						</div>
						<div class="row">
							<div class="form-group col-md-6">
								<label for="numeroDosCtrs">Nº dos Ctrs</label>
								<input type="text" class="form-control" id="numeroDosCtrs" value="TRANSPORTE RODOVIÁRIO">
							</div>
							<div class="form-group col-md-6">
								<label for="natProduto">Natureza do Produto</label>
								<input type="text" class="form-control" id="natProduto">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-6">
								<label for="remetente">Remetente</label>
								<select class="custom-select" id="remetente" style="text-transform: uppercase" onchange="popOrigem()"></select>
								<input type="hidden" id="nomeRemetente">
							</div>
							<div class="form-group col-md-6">
								<label for="destinatario">Destinatário</label>
								<select class="custom-select" id="destinatario" style="text-transform: uppercase" onchange="popDestino()"></select>
								<input type="hidden" id="nomeDestinatario">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-4">
								<label for="navio">Navio</label>
								<input type="text" class="form-control" id="navio" maxlength="100" value="TRANSPORTE RODOVIÁRIO">
							</div>
							<div class="form-group col-md-4">
								<label for="local">Local</label>
								<select class="custom-select" id="local" onchange="popEstufa()"></select>
							</div>
							<div class="form-group col-md-4">
								<label for="localFumigacao">Fumigado em</label>
								<input type="text" class="form-control" id="localFumigacao">
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="form-group col-md-4">
								<label for="modalidade">Produto Utilizado</label>
								<input type="text" class="form-control" id="modalidade"  maxlength="150">
							</div>
							<div class="form-group col-md-3">
								<label for="dataExpurgo">Início da Fumigação</label>
								<input type="date" class="form-control" id="dataExpurgo">
							</div>
							<div class="form-group col-md-3">
								<label for="dataTerminoExpurgo">Término da Fumigação</label>
								<input type="date" class="form-control" id="dataTerminoExpurgo">
							</div>
							<div class="form-group col-md-2">
								<label for="tempTratamento">Temp. Tratamento</label>
								<input type="text" class="form-control" id="tempTratamento">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-3">
								<label for="temperatura">Temperatura</label>
								<select class="custom-select" id="temperatura">
									<option value="20º">20º</option>
									<option value="21º">21º</option>
									<option value="22º">22º</option>
									<option value="23º">23º</option>
								</select>
							</div>
							<div class="form-group col-md-3">
								<label for="horaInicio">Início</label>
								<input type="time" class="form-control" id="horaInicio">
							</div>
							<div class="form-group col-md-3">
								<label for="horaFim">Término</label>
								<input type="time" class="form-control" id="horaFim">
							</div>
							<div class="form-group col-md-3">
								<label for="tempo">Tempo Exposição</label>
								<input type="text" class="form-control" id="tempo">
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
						<button type="button" class="btn btn-outline-danger" onclick="window.location='../certificado'">Cancelar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
    
</body>
</html>
