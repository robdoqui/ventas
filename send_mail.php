<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $cart = json_decode($_POST['cart'], true);

    if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($cart)) {
        $subject = "Contenido del Carrito de Compras";
        $message = "Has agregado los siguientes productos a tu carrito:\n\n";
        foreach ($cart as $item) {
            $message .= $item['name'] . " - $" . $item['price'] . "\n";
        }

        $header= "From: rob_jimenez@hotmail.com" . "\r\n";
        $header= "Reply-To: rob_jimenez@hotmail.com" . "\r\n";
        $header= "X-Mailer:PHP/" . phpversion();

        if (mail($email, $subject, $message, $header)) {
            echo "Correo enviado correctamente.";
        } else {
            echo "Error al enviar el correo.";
        }
    } else {
        echo "Datos inválidos.";
    }
} else {
    echo "Método no permitido.";
}
?>
