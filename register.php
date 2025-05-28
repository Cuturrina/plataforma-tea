<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? null;
    $password = $_POST['password'] ?? null;

    if (!$username || !$password) {
        echo "Por favor, completa todos los campos.";
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    if (!$stmt) {
        echo "Error en la preparación de la consulta: " . $conn->error;
        exit;
    }

    $stmt->bind_param("ss", $username, $hashed_password);

    if ($stmt->execute()) {
        echo "✅ Registro exitoso. <a href='login.php'>Iniciar sesión</a>";
    } else {
        echo "❌ Error al registrar: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
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
            <input type="text" id="username" name="username" required>
        </div>

        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div id="registerMessage" class="message"></div>

        <div class="form-buttons-row">
            <button type="submit" class="btn">Registrarse</button>
    </form>

    <p style="text-align: center; margin-top: 20px;">
        ¿Ya tienes cuenta? <a href="login.php" class="nav-link">Inicia sesión aquí</a>
    </p>
</section>
<?php } ?>

    <script src="script.js"></script>
</body>
</html>
