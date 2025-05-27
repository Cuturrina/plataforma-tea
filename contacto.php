<?php session_start();
$response = $_SESSION['response'] ?? ['old_input' => [], 'error' => '', 'success' => ''];
unset($_SESSION['response']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🌈 Plataforma Infantil para Niños con TEA 🌟</title>
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

    <div class="container" id="contacto">
        <h2>Contacto</h2>
        <p>Si tienes alguna pregunta, sugerencia o necesitas más información, no dudes en ponerte en contacto con nosotros. Estamos aquí para ayudarte.</p>

        <!-- Mensajes de error o éxito -->
        <?php if ($response['error']): ?>
            <div style="color: red; font-weight: bold;"><?= $response['error'] ?></div>
        <?php elseif ($response['success']): ?>
            <div style="color: green; font-weight: bold;"><?= $response['success'] ?></div>
        <?php endif; ?>

        <form action="enviar_contacto.php" method="POST" id="formContacto"> 
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($response['old_input']['nombre'] ?? '') ?>" required oninvalid="this.setCustomValidity('Parece que falta tu nombre. ¿Puedes escribirlo, por favor?')" oninput="this.setCustomValidity('')">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($response['old_input']['email'] ?? '') ?>" required oninvalid="this.setCustomValidity('Necesitamos tu dirección de email para poder contactarte. ¿Puedes escribirla?')" oninput="this.setCustomValidity('')">
            </div>

            <div class="form-group">
                <label for="mensaje">Mensaje:</label>
                <textarea id="mensaje" name="mensaje" rows="4" required oninvalid="this.setCustomValidity('Tu mensaje está vacío. ¿Qué nos quieres contar?')" oninput="this.setCustomValidity('')"><?= htmlspecialchars($response['old_input']['mensaje'] ?? '') ?></textarea>
            </div>

            <button type="submit">Enviar</button>
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
