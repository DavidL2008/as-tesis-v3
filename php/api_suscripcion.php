<?php
    // Conexión a la base de datos (ejemplo con MySQL)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dbastesis";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir datos del formulario
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $telefono1 = $_POST['telefono1'];
    $telefono2 = $_POST['telefono2'];
    $email = $_POST['email'];
    $comentario = $_POST['comentario'];


    // Insertar datos en la base de datos
    $sql = "INSERT INTO persona (nombre, apellidos, email, telefono1, telefono2) VALUES ('$nombres', '$apellidos', '$telefono1', '$telefono2', '$email')";

    if ($conn->query($sql) === TRUE) {
        $lastid = $conn->insert_id;
        $suscripcion = "INSERT INTO suscripcion (id_persona, comentario) VALUES ('$lastid', '$comentario')";

        if ($conn->query($suscripcion) === TRUE) {
            $response = array(
                'message' => 'Formulario enviado con éxito.',
                'icon' => 'success'
            );
        } else {
            $response = array(
                'message' => 'Error al guardar datos de suscripción: ' . $conn->error,
                'icon' => 'error'
            );
        }
    } else {
        $response = array(
            'message' => 'Error al guardar datos de persona: ' . $conn->error,
            'icon' => 'error'
        );
    }
    echo json_encode($response);
    $conn->close();

    //==================================================================

    //mandar correo

    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $nombres = filter_var($_POST['nombres'], FILTER_SANITIZE_STRING);
    $apellidos = filter_var($_POST['apellidos'], FILTER_SANITIZE_STRING);
    $telefono1 = filter_var($_POST['telefono1'], FILTER_SANITIZE_STRING);
    $telefono2 = filter_var($_POST['telefono2'], FILTER_SANITIZE_STRING);
    $comentario = filter_var($_POST['comentario'], FILTER_SANITIZE_STRING);
    
    if(!empty($email) && !empty($nombres) && !empty($telefono1)){
        $destino = 'jahir1587@gmail.com';
        $asunto = 'FORMULARIO SUSCRIPCION';

        $cuerpo = '
        
        <html>
            <head>
                <title>Correo de prueba</title>
            </head>
            <body>
                <h2>Nombre del emitente: '.$nombres.' '.$apellidos.' </h2>
                <h2>Correo: '.$email.'</h2>
                <h3>Telefono: '.$telefono1.'</h3>
                <h3>Telefono2: '.$telefono2.'</h3>
                <h3>Comentario:</h3> 
                <p>'.$comentario.'</p>
                
            </body>
        </html>
        
        ';

        //para el envio en formato html
        $header = "MIME-Version:  1.0\r\n";
        $header .= "Content-type: text/html; charset=utf-8\r\n";

        //direccion del remitente
        $header .= "From: $nombres $apellidos <$email>\r\n";
        
        //ruta del mensaje de origen a destino
        $header .= "Return-path: $destino\r\n";

        mail($destino, $asunto, $cuerpo, $header);
        
    }else{
        echo "error al enviar";
    }

    } else {
        http_response_code(400);
        echo 'Error: Acceso no permitido.';
    }
