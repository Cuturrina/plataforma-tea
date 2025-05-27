<?php
include("conexion.php");

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username'] ?? null);
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? null;

    // 1. Validaciones básicas del lado del servidor
    if (empty($username) || empty($email) || empty($password)) {
        $message = '<span style="color: red;">Por favor, completa todos los campos.</span>';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = '<span style="color: red;">Formato de email inválido.</span>';
    } elseif (strlen($password) < 6) {
        $message = '<span style="color: red;">La contraseña debe tener al menos 6 caracteres.</span>';
    } else {
        
        // 2. Verificar si el username o email ya existen
        $stmt_check = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ? LIMIT 1");
        $stmt_check->bind_param("ss", $username, $email);
        $stmt_check->execute();
        $stmt_check->store_result();

        if ($stmt_check->num_rows > 0) {
            $message = '<span style="color: red;">El nombre de usuario o el email ya están registrados. Por favor, elige otros.</span>';
        } else {

            // 3. Hashear la contraseña
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // 4. Insertar nuevo usuario
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

        <?php if (!empty($message)): ?>
            <div id="registerMessage" class="message">
                <?= $message ?>
            </div>
        <?php endif; ?>

        <div class="form-buttons-row">
            <button type="submit" class="btn">Registrarse</button>
        </div>
    </form>

    <p style="text-align: center; margin-top: 20px;">
        ¿Ya tienes cuenta? <a href="login.php" class="nav-link">Inicia sesión aquí</a>
    </p>
</section>

<script src="script.js"></script>
</body>
</html>