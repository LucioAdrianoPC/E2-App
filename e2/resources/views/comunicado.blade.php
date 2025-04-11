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
	<!--<script src="{{ asset('js/jquery.nav.js') }}"></script>
    <script src="{{ asset('js/jquery.sticky.js') }}"></script>-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/2.0.0/js/bootstrap-switch.min.js" integrity="sha512-eRI64H/+n22qknZMCMmIRYY/PIVxRdJizYRB+fMHJRT+qkTX0B/no3i2V7945KwxReUScbdICK+ToNslFjZ2ng==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="{{ asset('js/api/comunicado.js') }}"></script>

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	  	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/2.0.0/css/bootstrap-switch.css" integrity="sha512-RQTlbzuquSshDkFhOYQGKj103GzZtfc7m3sD6vr3sGrxs+V1mgorXZHuXOupYg4Eb0LyoVOxQlLvD8wkVv73AQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<link rel="stylesheet" href="{{ asset('css/style.css') }}">
		<link rel="shortcut icon" href="{{ asset('img/favicon.png') }}" />
</head>
<body onload="popComunicadosA()">
<div class="content-fluid">	
	<div class="row">
		        <!-- Page Content  -->
		@include('menu')
		<div class="col-md-9"  style="padding-right: 40px; padding-top: 10px">

			<nav class="navbar navbar-expand-lg navbar-light bg-warning">
			  <div class="container-fluid">

				<div id="pesquisar" class="col-md-8">
					<div class="row">
						<div class="col-md-2">	
					    	<h5 class="mb-1">Pesquisar</h5>
						</div>
						<div class="input-group col-md-8">
							<div class="input-group-prepend">
							<div class="dropdown">
								<button class="btn btn-warning dropdown-toggle" type="button" id="pMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Nome 
								</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenu2">
									<button class="dropdown-item" type="button" id="pNome" onclick="pNome()">Nome   </button>
									<button class="dropdown-item" type="button" id="pCNPJ" onclick="pNumero()">Nº Comunicado </button>
								</div>
								</div>
							</div>
							<input type="text" class="form-control" id="pesquisaNome" onkeyup="pesquisaNome()">
							<input type="text" class="form-control" id="pesquisaCNPJ" onkeyup="pesquisaNumero()" style="display: none">
						</div>
						<div class="col-md-1">
					    	<img src="{{ asset('img/orange_circles.gif') }}" id="carregaPesquisa" style="max-width: 40px; display: none" alt="preload">
						</div>
					</div>
				</div>
				
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
				  <ul class="nav navbar-nav ml-auto">
					<li >
						<a class="btn btn-dark" href="cadcom/0"><i class="fa fa-plus" aria-hidden="true"></i> Novo</a>
					</li>
				  </ul>
				</div>
			  </div>
			</nav>
<div class="card">
  <div class="card-header">
    COMUNICADOS DE TRATAMENTOS 
  </div>
  <div class="card-body">
    <div class="card-text">
		<ul class="nav nav-tabs" role="tablist">
			<a href="#" ><li role="presentation" class="nav-link active" id="ativos" onclick="abas(1)">Abertos</li></a>
			<a href="#"><li role="presentation" class="nav-link" id="inativos" onclick="abas(2)">Com Certificado</li></a>
			<a href="#"><li role="presentation" class="nav-link" id="finalizados" onclick="abas(3)">Finalizados</li></a>
		</ul>
		
		<!-- Tab panes -->
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="tabAtivos">
				<table class="table table-hover">
					<thead style="background-color: #555353; color: #E5E5E5">
					  <tr>
						<th scope="col" style="width: 50px; vertical-align: center">Número</th>
						<th scope="col" style="width: 550px; vertical-align: center">Tomador do Serviço</th>
						<th scope="col" style="width: 100px; text-align: center">Editar</th>
						<th scope="col" style="width: 100px; text-align: center">Certificado</th>
						<th scope="col" style="width: 100px; text-align: center">Imprimir</th>
						<th scope="col" style="width: 100px; text-align: center">Excluir</th>
					  </tr>
					</thead>
					<tbody id="tb-ca">
						
					</tbody>
				</table>
				
				<nav aria-label="Navegação de página">
					<ul class="pagination justify-content-center" id="paginacao">

					</ul>
				</nav>
			</div>
			<div role="tabpanel" class="tab-pane" id="tabInativos">
				<table class="table table-hover">
					<thead style="background-color: #555353; color: #E5E5E5">
					  <tr>
						<th scope="col" style="width: 50px; vertical-align: center">Número</th>
						<th scope="col" style="width: 550px; vertical-align: center">Tomador do Serviço</th>
						<th scope="col" style="width: 100px; text-align: center">Imprimir</th>
					  </tr>
					</thead>
					<tbody id="tb-cc">
						
					</tbody>
				</table>
				
				<nav aria-label="Navegação de página">
					<ul class="pagination justify-content-center" id="paginacao">

					</ul>
				</nav>
			</div>
			<div role="tabpanel" class="tab-pane" id="tabFinalizados">
				<table class="table table-hover">
					<thead style="background-color: #555353; color: #E5E5E5">
					  <tr>
						<th scope="col" style="width: 50px; vertical-align: center">Número</th>
						<th scope="col" style="width: 600px; vertical-align: center">Tomador do Serviço</th>
						<th scope="col" style="width: 100px; text-align: center">Imprimir</th>
					  </tr>
					</thead>
					<tbody id="tb-cf">
						
					</tbody>
				</table>
				
				<nav aria-label="Navegação de página">
					<ul class="pagination justify-content-center" id="paginacao">

					</ul>
				</nav>
			</div>
		</div>
	</div>
</div>
    
</body>
</html>
