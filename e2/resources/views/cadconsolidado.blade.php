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
	<script src="{{ asset('js/api/cadconsolidado.js') }}"></script>

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
							  <h5 class="mb-1">Cadastro de Certificado Consolidado</h5>
						  </div>
					  </div>
				  </div>
				  
				  <div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="nav navbar-nav ml-auto">
					  <li >
						  <a class="btn btn-dark" href="../consolidado"><i class="fa fa-arrow-left" aria-hidden="true"></i> voltar</a>
					  </li>
					</ul>
				  </div>
				</div>
			  </nav>
			  
			<div class="card">
				<div class="card-header">
					Ficha de Cadastro de Certificado Consolidado
				</div>
				
				<div class="card-body">
				  	<div class="card-text">
						<div class="row">
							<div class="form-group col-md-6">
								<label for="ctrlConsolidado">Nº de Controle do Consolidado</label>
								<input type="text" class="form-control" id="ctrlConsolidado" onchange="populaCadastro()">
							</div>
							<div class="form-group col-md-6">
								<label for="invoice">INVOICE</label>
								<input type="text" class="form-control" id="invoice">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-8">
								<label for="natProduto">Natureza do Produto</label>
								<input type="text" class="form-control" id="natProduto">
							</div>
							<div class="form-group col-md-4">
								<label for="dataEmissao">Emissão</label>
								<input type="date" class="form-control" id="dataEmissao">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-4">
								<label for="qtdVolume">Qtd. Volume</label>
								<input type="text" class="form-control" id="qtdVolume" maxlength="150">
							</div>
							<div class="form-group col-md-4">
								<label for="pesoBruto">Peso Bruto</label>
								<input type="text" class="form-control" id="pesoBruto">
							</div>
							<div class="form-group col-md-4">
								<label for="marcas">Marcas</label>
								<input type="text" class="form-control" id="marcas">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-6">
								<label for="numeroDosCtrs">Número dos Contêineres</label>
								<input type="text" class="form-control" id="numeroDosCtrs">
							</div>
							<div class="form-group col-md-6">
								<label for="transporte">Meio de Transporte</label>
								<input type="text" class="form-control" id="transporte" maxlength="150">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-6">
								<label for="embarque">Porto de Embarque</label>
								<input type="text" class="form-control" id="embarque">
							</div>
							<div class="form-group col-md-6">
								<label for="desembarque">Porto Destino</label>
								<input type="text" class="form-control" id="desembarque">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-12">
								<label for="remetente">Remetente</label>
								<select class="custom-select" id="remetente" style="text-transform: uppercase" onchange="enderecoRemetente()"></select>
							</div>
							<div class="form-group col-md-12">
								<label for="enderecoRemetente">Nome e Endereço do Remetente</label>
								<textarea class="form-control" id="enderecoRemetente" style="text-transform: uppercase"></textarea>
							</div>
							<div class="form-group col-md-12">
								<label for="enderecoDestinatario">Nome e Endereço do Destinatário</label>
								<textarea class="form-control" id="enderecoDestinatario" style="text-transform: uppercase"></textarea>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-4">
								<label for="ciclo">Ciclo</label>
								<input type="text" class="form-control" id="ciclo" maxlength="150">
							</div>
							<div class="form-group col-md-4" style="padding-top: 3.5%">
								<button type="button" class="btn btn-dark" onclick="popCertificados()">Pesquisar</button>
							</div>
							<div class="form-group col-md-4" style="padding-top: 3.5%">
								<img src="{{ asset('img/orange_circles.gif') }}" id="carrega" style="max-width: 40px; display: none" alt="preload">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-7">
								<label for="certificado">Certificado</label>
								<select class="custom-select" id="certificado" style="text-transform: uppercase"></select>
								<input type="hidden" class="form-control" id="idCerificado" maxlength="150">
								<input type="hidden" class="form-control" id="sequencia" maxlength="150">
							</div>
							<div class="form-group col-md-3">
								<label for="qtd">Qtd.</label>
								<input type="text" class="form-control" id="qtd" maxlength="150" required>
							</div>
							<div class="form-group col-md-2" style="padding-top: 3.5%">
								<button type="button" class="btn btn-warning" onclick="adicionar()">Adicionar</button>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-12">
								<table class="table table-hover" id="tabela">
									<thead style="background-color: #555353; color: #E5E5E5">
									  <tr>
										<th scope="col" style="width: 100px; vertical-align: center">Ciclo</th>
										<th scope="col" style="width: 350px; vertical-align: center">Certificado</th>
										<th scope="col" style="width: 250px; text-align: center">Quantidade</th>
										<th scope="col" style="width: 100px; text-align: center">Imprimir</th>
										<th scope="col" style="width: 100px; text-align: center">Excluir</th>
									  </tr>
									</thead>
									<tbody id="tb-ca">
										
									</tbody>
								</table>
							</div>
						</div>
					<div class="card-footer text-right">
						<button type="button" class="btn btn-outline-danger" onclick="window.location='../consolidado'">Fechar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
    
</body>
</html>
