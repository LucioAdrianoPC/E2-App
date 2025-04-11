<!doctype html>
<html lang="pt-BR">
<head>
	<script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/popper.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/api/printconsolidado.js') }}"></script>
	<link rel="stylesheet" href="{{ asset('css/paper.css') }}">
	
	<!--<link href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css" rel="stylesheet" />-->
	<meta charset="utf-8">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@300&family=Poppins&display=swap" rel="stylesheet">
		
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
	.img{
		width: 600px;
	}
	
	.info{
		font-family: "Barlow Condensed", serif;
		font-weight: 400;
		font-style: normal;
		font-size: 10px;
	}
	.txt{
		font-family: "Barlow Condensed", serif;
		font-weight: 400;
		font-style: normal;
		font-size: 12px;
	}
	.res{
		text-transform: uppercase;
	}
	
</style>

</head>

<body class="A4" style="margin-left: 20%; margin-right: 20%;" >
	
	<div class="row" id="imprimir" style="align-content: center; text-align: center; margin-top: 10px;">
		<div class="col-2">
			<button type="button" class="btn btn-outline-secondary" onclick="imprimir()">Imprimir</button>
		</div>
		<div class="col-2">
			<button type="button" class="btn btn-outline-warning" onclick="window.close()">Fechar</button>
		</div>
	</div>
	<section class="sheet padding-5mm mdagua">
		<b class="info">1.</b>
		<div class="row">
			<div class="col-12">
				<img src="{{ asset('img/cabecalho.jpg') }}" class="img" alt="Logo">
			</div>
		</div>
		<hr>
      	<div class="col-12">
			<div class="row">
				<table>
					<tr>
						<div class="col-md-3 info"><b>11. N° CICLO/CYCLE: </b><text id="ciclo"></text></div>
						<div class="col-md-4 info"><b>10. N° COMUN. DE TRATAMENTO: </b><text id="numeroComunicado"></text></div>
						<div class="col-md-5 info"><b>2. N° CERT. DE TRATAMENTO: </b><text id="numeroCertificado"></text></div>
					</tr>
				</table>
			</div>
		</div><br>
		<div class="col-md-12" style="text-align: center; font-size: 16px;"><b>FUMIGATION CERTIFICATE</b></div>
		<div class="col-md-12" style="text-align: center; font-size: 13px;">CERTIFICADO DE FUMIGAÇÃO</div>
		<div class="col-md-12 txt" style="text-align: justify;"><b>The undersigned, certifies that the products reported of the under described despatch were submitted to FUMIGATION accordingly following indications. (O abaixo assinado certifica que os produtos constantes da remessa	abaixo descrita foram submetidos à fumigação conforme indicação a seguir.)</b></div>
		<div class="col-md-12" style="text-align: center; font-size: 13px;"><b>DESCRIPTION OF THE CONSIGNMENT</b></div>
		<div class="col-md-12" style="text-align: center; font-size: 12px;">DESCRIÇÃO DA REMESSA</div>
		<table><tr><td>
		<div class="row">
			<div class="col-md-5">
				<table>
					<tr>
						<td style="width: 1000px"><text class="info"><b>9. Lot number / N° Lote:</b></text></td>
					</tr>
					<tr>
						<td class="info res" id="lote"></td>
					</tr>
				</table>
			</div>
			<div class="col-md-7">
				<table>
					<tr>
						<td style="width: 1000px"><text class="info"><b>8. Gross weight / Peso bruto:</b></text></td>
					</tr>
					<tr>
						<td class="info res" id="pesoBruto"></td>
					</tr>
				</table>
			</div>
		</div>
	</td></tr></table>
		<div class="row">
			<div class="col-md-5">
				<table>
					<tr>
						<td style="width: 1000px"><text class="info"><b>Origin / Origem:</b></text></td>
					</tr>
					<tr>
						<td class="info res" id="origem"></td>
					</tr>
				</table>
			</div>
			<div class="col-md-7">
				<table>
					<tr>
						<td style="width: 1000px"><text class="info"><b>5. Service contractor / Contratante do Serviço // Destination / Destino:</b></text></td>
					</tr>
					<tr>
						<td class="info res" id="destino"></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-md-5">
				<table>
					<tr>
						<td style="width: 1000px"><text class="info"><b>12. Distinctive Marks / Marcas distintivas:</b></text></td>
					</tr>
					<tr>
						<td class="info res" id="marcas"></td>
					</tr>
				</table>
			</div>
			<div class="col-md-7">
				<table>
					<tr>
						<td style="width: 1000px"><text class="info"><b>7. Quantity of Packages / Quant. de Volumes:</b></text></td>
					</tr>
					<tr>
						<td class="info res" id='qtdVolume'></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-md-5">
				<table>
					<tr>
						<td style="width: 1000px"><text class="info"><b>12.1 Ctrs Number / N° dos ctrs:</b></text></td>
					</tr>
					<tr>
						<td class="info res" id="numeroDosCtrs"></td>
					</tr>
				</table>
			</div>
			<div class="col-md-7">
				<table>
					<tr>
						<td style="width: 1000px"><text class="info"><b>6. Kind of Product / Natureza do produto:</b></text></td>
					</tr>
					<tr>
						<td class="info res" id="natProduto"></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-md-5">
				<table>
					<tr>
						<td style="width: 1000px"><text class="info"><b>12.2 Vessel / Navio:</b></text></td>
					</tr>
					<tr>
						<td class="info res" id="navio"></td>
					</tr>
				</table>
			</div>
			<div class="col-md-7">
				<table>
					<tr>
						<td style="width: 1000px"><text class="info"><b>3. Name and address consignee / Nome e endereço do destinatário:</b></text></td>
					</tr>
					<tr>
						<td class="info res" id="destinatario"></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-md-7">
				<table>
					<tr>
						<td style="width: 1000px"><text class="info"><b>3.1 Name and address of shipper / Nome e endereço do remetente:</b></text></td>
					</tr>
					<tr>
						<td class="info res" id="remetente"></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="col-md-12" style="text-align: center; font-size: 13px;"><b>TREATMENT (HT)</b></div>
		<div class="col-md-12" style="text-align: center; font-size: 12px;">TRATAMENTO (HT)</div>
		<div class="row">
			<div class="col-md-6">
				<table>
					<tr>
						<td style="width: 1000px"><text class="info"><b>13. Treatment Mode / Modalidade de Tratamento:</b></text></td>
					</tr>
					<tr>
						<td class="info res" id="modalidade"></td>
					</tr>
				</table>
			</div>
			<div class="col-md-6">
				<table>
					<tr>
						<td style="width: 1000px"><text class="info"><b>4. Treatment Place / Local de Tratamento:</b></text></td>
					</tr>
					<tr>
						<td class="info res" id="localTratamento">ESTUFA E2 SERVIÇOS / RUA JOSE LEVINDO VALADARES, 291, VASCO LOPES,	PAPAGAIOS - MG - 35669000 / BRASIL</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<table>
					<tr>
						<td style="width: 1000px"><text class="info"><b>18.1 Temperature Treatment / Temperatura de tratamento:</b></text></td>
					</tr>
					<tr>
						<td class="info res" id="tempTratamento"></td>
					</tr>
				</table>
			</div>
			<div class="col-md-6">
				<table>
					<tr>
						<td style="width: 1000px"><text class="info"><b>Date of fumigation / Data da fumigação:</b></text></td>
					</tr>
					<tr>
						<td class="info"><b>14.</b>START/INÍCIO: <text id="dataExpurgo"></text><b> - 16.</b>END/TÉRMINO: <text id="dataTerminoExpurgo"></text></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<table>
					<tr>
						<td style="width: 1000px"><text class="info"><b>27. Exposition Time / Tempo de exposição:</b></text></td>
					</tr>
					<tr>
						<td class="info res" id="tempoExposicao"></td>
					</tr>
				</table>
			</div>
			<div class="col-md-6">
				<table>
					<tr>
						<td style="width: 1000px"><text class="info"><b>15. Start Time / Hora início:</b></text></td>
					</tr>
					<tr>
						<td class="info" id="horaInicio"></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<table>
					<tr>
						<td style="width: 1000px"><text class="info"><b>24. Place of issue / Local de Emissão:</b></text></td>
					</tr>
					<tr>
						<td class="info res" id="localTratamento">CARMO DE MINAS - MG / BRASIL</td>
					</tr>
				</table>
			</div>
			<div class="col-md-6">
				<table>
					<tr>
						<td style="width: 1000px"><text class="info"><b>17. End Time / Hora Término:</b></text></td>
					</tr>
					<tr>
						<td class="info" id="horaFim"></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<table>
					<tr>
						<td style="width: 1000px"><text class="info"><b>18. Temperature / Temperatura:</b></text></td>
					</tr>
					<tr>
						<td class="info" id="temperatura"></td>
					</tr>
				</table>
			</div>
			<div class="col-md-6">
				<table>
					<tr>
						<td style="width: 1000px"><text class="info"><b>25. Issue date / Data de emissão:</b></text></td>
					</tr>
					<tr>
						<td class="info" id="dataEmissao"></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<table>
					<tr>
						<td style="width: 1000px"><text class="info"><b>Remarks / Observaçoes:</b></text></td>
					</tr>
					<tr>
						<td class="info res"><span id="invoice"></span>- ONLY THE WOODEN CREATES (PALLETS) HAVE BEEN TRATED</td>
					</tr>
					<tr>
						<td class="info" id="obs"></td>
					</tr>
					<tr>
						<td><img src="{{ asset('img/carimbo.png') }}"></td>
					</tr>
				</table>
			</div>
			<div class="col-md-6">
				<br>
				<table>
					<tr style="text-align: center">
						<td><img src="{{ asset('img/campo.png') }}"></td>
					</tr>
					<tr style="text-align: center;">
						<td style="width: 1000px"><b class="info">26.<text class="info res" id="engenheiro"></text></b></td>
					</tr>
					<tr style="text-align: center;">
						<td class="info res" id="formacao"></td>
					</tr>
					<tr style="text-align: center;">
						<td class="info" id="crea"></td>
					</tr>
				</table>
			</div>
		</div>
    </section>
</body>
</html>


  
