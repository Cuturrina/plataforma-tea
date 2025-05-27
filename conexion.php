<?php
$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_de_datos = "plataformaTEA";

// Conexión orientada a objetos
$conn = new mysqli($host, $usuario, $contrasena, $base_de_datos);

// Verificar conexión
if ($conn->connect_error) {
    die("❌ Error de conexión: " . $conn->connect_error);
}

// Esto ayuda con caracteres especiales y emojis
$conn->set_charset("utf8mb4");
?>
