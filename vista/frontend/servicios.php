<?php
require_once '../../config.php';
?>
<!DOCTYPE html>
<html lang="es-ES">
    <head>
        <?php include_once("includes/metatag.php"); ?>
        <meta property="og:title" content="Caribetour.es | Especialistas en el Caribe" />
        <meta name="title" content="CaribeTour.es: Especialistas en el Caribe" />
        <meta name="DC.title" content="CaribeTour.es: Especialistas en el Caribe" />
        <title>Servicios | Especialistas en el Caribe</title>        
        <meta name="description" content="CaribeTour.es | Agencia especializada en el Caribe y sus destinos" />
        <meta name="keywords" content="CaribeTour.es | Agencia especializada en el Caribe y sus destinos" />
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
            	<!--inicio breadcrumb-->
	        <div class="miga" id="breadcrumb">
	                <div class="breadcrumb">
		                <a hreflang="es" type="text/html" charset="iso-8859-1" href="inicio" rel="tag" title="Inicio">Inicio</a>
	                </div>
	                <div class="breadcrumb">
		                Servicios
	                </div>
               </div>

				<!--fin de breadcrumb-->

                <div class="row">
                    <div class="tabs-container vertical-tabs">
                        <div class="column threecol tabs">
                            <ul>
                                <li><a href="servicios#airline-tickets"> Billetes Aereos</a></li>
                                <li><a href="servicios#worldwide-tours"> Excursiones</a></li>
                                <li><a href="servicios#hotel-reservation"> Hoteles</a></li>
                                <li><a href="servicios#transport-rental"> Rent a Cars </a></li>
                                <!--<li><a href="#event-planning"> Turismo Est&eacute;tico</a></li>-->
                            </ul>
                        </div>
                        <div class="panes column ninecol last">
                            <div class="pane"><div class="sevencol column">
                                <h1>Reserva tus Vuelos con Nosotros</h1>
                                <p><strong>Viaja desde todo el mundo al Caribe con las mejores compa&ntilde;&iacute;as a&eacute;reas internacionales.</strong></p>
                                <p>En CaribeTour.es te ofrecemos un buscador de vuelos muy sencillo que te permitir&aacute; reservar los mejores billetes a&eacute;reos desde la comodidad de tu hogar en pocos clics.</p>
                                <a hreflang="es" type="text/html" charset="iso-8859-1" href="css/prueba.html" target="_self" class="button medium primary">Reservar Billetes</a>
                            </div>
                            <div class="fivecol column last">
	                            <img class="aligncenter" alt="Billetes de avion" title="Billetes de avi&oacute;n" src="<?=PATHFRONTEND ?>images/ticket_aereo.jpg" />
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="pane">
                            <div class="sevencol column">
                                <h3>Excursiones</h3>
                                <p><strong>Quisque id augue erat, suscipit ultricies est. Maecenas feugiat justo ac massa porttitor mollis auctor nulla ullamcorper. Sed blandit interdum consequat. Mauris eget felis leo. Sed fermentum sollicitudin sagittis.</strong></p>
                                <p>Suspendisse luctus, felis at fringilla dictum, erat massa vehicula velit, id venenatis eros libero et lectus. Proin ullamcorper molestie lectus, sit amet condimentum dui tincidunt ut. In tempor faucibus eros, sed auctor orci ultricies non. Suspen lacinia enim vel nibh tincidunt vel consectetur est ullamcorper. Suspen orce.</p>
                                <a hreflang="es" type="text/html" charset="iso-8859-1" href="contactos" target="_self" class="button medium primary">Ver Escursiones Disponibles</a>
                            </div>
                            <div class="fivecol column last"><img class="aligncenter" alt="Excursiones en el Caribe" title="Excursiones en el Caribe" src="<?=PATHFRONTEND ?>images/excursiones.jpg" /></div>
                            <div class="clear"></div>
                        </div>
                        <div class="pane">
                            <div class="sevencol column">
                                <h3>Los Mejores Hoteles</h3>
                                <p><strong>Nulla in orci justo. In elit elit, tempus sit amet pellentesque ut, tempus ac risus. Suspendisse imperdiet, mi in bibendum scelerisque, massa leo mollis eros, vel congue enim leo eu arcu. Suspendisse a nibh odio.</strong></p>
                                <p>Quisque volutpat nunc ligula. Praesent nec massa in tortor malesuada  conse scelerisque. Sed lobortis interdum pulvinar. Maecenas et est vel nunc imperdiet blandit at sed turpis. Mauris non libero ut nulla tempus gravida nec vel mi. Praesent et egestas ipsum. Ut vitae sapien elit. Aliquam erat volutpat.</p>
                                <a hreflang="es" type="text/html" charset="iso-8859-1" href="contactos" target="_self" class="button medium primary">Reservar Hotel</a>
                            </div>
                            <div class="fivecol column last">
                            	<img class="aligncenter" alt="Los Mejores Hoteles" title="Los Mejores Hoteles" src="<?=PATHFRONTEND ?>images/hoteles.jpg" />
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="pane">
                            <div class="sevencol column">
                                <h3>Arquiler de Coches</h3>
                                <p><strong>Fusce hendrerit hendrerit lacus id euismod. Aliquam erat volutpat. In in sem tortor. Vestibulum facilisis consequat purus, vel adipiscing velit sollicitudin quis. Vestibulum nec urna in lorem imperdiet iaculis.</strong></p>
                                <p>Etiam quam est, malesuada ut fringilla eu, auctor vel odio. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Integer fringilla magna ut risus sagittis ultrices. Nam eget varius sem. Nam mattis consectetur suscipit. Vivamus quis ante enim. Cras id sodales metus.</p>
                                <a hreflang="es" type="text/html" charset="iso-8859-1" href="contactos" target="_self" class="button medium primary">Reservar</a>
                            </div>
                            <div class="fivecol column last">
	                            <img class="aligncenter" alt="Arquiler de Coches" title="Arquiler de Coches" src="<?=PATHFRONTEND ?>images/rent_a_car.jpg" />
                            </div>
                            <div class="clear"></div>
                        </div>

                        <!--<div class="pane">

                            <div class="sevencol column">

                                <h3>Turismo Est&eacute;tico</h3>

                                <p><strong>Fusce euismod euismod enim non adipiscing. Integer ante nisi, dictum tempus elementum hendrerit, convallis a tortor. Maecenas sed ante cursus ligula egestas egestas eu et ante. Maecenas leo odio, sodales.</strong></p>

                                <p>Fusce a justo non dui imperdiet ultricies. Donec consectetur metus sed velit placerat pulvinar. Nam neque libero, tristique eu placerat sed, consectetur mattis leo. Aliquam sapien nulla, mattis ac luctus tincidunt, gravida eu quam. Praesent sem nisl, scelerisque venenatis euismod nec, interdum nec neque. </p>

                                <a href="contactos" target="_self" class="button medium primary">Inf&oacute;rmate</a>

                            </div>            

                            <div class="fivecol column last"><img class="aligncenter" alt="Turismo Est&eacute;tico" title="Turismo Est&eacute;tico" src="<?=PATHFRONTEND ?>images/estetica3.jpg" /></div>

                            <div class="clear"></div>

                        </div>-->

                    </div>
                </div>
                <div class="fivecol column">
                    <div class="section-title">
                        <h4>Expertos en Viajes</h4>
                    </div>
                    <div class="staff-block">
                        <div class="fourcol column">
                            <div class="featured-image">
                                <img src="<?=PATHFRONTEND ?>images/teleoperadora.jpg" alt="Expertos en todo el Caribe" title="Expertos en todo el Caribe" />
                            </div>
                        </div>
                        <div class="eightcol column last">
                            <h5>Equipo de CaribeTour.es</h5>
                            <p>Contamos con el mejor equipo humano el cual est&aacute; siempre a tu disposici&oacute;n. puedes contactar con nosotros en cualquier momento. siempre estaremos dispuestos a ayudarte ante cualquier duda o inquietud.</p>
                            <a hreflang="es" type="text/html" charset="iso-8859-1" href="contactos" target="_self" class="button  grey" title="Contactar con caribetour.es">Contactar</a>
                        </div>
                        <div class="clear"></div>&nbsp;<br />
                    </div>
                </div>
                <div class="fourcol column">
                    <div class="section-title">
                        <h4>Por Qu&eacute; Elegirnos</h4>
                    </div>
                    <div class="toggle"><div class="toggle-title">Precio Econ�nico</div>
                        <div class="toggle-content">En CaribeTour.es hacemos siempre una exhaustiva comparaci�n entre los mejores productos y servicios tur�sticos para que nuestros clientes siempre puedan obtener la mejor calidad y al mejor precio.</div>
                    </div>
                    <div class="toggle">
                    		<div class="toggle-title">
                    			Servicio Postventa
                    		</div>
                        <div class="toggle-content">
	                        En CaribeTour.es les damos un seguimiento a nuestros clientes para estar al tanto de su satisfacci�n con los servicios ofrecidos, as� garantizamos una mejora constante de cara al futuro.
                        </div>
                    </div>
                    <div class="toggle">
                    		<div class="toggle-title">Gran Experiencia</div>
                        <div class="toggle-content">Hemos recorrido medio mundo, hemos estado en todos y cada unos de los rincones m�s paradisiacos del Caribe para que nuestros clientes sepan de primera mano la buena vida que les espera.</div>
                    </div>
                    <div class="toggle">
                    		<div class="toggle-title">Filosof�a y forma de trabajar</div>
                        <div class="toggle-content">En CaribeTour.es siempre planificamos nuestros paquetes vacacionales de manera artesanal, nos destacamos por elegir los destinos siempre cumpliendo las exigencias de nuestros clientes.</div>
                    </div>
                    <div class="toggle">
                    		<div class="toggle-title">Tecnolog�a, infraestructura y log�stica.</div>
                        <div class="toggle-content">Contamos con las mejores herramientas disponibles en materia de tur�smo para estar a la vanguardia en estos tiempos modernos.</div>
                    </div>
                </div>

                <!--<div class="threecol column last">

                    <div class="section-title">

                        <h4>Colaboradores</h4>

                    </div>

                    <a href="servicios"><img src="http://themextemplates.com/demo/midway/wp-content/uploads/2012/12/image_24.jpg" alt="Colaboradores" /></a>

                </div><div class="clear"></div>-->

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
