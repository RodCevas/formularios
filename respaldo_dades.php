<?php
require("../../../../../recursos/php/constants.inc");
require("../../../../../recursos/php/funciones.php");
require("../../funciones_ti.php");
require('../../conecta_sap.php');

$new_postg = conectabdpgsql(BD_SERVIDOR_POSTGES, BD_PORT_POSTGES, BD_NOM_POSTGES, BD_USUARI_POSTGES, BD_CLAU_POSTGES, 1);	//Nuevo Prostgres

$usuario = str_replace("@BSA.ES", '', $_SERVER['REMOTE_USER']);
$titulo_web 	= "Petició d'Dades a TI";
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<link href="../../../../recursos/css/formulari_ti.css" type='text/css' rel='stylesheet'>
	<title><?php echo $titulo_web; ?></title>
	<style>
		body {
			max-width: 800px;
			margin: 0 auto;
		}

		.invisible {
			visibility: hidden !important;
		}
	</style>
</head>

<body>
	<div class="container-fluid">
		<?php require('../../cabecera.php'); ?>

		<div id="resumen" class="row justify-content-center bg-light m-5 p-2 rounded d-none">
			<div class="col-8">
				<div class="row">
					<div class="col-4"><strong>Resum</strong>:</div>
					<div class="col-8"></div>
				</div>
				<div class="row">
					<div class="col-4">Nom Cognom1 Cognom2:</div>
					<div class="col-8">
						<p id="nomCognomPopulated"></p>
					</div>
				</div>
				<div class="row">
					<div class="col-4">Email:</div>
					<div class="col-8">
						<p id="emailPopulated"></p>
					</div>
				</div>
				<div class="row">
					<div class="col-4">Tel:</div>
					<div class="col-8">
						<p id="telPopulated"></p>
					</div>
				</div>
				<div class="row">
					<div class="col-4">Sollicitud Externa:</div>
					<div class="col-8">
						<p id="sollicitudExternaPopulated"></p>
					</div>
				</div>
				<div class="row">
					<div class="col-4">Petició:</div>
					<div class="col-8">
						<p id="peticioPopulated"></p>
					</div>
				</div>
				<div class="row">
					<div class="col-4">Centre:</div>
					<div class="col-8">
						<p id="centrePopulated"></p>
					</div>
				</div>
				<div class="row">
					<div class="col-4">Justificacio:</div>
					<div class="col-8">
						<p id="justificacioPopulated"></p>
					</div>
				</div>
				<div class="row">
					<div class="col-4">Per:</div>
					<div class="col-8">
						<p id="perPopulated"></p>
					</div>
				</div>
				<div class="row">
					<div class="col-4">Servei:</div>
					<div class="col-8">
						<p id="serveiPopulated"></p>
					</div>
				</div>
				<div class="row">
					<div class="col-4">Periodicitat:</div>
					<div class="col-8">
						<p id="periodicitatPopulated"></p>
					</div>
				</div>
				<div class="row">
					<div class="col-4">Publicar:</div>
					<div class="col-8">
						<p id="publicarPopulated"></p>
					</div>
				</div>
				<div class="row">
					<div class="col-4">Aplicació:</div>
					<div class="col-8">
						<p id="aplicacioPopulated"></p>
					</div>
				</div>
				<div class="row">
					<div class="col-4">Necessites:</div>
					<div class="col-8">
						<p id="necessitesPopulated"></p>
					</div>
				</div>
				<div class="row">
					<div class="col-4">Camps:</div>
					<div class="col-8">
						<p id="campsPopulated"></p>
					</div>
				</div>
				<div class="row">
					<div class="col-4">Fitxers:</div>
					<div class="col-8">
						<p id="filesPopulated"></p>
					</div>
				</div>
				<div class="row">
					<div class="col-4">Filtres:</div>
					<div class="col-8">
						<p id="filtresPopulated"></p>
					</div>
				</div>
				<div class="row">
					<div class="col-4">Fecha:</div>
					<div class="col-8">
						<p id="fechaPopulated"></p>
					</div>
				</div>
			</div>
		</div>

		<div class="toast fixed-top mx-auto my-5 bg-danger text-light" role="alert" aria-live="assertive" aria-atomic="true">


			<img class="img-fluid m-3 float-end" data-bs-dismiss="toast" aria-label="Close" src="../../../../recursos/imagenes/blade_white.png" style='width:20px;cursor:pointer;'>

			<div class="toast-body">
				<p id="nomCognomError" class="d-none">Falta omplir el camp 'Nom Cognom'</p>
				<p id="emailError" class="d-none">Si us plau ingressi un correu electrònic vàlid.</p>
				<p id="telError" class="d-none">El número de telèfon ha de ser de 5 o 9 dígits.</p>
				<p id="centreError" class="d-none">Falta omplir el camp 'Tria el Centre'</p>
				<p id="serveiError" class="d-none">Falta omplir el camp 'Tria el servei'</p>
				<p id="justificacioError" class="d-none">Falta omplir el camp 'Justificacio'</p>
				<p id="perError" class="d-none">Falta omplir el camp 'Per'</p>
				<p id="periodicitatError" class="d-none">Falta omplir el camp 'Periodicitat'</p>
				<p id="publicarError" class="d-none">Falta omplir el camp 'Publicar'</p>
				<p id="aplicacioError" class="d-none">Falta omplir el camp 'Aplicació'</p>
				<p id="necessitesError" class="d-none">Falta omplir el camp 'Necessites'</p>
				<p id="campsError" class="d-none">Falta omplir el camp 'Camps'</p>
				<p id="filtresError" class="d-none">Falta omplir el camp 'Filtres'</p>
				<p id="fechaError" class="d-none">Falta omplir el camp 'Fecha'</p>
			</div>

		</div>



		<form method="POST" action="sist_informacio_exit.php" id="sistInformacioForm">
			<div id="ocultarForm">

				<!-- 				<div id="alert-error" class="row my-5 justify-content-center d-none">
					<div class="col-lg-8 p-3 fw-bold text-center bg-danger rounded">
						Si us plau ompli els camps obligatoris.
					</div>
				</div> -->

				<div class="row bg-light m-5 p-3 rounded">
					<div class="col-lg-2 d-flex justify-content-center align-items-center">
						<h6>Hola!</h6>
					</div>
					<div class="col-lg-4">
						<input name="nomCognom" type="text" class="form-control" id="nomCognom" placeholder="Nom_Cognom1_Cognom2" value="<?php echo $nom_usu . " " . $cognom_usu ?>" disabled>
						<div class="input-group">
							<input name="email" type="email" class="form-control" id="email" placeholder="usuari@bsa.cat" value="<?php echo $usuario; ?>" aria-describedby="basic-addon2" disabled>
							<span class="input-group-text" id="basic-addon2">@bsa.cat</span>
						</div>
					</div>
					<div class="col-lg-6 d-flex align-items-center">
						<div class="form-check d-flex">
							<input class="option-input checkbox" type="checkbox" value="" id="usuari" onclick=modifica_usuari()>
							<label class="form-check-label" for="usuari">
								Si no ets la persona correcta, si us plau, fes click aquí
							</label>
						</div>
					</div>

					<div class="col-lg-2 d-flex justify-content-center align-items-center mt-3">
						<h6>Telef./Ext *</h6>
					</div>
					<div class="col-lg-4 mt-3">
						<input name="tel" type="number" class="form-control" id="tel" placeholder="Telef./Ext" onKeyPress="if(this.value.length==9) return false;">
					</div>
					<div class="col-lg-6 d-flex align-items-center mt-3">
						<div class="form-check d-flex">
							<input name="sollicitudExterna" class="option-input checkbox" type="checkbox" value="sollicitudExterna" id="sollicitudExterna">
							<label class="form-check-label" for="solExt">
								Si és una sol·licitud externa, si us plau, fes click aquí
							</label>
						</div>
					</div>
				</div>

				<div class="row bg-light m-5 p-3 rounded">
					<div class="col-lg-12 text-center">
						<div class="form-check form-check-inline">
							<input class="option-input radio peticio" type="radio" name="peticio" id="gestioInterna" value="gestioInterna" onclick="mostrarOcultar()">
							<label class="form-check-label" for="gestioInterna">
								<h6>Gestió Interna</h6>
							</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="option-input radio peticio" type="radio" name="peticio" id="recerca" value="recerca" onclick="mostrarOcultar()">
							<label class="form-check-label" for="recerca">
								<h6>Recerca</h6>
							</label>
						</div>
					</div>
				</div>

				<div class="row bg-light m-5 p-3 rounded mostrar d-none invisible">
					<div class="col-lg-12 fw-bold text-danger text-center recerca d-none invisible">“Abans de cursar aquesta sol·licitud, recorda que cal haver presentat el protocol d'estudi al Comitè de Recerca”</div>
					<div class="col-lg-12">
						<div class="row my-5">
							<div class="col-lg-2 d-flex justify-content-center align-items-center">
								<h6>Tria el centre *</h6>
							</div>
							<div class="col-lg-4 align-items-center">
								<select name="centre" id="centre" class="select" style="width: 100%;" aria-label="Default select example">
									<option value="" selected hidden>Centre</option>
									<?php
									for ($i = 1; $i < count($centres_SAP); $i++) {
										echo "<option value='" . $centres_SAP[$i]["CMB_UP"] . "'>" . $centres_SAP[$i]["DESCRIPCION"] . "</option>";
									}
									?>
								</select>
							</div>

							<div class="col-lg-2 d-flex justify-content-center align-items-center">
								<h6 class="gestioInterna d-none">Tria el tipus de justificació *</h6>
								<h6 class="recerca d-none">Per *</h6>
							</div>
							<div class="col-lg-4">
								<select name="justificacio" id="justificacio" class="select gestioInterna d-none invisible" aria-label="Default select example" style="width: 100%;">
									<option value="" selected hidden>Justificació</option>
									<option value="Gestió_interna_del_Servei_Unitat">Gestió interna del Servei / Unitat</option>
									<option value="Pla_de_Salut_o_similars">Pla de Salut o similars</option>
									<option value="Resposta_a_objectius">Resposta a objectius</option>
									<option value="IQF">IQF</option>
									<option value="Altres">Altres</option>
								</select>
								<select name="per" id="per" class="select recerca d-none invisible" aria-label="Default select example" style="width: 100%;">
									<option value="" selected hidden>Per</option>
									<option value="Publicació_a_congressos">Publicació a congressos</option>
									<option value="Publicació_a_revistes">Publicació a revistes</option>
									<option value="Per_documentació">Per documentació (tesis, tesines)</option>
								</select>
							</div>

						</div>
						<div class="row my-5">
							<div class="col-lg-2 d-flex justify-content-center align-items-center">
								<h6>Tria el servei *</h6>
							</div>
							<div class="col-lg-4">
								<select name="servei" id="servei" class="select" aria-label="Default select example" style="width: 100%;">
									<option value="" selected hidden>Servei</option>
									<?php
									for ($i = 1; $i < count($serveis_SAP); $i++) {
										echo "<option value='" . $serveis_SAP[$i]["ORGID"] . "'>" . $serveis_SAP[$i]["ORGNA"] . "</option>";
									}
									?>
								</select>
							</div>
							<div class="col-lg-2 d-flex justify-content-center align-items-center">
								<h6>Periodicitat *</h6>
							</div>
							<div class="col-lg-4">
								<select name="periodicitat" id="periodicitat" class="select" aria-label="Default select example" style="width: 100%;">
									<option value="" selected hidden>Periodicitat</option>
									<option value="Només_ara">Només ara</option>
									<option value="Setmanal">Setmanal</option>
									<option value="Quinzenal">Quinzenal</option>
									<option value="Mensual">Mensual</option>
									<option value="Trimestral">Trimestral</option>
									<option value="Quadrimestral">Quadrimestral</option>
									<option value="Semestral">Semestral</option>
									<option value="Anual">Anual</option>
								</select>
							</div>
						</div>
					</div>

					<div class="col-lg-12 my-3 recerca d-none invisible">
						<div class="row">
							<div class="col-lg-4 d-flex justify-content-center align-items-center">
								<label for="publicar" class="form-label">
									<h6>A on ho penses publicar? *</h6>
								</label>
							</div>
							<div class="col-lg-8">
								<textarea name="publicar" class="form-control" id="publicar" rows="1"></textarea>
							</div>
						</div>
					</div>

					<div class="col-lg-12 my-3 mostrar d-none invisible">
						<div class="row">
							<div class="col-lg-12 text-center my-3">
								<h6>Especifica de quina aplicació necessites les dades. Poden haver-hi múltiples seleccions. *</h6>
							</div>
							<div class="row my-3">
								<div class="col-md-3 text-center d-flex my-2">
									<input name="app[]" class="option-input checkbox app" type="checkbox" value="FormularisWeb" id="FormularisWeb">
									<label class="form-check-label" for="FormularisWeb">
										Formularis web
									</label>
								</div>
								<div class="col-md-3 text-center d-flex my-2">
									<input name="app[]" class="option-input checkbox app" type="checkbox" value="gesdohc" id="gesdohc">
									<label class="form-check-label" for="gesdohc">
										Gesdohc
									</label>
								</div>
								<div class="col-md-3 text-center d-flex my-2">
									<input name="app[]" class="option-input checkbox app" type="checkbox" value="ecap" id="ecap">
									<label class="form-check-label" for="ecap">
										Ecap
									</label>
								</div>
								<div class="col-md-3 text-center d-flex my-2">
									<input name="app[]" class="option-input checkbox app" type="checkbox" value="tesis" id="tesis">
									<label class="form-check-label" for="tesis">
										Tesis
									</label>
								</div>
							</div>
							<div class="row my-3">
								<div class="col-md-3 text-center d-flex my-2">
									<input name="app[]" class="option-input checkbox app" type="checkbox" value="omi" id="omi">
									<label class="form-check-label" for="omi">
										Omi
									</label>
								</div>

								<div class="col-md-3 text-center d-flex my-2">
									<input name="app[]" class="option-input checkbox app" type="checkbox" value="silicon" id="silicon">
									<label class="form-check-label" for="silicon">
										Silicon
									</label>
								</div>
								<div class="col-md-3 text-center d-flex my-2">
									<input name="app[]" class="option-input checkbox app" type="checkbox" value="taonet" id="taonet">
									<label class="form-check-label" for="taonet">
										Taonet
									</label>
								</div>
								<div class="col-md-3 text-center d-flex my-2">
									<input name="app[]" class="option-input checkbox app" type="checkbox" value="sisdi" id="sisdi">
									<label class="form-check-label" for="sisdi">
										Sisdi
									</label>
								</div>
							</div>
							<div class="row my-3">
								<div class="col-md-3 text-center d-flex my-2">
									<input name="app[]" class="option-input checkbox app" type="checkbox" value="sap" id="sap">
									<label class="form-check-label" for="sap">
										SAP
									</label>
								</div>
								<div class="col-md-3 text-center d-flex my-2">
									<input name="app[]" class="option-input checkbox app" type="checkbox" value="altres" id="altres">
									<label class="form-check-label" for="altres">
										Altres
									</label>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row bg-light m-5 p-3 rounded mostrar d-none invisible">
					<div class="col-lg-12 my-3">
						<label for="necessites" class="form-label">
							<h6>Indica'ns que necessites *</h6>
						</label>
						<textarea name="necessites" class="form-control" id="necessites" rows="1"></textarea>
					</div>
					<div class="col-lg-6 my-3">
						<label for="camps" class="form-label">
							<h6>Indica'ns quins camps necessites *</h6>
						</label>
						<textarea name="camps" class="form-control" id="camps" rows="1"></textarea>
					</div>
					<div class="col-lg-6 my-3">
						<label for="filtres" class="form-label">
							<h6>Indica'ns quins filtres necessites *</h6>
						</label>
						<textarea name="filtres" class="form-control" id="filtres" rows="1"></textarea>
					</div>
					<div class="col-lg-6">
						<div class="row">
							<div class="col-lg-12 my-3">
								<p>Si ho necessites, fes una captura de pantalla, guarda-la en un arxiu i adjunta-la aquí</p>
							</div>
							<div class="col-lg-12 my-3">
								<input id="bfupload" name="bfupload[]" type="file" class="file" multiple data-show-upload="false" data-show-caption="true" data-msg-placeholder="Select {files} for upload...">
							</div>
						</div>
					</div>


					<div class="col-lg-6">
						<div class="row recerca d-none invisible">
							<div class="col-lg-12 my-3">
								<label for="fecha">Data de termini per presentar el resum? *</label>
							</div>
							<div class="col-lg-12 my-3">
								<input type="date" id="fecha" name="fecha">
							</div>
						</div>
					</div>


				</div>
			</div>
			<div class="row bg-light m-5 p-3 rounded">
				<div class="col-md-4 text-center">
					<button type="button" class="btn btn-primary px-4 m-2" onclick="window.location='http://seradev.bsa.es/serveisgenerals/informatica/formulari_ti/menu.php'">Sortir</button>
				</div>
				<div class="col-md-4 text-center">
					<button id="enrereBtn" type="button" class="btn btn-primary px-4 m-2" onclick="javascript:window.history.back();">Enrere</button>
					<button id="editaBtn" type="button" class="btn btn-primary px-4 m-2 d-none" onclick="edita()">Edita</button>
				</div>
				<div class="col-md-4 text-center">
					<button id="continuarBtn" type="button" class="btn btn-primary px-4 m-2" onclick="validacion()">Continuar</button>
					<button id="enviarBtn" type="submit" class="btn btn-primary px-4 m-2 d-none">Enviar</button>
				</div>
			</div>

		</form>

	</div>





	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

	<script>
		//prevenir que se envie el formulario si se presiona enter
		document.querySelector('form').onkeypress = checkEnter;

		function checkEnter(e) {
			e = e || event;
			var txtArea = /textarea/i.test((e.target || e.srcElement).tagName);
			return txtArea || (e.keyCode || e.which || e.charCode || 0) !== 13;
		}

		var sistInformacioForm = document.getElementById("sistInformacioForm");

		var resumen = document.getElementById("resumen");
		var ocultarForm = document.getElementById("ocultarForm");

		// get msg errors		
		var nomCognomError = document.getElementById("nomCognomError");
		var emailError = document.getElementById("emailError");
		var telError = document.getElementById("telError");
		var centreError = document.getElementById("centreError");
		var serveiError = document.getElementById("serveiError");
		var justificacioError = document.getElementById("justificacioError");
		var perError = document.getElementById("perError");
		var periodicitatError = document.getElementById("periodicitatError");
		var publicarError = document.getElementById("publicarError");
		var aplicacioError = document.getElementById("aplicacioError");
		var necessitesError = document.getElementById("necessitesError");
		var campsError = document.getElementById("campsError");
		var filtresError = document.getElementById("filtresError");
		var fechaError = document.getElementById("fechaError");

		var nomCognom = document.getElementById("nomCognom");
		var email = document.getElementById("email");
		var sollicitudExterna = document.getElementById("sollicitudExterna");
		var gestioInterna = document.getElementById("gestioInterna");
		var recerca = document.getElementById("recerca");
		var tel = document.getElementById("tel");
		var centre = document.getElementById("centre");
		var justificacio = document.getElementById("justificacio");
		var per = document.getElementById("per");
		var servei = document.getElementById("servei");
		var periodicitat = document.getElementById("periodicitat");
		var publicar = document.getElementById("publicar");
		var necessites = document.getElementById("necessites");
		var camps = document.getElementById("camps");
		var bfupload = document.getElementById("bfupload");
		var filtres = document.getElementById("filtres");
		var fecha = document.getElementById("fecha");

		var peticio = document.querySelectorAll(".peticio");
		var peticioSelected;

		var app = document.querySelectorAll(".app");
		var appValueArray = [];

		var editaBtn = document.getElementById("editaBtn");
		var continuarBtn = document.getElementById("continuarBtn");
		var enviarBtn = document.getElementById("enviarBtn");
		var enrereBtn = document.getElementById("enrereBtn");

		function modifica_usuari() {
			if (document.getElementById("email").disabled == false) {
				document.getElementById("email").disabled = true;
			} else {
				document.getElementById("email").disabled = false
			}
			if (document.getElementById("nomCognom").disabled == false) {
				document.getElementById("nomCognom").disabled = true;
			} else {
				document.getElementById("nomCognom").disabled = false
			}
		}

		function mostrarOcultar() {
			var mostrarClass = document.querySelectorAll(".mostrar");
			var gestioInternaClass = document.querySelectorAll(".gestioInterna");
			var recercaClass = document.querySelectorAll(".recerca");

			if (gestioInterna.checked) {
				mostrarClass.forEach((item, index) => {
					item.classList.remove("d-none")
					item.classList.remove("invisible")
				});
				gestioInternaClass.forEach((item, index) => {
					item.classList.remove("d-none")
					item.classList.remove("invisible")
				});
				recercaClass.forEach((item, index) => {
					item.classList.add("d-none")
					item.classList.add("invisible")
				});
			}

			if (recerca.checked) {
				mostrarClass.forEach((item, index) => {
					item.classList.remove("d-none")
					item.classList.remove("invisible")
				});
				recercaClass.forEach((item, index) => {
					item.classList.remove("d-none")
					item.classList.remove("invisible")
				});
				gestioInternaClass.forEach((item, index) => {
					item.classList.add("d-none")
					item.classList.add("invisible")
				});
			}
		}

		function edita() {
			ocultarForm.classList.remove("d-none");
			resumen.classList.add("d-none");
			editaBtn.classList.add("d-none");
			enviarBtn.classList.add("d-none");
			ocultarForm.classList.remove("d-none");
			continuarBtn.classList.remove("d-none");
			enrereBtn.classList.remove("d-none");
		}




		var options = {
			animation: true,
			delay: 5000
		};
		var toastElList = [].slice.call(document.querySelectorAll('.toast'))
		var toastList = toastElList.map(function(toastEl) {
			return new bootstrap.Toast(toastEl, options)
		})





		//validacion formulario

		function validacion() {

			var telValidacio = tel.value.length < 5 || (tel.value.length > 5 && tel.value.length < 9) || tel.value.length > 9;

			peticio.forEach((item) => {
				if (item.checked) {
					peticioSelected = item.value;
					return;
				}
			});

			if (!nomCognom.value) {
				nomCognomError.classList.remove("d-none");
				toastList[0].show();
				window.scrollTo({
					top: 0,
					behavior: 'smooth'
				});
			} else {
				nomCognomError.classList.add("d-none");
				toastList[0].hide();
			}

			if (!email.value) {
				emailError.classList.remove("d-none");
				toastList[0].show();
				window.scrollTo({
					top: 0,
					behavior: 'smooth'
				});
			} else {
				emailError.classList.add("d-none");
				toastList[0].hide();
			}

			if (telValidacio) {
				telError.classList.remove("d-none");
				toastList[0].show();
				window.scrollTo({
					top: 0,
					behavior: 'smooth'
				});
			} else {
				telError.classList.add("d-none");
				toastList[0].hide();
			}

			if (!centre.value) {
				centreError.classList.remove("d-none");
				toastList[0].show();
				window.scrollTo({
					top: 0,
					behavior: 'smooth'
				});
			} else {
				centreError.classList.add("d-none");
				toastList[0].hide();
			}

			if (!servei.value) {
				serveiError.classList.remove("d-none");
				toastList[0].show();
				window.scrollTo({
					top: 0,
					behavior: 'smooth'
				});
			} else {
				serveiError.classList.add("d-none");
				toastList[0].hide();
			}

			if (!periodicitat.value) {
				periodicitatError.classList.remove("d-none");
				toastList[0].show();
				window.scrollTo({
					top: 0,
					behavior: 'smooth'
				});
			} else {
				periodicitatError.classList.add("d-none");
				toastList[0].hide();
			}

			if (!necessites.value) {
				necessitesError.classList.remove("d-none");
				toastList[0].show();
				window.scrollTo({
					top: 0,
					behavior: 'smooth'
				});
			} else {
				necessitesError.classList.add("d-none");
				toastList[0].hide();
			}

			if (!camps.value) {
				campsError.classList.remove("d-none");
				toastList[0].show();
				window.scrollTo({
					top: 0,
					behavior: 'smooth'
				});
			} else {
				campsError.classList.add("d-none");
				toastList[0].hide();
			}

			if (!filtres.value) {
				filtresError.classList.remove("d-none");
				toastList[0].show();
				window.scrollTo({
					top: 0,
					behavior: 'smooth'
				});
			} else {
				filtresError.classList.add("d-none");
				toastList[0].hide();
			}

			//push to array checked values aplicació
			app.forEach((item) => {
				if (item.checked) {					
					appValueArray.push(item.value);					
					
				} 
			});

			//validacion aplicació
			var appValid = 0;
			for (j = 0; j < app.length; j++) {
				if (app.item(j).checked == false) {
					appValid++;
				}
			}
			if (appValid == app.length) {
				aplicacioError.classList.remove("d-none");
				toastList[0].show();
				window.scrollTo({
					top: 0,
					behavior: 'smooth'
				});
				return false;
			} else {
				aplicacioError.classList.add("d-none");
				toastList[0].hide();
			}

			if (gestioInterna.checked) {
				if (!justificacio.value) {
					justificacioError.classList.remove("d-none");
					toastList[0].show();
					window.scrollTo({
						top: 0,
						behavior: 'smooth'
					});
				} else {
					justificacioError.classList.add("d-none");
					toastList[0].hide();
				}

				if (email.value && nomCognom.value && !telValidacio && centre.value && servei.value && periodicitat.value && necessites.value && camps.value && filtres.value && justificacio.value && appValid > 0) {
					resumen.classList.remove("d-none");
					editaBtn.classList.remove("d-none");
					enviarBtn.classList.remove("d-none");
					ocultarForm.classList.add("d-none");
					continuarBtn.classList.add("d-none");
					enrereBtn.classList.add("d-none");
					toastList[0].hide();
				}
			}
			if (recerca.checked) {
				if (!per.value) {
					perError.classList.remove("d-none");
					toastList[0].show();
					window.scrollTo({
						top: 0,
						behavior: 'smooth'
					});
				} else {
					perError.classList.add("d-none");
					toastList[0].hide();
				}

				if (!publicar.value) {
					publicarError.classList.remove("d-none");
					toastList[0].show();
					window.scrollTo({
						top: 0,
						behavior: 'smooth'
					});
				} else {
					publicarError.classList.add("d-none");
					toastList[0].hide();
				}

				if (!fecha.value) {
					fechaError.classList.remove("d-none");
					toastList[0].show();
					window.scrollTo({
						top: 0,
						behavior: 'smooth'
					});
				} else {
					fechaError.classList.add("d-none");
					toastList[0].hide();
				}

				if (email.value && nomCognom.value && !telValidacio && centre.value && servei.value && periodicitat.value && necessites.value && camps.value && filtres.value && per.value && publicar.value && fecha.value && appValid > 0) {
					resumen.classList.remove("d-none");
					editaBtn.classList.remove("d-none");
					enviarBtn.classList.remove("d-none");
					ocultarForm.classList.add("d-none");
					continuarBtn.classList.add("d-none");
					enrereBtn.classList.add("d-none");
					toastList[0].hide();
				}
			}

			// resumen

			var txtFiles = "";

			if ('files' in bfupload) {
				for (var i = 0; i < bfupload.files.length; i++) {
					var file = bfupload.files[i];
					if ('name' in file) {
						txtFiles += "name: " + file.name + " ";
					}
					if ('size' in file) {
						txtFiles += "size: " + file.size + " bytes <br>";
					}
				}
			}


			document.getElementById("nomCognomPopulated").innerHTML = nomCognom.value ? nomCognom.value : 'N/A';
			document.getElementById("emailPopulated").innerHTML = email.value ? email.value : 'N/A';
			document.getElementById("telPopulated").innerHTML = tel.value ? tel.value : 'N/A';
			document.getElementById("peticioPopulated").innerHTML = peticioSelected ? peticioSelected : 'N/A';
			document.getElementById("sollicitudExternaPopulated").innerHTML = sollicitudExterna.checked ? 'Si' : 'No';
			document.getElementById("centrePopulated").innerHTML = centre.value ? centre.value : 'N/A';
			document.getElementById("justificacioPopulated").innerHTML = justificacio.value ? justificacio.value : 'N/A';
			document.getElementById("perPopulated").innerHTML = per.value ? per.value : 'N/A';
			document.getElementById("serveiPopulated").innerHTML = servei.value ? servei.value : 'N/A';
			document.getElementById("periodicitatPopulated").innerHTML = periodicitat.value ? periodicitat.value : 'N/A';
			document.getElementById("publicarPopulated").innerHTML = publicar.value ? publicar.value : 'N/A';
			document.getElementById("aplicacioPopulated").innerHTML = appValueArray ? appValueArray.splice(0, appValueArray.length, appValueArray) : 'N/A';
			document.getElementById("necessitesPopulated").innerHTML = necessites.value ? necessites.value : 'N/A';
			document.getElementById("campsPopulated").innerHTML = camps.value ? camps.value : 'N/A';
			document.getElementById("filtresPopulated").innerHTML = filtres.value ? filtres.value : 'N/A';
			document.getElementById("fechaPopulated").innerHTML = fecha.value ? fecha.value : 'N/A';
			document.getElementById("filesPopulated").innerHTML = txtFiles ? txtFiles : 'N/A';



		}
	</script>
</body>
</script>

</html>