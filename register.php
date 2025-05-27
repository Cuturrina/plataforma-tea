<?php
include("conexion.php");

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username'] ?? null);
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? null;  // No se usará si el registro es de Firebase
    $confirm_password = $_POST['confirm_password'] ?? null;  // No se usará si el registro es de Firebase

    // 1. Validaciones básicas del lado del servidor
    if (empty($username) || empty($email)) {
        $message = '<span style="color: red;">Por favor, completa todos los campos.</span>';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = '<span style="color: red;">Formato de email inválido.</span>';
    } elseif ($password !== $confirm_password) {
        $message = '<span style="color: red;">Las contraseñas no coinciden.</span>';
    } elseif (strlen($password) < 6) {
        $message = '<span style="color: red;">La contraseña debe tener al menos 6 caracteres.</span>';
    } else {
        $stmt_check = $conn->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");
        $stmt_check->bind_param("s", $email);
        $stmt_check->execute();
        $stmt_check->store_result();

        if ($stmt_check->num_rows > 0) {
            $message = '<span style="color: red;">El email ya está registrado. Por favor, elige otro.</span>';
        } else {

            // Si es un registro de Firebase, no es necesario que sea un password tradicional
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);  // Para otros casos, usar el hash de la contraseña
            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            if (!$stmt) {
                $message = '<span style="color: red;">Error en la preparación de la consulta: ' . $conn->error . '</span>';
            } else {
                $stmt->bind_param("sss", $username, $email, $hashed_password);
                if ($stmt->execute()) {
                    $message = '<span style="color: green;">✅ Registro exitoso. ¡Bienvenido, ' . htmlspecialchars($username) . '! Ahora puedes <a href="login.php">iniciar sesión</a>.</span>';
                } else {
                    $message = '<span style="color: red;">❌ Error al registrar: ' . $stmt->error . '</span>';
                }
                $stmt->close();
            }
        }
        $stmt_check->close();
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Cuenta</title>
    <link rel="stylesheet" href="styles.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <section id="register-page" class="page-section">
        <h2>Crear Cuenta</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Usuario:</label>
                <input type="text" id="username" name="username" required autocomplete="username">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required autocomplete="email">
            </div>

            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required autocomplete="new-password">
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirmar Contraseña:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>

            <?php if (!empty($message)): ?>
                <div id="registerMessage" class="message">
                    <?= $message ?>
                </div>
            <?php endif; ?>

            <div class="form-buttons-row">
                <button type="submit" class="btn">Registrarse</button>
            </div>
        </form>

        <div class="social-login">
            <button id="googleSignInBtn" class="btn btn-google">
                <i class="fab fa-google"></i> Google
            </button>
        </div>

        <p style="text-align: center; margin-top: 20px;">
            ¿Ya tienes cuenta? <a href="login.php" class="nav-link">Inicia sesión aquí</a>
        </p>
    </section>

    <!-- Incluir Firebase -->
    <script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-auth.js"></script>

    <!-- Enlace a archivo Javascript -->
    <script src="script.js"></script>
</body>
</html>
