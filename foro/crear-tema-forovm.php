<?php session_start();
include("../conexion.php");

// Redirigir si el usuario no está logueado
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$message = '';
$categories_list = [];
$selected_category_id = $_GET['category_id'] ?? null;

// Obtener la lista de categorías para el dropdown del formulario
$sql_categories = "SELECT id, name FROM categories ORDER BY name ASC";
$result_categories = $conn->query($sql_categories);
if ($result_categories && $result_categories->num_rows > 0) {
    while ($row = $result_categories->fetch_assoc()) {
        $categories_list[] = $row;
    }
} else {
    $message = '<span style="color: red;">No hay categorías disponibles para crear un tema. Por favor, contacta al administrador.</span>';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_id = $_POST['category_id'] ?? null;
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $user_id = $_SESSION['user_id']; // El ID del usuario logueado

    if (empty($title) || empty($content) || empty($category_id)) {
        $message = '<span style="color: red;">Por favor, completa todos los campos requeridos.</span>';
    } elseif (!is_numeric($category_id)) {
        $message = '<span style="color: red;">Categoría inválida.</span>';
    } else {
        // Verificar que la categoría realmente existe
        $stmt_check_cat = $conn->prepare("SELECT id FROM categories WHERE id = ? LIMIT 1");
        $stmt_check_cat->bind_param("i", $category_id);
        $stmt_check_cat->execute();
        $stmt_check_cat->store_result();
        if ($stmt_check_cat->num_rows === 0) {
            $message = '<span style="color: red;">La categoría seleccionada no existe.</span>';
            $stmt_check_cat->close();
        } else {
            $stmt_check_cat->close();

            // Insertar el nuevo tema
            $stmt = $conn->prepare("INSERT INTO topics (category_id, user_id, title, content) VALUES (?, ?, ?, ?)");
            if ($stmt) {
                $stmt->bind_param("iiss", $category_id, $user_id, $title, $content);

                if ($stmt->execute()) {
                    $new_topic_id = $conn->insert_id; // Obtener el ID del nuevo tema
                    $message = '<span style="color: green;">✅ Tema creado exitosamente.</span>';
                    // Redirigir al nuevo tema
                    // LÍNEA CORREGIDA: topic.php a temas-foro.php
                    header("Location: temas-foro.php?id=" . $new_topic_id);
                    exit();
                } else {
                    $message = '<span style="color: red;">❌ Error al crear el tema: ' . $stmt->error . '</span>';
                }
                $stmt->close();
            } else {
                $message = '<span style="color: red;">Error en la preparación de la consulta: ' . $conn->error . '</span>';
            }
        }
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🌈 Crear Nuevo Tema Vista Móvil🌟</title>
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
        <h2>Crear Nuevo Tema</h2>

        <?php if ($message): ?>
            <div class="message">
                <?= $message ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($categories_list)): ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="category_id">Categoría:</label>
                    <select id="category_id" name="category_id" required>
                        <option value="">Selecciona una categoría</option>
                        <?php foreach ($categories_list as $cat): ?>
                            <option value="<?= $cat['id'] ?>" <?= ($selected_category_id == $cat['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($cat['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="title">Título del Tema:</label>
                    <input type="text" id="title" name="title" required maxlength="255">
                </div>

                <div class="form-group">
                    <label for="content">Contenido:</label>
                    <textarea id="content" name="content" rows="10" required></textarea>
                </div>

                <div class="form-buttons-row">
                    <button type="submit" class="btn">Publicar Tema</button>
                    <a href="../forovm.php" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
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