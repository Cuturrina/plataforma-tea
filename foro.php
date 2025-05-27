<?php session_start();
include("conexion.php"); // Asegúrate de que este archivo exista y establezca $conn

// Recuperar categorías del foro
$categories = [];
$sql_categories = "SELECT id, name, description FROM categories ORDER BY name ASC";
$result_categories = $conn->query($sql_categories);

if ($result_categories && $result_categories->num_rows > 0) {
    while ($row = $result_categories->fetch_assoc()) {
        $categories[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🌈 Foro TEA - Plataforma Infantil para Niños con TEA 🌟</title>
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

    <main class="container">
        <h2>Foro de la Plataforma</h2>
        <?php if (!empty($categories)): ?>
            <div class="forum-categories">
                <?php foreach ($categories as $category): ?>
                    <div class="category-item">
                        <h3><a href="foro/categorias-foro.php?id=<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></a></h3>
                        <p><?= htmlspecialchars($category['description']) ?></p>
                        </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No hay categorías de foro disponibles en este momento.</p>
        <?php endif; ?>

        <?php if (isset($_SESSION['username'])): ?>
            <div class="new-topic-button">
                <a href="foro/crear-tema-foro.php" class="btn">Crear Nuevo Tema</a>
            </div>
        <?php else: ?>
            <p>Por favor, <a href="login.php">inicia sesión</a> para crear nuevos temas y participar en el foro.</p>
        <?php endif; ?>
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