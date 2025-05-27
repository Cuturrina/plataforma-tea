<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Política de Privacidad</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <header>
        <h1>🌈 Plataforma Infantil para Niños con TEA 🌟</h1>
        <nav>
            <ul>
                <li><a href="index.php"><i class="fas fa-home"></i> Inicio</a></li>
                <li><a href="recursos.php"><i class="fas fa-book"></i> Recursos</a></li>
                <li><a href="padres.php"><i class="fas fa-user-friends"></i> Para Padres</a></li>
                <li><a href="foro.php"><i class="fas fa-comments"></i> Foro</a></li>
                <li><a href="juegos.php"><i class="fas fa-gamepad"></i> Juegos</a></li>
                <li><a href="contacto.php"><i class="fas fa-envelope"></i> Escríbenos</a></li>
                <li><a href="sugerencias.php"><i class="fas fa-lightbulb"></i> Buzón de Sugerencias</a></li>
                <li><a href="sobre-el-proyecto.php"><i class="fas fa-info-circle"></i> Sobre el Proyecto</a></li>
                <?php session_start(); ?>
                <?php if (isset($_SESSION['username'])): ?>
                <li class="dropdown">
                    <div class="dropdown-toggle" id="user-menu">
                        <?= htmlspecialchars($_SESSION['username']) ?> <i class="fas fa-chevron-down"></i>
                    </div>
                    <ul class="dropdown-menu" id="dropdown-menu" style="display: none;">
                        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a></li>
                    </ul>
                </li>
                <?php else: ?>
                <li><a href="login.php">Iniciar sesión</a> | <a href="register.php">Crear Cuenta</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <button 
        id="toggle-view-button" 
        style="position: fixed; top: 15px; right: 20px; padding: 10px 15px; background-color:rgb(11, 142, 230); color: white; border: none; border-radius: 5px; cursor: pointer; z-index: 1000;">
        Vista Móvil 📱
    </button>

    <div id="simulacion-movil-overlay" class="simulacion-movil">
        <div class="marco-movil">
          <div class="pantalla-movil">
              <iframe id="iframe-movil" class="iframe-movil" src="vista-movil.php"></iframe>
          </div>
          <button id="cerrar-simulador-iframe-boton">Cerrar</button>
        </div>
    </div>

    <main style="padding: 2em; max-width: 800px; margin: 2em auto; background-color: white; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <h1 style="color: #333; text-align: center; margin-bottom: 1.5em;">POLÍTICA DE PRIVACIDAD</h1>
        <p style="text-align: center; font-style: italic; color: #666;">Última actualización: Enero 2023.</p>

        <h2 style="color: #6A0DAD; margin-top: 2em; border-bottom: 1px solid #eee; padding-bottom: 0.5em;">1. INFORMACIÓN AL USUARIO</h2>
        <p>PLATAFORMA TEA, como Responsable del Tratamiento, le informa que, según lo dispuesto en el Reglamento (UE) 2016/679, de 27 de abril, (RGPD) y en la L.O. 3/2018, de 5 de diciembre, de protección de datos y garantía de los derechos digitales (LOPDGDD), trataremos su datos tal y como reflejamos en la presente Política de Privacidad.</p>
        <p>En esta Política de Privacidad describimos cómo recogemos sus datos personales y por qué los recogemos, qué hacemos con ellos, con quién los compartimos, cómo los protegemos y sus opciones en cuanto al tratamiento de sus datos personales.</p>
        <p>Esta Política se aplica al tratamiento de sus datos personales recogidos por la empresa para la prestación de sus servicios. Si acepta las medidas de esta Política, acepta que tratemos sus datos personales como se define en esta Política.</p>

        <h2 style="color: #6A0DAD; margin-top: 2em; border-bottom: 1px solid #eee; padding-bottom: 0.5em;">2. CONTACTO</h2>
        <p>Denominación social: <strong>PLATAFORMA TEA</strong></p>
        <p>Nombre comercial: <strong>PLATAFORMA TEA</strong></p>
        <p>CIF: <strong>NUMERO CIF</strong></p>
        <p>Domicilio: <strong>DIRECCION DE TU NEGOCIO</strong></p>
        <p>e-mail: <a href="mailto:info@plataformatea.com" style="color: #6A0DAD; text-decoration: none;">info@plataformatea.com</a></p>

        <h2 style="color: #6A0DAD; margin-top: 2em; border-bottom: 1px solid #eee; padding-bottom: 0.5em;">3. PRINCIPIOS CLAVE</h2>
        <p>Siempre hemos estado comprometidos con prestar nuestros servicios con el más alto grado de calidad, lo que incluye tratar sus datos con seguridad y transparencia. Nuestros principios son:</p>
        <ul>
            <li><strong>Legalidad:</strong> Solo recopilaremos sus Datos personales para fines específicos, explícitos y legítimos.</li>
            <li><strong>Minimización de datos:</strong> Limitamos la recogida de datos de carácter personal a lo que es estrictamente relevante y necesario para los fines para los que se han recopilado.</li>
            <li><strong>Limitación de la Finalidad:</strong> Solo recogeremos sus datos personales para los fines declarados y solo según sus deseos.</li>
            <li><strong>Precisión:</strong> Mantendremos sus datos personales exactos y actualizados.</li>
            <li><strong>Seguridad de los Datos:</strong> Aplicamos las medidas técnicas y organizativas adecuadas y proporcionales a los riesgos para garantizar que sus datos no sufran daños, tales como divulgación o acceso no autorizado, la destrucción accidental o ilícita o su pérdida accidental o alteración y cualquier otra forma de tratamiento ilícito.</li>
            <li><strong>Acceso y Rectificación:</strong> Disponemos de medios para que acceda o rectifique sus datos cuando lo considere oportuno.</li>
            <li><strong>Conservación:</strong> Conservamos sus datos personales de manera legal y apropiada y solo mientras es necesario para los fines para los que se han recopilado.</li>
            <li><strong>Las transferencias internacionales:</strong> cuando se dé el caso de que sus datos vayan a ser transferidos fuera de la UE/EEE se protegerán adecuadamente.</li>
            <li><strong>Terceros:</strong> El acceso y transferencia de datos personales a terceros se llevan a cabo de acuerdo con las leyes y reglamentos aplicables y con las garantías contractuales adecuadas.</li>
            <li><strong>Marketing Directo y cookies:</strong> Cumplimos con la legislación aplicable en materia de publicidad y cookies.</li>
        </ul>

        <h2 style="color: #6A0DAD; margin-top: 2em; border-bottom: 1px solid #eee; padding-bottom: 0.5em;">4. RECOGIDA Y TRATAMIENTO DE SUS DATOS PERSONALES</h2>
        <p>Las tipos de datos que se pueden solicitar y tratar son:</p>
        <ul>
            <li>Datos de carácter identificativo.</li>
        </ul>
        <p>También recogemos de forma automática datos sobre su visita a nuestro sitio web según se describe en la política de cookies.</p>
        <p>Siempre que solicitemos sus Datos personales, le informaremos con claridad de qué datos personales recogemos y con qué fin. En general, recogemos y tratamos sus datos personales con el propósito de:</p>
        <ul>
            <li>Proporcionar información, servicios, productos, información relevante y novedades en el sector.</li>
            <li>Envío de comunicaciones.</li>
        </ul>

        <h2 style="color: #6A0DAD; margin-top: 2em; border-bottom: 1px solid #eee; padding-bottom: 0.5em;">5. LEGITIMIDAD</h2>
        <p>De acuerdo con la normativa de protección de datos aplicable, sus datos personales podrán tratarse siempre que:</p>
        <ul>
            <li>Nos ha dado su consentimiento a los efectos del tratamiento. Por supuesto podrá retirar su consentimiento en cualquier momento.</li>
            <li>Por requerimiento legal.</li>
            <li>Por existir un interés legítimo que no se vea menoscabado por sus derechos de privacidad, como por ejemplo el envío de información comercial bien por suscripción a nuestra newsletter o por su condición de cliente.</li>
            <li>Por ser necesaria para la prestación de alguno de nuestros servicios mediante relación contractual entre usted y nosotros.</li>
        </ul>

        <h2 style="color: #6A0DAD; margin-top: 2em; border-bottom: 1px solid #eee; padding-bottom: 0.5em;">6. COMUNICACIÓN DE DATOS PERSONALES</h2>
        <p>Los datos pueden ser comunicados a empresas relacionadas con PLATAFORMA TEA para la prestación de los diversos servicios en calidad de Encargados del Tratamiento. La empresa no realizará ninguna cesión, salvo por obligación legal.</p>

        <h2 style="color: #6A0DAD; margin-top: 2em; border-bottom: 1px solid #eee; padding-bottom: 0.5em;">7. SUS DERECHOS</h2>
        <p>En relación con la recogida y tratamiento de sus datos personales, puede ponerse en contacto con nosotros en cualquier momento para:</p>
        <ul>
            <li>Acceder a sus datos personales y a cualquier otra información indicada en el Artículo 15.1 del RGPD.</li>
            <li>Rectificar sus datos personales que sean inexactos o estén incompletos de acuerdo con el Artículo 16 del RGPD.</li>
            <li>Suprimir sus datos personales de acuerdo con el Artículo 17 del RGPD.</li>
            <li>Limitar el tratamiento de sus datos personales de acuerdo con el Artículo 18 del RGPD.</li>
            <li>Solicitar la portabilidad de sus datos de acuerdo con el Artículo 20 del RGPD.</li>
            <li>Oponerse al tratamiento de sus datos personales de acuerdo con el Artículo 21 del RGPD.</li>
        </ul>
        <p>Si ha otorgado su consentimiento para alguna finalidad concreta, tiene derecho a retirar el consentimiento otorgado en cualquier momento, sin que ello afecte a la licitud del tratamiento basado en el consentimiento previo a su retirada rrhh.</p>
        <p>Puede ejercer estos derechos enviando comunicación, motivada y acreditada, a <a href="mailto:tuemail@tudominio.com" style="color: #6A0DAD; text-decoration: none;">tuemail@tudominio.com</a></p>
        <p>También tiene derecho a presentar una reclamación ante la Autoridad de control competente (<a href="https://www.aepd.es" target="_blank" style="color: #6A0DAD;">www.aepd.es</a>) si considera que el tratamiento no se ajusta a la normativa vigente.</p>

        <h2 style="color: #6A0DAD; margin-top: 2em; border-bottom: 1px solid #eee; padding-bottom: 0.5em;">8. INFORMACIÓN LEGAL</h2>
        <p>Los requisitos de esta Política complementan, y no reemplazan, cualquier otro requisito existente bajo la ley de protección de datos aplicable, que será la que prevalezca en cualquier caso.</p>
        <p>Esta Política está sujeta a revisiones periódicas y la empresa puede modificarla en cualquier momento. Cuando esto ocurra, le avisaremos de cualquier cambio y le pediremos que vuelva a leer la versión más reciente de nuestra Política y que confirme su aceptación.</p>

    </main>

    <footer>
        <p>&copy; Ayuda para Niños con Autismo. Todos los derechos reservados.</p>
        <div>
            <a href="politica-privacidad.php">Política de Privacidad</a>
            <a href="aviso-legal.php">Aviso Legal</a>
            <a href="politica-cookies.php">Política de Cookies</a>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>