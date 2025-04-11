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
	<script src="{{ asset('js/api/cadusuario.js') }}"></script>

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
							  <h5 class="mb-1">Cadastro de Usuários</h5>
						  </div>
					  </div>
				  </div>
				  
				  <div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="nav navbar-nav ml-auto">
					  <li >
						  <a class="btn btn-dark" href="../usuarios"><i class="fa fa-arrow-left" aria-hidden="true"></i> voltar</a>
					  </li>
					</ul>
				  </div>
				</div>
			  </nav>
			<div class="card">
				<div class="card-header">
					Ficha de Cadastro de Usuário
				</div>
				<div class="card-body">
				  	<div class="card-text">
						<div class="row">
							<div class="form-group col-md-4">
								<label for="id">Código do Usuário</label>
								<input type="number" class="form-control" id="id" disabled>
							</div>
							<div class="form-group col-md-8">
								<label for="nome">Nome</label>
								<input type="text" class="form-control" id="nome" maxlength="191">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-8">
								<label for="email">Email</label>
								<input type="email" class="form-control" id="email" autocomplete="off" maxlength="191">
							</div>
							<div class="form-group col-md-4">
								<label for="senha">Senha</label>
								<input type="password" class="form-control" id="senha" autocomplete="off" maxlength="191">
							</div>
						</div>
					<div class="card-footer text-right">
						<button type="button" class="btn btn-outline-success" onclick="salvar()">Salvar</button>
						<button type="button" class="btn btn-outline-danger" onclick="window.location='../usuarios'">Cancelar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
    
</body>
</html>
