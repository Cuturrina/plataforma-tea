<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contacto Vista Móvil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="vista-movil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header>
    <h1>🌈 Plataforma Infantil para Niños con TEA 🌟</h1>
    <div id="menuSimulador" class="menu-simulador">
        <div class="hamburguesa" onclick="toggleMenuSimulador()">☰</div>
            <ul id="opcionesSimulador" class="opciones oculto">
                <li><a href="indexvm.php"><i class="fas fa-home"></i> Inicio</a></li>
                <li><a href="recursosvm.php"><i class="fas fa-book"></i> Recursos</a></li>
                <li><a href="padresvm.php"><i class="fas fa-user-friends"></i> Para Padres</a></li>
                <li><a href="forovm.php"><i class="fas fa-comments"></i> Foro</a></li>
                <li><a href="juegosvm.php"><i class="fas fa-gamepad"></i> Juegos</a></li>
                <li><a href="contactovm.php"><i class="fas fa-envelope"></i> Escríbenos</a></li>
                <li><a href="sugerenciasvm.php"><i class="fas fa-lightbulb"></i> Buzón de Sugerencias</a></li>
                <li><a href="proyectovm.php"><i class="fas fa-info-circle"></i> Sobre el Proyecto</a></li>
                <li><a href="#" onclick="toggleMenuSimulador();"><i class="fas fa-times-circle"></i> Cerrar Menú</a></li>
            </ul>
        </div>
    </div>

    <div class="container" id="contacto">
        <h2>Contacto</h2>
        <p>Si tienes alguna pregunta, sugerencia o necesitas más información, no dudes en ponerte en contacto con nosotros. Estamos aquí para ayudarte.</p>
        
        <form action="enviar_contacto.php" method="POST" id="formContacto"> 
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?= isset($response['old_input']['nombre']) ? htmlspecialchars($response['old_input']['nombre']) : '' ?>" required oninvalid="this.setCustomValidity('Parece que falta tu nombre. ¿Puedes escribirlo, por favor?')" oninput="this.setCustomValidity('')">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= isset($response['old_input']['email']) ? htmlspecialchars($response['old_input']['email']) : '' ?>" required oninvalid="this.setCustomValidity('Necesitamos tu dirección de email para poder contactarte. ¿Puedes escribirla?')" oninput="this.setCustomValidity('')">
            </div>

            <div class="form-group">
                <label for="mensaje">Mensaje:</label>
              <textarea id="mensaje" name="mensaje" rows="4" required oninvalid="this.setCustomValidity('Tu mensaje está vacío. ¿Qué nos quieres contar?')" oninput="this.setCustomValidity('')"><?= isset($response['old_input']['mensaje']) ? htmlspecialchars($response['old_input']['mensaje']) : '' ?></textarea>
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
    <script src="scriptvm.js"></script>
</body>
</html>