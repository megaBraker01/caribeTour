<?php
require_once '../../config.php';
require_once "../../AutoLoader/autoLoader.php";


$formEdit = false;


$productoC = new ProductoController;
$filter = [
	['idProducto', '=', $_GET['idProducto']]
];
$producto = $productoC->select($filter)[0];

// creamos el fomulario
$form = new Form;
$fieldSet = new Fieldset();

// campos del form que serán readonly siempre
$fieldsReadOnly = ['idProducto', 'fechaAlta', 'fechaUpdate'];
$fieldsTypeTextarear = ['descripcion', 'itinerario', 'incluye', 'metaDescripcion', 'metaKeyWords'];
$fieldTypeSelect = ['idCategoria', 'idTipo'];
$categoriaOption = [11 => 'republica Dominicana', 3 => 'cuba', 4 => 'mexico'];
//$categoriaOption = ['republica Dominicana', 'cuba', 'mexico'];
$fieldSet = [];
$fields = [];
foreach($producto->getAllParams(false, false) as $key => $val){
	$field = new Field($key);
	$field->showLabel()->setClass('form-control')->setValue($val);

	if(in_array($key, $fieldsReadOnly) or $formEdit){
		$field->setReadonly();
	}

	if(in_array($key, $fieldsTypeTextarear)){
		$field->setType('textarea');
	}

	if(in_array($key, $fieldTypeSelect)){
		$field->setType('select');
		$field->setOptions($categoriaOption);
	}

	$fields[] = $field;
}

$form->setFields($fields);
$show = $form->render();
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Blank Page - Ace Admin</title>

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<?php include_once("includes/baselink.php"); ?>

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="css/jquery-ui.custom.min.css" />
		<link rel="stylesheet" href="css/chosen.min.css" />
		<link rel="stylesheet" href="css/bootstrap-datepicker3.min.css" />
		<link rel="stylesheet" href="css/bootstrap-timepicker.min.css" />
		<link rel="stylesheet" href="css/daterangepicker.min.css" />
		<link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css" />
		<link rel="stylesheet" href="css/bootstrap-colorpicker.min.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="css/ace-skins.min.css" />
		<link rel="stylesheet" href="css/ace-rtl.min.css" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="js/ace-extra.min.js"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="js/html5shiv.min.js"></script>
		<script src="js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="no-skin">
		<?php require_once 'includes/navbar.php' ?>

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<?php require_once 'includes/sidebar.php' ?>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Inicio</a>
							</li>

							<li>
								<a href="#">Other Pages</a>
							</li>
							<li class="active">Blank Page</li>
						</ul><!-- /.breadcrumb -->

						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Buscar..." class=" nav-search-input " id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div><!-- /.nav-search -->

					</div>

					<div class="page-content">
						<?php require_once 'includes/ace-setting.php' ?>

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<div class="row">
									<div class="col-sm-offset-1 col-sm-10">
										

									

										
										<div class="">
											<h3 class="header smaller lighter blue">Datos del Producto</h3>



											<?php
											//var_dump($show);
											echo $show;
											?>


											<!--
											<form id="form1">
												<fieldset class='col-xs-6'  disabled>
													<div class='form-group'>
														<label for='nombre'>nombre:</label>
														<input name='nombre' id='nombre' class='form-control' value="Vik arena blanca"/>
													</div>
													<div class='form-group'>
														<label for='apellidos'>apellidos:</label>
														<input name='apellidos' id='apellidos' class='form-control'/>
													</div>
													<div class='form-group'>
														<label for='tel'>tel:</label>
														<input name='tel' id='tel' class='form-control'/>
													</div>
												</fieldset>
												<fieldset class='col-xs-6' >
													<div class='form-group'>
														<label for='nombre'>nombre:</label>
														<input name='nombre' type='text' id='nombre2' class='form-control'/>
													</div>
													<div class='form-group'>
														<label for='apellidos'>apellidos:</label>
														<input name='apellidos' type='text' id='apellidos2' class='form-control'/>
													</div>
													<div class='form-group'>
														<label for='tel'>tel:</label>
														<input name='tel' type='text' id='tel2' class='form-control'/>
													</div>
												</fieldset>
												<div class="clearfix form-actions">
													<div class="col-md-offset-3 col-md-9">

														<button id="submitForm" class="btn btn-info" type="button" onclick="submitform()">
															<i class="ace-icon fa fa-check bigger-110"></i>
															Aceptar
														</button>

														&nbsp; &nbsp; &nbsp;
														<button class="btn" type="reset">
															<i class="ace-icon fa fa-undo bigger-110"></i>
															Borrar Todo
														</button>
													</div>
												</div>
											</form>

										</div>
										-->
										
										<!--
										<form class="form-horizontal" role="form" id="form1" name="form1">

											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right" for="nombre">Nombre</label>
												<div class="col-sm-9">
													<input class="col-xs-10 col-sm-5" type="text" id="nombre" placeholder="Nombre"/>
												</div>												
											</div>

											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right" for="email">Email</label>
												<div class="col-sm-9">
													<input class="col-xs-10 col-sm-5" type="text" id="email" placeholder="Email"/>
												</div>												
											</div>

											<div class="clearfix form-actions">
												<div class="col-md-offset-3 col-md-9">

													<button id="submitForm" class="btn btn-info" type="button" onclick="submitform()">
														<i class="ace-icon fa fa-check bigger-110"></i>
														Aceptar
													</button>

													&nbsp; &nbsp; &nbsp;
													<button class="btn" type="reset">
														<i class="ace-icon fa fa-undo bigger-110"></i>
														Borrar Todo
													</button>
												</div>
											</div>

										</form>
										-->
									</div>
								</div>



								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<?php require_once 'includes/footer.php' ?>

			<?php require_once 'includes/btn-scroll-up.php' ?>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="js/jquery-2.1.4.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
		<script src="js/jquery-1.11.3.min.js"></script>
		<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->

		<!-- ace scripts -->
		<script src="js/ace-elements.min.js"></script>
		<script src="js/ace.min.js"></script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			function submitform()
			{
				$('#submitForm').addClass('disabled');
				var theForm = document.forms['form1'];
				if (!theForm) {
								theForm = document.form1;
				}
				theForm.submit();
			}
		</script> 
	</body>
</html>
