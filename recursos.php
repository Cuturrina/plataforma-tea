<?php
$pictogramas = [
  'Emociones' => [
    ['nombre' => 'Feliz', 'archivo' => 'img/feliz.png'],
    ['nombre' => 'Triste', 'archivo' => 'img/triste.png'],
    ['nombre' => 'Enfadado', 'archivo' => 'img/enfadado.png'],
    ['nombre' => 'Asustado', 'archivo' => 'img/asustado.png'],
    ['nombre' => 'Ansiedad', 'archivo' => 'img/ansioso.png'],
  ],
  'Rutinas Diarias' => [
    ['nombre' => 'Desayuno', 'archivo' => 'img/desayuno.png'],
    ['nombre' => 'Cepillarse los dientes', 'archivo' => 'img/cepillarse.png'],
    ['nombre' => 'Vestirse', 'archivo' => 'img/vestirse.png'],
    ['nombre' => 'Ir al colegio', 'archivo' => 'img/cole.png'],
    ['nombre' => 'Ir al baño', 'archivo' => 'img/retrete.png'],
  ],
  'Necesidades' => [
    ['nombre' => 'Tengo sed', 'archivo' => 'img/sed.png'],
    ['nombre' => 'Tengo hambre', 'archivo' => 'img/hambre.png'],
    ['nombre' => 'Quiero descansar', 'archivo' => 'img/descansar.png'],
    ['nombre' => 'Necesito ayuda', 'archivo' => 'img/ayuda.png'],
    ['nombre' => 'Me molesta el ruido', 'archivo' => 'img/ruidoso.png'],
  ],
];
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

    <div class="container-recursos">
      <h1>Pictogramas descargables para niños con TEA</h1>
      <p>Haz clic en los botones para descargar los pictogramas que necesites. Son ideales para crear rutinas visuales, reforzar el lenguaje o facilitar la comunicación.</p>

      <?php foreach ($pictogramas as $categoria => $imagenes): ?>
        <h2><?php echo $categoria; ?></h2>
        <div class="galeria">
          <?php foreach ($imagenes as $picto): ?>
            <div class="pictograma">
              <img src="<?php echo $picto['archivo']; ?>" alt="<?php echo $picto['nombre']; ?>">
              <p><?php echo $picto['nombre']; ?></p>
              <a href="<?php echo $picto['archivo']; ?>" download class="boton">Descargar</a>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endforeach; ?>
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