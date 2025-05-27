<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Política de Cookies</title>
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
        <h1 style="color: #333; text-align: center; margin-bottom: 1.5em;">POLÍTICA DE COOKIES</h1>
        <p>Las cookies son pequeñas cantidades de información que se almacenan en el navegador utilizado por cada usuario para que el servidor recuerde cierta información que posteriormente pueda utilizar.</p>

        <h2 style="color: #6A0DAD; margin-top: 2em; border-bottom: 1px solid #eee; padding-bottom: 0.5em;">TIPOS DE COOKIES QUE UTILIZAMOS</h2>
        <p>Esta página web utiliza cookies de terceros que son aquellas que se envían a tu ordenador o terminal desde un dominio o una página web que no es gestionada por nosotros, sino por otra entidad que trata los datos obtenidos a través de las cookies.</p>
        <p>En este caso las Cookies son utilizadas con fines estadísticos relacionados con las visitas que recibe y las páginas que se consultan, quedando aceptado su uso al navegar por ella.</p>

        <table style="width: 100%; border-collapse: collapse; margin-top: 1.5em; text-align: left;">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th style="padding: 10px; border: 1px solid #ddd;">COOKIE (Y PROVEEDOR)</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">DURACIÓN</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">DESCRIPCIÓN</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd;">__cfduid (cloudflare.com - antes notin.es)</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">Sesión / Persistente</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">Cookie utilizada por Cloudflare para identificar a usuarios de confianza detrás de una dirección IP compartida y aplicar configuraciones de seguridad.</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd;">personalization_id (twitter.com)</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">Sesión / Persistente</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">Utilizada por Twitter para personalizar la experiencia del usuario y proporcionar contenido relevante.</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd;">Facebook</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">Publicidad, estadísticas y mediciones</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">Coloca Cookies en el ordenador o dispositivo y recibe la información almacenada en ellas cuando utilizas o visitas servicios prestados por otras empresas que utilizan los servicios de Facebook.</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd;">_ga (Google Analytics)</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">2 años</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">Se usa para distinguir a los usuarios.</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd;">_gid (Google Analytics)</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">24 horas</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">Se usa para distinguir a los usuarios.</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd;">_gat (Google Analytics)</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">1 minuto</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">Se usa para limitar el porcentaje de solicitudes. Si has implementado Google Analytics mediante Google Tag Manager, esta cookie se llamará _dc_gtm_.</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd;">_gali (Google Analytics)</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">30s</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">Atribución de enlace mejorada.</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd;">_unam (SHARETHIS)</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">Persistente</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">Su finalidad es cuantificar el número de Usuarios que comparten un determinado contenido y cuántas páginas web son visitadas a raíz de esa acción.</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd;">WordPress</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">2 años</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">Utilizado para el correcto funcionamiento del gestor de contenido WordPress.</td>
                </tr>
            </tbody>
        </table>

        <p style="margin-top: 1.5em;">Si desea más información sobre los tipos de cookies de seguimiento y análisis de datos de Google <a href="https://policies.google.com/technologies/cookies" target="_blank" style="color: #6A0DAD; text-decoration: none;">haga clic aquí</a>.</p>

        <h3 style="color: #6A0DAD; margin-top: 2em; border-bottom: 1px solid #eee; padding-bottom: 0.5em;">Para informarse sobre cómo eliminar las cookies de su explorador:</h3>
        <ul style="list-style-type: disc; padding-left: 20px;">
            <li><a href="https://support.mozilla.org/es/kb/habilitar-y-deshabilitar-cookies-que-los-sitios-web" target="_blank" style="color: #6A0DAD; text-decoration: none;">Firefox</a></li>
            <li><a href="https://support.google.com/chrome/answer/95647?hl=es" target="_blank" style="color: #6A0DAD; text-decoration: none;">Chrome</a></li>
            <li><a href="https://support.microsoft.com/es-es/topic/eliminar-y-administrar-cookies-16177309-5b1e-b8cc-011a-878f71253e20" target="_blank" style="color: #6A0DAD; text-decoration: none;">Internet Explorer</a></li>
            <li><a href="https://support.apple.com/es-es/guide/safari/sfri11471/mac" target="_blank" style="color: #6A0DAD; text-decoration: none;">Safari</a></li>
            <li><a href="https://help.opera.com/en/latest/web-preferences/#cookies" target="_blank" style="color: #6A0DAD; text-decoration: none;">Opera</a></li>
        </ul>
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