<?php
//ini_set('display_errors', '1');
//error_reporting(E_ALL); 
require_once '../../config.php';
?>
<!DOCTYPE html>
<html lang="es-ES">
    <head>
        <?php include_once("includes/metatag.php"); ?>
        <meta property="og:title" content="Cont&aacute;tos de CaribeTour.es | Especialistas en el Caribe" />
        <meta name="title" content="Cont&aacute;tos de CaribeTour.es | Especialistas en el Caribe" />
        <meta name="DC.title" content="Cont&aacute;tos de CaribeTour.es | Especialistas en el Caribe" />
        <title>Cont&aacute;tos de CaribeTour.es | Especialistas en el Caribe</title>
        <meta name="description" content="Cont&aacute;tos de CaribeTour.es | Especialistas en el Caribe" />
        <meta name="keywords" content="Cont&aacute;tos de CaribeTour.es" />
        <!--[if lt IE 9]>
            <script type="text/javascript" src="http://www.caribetour.es/js/jquery/html5.js"></script>
        <![endif]-->
        <?php include_once("includes/baselink.php"); ?>
        <link rel="canonical" href="http://www.caribetour.es/" />
	    <?php include_once("includes/icons.php"); ?>
        <link rel='stylesheet' id='colorbox-css'  href='<?=PATHFRONTEND ?>css/colorbox.css?ver=3.7.1' type='text/css' media='all' />
        <link rel='stylesheet' id='jquery-ui-datepicker-css'  href='<?=PATHFRONTEND ?>css/datepicker.css?ver=3.7.1' type='text/css' media='all' />
        <link rel='stylesheet' id='general-css'  href='<?=PATHFRONTEND ?>css/style.css?ver=3.7.1' type='text/css' media='all' />
        <?php include_once("includes/jsHead.php"); ?>
        <script type="text/javascript">
            function suscriptor (){
                var suscribir = document.getElementById("suscribir").value;
                if (typeof(suscribir) !="undefined"){
                    expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                    if(suscribir == "" || !expr.test(suscribir)){
                        document.getElementById("srequired").style.display ="";
                        document.getElementById("suscribir").focus();
                        return false;
                    }
                }
            }
		</script>
        <?php include_once("includes/css.php"); ?>
        <script type="text/javascript">
        WebFontConfig = {google: { families: [ "Signika:400,600","Open Sans:400,400italic,600" ] } };
        (function() {
            var wf = document.createElement("script");
            wf.src = ("https:" == document.location.protocol ? "https" : "http") + "://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js";
            wf.type = "text/javascript";
            wf.async = "true";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(wf, s);
        })();
        </script>
        <style type="text/css">.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}</style>
    </head>
    <body class="home page page-id-96 page-template-default">
        <!-- container -->
        <div class="container site-container">
            <!-- header -->
            <header class="container site-header">
                <div class="substrate top-substrate">
                    <?php include('includes/imgSiteBg.php') ?>
                </div>
                <!-- background -->
                <!-- supheader -->
                <?php include("includes/header.php");?>
                <!-- /supheader -->
                <div class="block-background header-background"></div>
            </header>
            <!-- /header -->

            <!-- content -->
            

            <section class="container site-content">
            
                <!-- breadcrumb-->
                <div class="miga" id="breadcrumb">
                    <div class="breadcrumb">
                        <a hreflang="es" type="text/html" charset="iso-8859-1" href="inicio" rel="tag" title="Inicio">Inicio</a>
                    </div>
                    <div class="breadcrumb">
                        Contactos
                    </div>
                </div>
                <!-- /breadcrumb--> 


                <div class="row">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3039.318127169372!2d-3.635495784605191!3d40.37964137936939!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd4225b1f47cf917%3A0xe12ce78a2cacc049!2sCalle%20del%20Puerto%20de%20Pozazal%2C%2037%2C%2028031%20Madrid!5e0!3m2!1ses!2ses!4v1580308776190!5m2!1ses!2ses" width="100%" height="360" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                </div>


                <div class="row">
                    <div class="eightcol column"><?php if (isset($_SESSION['nombre']) && !isset($_SESSION['enviado'])){
				echo "<h1>Por favor rellene todos los campos del formulario.</h1><br>";
				} ?><?php if (isset($_SESSION['enviado']) && $_SESSION['enviado']==1){
				echo "<h1>Gracias por su consulta, los datos se han enviado correctamente.</h1><br>";
				} ?><?php if (isset($_SESSION['enviado']) && $_SESSION['enviado']==0){
				echo "<h1 style='color:red'>Error al enviar los datos del formulario, por favor int&eacute;ntelo de nuevo.</h1><br>";
				} ?>
                        <div class="section-title"><h1>Contacta con nosotros</h1></div>
                        <form action="mail.php" method="POST" class="formatted-form" name="clientes" onSubmit="return validacion();">
                        <p></p>
                            <div class="sixcol column ">
                                <div class="field-container">
                                    <input type="text" id="nombre" name="nombre" title="Nombtre Completo (s&oacute;lo letras)" maxlength="50" placeholder="Nombre Completo" value="<?php if (isset($_SESSION['nombre']) && $_SESSION['enviado']!=1) { echo $_SESSION['nombre']; } ?>" required pattern="[A-Za-z]"/>
                                </div>
                            </div>
                            <div class="sixcol column last">
                                <div class="field-container">
                                    <input  type="email" id="email" name="email" title="Introduzca su Email." maxlength="80" placeholder="Email" value="<?php if (isset($_SESSION['email']) && $_SESSION['enviado']!=1) { echo $_SESSION['email']; } ?>" required />
                                </div>
                            </div>                            
                            <div class="clear"></div>
                            <div class="field-container">
                                <textarea id="mensaje" name="mensaje" title="Introduzca su Mensaje." maxlength="1000" placeholder="Mensaje" required ><?php if (isset($_SESSION['mensaje']) && $_SESSION['enviado']!=1) { echo $_SESSION['mensaje']; } ?></textarea>
                            </div>
                            <input type="submit" class="action" value="Enviar" title="Enviar" />
                            <input type="hidden" name="producto" value="algo" />
                            <input type="hidden" name="volver" value="http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"]; ?>" />
                        </form>
                    </div>
                    <div class="fourcol column last">
                        <div class="widget widget-subscribe">
                            <div class="section-title">
                                <h4>Noticias</h4>
                            </div>
                            <p>Suscr&iacute;bete a nuestras noticias para mantenerte actualizado con las ofertas de &uacute;ltimo minuto disponibles en CaribeTour.es</p>
                            <form action="" method="POST" name="suscribir" onSubmit="return suscriptor();" >
                            	<div class="message" id="srequired" style="display:none;">Por favor indique un correo v&aacute;lido</div>
                                <?php if (isset($_GET['suscritor'])) {echo '<div class="message">Este correo ya est&aacute; suscrito</div>';} ?>
                                <?php if (isset($_GET['suscritook'])){ echo '<div>Gracias por suscribirte!!</div>';} ?>
                                <?php if (isset($_GET['errorsuscritor'])){ echo '<div class="message">Por favor indique un correo v&aacute;lido</div>';} ?>
                                <div class="field-container">
                                    <input type="email" name="email" id="suscribir" placeholder="Email" value="<?php if (isset($_GET['suscritor'])) {echo $_GET['suscritor'];} if (isset($_GET['errorsuscritor'])) {echo $_GET['errorsuscritor'];} ?>" title="Introduzca su Email para suscribirse." maxlength="60" required />
                                </div><br>
                                <input type="submit" class="action" value="Suscribirse" title="Suscribirse" />
                                <input type="hidden" name="MM_insert" value="suscribir">
                            </form>
                      </div>
                        <div class="widget widget_text">
                            <div class="section-title">
                                <h4>Detalles</h4>
                            </div>
                            <div class="textwidget">
                              <!--<strong>Ofic&iacute;na:</strong> direccion<br />
                              <strong>Tel&eacute;fono:</strong> 654654654<br />-->
                              <strong>Email:</strong><img src="images/email.gif" alt="Email" width="119" height="15">
                          </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </section>

            <!-- /content -->

            <!-- footer -->
            <?php include("includes/footer.php");?>
            <!-- /footer -->

            <div class="substrate bottom-substrate">
                <?php include('includes/imgSiteBg.php') ?>
            </div>
        </div>
        <!-- /container -->
	    <?php include_once('includes/jsFoot.php'); ?>
        
    </body>
</html>