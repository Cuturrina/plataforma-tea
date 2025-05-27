<?php
session_start();

// Email del administrador que recibirá las sugerencias
$admin_email = "info@plataformatea.com"; // ¡IMPORTANTE! Cambia esto por tu correo electrónico de administración

$mensaje_enviado = false;
$errores = [];
$old_input = [
    'nombre' => '',
    'sugerencia' => ''
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recogemos y saneamos los datos
    $nombre = isset($_POST['nombre']) ? htmlspecialchars(trim($_POST['nombre'])) : "Anónimo";
    $sugerencia = isset($_POST['sugerencia']) ? htmlspecialchars(trim($_POST['sugerencia'])) : ""; 

    $old_input['nombre'] = $nombre;
    $old_input['sugerencia'] = $sugerencia;

    if (empty($sugerencia)) {
        $errores[] = "Parece que olvidaste escribir tu sugerencia. ¿Puedes contarnos algo, por favor?";
    } elseif (strlen($sugerencia) < 5) {
        $errores[] = "Tu sugerencia es un poco corta. ¿Puedes añadir más detalles para entenderla mejor?";
    }

    if (empty($errores)) {
        // Preparamos el asunto y cuerpo del email
        $asunto = "Nueva sugerencia desde la web";
        $cuerpo = "Has recibido una nueva sugerencia.\n\n";
        $cuerpo .= "Nombre: $nombre\n";
        $cuerpo .= "Sugerencia:\n$sugerencia\n";

        // Headers para indicar que es texto plano y de parte de quien envía
        $headers = "From: no-reply@tuweb.com\r\n";
        $headers .= "Reply-To: no-reply@tuweb.com\r\n"; // Aquí pones el email donde quieres recibir las respuestas
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        // Enviamos el correo
        if (mail($admin_email, $asunto, $cuerpo, $headers)) {
            $_SESSION['form_response'] = [
                'type' => 'success',
                'message' => '¡Gracias por tu sugerencia! La hemos recibido correctamente.'
            ];
            // Redirigir para evitar reenvío del formulario
            header("Location: sugerencias.php");
            exit();
        } else {
            $errores[] = 'Lo sentimos, hubo un problema al enviar tu sugerencia. Por favor, inténtalo de nuevo más tarde.';
        }
    }
    // Si hay errores, se guardan en la sesión para mostrarlos después de la redirección
    $_SESSION['form_response'] = [
        'type' => 'error',
        'messages' => $errores,
        'old_input' => $old_input
    ];
    header("Location: sugerencias.php");
    exit();
}

// Recuperar mensajes de la sesión si existen
$response = [];
if (isset($_SESSION['form_response'])) {
    $response = $_SESSION['form_response'];
    unset($_SESSION['form_response']); // Limpiar la sesión
    if ($response['type'] === 'error' && isset($response['old_input'])) {
        $old_input = $response['old_input'];
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar sugerencias</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

    <div class="container" id="sugerencias">
        <h2>Buzón de Sugerencias</h2>
        <p>Si tienes alguna sugerencia para mejorar nuestra plataforma o añadir contenido, no dudes en compartirla con nosotros. ¡Tu opinión es muy importante!</p>


        <?php
        if (!empty($response)) {
            if ($response['type'] === 'success') {
                echo '<div class="message success">' . htmlspecialchars($response['message']) . '</div>';
            } elseif ($response['type'] === 'error') {
                echo '<div class="message error">';
                if (isset($response['messages']) && is_array($response['messages'])) {
                    echo '<ul class="error-list">';
                    foreach ($response['messages'] as $msg) {
                        echo '<li>' . htmlspecialchars($msg) . '</li>';
                    }
                    echo '</ul>';
                } else {
                    echo htmlspecialchars($response['message']); // Fallback por si hay un solo error sin 'messages'
                }
                echo '</div>';
            }
        }
        ?>

        <form method="post" action="sugerencias.php" id="formsugerencias">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" maxlength="50" value="<?= htmlspecialchars($old_input['nombre']) ?>" required oninvalid="this.setCustomValidity('Parece que falta tu nombre. ¿Puedes escribirlo, por favor?')" oninput="this.setCustomValidity('')">
            </div>

            <div class="form-group">
                <label for="sugerencia">Tu Sugerencia:</label>
                <textarea id="sugerencia" name="sugerencia" rows="5" cols="40" required oninvalid="this.setCustomValidity('Parece que tu sugerencia está vacía. ¿Puedes contarnos algo, por favor?')" oninput="this.setCustomValidity('')"><?= htmlspecialchars($old_input['sugerencia']) ?></textarea>
            </div>

            <button type="submit">Enviar sugerencia</button>
        </form>
    </div>


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
