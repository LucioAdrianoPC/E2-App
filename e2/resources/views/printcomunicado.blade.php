<!doctype html>
<html>
<head>
	<script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/popper.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/api/printcomunicado.js') }}"></script>
	
	<link href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css" rel="stylesheet" />
<meta charset="utf-8">
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/2.0.0/css/bootstrap-switch.css" integrity="sha512-RQTlbzuquSshDkFhOYQGKj103GzZtfc7m3sD6vr3sGrxs+V1mgorXZHuXOupYg4Eb0LyoVOxQlLvD8wkVv73AQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="shortcut icon" href="{{ asset('img/favicon.png') }}" />

<title>E2 Serviços</title>

<style>
	@page {
		size: A4
	}
  	.mdagua{
		background-image: url({{ asset('img/marca_dagua.jpg')}});
		background-repeat: no-repeat;
		margin-top: 10px;
	}
		.cabecalho{
			
		}
		.img{
			width: 125px;
		}
		#logo{
			
		}
		#endereco{
			
		}
</style>

</head>

<body class="A4" style="margin-left: 20%; margin-right: 20%;" >
	
	<div class="row" id="imprimir" style="align-content: center; text-align: center; margin-top: 10px;">
		<div class="col-2">
			<button type="button" class="btn btn-outline-secondary" onclick="imprimir()">Imprimir</button>
		</div>
		<div class="col-2">
			<button type="button" class="btn btn-outline-warning" onclick="window.location='../comunicado'">Fechar</button>
		</div>
	</div>
	

	<section class="sheet padding-10mm mdagua">
		<div class="row">
			<div class="col-3" id="logo">
				<img src="{{ asset('img/logo.png') }}" class="img" alt="Logo">
			</div>
			<div class="col-9" id="endereco">
				<h2><b>E2 SERVIÇOS LTDA</b></h2>
				Rua Gorgulho, 926 - Carmo de Minas - MG<br>
				Telefone: (35)3334-1373  - Email: atendimento@e2servicos.com.br<br>
				CNPJ: 07.383.955/0001-14  - IE: 141434832.00-20<br>
				Cadastro no MAPA: BR MG 0196
			</div>
		</div>
		<hr>
      	<div class="col-12" style="text-align: center">
			<h4>COMUNICADO DE TRATAMENTO</h4>
		</div>
		<hr>
		<table>
			<tr>
				<td style="width: 1000px"><small><b>1 - Número do Comunicado de Tratamento</b></small></td>
			</tr>
			<tr>
				<td id="numeroComunicado"  style="border-style: solid; border-width: 1px;"></td>
			</tr>
		</table>
		<table>
			<tr>
				<td style="width: 333px"><small><b>2 - Prestador do Serviço</b></small></td>
				<td style="width: 333px"><small><b>CNPJ</b></small></td>
				<td style="width: 333px"><small><b>3 - Número do Credenciamento</b></small></td>
			</tr>
			<tr>
				<td id="nomePrestador" style="border-style: solid; border-width: 1px;"></td>
				<td id="cnpj" style="border-style: solid; border-width: 1px;"></td>
				<td id="numCredenciamento" style="border-style: solid; border-width: 1px;"></td>
			</tr>
		</table>
		<table>
			<tr>
				<td style="width: 500px"><small><b>4 - Tomador do Serviço</b></small></td>
				<td style="width: 500px"><small><b>CNPJ</b></small></td>
			</tr>
			<tr>
				<td id="nomeFornecedor" style="border-style: solid; border-width: 1px;"></td>
				<td id="cnpjFornecedor" style="border-style: solid; border-width: 1px;"></td>	
			</tr>
		</table>
		<table>
			<tr>
				<td style="width: 1000px"><small><b>5 - Endereço Completo do Local de Tratamento</b></small></td>
			</tr>
			<tr style="border-style: solid; border-width: 1px;">
				<td id="localTratamento" ></td>
			</tr>
		</table>
		<table>
			<tr>
				<td style="width: 1000px"><small><b>6 - Destino</b></small></td>
			</tr>
			<tr style="border-style: solid; border-width: 1px;">
				<td id="destino"></td>
			</tr>
		</table>
		<table>
			<tr>
				<td style="width: 320px"><small><b>7 - Produto a ser Tratado/Destruído</b></small></td>
				<td style="width: 680px"><small><b>8 - Número e Descrição dos Volumes</b></small></td>
			</tr>
			<tr>
				<td  style="border-style: solid; border-width: 1px; text-align: center">
					<div class="form-check form-check-inline">
					  <span id="tratado"></span>
					  <label class="form-check-label" for="inlineCheckbox1">Tratado</label>
					</div>
					<div class="form-check form-check-inline">
                        <span id="destruido"></span>
					  <label class="form-check-label" for="inlineCheckbox2">Destruído</label>
					</div>
				</td>
				<td id="numDescVolumes" style="border-style: solid; border-width: 1px;"></td>
			</tr>
		</table>
		<table>
			<tr>
				<td style="width: 1000px"><small><b>9 - Quantidade Produto a ser Tratado ou Destruído</b></small></td>
			</tr>
			<tr style="border-style: solid; border-width: 1px;">
				<td id="quantidade"></td>
				<td  style="border-style: solid; border-width: 1px; text-align: center; width: 250px">
					<div class="form-check form-check-inline">
					  <span id="tratado2"></span>
					  <label class="form-check-label" for="inlineCheckbox1">Tratado</label>
					</div>
					<div class="form-check form-check-inline">
                        <span id="destruido2"></span>
					  <label class="form-check-label" for="inlineCheckbox2">Destruído</label>
					</div>
				</td>
			</tr>
		</table>
		<table>
			<tr>
				<td style="width: 450px"><small><b>10 - Marcas Distintivas</b></small></td>
				<td style="width: 550px"><small><b>11 - Modalidade de Tratamento / Medidas Fitossanitárias</b></small></td>
			</tr>
			<tr>
				<td id="marcas" style="border-style: solid; border-width: 1px;"></td>
				<td id="modalidade" style="border-style: solid; border-width: 1px;"></td>	
			</tr>
		</table>
		<table>
			<tr>
				<td style="width: 333px"><small><b>12 - Data Início do Tratamento</b></small></td>
				<td style="width: 333px"><small><b>13 - Hora Início do Tratamento</b></small></td>
				<td style="width: 333px"><small><b>14 - Duração do Tratamento</b></small></td>
			</tr>
			<tr>
				<td id="dataInicio" style="border-style: solid; border-width: 1px;"></td>
				<td id="horaInicio" style="border-style: solid; border-width: 1px;"></td>
				<td id="duracao" style="border-style: solid; border-width: 1px;"></td>
			</tr>
		</table>
		<table>
			<tr>
				<td style="width: 400px"><small><b>15 - Temperatura a ser Aplicada</b></small></td>
				<td style="width: 300px"><small><b>16 - Agrotóxico</b></small></td>
				<td style="width: 300px"><small><b>17 - Ingrediente Ativo</b></small></td>
				<td style="width: 200px"><small><b>18 - Dose</b></small></td>
			</tr>
			<tr>
				<td id="temperatura" style="border-style: solid; border-width: 1px;"></td>
				<td id="agrotoxico" style="border-style: solid; border-width: 1px;"></td>
				<td id="ingredienteAtivo" style="border-style: solid; border-width: 1px;"></td>
				<td id="dose" style="border-style: solid; border-width: 1px;"></td>
			</tr>
		</table>
		<table>
			<tr>
				<td style="width: 500px"><small><b>19 - Produto Comercial</b></small></td>
				<td style="width: 500px"><small><b>20 - Radiação</b></small></td>
			</tr>
			<tr>
				<td id="produtoComercial" style="border-style: solid; border-width: 1px;"></td>
				<td id="radiacao" style="border-style: solid; border-width: 1px;"></td>	
			</tr>
		</table>
		<table>
			<tr>
				<td style="width: 500px"><small><b>Responsável Técnico</b></small></td>
				<td style="width: 500px"><small><b>CREA</b></small></td>
			</tr>
			<tr>
				<td id="engenheiro_1" style="border-style: solid; border-width: 1px;"></td>
				<td id="crea_1" style="border-style: solid; border-width: 1px;"></td>	
			</tr>
		</table>
		<table>
			<tr>
				<td style="width: 500px"><small><b>Responsável Técnico</b></small></td>
				<td style="width: 500px"><small><b>CREA</b></small></td>
			</tr>
			<tr>
				<td id="engenheiro_2" style="border-style: solid; border-width: 1px;"></td>
				<td id="crea_2" style="border-style: solid; border-width: 1px;"></td>	
			</tr>
		</table>
    </section>
</body>
</html>


  
