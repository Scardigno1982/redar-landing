<?php
// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Only process POST requests
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Debug: Print received data
    echo "POST Data: ";
    print_r($_POST);
    echo "<br>";

    // Get the form fields and remove whitespace
    $name = isset($_POST["name"]) ? strip_tags(trim($_POST["name"])) : '';
    $name = str_replace(array("\r","\n"),array(" "," "),$name);
    $email = isset($_POST["email"]) ? filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL) : '';
    $message = isset($_POST["message"]) ? trim($_POST["message"]) : '';

    // Check that data was sent to the mailer
    if (empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Set a 400 (bad request) response code and exit
        http_response_code(400);
        echo "¡Vaya! Hubo un problema con su envío. Por favor, rellene el formulario e inténtelo de nuevo.";
        exit;
    }

    // Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    $mail->CharSet = 'UTF-8';  // Set the CharSet to UTF-8

    try {
        // Server settings
        $mail->SMTPDebug = 0; // 0 to disable debug output
        $mail->isSMTP();
        $mail->Host       = 'mail.redesargentinassa.com.ar'; // SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = '#'; // SMTP username
        $mail->Password   = '#'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('langindredar@redesargentinassa.com.ar', 'Landing Page');
        $mail->addAddress('langindredar@redesargentinassa.com.ar', 'Usuario 1');
        $mail->addReplyTo($email, $name);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Nuevo mensaje de contacto';
        $mail->Body    = '<p><strong>Nombre:</strong> ' . htmlspecialchars($name) . '</p>
                          <p><strong>Email:</strong> ' . htmlspecialchars($email) . '</p>
                          <p><strong>Mensaje:</strong><br>' . nl2br(htmlspecialchars($message)) . '</p>';
        $mail->AltBody = 'Nombre: ' . htmlspecialchars($name) . "\n" .
                         'Email: ' . htmlspecialchars($email) . "\n" .
                         'Mensaje: ' . htmlspecialchars($message);

        $mail->send();
        
        // Set a 200 (okay) response code
        http_response_code(200);
        echo "<script>alert('Formulario Enviado');location.href =history.back();</script>";
    } catch (Exception $e) {
        // Set a 500 (internal server error) response code
        http_response_code(500);
        echo "No se pudo enviar el mensaje. Error de correo: {$mail->ErrorInfo}";
    }
} else {
    // Not a POST request, set a 403 (forbidden) response code
    http_response_code(403);
    echo "Hubo un problema con su envío, inténtelo de nuevo.";
}