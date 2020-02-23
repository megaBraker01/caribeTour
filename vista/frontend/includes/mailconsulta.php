<div class="hidden">
    <div class="question-form popup-form" id="question-form">
        <div class="section-title popup-title">
            <h4></h4>
        </div>
        <form action="mail.php" method="POST" class="formatted-form" name="clientes" onSubmit="return validacion();">
            <div class="sixcol column ">
                <div class="field-container">
                    <input type="text" id="nombre" name="nombre" title="Introduzca su nombtre completo." maxlength="50" value="<?php if (isset($_SESSION['nombre']) && $_SESSION['enviado']!=1) { echo $_SESSION['nombre']; } ?>" placeholder="Nombre Completo" required />
                </div>
            </div>
            <div class="sixcol column last">
                <div class="clear"></div>
                <div class="field-container">
                    <input type="email" id="email" name="email" title="Introduzca su email." maxlength="80" value="<?php if (isset($_SESSION['email']) && $_SESSION['enviado']!=1) { echo $_SESSION['email']; } ?>" placeholder="Email" required />
                </div>
            </div>
            <div class="clear"></div>
            <div class="field-container">
                <textarea id="mensaje" name="mensaje" title="Indique su consulta." maxlength="500" placeholder="Consultas" required ><?php if (isset($_SESSION['mensaje']) && $_SESSION['enviado']!=1) { echo $_SESSION['mensaje']; } ?></textarea>
            </div>
            <input type="hidden" name="producto" id="producto" value="<?php if (isset($_SESSION['producto'])) { echo $_SESSION['producto']; } ?>" class="popup-id"/>
            <input type="hidden" name="volver" value="http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"]; ?>" />
            <input type="submit" value="Enviar" title="Enviar la consulta"/>
            <!--<a class="submit-button button" href="#">Enviar</a> -->
        </form>
    </div>
</div>
