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
	<script src="{{ asset('js/api/certificado.js') }}"></script>

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	  	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/2.0.0/css/bootstrap-switch.css" integrity="sha512-RQTlbzuquSshDkFhOYQGKj103GzZtfc7m3sD6vr3sGrxs+V1mgorXZHuXOupYg4Eb0LyoVOxQlLvD8wkVv73AQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<link rel="stylesheet" href="{{ asset('css/style.css') }}">
		<link rel="shortcut icon" href="{{ asset('img/favicon.png') }}" />
</head>
<body>

	<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" id="modalFilho" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Desmembramento do Certificado Nº <text id="numCer"></text></h5><text id="idc" style="display: none"></text>
				<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
				  <span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="tab-content">
					<div role="tabpanel">
						<table class="table table-hover">
							<thead style="background-color: #555353; color: #E5E5E5">
							  <tr>
								<th scope="col" style="width: 100px; vertical-align: center">Nº Cert.</th>
								<th scope="col" style="width: 100px; vertical-align: center">Quant.</th>
								<th scope="col" style="width: 600px; text-align: center">Destinatário</th>
								<th scope="col" style="width: 100px; text-align: center">Imprimir</th>
								<th scope="col" style="width: 100px; text-align: center">Editar</th>
							  </tr>
							</thead>
							<tbody id="tb-ceaf">
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="row">
					<div class="col-lg-5" style="text-align: left">
						<h6>Quantidade Restante: <text id="qtdrest"></text></h6>
					</div>
					<div class="col-lg-7">
						<div class="row">
							<div class="col-lg-5" id="finalizar" style="display: none">
								<button type="button" class="btn btn-info" onclick="finalizar()">Finalizar</button>
							</div>
							<div class="col-lg-5" id="novo">
								<button type="button" class="btn btn-info" onclick="novoFilho()">Novo</button>
							</div>
							<div class="col-lg-5">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	  </div>
	</div>
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
									<button class="dropdown-item" type="button" id="pNumero" onclick="pNumero()">Nº Certificado </button>
								</div>
								</div>
							</div>
							<input type="text" class="form-control" id="pesquisaNome" onkeyup="pesquisaNome()">
							<input type="number" class="form-control" id="pesquisaNumero" onkeyup="pesquisaNumero()" style="display: none">
						</div>
						<div class="col-md-1">
					    	<img src="{{ asset('img/orange_circles.gif') }}" id="carregaPesquisa" style="max-width: 40px; display: none" alt="preload">
						</div>
					</div>
				</div>
				
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
				  <ul class="nav navbar-nav ml-auto">
					<li >
						<!--<a class="btn btn-dark" href="cadcom/0"><i class="fa fa-plus" aria-hidden="true"></i> Novo</a>-->
					</li>
				  </ul>
				</div>
			  </div>
			</nav>
<div class="card">
  <div class="card-header">
    CERTIFICADOS HT 
  </div>
  <div class="card-body">
    <div class="card-text">
		<ul class="nav nav-tabs" role="tablist">
			<a href="#" ><li role="presentation" class="nav-link active" id="ativos" onclick="abas(1)">Abertos</li></a>
			<a href="#"><li role="presentation" class="nav-link" id="inativos" onclick="abas(2)">Finalizados</li></a>
		</ul>
		
		<!-- Tab panes -->
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="tabAtivos">
				<table class="table table-hover">
					<thead style="background-color: #555353; color: #E5E5E5">
					  <tr>
						<th scope="col" style="width: 100px; vertical-align: center">Nº Cert.</th>
						<th scope="col" style="width: 100px; vertical-align: center">Qtd.</th>
						<th scope="col" style="width: 600px; text-align: center">Cliente</th>
						<th scope="col" style="width: 100px; text-align: center">Filhos</th>
						<th scope="col" style="width: 100px; text-align: center">Imprimir</th>
						<th scope="col" style="width: 100px; text-align: center">Editar</th>
					  </tr>
					</thead>
					<tbody id="tb-cea">
						
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
						<th scope="col" style="width: 100px; vertical-align: center">Nº Cert.</th>
						<th scope="col" style="width: 100px; vertical-align: center">Qtd.</th>
						<th scope="col" style="width: 600px; text-align: center">Cliente</th>
						<th scope="col" style="width: 100px; text-align: center">Filhos</th>
						<th scope="col" style="width: 100px; text-align: center">Imprimir</th>
						<th scope="col" style="width: 100px; text-align: center">Editar</th>
					  </tr>
					</thead>
					<tbody id="tb-cef">
						
					</tbody>
				</table>
				<nav class="paginas" aria-label="Navegação de página exemplo">
					<ul class="pagination justify-content-center" id="paginacaoi">
						
					</ul>
				</nav>
			</div>
		</div>
	</div>
</div>
    
</body>
</html>
