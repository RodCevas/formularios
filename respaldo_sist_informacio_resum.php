<?php
require("../../../../../recursos/php/constants.inc");
require("../../../../../recursos/php/funciones.php");
require("../../funciones_ti.php");
require('../../conecta_sap.php');

$new_postg = conectabdpgsql(BD_SERVIDOR_POSTGES, BD_PORT_POSTGES, BD_NOM_POSTGES, BD_USUARI_POSTGES, BD_CLAU_POSTGES, 1);	//Nuevo Prostgres

$usuario = str_replace("@BSA.ES", '', $_SERVER['REMOTE_USER']);
$titulo_web 	= "Sol·licitud de Dades a Tècnologies de la Informació";

$nomCognom = $_POST['nomCognom'];
$email = $_POST['email'];
$tel = $_POST['tel'];
$peticio = $_POST['peticio'];
$sollicitudExterna = $_POST['sollicitudExterna'];
$centre = $_POST['centre'];
$justificacio = $_POST['justificacio'];
$per = $_POST['per'];
$servei = $_POST['servei'];
$periodicitat = $_POST['periodicitat'];
$publicar = $_POST['publicar'];
$app = $_POST['app'];
$necessites = $_POST['necessites'];
$camps = $_POST['camps'];
$filtres = $_POST['filtres'];
/* $bfupload[] = $_POST['bfupload[]']; */
$fecha = $_POST['fecha'];
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
	</style>
</head>

<body>
	<div class="container-fluid">
		<?php require('../../cabecera.php'); ?>

		<div class="row bg-light m-5 p-5 rounded justify-content-around">
			<div class="col-lg-12 text-center">
				<h1 class="text-success">El Formulari s'ha Enviat Correctament.</h1>
			</div>



			<div class="col-lg-12 text-center my-4">
				<h6>Necessites fer una nova petició?</h6>
			</div>
			<div class="col-lg-4 text-center">
				<button class="btn btn-danger px-5" onclick="window.location='http://seradev.bsa.es/serveisgenerals/informatica/formulari_ti/menu.php'">No</button>
			</div>
			<div class="col-lg-4 text-center">
				<button class="btn btn-primary px-5" onclick="window.location='http://seradev.bsa.es/serveisgenerals/informatica/formulari_ti/usuari/si/sist_informacio.php'">Si</button>
			</div>
		</div>


	</div>





	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</script>

</html>