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
    $dni= $_POST['dni'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $direccion = $_POST['direccion'];
    $correo = $_POST['correo'];
    $celular = $_POST['celular'];
    $monto = $_POST['monto'];
    $tipo = $_POST['tipo'];
    $reclamo = $_POST['reclamo'];
    $pedido = $_POST['pedido'];

    // Insertar datos en la base de datos
    $sqlreclamo = "INSERT INTO reclamo (dni, nombres, apellidos, direccion, correo, celular, monto,tipo, reclamo,pedido)VALUES ('$dni', '$nombres', '$apellidos', '$direccion', '$correo','$celular','$monto','$tipo','$reclamo','$pedido')";


        if ($conn->query($sqlreclamo) === TRUE) {
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

    echo json_encode($response);
    $conn->close();

    //==================================================================

    //mandar correo



    $dni = filter_var($_POST['dni'], FILTER_SANITIZE_STRING);
    $nombres = filter_var($_POST['nombres'], FILTER_SANITIZE_STRING);
    $apellidos = filter_var($_POST['apellidos'], FILTER_SANITIZE_STRING);
    $direccion = filter_var($_POST['direccion'], FILTER_SANITIZE_STRING);
    $correo = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);
    $celular = filter_var($_POST['celular'], FILTER_SANITIZE_STRING);
    $monto = filter_var($_POST['monto'], FILTER_SANITIZE_STRING);
    $tipo = filter_var($_POST['tipo'], FILTER_SANITIZE_STRING);
    $reclamo= filter_var($_POST['reclamo'], FILTER_SANITIZE_STRING);
    $pedido = filter_var($_POST['pedido'], FILTER_SANITIZE_STRING);
    
        if(!empty($correo) && !empty($nombres) && !empty($apellidos)){
            $destino = 'davidlarrea1225@gmail.com';
            $asunto = 'FORMULARIO DE RECLAMOS';

            $cuerpo = '
            
            <html>
                <head>
                    <title>Correo de prueba</title>
                </head>
                <body>
                    <h2>Nombre y Apellidos: '.$nombres.' '.$apellidos.' </h2>
                    <h2>Correo: '.$correo.'</h2>
                    <h3>Direccion: '.$direccion.'</h3>
                    <h3>Celular: '.$celular.'</h3>
                    <h3>Solicitud: '.$tipo.'</h3>
                    <h3>Monto: '.$monto.'</h3>
                    <h3>Reclamo:</h3> 
                    <p>'.$reclamo.'</p>
                    <h3>Pedido:</h3> 
                    <p>'.$pedido.'</p>
                    
                </body>
            </html>
            
            ';

            //para el envio en formato html
            $header = "MIME-Version:  1.0\r\n";
            $header .= "Content-type: text/html; charset=utf-8\r\n";

            //direccion del remitente
            $header .= "From: $nombres $apellidos <$correo>\r\n";
            
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


?>
