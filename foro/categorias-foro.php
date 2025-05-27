<?php session_start();
include("../conexion.php");

$category_id = $_GET['id'] ?? null; // Obtiene el ID de la categoría de la URL
$category_name = '';
$category_description = ''; // Asegurarse de inicializarla
$topics = [];

if ($category_id && is_numeric($category_id)) {
    // Obtener el nombre de la categoría
    $stmt_cat = $conn->prepare("SELECT name, description FROM categories WHERE id = ?");
    if ($stmt_cat) {
        $stmt_cat->bind_param("i", $category_id);
        $stmt_cat->execute();
        $stmt_cat->bind_result($category_name, $category_description);
        $stmt_cat->fetch();
        $stmt_cat->close();
    }

    // Obtener los temas de esta categoría
    $stmt_topics = $conn->prepare("
        SELECT
            t.id,
            t.title,
            t.created_at,
            t.last_post_at,
            u.username,
            COUNT(p.id) AS post_count -- Contar el número de posts en cada tema
        FROM
            topics t
        JOIN
            users u ON t.user_id = u.id
        LEFT JOIN
            posts p ON t.id = p.topic_id
        WHERE
            t.category_id = ?
        GROUP BY
            t.id, t.title, t.created_at, t.last_post_at, u.username
        ORDER BY
            t.last_post_at DESC, t.created_at DESC
    ");
    if ($stmt_topics) {
        $stmt_topics->bind_param("i", $category_id);
        $stmt_topics->execute();
        $result_topics = $stmt_topics->get_result();

        if ($result_topics->num_rows > 0) {
            while ($row = $result_topics->fetch_assoc()) {
                $topics[] = $row;
            }
        }
        $stmt_topics->close();
    }
} else {
    // Si no se proporciona un ID de categoría válido, redirigir o mostrar un error
    header("Location: foro.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🌈 <?= htmlspecialchars($category_name) ?> - Foro TEA 🌟</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header>
        <h1>🌈 Plataforma Infantil para Niños con TEA 🌟</h1>
        <nav>
            <ul>
                <li><a href="../index.php"><i class="fas fa-home"></i> Inicio</a></li>
                <li><a href="../recursos.php"><i class="fas fa-book"></i> Recursos</a></li>
                <li><a href="../padres.php"><i class="fas fa-user-friends"></i> Para Padres</a></li>
                <li><a href="../foro.php"><i class="fas fa-comments"></i> Foro</a></li>
                <li><a href="../juegos.php"><i class="fas fa-gamepad"></i> Juegos</a></li>
                <li><a href="../contacto.php"><i class="fas fa-envelope"></i> Escríbenos</a></li>
                <li><a href="../sugerencias.php"><i class="fas fa-lightbulb"></i> Buzón de Sugerencias</a></li>
                <li><a href="../sobre-el-proyecto.php"><i class="fas fa-info-circle"></i> Sobre el Proyecto</a></li>
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
        <?php if (!empty($category_name)): ?>
            <h2>Temas en la Categoría: <?= htmlspecialchars($category_name) ?></h2>
            <?php if (!empty($category_description)): ?>
                <p class="category-description"><?= htmlspecialchars($category_description) ?></p>
            <?php endif; ?>
            <div class="new-topic-button">
                <?php if (isset($_SESSION['username'])): ?>
                    <a href="crear-tema-foro.php?category_id=<?= $category_id ?>" class="btn">Crear Nuevo Tema en esta Categoría</a>
                <?php else: ?>
                    <p class="login-prompt">Por favor, <a href="login.php">inicia sesión</a> para crear nuevos temas.</p>
                <?php endif; ?>
            </div>
            <?php if (!empty($topics)): ?>
                <div class="topic-list">
                    <?php foreach ($topics as $topic): ?>
                        <div class="topic-item">
                            <h3><a href="temas-foro.php?id=<?= $topic['id'] ?>"><?= htmlspecialchars($topic['title']) ?></a></h3>
                            <p class="topic-meta">Iniciado por: <?= htmlspecialchars($topic['username']) ?> el <?= date("d/m/Y H:i", strtotime($topic['created_at'])) ?></p>
                            <p class="topic-meta">Respuestas: <?= $topic['post_count'] ?></p>
                            <p class="topic-meta">Última actividad: <?= date("d/m/Y H:i", strtotime($topic['last_post_at'])) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>No hay temas en esta categoría aún. ¡Sé el primero en crear uno!</p>
            <?php endif; ?>
        <?php else: ?>
            <h2>Categoría no encontrada</h2>
            <p>La categoría que buscas no existe o el ID proporcionado no es válido.</p>
            <p><a href="../foro.php">Volver al Foro</a></p>
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

    <script src="../script.js"></script>
</body>
</html>