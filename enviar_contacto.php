<?php
session_start();

$response = [
    'old_input' => $_POST,
    'error' => '',
    'success' => ''
];

// Validaciones
if (empty($_POST['nombre']) || empty($_POST['email']) || empty($_POST['mensaje'])) {
    $response['error'] = "Por favor, rellena todos los campos.";
    $_SESSION['response'] = $response;
    header("Location: contacto.php");
    exit;
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $response['error'] = "El email no es válido.";
    $_SESSION['response'] = $response;
    header("Location: contacto.php");
    exit;
}

// Datos
$nombre = htmlspecialchars($_POST['nombre']);
$email = htmlspecialchars($_POST['email']);
$mensaje = htmlspecialchars($_POST['mensaje']);

// Configuración del email
$destinatario = "tucorreo@ejemplo.com"; // <-- CAMBIA AQUÍ
$asunto = "Nuevo mensaje desde la Plataforma Infantil";
$cuerpo = "Nombre: $nombre\nEmail: $email\n\nMensaje:\n$mensaje";
$headers = "From: $email";

// Envío
if (mail($destinatario, $asunto, $cuerpo, $headers)) {
    $response['success'] = "¡Tu mensaje ha sido enviado correctamente!";
} else {
    $response['error'] = "Hubo un problema al enviar tu mensaje. Intenta más tarde.";
}

$_SESSION['response'] = $response;
header("Location: contacto.php");
exit;
