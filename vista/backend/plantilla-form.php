<?php
require_once '../../config.php';
require_once "../../AutoLoader/autoLoader.php";

// TODO: crear una clase formCaribeTour que sea quien maneje la logica general de los formularios, que sea quien haga la union entre formHandler y el controlador/modelo

$formName = "Proveedor";
$location = "proveedor-form.php";
$lister = "proveedor-lister.php";
$tableName = "proveedores";
$readOnlyFieldList = [];

$objName = ucfirst($formName);
$objIdName = "id{$objName}";
$objControllerName = "{$objName}Controller";
$show = $error = '';
$action = (isset($_GET['action']) and "" != $_GET['action']) ? $_GET['action'] : 'nuevo';
$readOnly = false;
$isNewRecord = true;
$fieldValues = [];
$rutaImg = "../frontend/img/";

try{
    
    $objC = new $objControllerName;
    $formHandler = new FormHandler($tableName, false, false);
    $utilC = new UtilController();
    $productoC = new ProductoController;
    
    // persistencia de datos (NUEVO O EDITAR)
    /* @var $_POST type */
    if (isset($_POST['Guardar']) and 'Guardar' === $_POST['Guardar']){
        
        if (isset($_POST['isNewRecord'])){
            $obj = $utilC->setObjFromPost(new $objName);
            $id = $objC->insert($obj);
        } else {
            $id = FormHandler::checkGetIdExist();
            $obj = @$objC->select([[$objIdName, $id]])[0];
            $obj = $utilC->setObjFromPost($obj);
            $objC->update($obj);
        }
        
        $location .= "?id={$id}&action=ver";
        header(sprintf("Location: %s", $location));
    }
    // fin persistencia
    
    // mostrar datos (VER O EDITAR)
    switch ($action){
        case 'ver':
            $id = FormHandler::checkGetIdExist();
            $obj = @$objC->select([[$objIdName, $id]])[0];            
            $readOnly = true;
            $isNewRecord = false;
            $show .= "<a href='{$location}?id={$id}&action=editar' class='btn btn-warning input-medium' value='Editar' title='Editar'>Editar</a><p></p>\n";            
            $fieldValues = $obj->getAllParams(false, false);
            break;
        case 'editar':
            $id = FormHandler::checkGetIdExist();
            $obj = @$objC->select([[$objIdName, $id]])[0];
            $readOnly = false;
            $isNewRecord = false;
            $fieldValues = $obj->getAllParams(false, false);
            break;
        case 'nuevo':
            $readOnly = false;
            $isNewRecord = true;
            $obj = new $objName;
            $fieldValues = $obj->getAllParams(false, false);
            break;
    }

    // mostramos los datos del formulario
    $formHandler->setValues($fieldValues);
    $formHandler->getForm()->setReadOnly($readOnly);
    $formHandler->setIsNewRecord($isNewRecord);
    $formHandler->setFieldsReadOnly($readOnlyFieldList);
    // TODO: setFieldIntoFieldset es un metodo que hay que ejecutarlo si o si, refactorizar eso
    $formHandler->setFieldIntoFieldset();
    $show .= $formHandler->renderForm();
    
    // fin mostrar

} catch (Exception $e){
    $error = '
    <div class="alert alert-warning" role="alert">
            <h4 class="alert-heading">[ERROR]</h4>
            ' . $e->getMessage() . '
    </div>';
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>Editar <?= $formName ?></title>
        <meta name="robots" content="noindex, nofollow, nosnippet, noarchive, noimageindex" />
	<meta name="googlebot" content="noindex, nofollow">
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
                                <a href="<?= $lister ?>"><?= $formName ?></a>
                            </li>
                            <li class="active"><?= $formName ?> Form</li>
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
                                        <h3 class="header smaller lighter blue">Datos del <?= $formName ?></h3>

                                        <?= $error ?>
                                        <?= $show ?>

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