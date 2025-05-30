<?php session_start();
include("conexion.php");

$message = ''; // Variable para almacenar mensajes de error

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username'] ?? ''); 
    $password = $_POST['password'] ?? '';

    // 1. Validaciones básicas del lado del servidor
    if (empty($username) || empty(trim($password))) {
        $message = '<span style="color: red;">Por favor, completa todos los campos.</span>';
    } else {

        // 2. Preparar la consulta para buscar al usuario
        // Seleccionamos id, password y role (si lo usas para autorizar después)
        $stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
        if ($stmt) {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result(); 

            if ($stmt->num_rows > 0) {

                // 3. Vincular resultados y obtener el hash de la contraseña y el ID
                $stmt->bind_result($id, $db_username, $hashed_password, $role);
                $stmt->fetch();

                // 4. Verificar la contraseña
                if (password_verify($password, $hashed_password)) {
                    $_SESSION['user_id'] = $id;
                    $_SESSION['username'] = $db_username;
                    $_SESSION['role'] = $role;

                    // Redirigir al usuario
                    header("Location: index.php");
                    exit(); 
                } else {
                    $message = '<span style="color: red;">Usuario o contraseña incorrectos.</span>';
                }
            } else {
                $message = '<span style="color: red;">Usuario o contraseña incorrectos.</span>';
            }
            $stmt->close(); 
        } else {
            $message = '<span style="color: red;">Error en la preparación de la consulta: ' . $conn->error . '</span>';
        }
    }
    $conn->close(); 
}

// Si el usuario ya está logueado, redirigir a index.php para evitar que vea el formulario de login de nuevo
if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <section id="login-page" class="page-section">
        <h2>Iniciar Sesión</h2>

        <?php if (!empty($message)): ?>
            <div class="message"><?= $message ?></div>
        <?php endif; ?>

        <form id="loginForm" method="POST" action="">
            <div class="form-group">
                <label for="username">Usuario:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-buttons-row">
                <button type="submit" id="loginBtn">Iniciar Sesión</button>
            </div>
        </form>

        <p style="text-align: center; margin-top: 20px;">
            ¿No tienes cuenta? <a href="register.php">Regístrate aquí</a>
        </p>
    </section>

    <!-- Enlace a archivo Javascript -->
    <script src="script.js"></script>
</body>
</html>


