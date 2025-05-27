<?php session_start();
include("conexion.php"); // Asegúrate de que este archivo exista y establezca $conn

// Redirigir si el usuario no está logueado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$message = '';
$redirect_to_topic = false;
$topic_id_to_redirect = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $topic_id = $_POST['topic_id'] ?? null;
    $content = trim($_POST['content'] ?? '');
    $user_id = $_SESSION['user_id'];

    if (empty($content) || empty($topic_id)) {
        $message = '<span style="color: red;">El contenido de la respuesta y el ID del tema son requeridos.</span>';
    } elseif (!is_numeric($topic_id)) {
        $message = '<span style="color: red;">ID de tema inválido.</span>';
    } else {

        // Verificar que el tema realmente existe
        $stmt_check_topic = $conn->prepare("SELECT id FROM topics WHERE id = ? LIMIT 1");
        $stmt_check_topic->bind_param("i", $topic_id);
        $stmt_check_topic->execute();
        $stmt_check_topic->store_result();

        if ($stmt_check_topic->num_rows === 0) {
            $message = '<span style="color: red;">El tema al que intentas responder no existe.</span>';
            $stmt_check_topic->close();
        } else {
            $stmt_check_topic->close();

            // Insertar el nuevo post (respuesta)
            $stmt = $conn->prepare("INSERT INTO posts (topic_id, user_id, content) VALUES (?, ?, ?)");
            if ($stmt) {
                $stmt->bind_param("iis", $topic_id, $user_id, $content);

                if ($stmt->execute()) {
                    $message = '<span style="color: green;">✅ Respuesta publicada exitosamente.</span>';
                    $redirect_to_topic = true;
                    $topic_id_to_redirect = $topic_id;

                    // Actualizar la columna last_post_at del tema
                    $stmt_update_topic = $conn->prepare("UPDATE topics SET last_post_at = CURRENT_TIMESTAMP WHERE id = ?");
                    if ($stmt_update_topic) {
                        $stmt_update_topic->bind_param("i", $topic_id);
                        $stmt_update_topic->execute();
                        $stmt_update_topic->close();
                    }
                } else {
                    $message = '<span style="color: red;">❌ Error al publicar la respuesta: ' . $stmt->error . '</span>';
                }
                $stmt->close();
            } else {
                $message = '<span style="color: red;">Error en la preparación de la consulta: ' . $conn->error . '</span>';
            }
        }
    }
} else {
    $message = '<span style="color: orange;">Acceso denegado. Este script solo acepta solicitudes POST.</span>';
}

$conn->close();

// Redirigir al tema después de procesar
if ($redirect_to_topic && $topic_id_to_redirect) {
    // Puedes añadir el mensaje a la URL o a una sesión para mostrarlo en temas-foro.php
    $_SESSION['post_message'] = $message;
    // LÍNEA CORREGIDA: topic.php a temas-foro.php
    header("Location: temas-foro.php?id=" . $topic_id_to_redirect);
    exit();
} else {
    // Si hubo un error que impidió la redirección al tema, podrías redirigir al foro principal
    // O mostrar el mensaje de error directamente aquí
    $_SESSION['post_message'] = $message; // Guarda el mensaje en la sesión
    header("Location: foro.php");
    exit();
}
?>
