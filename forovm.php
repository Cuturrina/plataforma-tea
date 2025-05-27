<?php session_start();
include("conexion.php"); 

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
    <title>🌈 Foro Vista Móvil</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
    </header>

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
    <script src="scriptvm.js"></script>
</body>
</html>