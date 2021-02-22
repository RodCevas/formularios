<?php
require("../../../../../recursos/php/constants.inc");
require("../../../../../recursos/php/funciones.php");
require("../../funciones_ti.php");
require('../../conecta_sap.php');

$new_postg = conectabdpgsql(BD_SERVIDOR_POSTGES, BD_PORT_POSTGES, BD_NOM_POSTGES, BD_USUARI_POSTGES, BD_CLAU_POSTGES, 1);	//Nuevo Prostgres

$usuario = str_replace("@BSA.ES", '', $_SERVER['REMOTE_USER']);
$titulo_web 	= "Sol·licitud de Dades a Tècnologies de la Informació";
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
</head>

<body>
	<div class="container-fluid">
		<?php require('../../cabecera.php'); ?>

		<form>

			<div class="row bg-light m-5 p-5 rounded">
				<div class="col-lg-2 d-flex justify-content-center align-items-center">
					<h6>Hola!</h6>
				</div>
				<div class="col-lg-4">
					<input type="text" class="form-control" id="nom-cognom" placeholder="Nom_Cognom1_Cognom2" value="<?php echo $nom_usu . " " . $cognom_usu ?>" disabled>
					<input type="email" class="form-control" id="email" placeholder="usuari@bsa.cat" value="<?php echo $usuario; ?>@bsa.cat" disabled>
				</div>
				<div class="col-lg-6 d-flex align-items-center">
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="" id="usuari" onclick=modifica_usuari()>
						<label class="form-check-label" for="usuari">
							Si no ets la persona correcta, si us plau, fes click aquí
						</label>
					</div>
				</div>

				<div class="col-lg-2 d-flex justify-content-center align-items-center mt-3">
					<h6>Telef./Ext *</h6>
				</div>
				<div class="col-lg-4 mt-3">
					<input type="tel" class="form-control" id="tel" placeholder="Telef./Ext" minlength="5" maxlength="9">
				</div>
				<div class="col-lg-6 d-flex align-items-center mt-3">
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="sollicitudExterna" id="solExt">
						<label class="form-check-label" for="solExt">
							Si és una sol·licitud externa, si us plau, fes click aquí
						</label>
					</div>
				</div>
			</div>

			<div class="row bg-light m-5 p-5 rounded">

				<div class="col-lg-12 text-center">
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="inlineRadioOptions" id="gestioInterna" value="gestioInterna" onclick="mostrarOcultar()">
						<label class="form-check-label" for="gestioInterna">
							<h6>Gestió Interna</h6>
						</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="inlineRadioOptions" id="recerca" value="recerca" onclick="mostrarOcultar()">
						<label class="form-check-label" for="recerca">
							<h6>Recerca</h6>
						</label>
					</div>
				</div>
			</div>

			<div class="row bg-light m-5 p-5 rounded mostrar d-none">
				<div class="col-lg-12 fw-bold text-danger text-center recerca d-none">“Abans de cursar aquesta sol·licitud, recorda que cal haver presentat el protocol d'estudi al Comitè de Recerca”</div>
				<div class="col-lg-12">
					<div class="row my-5">
						<div class="col-lg-2 d-flex justify-content-center align-items-center">
							<h6>Tria el centre *</h6>
						</div>
						<div class="col-lg-4">
							<select class="form-select" aria-label="Default select example">
								<option value="" selected hidden>Centre</option>
								<?php
										for ($i=1;$i<count($centres_SAP);$i++){
											echo "<option value='".$centres_SAP[$i]["CMB_UP"]."'>".$centres_SAP[$i]["DESCRIPCION"]."</option>";
										}
									?>
							</select>
						</div>

						<div class="col-lg-2 d-flex justify-content-center align-items-center">
							<h6 class="gestioInterna d-none">Tria el tipus de justificació *</h6>
							<h6 class="recerca d-none">Per *</h6>
						</div>
						<div class="col-lg-4">
							<select class="form-select gestioInterna d-none" aria-label="Default select example">
								<option value="" selected hidden>Justificació</option>
								<option value="Gestió_interna_del_Servei_Unitat">Gestió interna del Servei / Unitat</option>
								<option value="Pla_de_Salut_o_similars">Pla de Salut o similars</option>
								<option value="Resposta_a_objectius">Resposta a objectius</option>
								<option value="IQF">IQF</option>
								<option value="Altres">Altres</option>
							</select>
							<select class="form-select recerca d-none" aria-label="Default select example">
								<option value="" selected hidden>Justificació</option>
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
							<select class="form-select" aria-label="Default select example">
								<option value="" selected hidden>Servei</option>
								<?php
										for ($i=1;$i<count($serveis_SAP);$i++){
											echo "<option value='".$serveis_SAP[$i]["ORGID"]."'>".$serveis_SAP[$i]["ORGNA"]."</option>";
										}
									?>
							</select>
						</div>
						<div class="col-lg-2 d-flex justify-content-center align-items-center">
							<h6>Periodicitat *</h6>
						</div>
						<div class="col-lg-4">
							<select class="form-select" aria-label="Default select example">
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

				<div class="col-lg-12 my-3 recerca d-none">
					<div class="row">
						<div class="col-lg-4 d-flex justify-content-center align-items-center">
							<label for="publicar" class="form-label">
								<h6>A on ho penses publicar? *</h6>
							</label>
						</div>
						<div class="col-lg-8">
							<textarea class="form-control" id="publicar" rows="1"></textarea>
						</div>
					</div>
				</div>

				<div class="col-lg-12 my-3 mostrar d-none">
					<div class="row">
						<div class="col-lg-12 text-center my-3">
							<h6>Especifica de quina aplicació necessites les dades. Poden haver-hi múltiples seleccions. *</h6>
						</div>
						<div class="row d-flex justify-content-center align-items-center my-3">
							<div class="col-md-2 form-check">
								<input class="form-check-input" type="checkbox" value="FormularisWeb" id="FormularisWeb">
								<label class="form-check-label" for="FormularisWeb">
									Formularis web
								</label>
							</div>
							<div class="col-md-2 form-check">
								<input class="form-check-input" type="checkbox" value="gesdohc" id="gesdohc">
								<label class="form-check-label" for="gesdohc">
									Gesdohc
								</label>
							</div>
							<div class="col-md-2 form-check">
								<input class="form-check-input" type="checkbox" value="ecap" id="ecap">
								<label class="form-check-label" for="ecap">
									Ecap
								</label>
							</div>
							<div class="col-md-2 form-check">
								<input class="form-check-input" type="checkbox" value="tesis" id="tesis">
								<label class="form-check-label" for="tesis">
									Tesis
								</label>
							</div>
							<div class="col-md-2 form-check">
								<input class="form-check-input" type="checkbox" value="omi" id="omi">
								<label class="form-check-label" for="omi">
									Omi
								</label>
							</div>
						</div>
						<div class="row d-flex justify-content-center align-items-center my-3">
							<div class="col-md-2 form-check">
								<input class="form-check-input" type="checkbox" value="silicon" id="silicon">
								<label class="form-check-label" for="silicon">
									Silicon
								</label>
							</div>
							<div class="col-md-2 form-check">
								<input class="form-check-input" type="checkbox" value="taonet" id="taonet">
								<label class="form-check-label" for="taonet">
									Taonet
								</label>
							</div>
							<div class="col-md-2 form-check">
								<input class="form-check-input" type="checkbox" value="sisdi" id="sisdi">
								<label class="form-check-label" for="sisdi">
									Sisdi
								</label>
							</div>
							<div class="col-md-2 form-check">
								<input class="form-check-input" type="checkbox" value="sap" id="sap">
								<label class="form-check-label" for="sap">
									SAP
								</label>
							</div>
							<div class="col-md-2 form-check">
								<input class="form-check-input" type="checkbox" value="altres" id="altres">
								<label class="form-check-label" for="altres">
									Altres
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row bg-light m-5 p-5 rounded mostrar d-none">
				<div class="col-lg-12 my-3">
					<label for="necessites" class="form-label">
						<h6>Indica'ns que necessites *</h6>
					</label>
					<textarea class="form-control" id="necessites" rows="1"></textarea>
				</div>
				<div class="col-lg-6 my-3">
					<label for="camps" class="form-label">
						<h6>Indica'ns quins camps necessites *</h6>
					</label>
					<textarea class="form-control" id="camps" rows="1"></textarea>
				</div>
				<div class="col-lg-6 my-3">
					<label for="filtres" class="form-label">
						<h6>Indica'ns quins filtres necessites *</h6>
					</label>
					<textarea class="form-control" id="filtres" rows="1"></textarea>
				</div>
				<div class="col-lg-6">
					<div class="row">
						<div class="col-lg-12 my-3">
							<p>Si ho necessites, fes una captura de pantalla, guarda-la en un arxiu i adjunta-la aquí</p>
						</div>
						<div class="col-lg-12 my-3">
							<input id="bfupload-b3" name="bfupload-b3[]" type="file" class="file" multiple data-show-upload="false" data-show-caption="true" data-msg-placeholder="Select {files} for upload...">
						</div>
					</div>
				</div>


				<div class="col-lg-6">
					<div class="row recerca d-none">
						<div class="col-lg-12 my-3">
							<label for="fecha">Data de termini per presentar el resum? *</label>
						</div>
						<div class="col-lg-12 my-3">
							<input type="date" id="fecha" name="fecha">
						</div>
					</div>
				</div>


			</div>

			<div class="row bg-light m-5 p-5 rounded">
				<div class="col-md-4 text-center">
					<button type="button" class="btn btn-danger px-4 m-2">Sortir</button>
				</div>
				<div class="col-md-4 text-center">
					<button type="button" class="btn btn-secondary px-4 m-2">Enrere</button>
				</div>
				<div class="col-md-4 text-center">
					<button type="button" class="btn btn-primary px-4 m-2">Continuar</button>
				</div>
			</div>

		</form>

	</div>





	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
	<script>
		function modifica_usuari() {
			if (document.getElementById("email").disabled == false) {
				document.getElementById("email").disabled = true;
			} else {
				document.getElementById("email").disabled = false
			}
			if (document.getElementById("nom-cognom").disabled == false) {
				document.getElementById("nom-cognom").disabled = true;
			} else {
				document.getElementById("nom-cognom").disabled = false
			}
		}

		function mostrarOcultar() {
			var checkBoxGestioInterna = document.getElementById("gestioInterna");
			var checkBoxRecerca = document.getElementById("recerca");
			var mostrar = document.querySelectorAll(".mostrar");
			var gestioInterna = document.querySelectorAll(".gestioInterna");
			var recerca = document.querySelectorAll(".recerca");



			if (checkBoxGestioInterna.checked) {
				mostrar.forEach((item, index) => {
					item.classList.remove("d-none")
				});
				gestioInterna.forEach((item, index) => {
					item.classList.remove("d-none")
				});
				recerca.forEach((item, index) => {
					item.classList.add("d-none")
				});
			}

			if (checkBoxRecerca.checked) {
				mostrar.forEach((item, index) => {
					item.classList.remove("d-none")
				});
				recerca.forEach((item, index) => {
					item.classList.remove("d-none")
				});
				gestioInterna.forEach((item, index) => {
					item.classList.add("d-none")
				});
			}
		}
	</script>
</body>
</script>

</html>