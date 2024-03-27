<?php

header('Content-Type: text/html');


// Validación de datos
if (empty($_POST['name'])) {
    echo "El nombre es obligatorio.";
    exit;
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    echo "La dirección de correo electrónico no es válida.";
    exit;
}

// Validar la fecha y hora (formato YYYY-MM-DD HH:MM)
if (!preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}$/', $_POST['date'])) {
    echo "La fecha y hora no tienen el formato correcto.";
    exit;
}

// Crear el cuerpo del mensaje
$message = "Nombre: " . htmlspecialchars($_POST['name']) . "\n";
$message .= "Correo electrónico: " . htmlspecialchars($_POST['email']) . "\n";
$message .= "Fecha: " . htmlspecialchars($_POST['date']) . "\n";
$message .= "Hora: " . htmlspecialchars($_POST['time']) . "\n";

// Enviar el correo electrónico
try {
    if (!mail('ghanamaktham@gmail.com', 'Formulario de contacto', $message)) {
        throw new Exception('Error al enviar el correo electrónico.');
    }
} catch (Exception $e) {
    echo $e->getMessage();
    exit;
}

// Redirigir al usuario a una página de agradecimiento
header('Location: index.html');

?>
