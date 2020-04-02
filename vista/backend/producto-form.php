<?php
require_once '../../config.php';
require_once "../../AutoLoader/autoLoader.php";


$readOnly = true;
if(isset($_GET['action']) and 'editar' == $_GET['action']){
	$readOnly = false;
}

$show = $error = '';

try {
	if(isset($_GET['idProducto']) and '' != $_GET['idProducto']){
		$productoC = new ProductoController;
		$filter = [
			['idProducto', '=', $_GET['idProducto']]
		];
	
		// si hay producto con el id indicado, entonces realizamos la accion
		if($producto = @$productoC->select($filter)[0]){

			// creamos los datos a mostrar
			$fieldValues = $producto->getAllParams(false, false); // usar array_merge para unir valores al formulario
			
			$categoriaC = new CategoriaController;
			$categoriaOptions = [];
			foreach($categoriaC->select([], [['idCategoriaPadre']]) as $categoria){
				$categoriaOptions[$categoria->getIdCategoria()] = $categoria->getNombre();
			}

			$formHandler = new FormHandler('productos', $readOnly);
			$formHandler->setValues($fieldValues);
			$formHandler->setFieldsReadOnly(['idProducto', 'fechaAlta', 'fechaUpdate']);
			$formHandler->setFieldsTypeSelect(['idCategoria', 'idTipo']);
			$formHandler->setFieldsTypeImgFile(['imagen']);
			$formHandler->setFieldOptions('idCategoria', $categoriaOptions);
			$formHandler->setFieldOptions('idTipo', ['tour', 'vuelo', 3 => 'excursion']);
			$formHandler->setFieldIntoFieldset();
			$show = $formHandler->renderForm();
	
			// editamos los datos del producto
			$location = "producto-form.php?idProducto={$producto->getIdProducto()}";
			if(isset($_POST['Guardar']) and 'Guardar' == $_POST['Guardar']){
				// seteamos los valores del producto y lo guardamos en bbdd
				$producto->setAllParams($_POST);
				$productoC->update($producto);

				// verificamos si se ha subido una imagen y la guardamos
				$nombreImg = $producto->getSlug();
				$destinoImg = "../frontend/img/";
				if(isset($_FILES['imagen']) and 0 == $_FILES['imagen']['error']){
					$imgHandler = new ImgHandler($_FILES['imagen']);
					$imgHandler->uploadImage($destinoImg, $nombreImg);
				}				
				//$imgHandler->cropAndUploadImage($destinoImg, $nombre_archivo, 550, 413);
	
				$location .= "&action=ver";
				header(sprintf("Location: %s", $location));
			} elseif(isset($_POST['Editar']) and 'Editar' == $_POST['Editar']){
				$location .= "&action=editar";
				header(sprintf("Location: %s", $location));
			}
		}
		
	}
} catch (Exception $e){
	$error = '
	<div class="alert alert-warning" role="alert">
		<h4 class="alert-heading">Ups!</h4>
		' . $e->getMessage() . '
	</div>';
}
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
										<h3 class="header smaller lighter blue">Datos del Producto</h3>

										<?php
										echo $error;
										echo $show;
										?>
									
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