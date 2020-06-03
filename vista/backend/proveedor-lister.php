<?php
require_once '../../config.php';
require_once "../../AutoLoader/autoLoader.php";

$ajaxListName = "proveedor-lista.php";
$listerName = "Proveedores";
$thList = ['idProveedor', 'Nombre', 'NIF', 'Telefono', 'Email', 'Web'];
$editorForm = "proveedor-form.php";
$idRecord = "idProveedor";

$util = new Util();
$ajaxPath = $util::AJAX_PATH;
$ajaxUrl = "\"{$ajaxPath}{$ajaxListName}\"";
$ajaxParamList = json_encode($thList);
$myTableColums = '';
foreach($thList as $colum){
    $myTableColums .= '{"data":"' .$colum. '"},';
}

$showTh = $util->renderThForLister($thList);
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>Listado de <?= $listerName ?> | Caribetour Admin</title>

        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <?php include_once("includes/baselink.php"); ?>

        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="font-awesome/4.5.0/css/font-awesome.min.css" />

        <!-- page specific plugin styles -->

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
                                    <li class="active"><?= $listerName ?></li>
                            </ul><!-- /.breadcrumb -->

                            <div class="nav-search" id="nav-search">
                                    <form class="form-search">
                                            <span class="input-icon">
                                                    <input type="text" placeholder="Buscar..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
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
                                
                                <h3 class="header smaller lighter blue"><?= $listerName ?></h3>

                                <div class="clearfix">
                                    <div class="pull-left tableTools-container">
                                        <!--
                                        <a class="dt-button buttons-collection btn btn-white btn-primary btn-bold" id="actualizar2" title="desactivar seleccionados">
                                            <span>
                                                <i class="fa fa-times bigger-110 green"></i> <span class="hidden">desactivar seleccionados</span>
                                            </span>
                                            desactivar seleccionados
                                        </a>
                                        -->
                                        <a class="dt-button buttons-collection btn btn-white btn-primary btn-bold" id="nuevo" title="nuevo" href="<?= $editorForm ?>">
                                            <span>
                                                <i class='ace-icon fa  fa-pencil-square-o bigger-110'></i> <span class="hidden">Nuevo</span>
                                            </span>
                                            Nuevo
                                        </a>                                        
                                    </div>

                                    <div class="pull-right tableTools-container">
                                        <a class="dt-button buttons-collection btn btn-white btn-primary btn-bold" id="actualizar" title="actualizar">
                                            <span>
                                                <i class="fa fa-refresh bigger-110 green"></i> <span class="hidden">Actualizar</span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                <!-- 
                                <div class="table-header">
                                        Subtitulos
                                </div> -->

                                <!-- div.table-responsive -->

                                <!-- div.dataTables_borderWrap -->
                                <div>
                                    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <?= $showTh ?>
                                            </tr>
                                        </thead>
                                    </table>
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
        <script src="js/jquery.dataTables.min.js"></script>
        <script src="js/jquery.dataTables.bootstrap.min.js"></script>
        <script src="js/dataTables.buttons.min.js"></script>
        <script src="js/buttons.flash.min.js"></script>
        <script src="js/buttons.html5.min.js"></script>
        <script src="js/buttons.print.min.js"></script>
        <script src="js/buttons.colVis.min.js"></script>
        <script src="js/dataTables.select.min.js"></script>

        <!-- ace scripts -->
        <script src="js/ace-elements.min.js"></script>
        <script src="js/ace.min.js"></script>

        <!-- inline scripts related to this page -->
        <script>

            $(document).on('ready', function(){

                // obtener los datos de la fila
                var openRow = function(tbody, table){
                    $(tbody).on('click', 'button.label', function(){
                        var dataRow = table.row($(this).parents('tr')).data();
                        var urlForm = '<?= $editorForm ?>?id='+ dataRow.<?= $idRecord ?>;
                        urlForm += '&action='+ this.id;
                        window.open(urlForm, '_self');
                        //console.log(urlForm);
                        //return dataRow;
                    });
                };

                // cuando haga clic en el boton ver o editar abre un formulario
                /*
                var openRow = function(idProducto, action = 'ver'){
                    $('button.label').on('click', function(){
                        var urlForm = 'producto-form.php?idProducto='+ dataRow.idProducto;
                        window.open(urlForm, '_self');
                        return false;
                    });
                };
                */

                var myDataTable = function(){
                    var myTable = $('#dynamic-table').DataTable( {
                        "order": [[0,'desc']],
                        "destroy": true,
                        "columns": [
                            <?= $myTableColums ?>
                            {
                                "sortable": false,
                                "defaultContent": "<button id='ver' title='Ver registro' class='label label-info label-white middle'><i class='ace-icon fa  fa-eye bigger-110'></i> Ver</button>&nbsp&nbsp&nbsp<button id='editar' title='Editar registro' class='label label-warning label-white middle'><i class='ace-icon fa  fa-pencil-square-o bigger-110'></i> Editar</button>"
                            }
                        ],
                        "bAutoWidth": true,
                        "language": {
                            "url": "js/dataTableLanguage.json"
                        },

                        "ajax": {
                            "method": "POST",
                            "url": <?= $ajaxUrl ?>,
                            "data": <?= $ajaxParamList ?>
                        },

                        "sScrollX": "100%",
                        "sScrollXInner": "100%",

                        buttons: [
                            {
                                "extend": "excelHtml5",
                                "text": "<i class='fa fa-user-plus></i>'",
                                "titleAttr": "no se que poner"
                            },
                            {
                                "extend": "copy",
                                "text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
                                "className": "btn btn-white btn-primary btn-bold"
                            }
                        ]
                    } );

                    var dataRow = openRow('#dynamic-table tbody', myTable);
                    //console.log(myTable);
                    //openRow(dataRow.idProducto);

                };

                // ejecutamos la funcion para crear el dataTable
                myDataTable();

                // cuando se haga click en el boton actualizar, se reconstruye la tabla
                $('#actualizar').on('click', function(){
                        myDataTable();
                });

            });                 

        </script>
    </body>
</html>
