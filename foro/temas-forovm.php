<?php session_start();
include("../conexion.php");

$topic_id = $_GET['id'] ?? null; 
$topic = null;
$posts = [];
$error_message = '';

if ($topic_id && is_numeric($topic_id)) {
    // Obtener la información del tema principal
    $stmt_topic = $conn->prepare("
        SELECT
            t.id,
            t.title,
            t.content,
            t.created_at,
            u.username,
            c.id AS category_id,
            c.name AS category_name
        FROM
            topics t
        JOIN
            users u ON t.user_id = u.id
        JOIN
            categories c ON t.category_id = c.id
        WHERE
            t.id = ?
        LIMIT 1
    ");
    if ($stmt_topic) {
        $stmt_topic->bind_param("i", $topic_id);
        $stmt_topic->execute();
        $result_topic = $stmt_topic->get_result();
        if ($result_topic->num_rows > 0) {
            $topic = $result_topic->fetch_assoc();
        } else {
            $error_message = "El tema solicitado no existe.";
        }
        $stmt_topic->close();
    } else {
        $error_message = "Error en la preparación de la consulta del tema: " . $conn->error;
    }

    if ($topic) {
        // Obtener todos los posts (respuestas) de este tema, ordenados cronológicamente
        $stmt_posts = $conn->prepare("
            SELECT
                p.id,
                p.content,
                p.created_at,
                u.username
            FROM
                posts p
            JOIN
                users u ON p.user_id = u.id
            WHERE
                p.topic_id = ?
            ORDER BY
                p.created_at ASC
        ");
        if ($stmt_posts) {
            $stmt_posts->bind_param("i", $topic_id);
            $stmt_posts->execute();
            $result_posts = $stmt_posts->get_result();

            if ($result_posts->num_rows > 0) {
                while ($row = $result_posts->fetch_assoc()) {
                    $posts[] = $row;
                }
            }
            $stmt_posts->close();
        } else {
            $error_message = "Error en la preparación de la consulta de posts: " . $conn->error;
        }
    }
} else {
    $error_message = "ID de tema inválido o no proporcionado.";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🌈 <?= $topic ? htmlspecialchars($topic['title']) : 'Tema no encontrado' ?> - Foro TEA 🌟</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="../vista-movil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header>
        <h1>🌈 Plataforma Infantil para Niños con TEA 🌟</h1>
        <div id="menuSimulador" class="menu-simulador">
            <div class="hamburguesa" onclick="toggleMenuSimulador()">☰</div>
                <ul id="opcionesSimulador" class="opciones oculto">
                    <li><a href="../indexvm.php"><i class="fas fa-home"></i> Inicio</a></li>
                    <li><a href="../recursosvm.php"><i class="fas fa-book"></i> Recursos</a></li>
                    <li><a href="../padresvm.php"><i class="fas fa-user-friends"></i> Para Padres</a></li>
                    <li><a href="../forovm.php"><i class="fas fa-comments"></i> Foro</a></li>
                    <li><a href="../juegosvm.php"><i class="fas fa-gamepad"></i> Juegos</a></li>
                    <li><a href="../contactovm.php"><i class="fas fa-envelope"></i> Escríbenos</a></li>
                    <li><a href="../sugerenciasvm.php"><i class="fas fa-lightbulb"></i> Buzón de Sugerencias</a></li>
                    <li><a href="../proyectovm.php"><i class="fas fa-info-circle"></i> Sobre el Proyecto</a></li>
                    <li><a href="#" onclick="toggleMenuSimulador();"><i class="fas fa-times-circle"></i> Cerrar Menú</a></li>
                </ul>
            </div>
        </div>
    </header>

    <main class="container">
        <?php if ($error_message): ?>
            <div class="message error">
                <p><?= htmlspecialchars($error_message) ?></p>
                <p><a href="../forovm.php">Volver al Foro</a></p>
            </div>
        <?php elseif ($topic): ?>
            <p><a href="categorias-foro.php?id=<?= $topic['category_id'] ?>">&laquo; Volver a <?= htmlspecialchars($topic['category_name']) ?></a></p>
            <div class="topic-header">
                <h2><?= htmlspecialchars($topic['title']) ?></h2>
                <p class="topic-info">Iniciado por: <strong><?= htmlspecialchars($topic['username']) ?></strong> el <?= date("d/m/Y H:i", strtotime($topic['created_at'])) ?></p>
            </div>
            <div class="topic-content">
                <div class="post-item original-post">
                    <div class="post-author">
                        <strong><?= htmlspecialchars($topic['username']) ?></strong>
                        <span class="post-date"><?= date("d/m/Y H:i", strtotime($topic['created_at'])) ?></span>
                    </div>
                    <div class="post-body">
                        <p><?= nl2br(htmlspecialchars($topic['content'])) ?></p>
                    </div>
                </div>
            </div>

            <h3>Respuestas</h3>
            <div class="posts-list">
                <?php if (!empty($posts)): ?>
                    <?php foreach ($posts as $post): ?>
                        <div class="post-item">
                            <div class="post-author">
                                <strong><?= htmlspecialchars($post['username']) ?></strong>
                                <span class="post-date"><?= date("d/m/Y H:i", strtotime($post['created_at'])) ?></span>
                            </div>
                            <div class="post-body">
                                <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No hay respuestas para este tema aún.</p>
                <?php endif; ?>
            </div>

            <div class="reply-section">
                <?php if (isset($_SESSION['username'])): ?>
                    <h3>Responder a este tema</h3>
                    <form action="crear-post-foro.php" method="POST">
                        <input type="hidden" name="topic_id" value="<?= $topic['id'] ?>">
                        <div class="form-group">
                            <label for="post_content">Tu respuesta:</label>
                            <textarea id="post_content" name="content" rows="6" required></textarea>
                        </div>
                        <button type="submit" class="btn">Publicar Respuesta</button>
                    </form>
                <?php else: ?>
                    <p class="login-prompt">Por favor, <a href="../login.php">inicia sesión</a> para responder a este tema.</p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; Ayuda para Niños con Autismo. Todos los derechos reservados.</p>
        <div>
            <a href="../politica-privacidad.php">Política de Privacidad</a>
            <a href="../aviso-legal.php">Aviso Legal</a>
            <a href="../politica-cookies.php">Política de Cookies</a>
        </div>
    </footer>

    <script src="../script.js"></script>
    <script src="../scriptvm.js"></script>
</body>
</html>