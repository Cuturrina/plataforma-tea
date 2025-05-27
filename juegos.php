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

    <section id="juegos">
        <div class="container">
            <h2>Juegos</h2>
            <div class="game">
                <h3>Encuentra las Parejas</h3>
                <p><strong>Instrucciones:</strong> Haz clic en dos cartas para voltearlas. Si son iguales, se quedarán visibles. Si no, se voltearán de nuevo. ¡Encuentra todas las parejas para ganar!</p>
                <div id="memory-board" class="game-container"></div>
                <button id="new-game-memory">Nueva partida</button>
            </div>
            <div class="game">
                <h3>Rompecabezas</h3>
                <p><strong>Instrucciones:</strong> Haz clic en las piezas para moverlas al espacio vacío y reordénalas hasta formar la secuencia numérica correcta (0, 1, 2, 3... el 0 es el espacio vacío).</p>
                <div id="puzzle" class="game-container"></div>
                <button id="new-game">Nueva partida</button>
            </div>
            <div class="game">
                <h3>Juego de Memoria</h3>
                <p><strong>Instrucciones:</strong> El juego te mostrará una secuencia de colores que se iluminan. Recuerda el orden y repítelo haciendo clic en los botones. ¡Cada nivel la secuencia se hará más larga!</p>
                <div id="game-container">
                    <button id="red" class="color-button" style="background-color: red;"></button>
                    <button id="blue" class="color-button" style="background-color: blue;"></button>
                    <button id="green" class="color-button" style="background-color: green;"></button>
                    <button id="yellow" class="color-button" style="background-color: yellow;"></button>
                    <p id="message"></p>
                    <button id="start">Comenzar Juego</button>
            </div>
            <div class="game">
                <h3>Identifica la Emoción</h3>
                <p><strong>Instrucciones:</strong> Observa el emoji y selecciona la emoción que representa entre las opciones disponibles.</p>
                <div id="emotion-game">
                    <div id="emoji-display"></div>
                    <div id="emotion-options">
                        <button>Feliz</button>
                        <button>Triste</button>
                        <button>Enfadado</button>
                        <button>Asustado</button>
                        <button>Contento</button>
                    </div>
                    <div id="emotion-message"></div>
                </div>
            </div>
        </div>
    </section>


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