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


/*PARA EL FORMULARIO DE CONTACTO*/
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $email  = $_POST['email'];
    $celular1 = $_POST['telefono1'];
    $celular2 = $_POST['telefono2'];
    $ciudades = $_POST['ciudadesContacto'];
    $carreras = $_POST['carreraContacto'];
    $comentario = $_POST['comentariosContacto'];

    // Insertar datos en la base de datos
    $sql = "INSERT INTO persona (nombre, apellidos, email, telefono1, telefono2) VALUES ('$nombre', '$apellidos', '$email', '$celular1', '$celular2')";

    if($conn->query($sql) === TRUE){
        $lastid = $conn->insert_id;
        $contacto = "INSERT INTO contacto (id_persona, ciudad, carreras, comentario) VALUES ('$lastid', '$ciudades','$carreras', '$comentario')";
        
        if($conn->query($contacto) === TRUE){
            $response = array(
                'message' => 'Formulario enviado con éxito.',
                'icon' => 'success'
            );
        }else{
            $response = array(
                'message' => 'Error al guardar datos del contacto: ' . $conn->error,
                'icon' => 'error'
            );
        }
    }else{
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
    $nombre = filter_var($_POST['nombres'], FILTER_SANITIZE_STRING);
    $apellidos = filter_var($_POST['apellidos'], FILTER_SANITIZE_STRING);
    $celular1 = filter_var($_POST['telefono1'], FILTER_SANITIZE_STRING);
    $celular2 = filter_var($_POST['telefono2'], FILTER_SANITIZE_STRING);
    $ciudades = filter_var($_POST['ciudadesContacto'], FILTER_SANITIZE_STRING);
    $carreras = filter_var($_POST['carreraContacto'], FILTER_SANITIZE_STRING);
    $comentario = filter_var($_POST['comentariosContacto'], FILTER_SANITIZE_STRING);

    if (!empty($email) && !empty($nombre) && !empty($celular1)) {
        $destino = 'jahir1587@gmail.com';
        $asunto = 'Formulario CONTACTO';

        $cuerpo = '
        
        <html>
            <head>
                <title>Correo de prueba</title>
            </head>
            <body>
                <h2>Nombre del emitente: ' . $nombre . ' ' . $apellidos . ' </h2>
                <h3>Correo: ' . $email . '</h3>
                <h3>Telefono 01: ' . $celular1 . '</h3>
                <h3>Telefono 02: ' . $celular2 . '</h3>
                <h3>Ciudad: ' . $ciudades . '</h3>
                <h3>Carrera: ' . $carreras . '</h3>
                <h3>Comentario:</h3><p>' . $comentario . '</p>
                
                
            </body>
        </html>
        
        ';

        //para el envio en formato html
        $header = "MIME-Version:  1.0\r\n";
        $header .= "Content-type: text/html; charset=utf-8\r\n";

        //direccion del remitente
        $header .= "From: $nombre $apellidos <$email>\r\n";

        //ruta del mensaje de origen a destino
        $header .= "Return-path: $destino\r\n";

        mail($destino, $asunto, $cuerpo, $header);

        // header("Location: index.html");
    } else {
        echo "error al enviar";
    }
} else {
    http_response_code(400);
    echo 'Error: Acceso no permitido.';
}
