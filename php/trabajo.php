<?php
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "dbastesis";

// $conn = new mysqli($servername, $username, $password, $dbname);
// if ($conn->connect_error) {
//     die("Conexión fallida: " . $conn->connect_error);
// }

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {


//     $nombres = $_POST['nombres'];
//     $apellidos = $_POST['apellidos'];
//     $correo = $_POST['correo'];
//     $telefono = $_POST['telefono'];
//     $especialidad = $_POST['especialidad']; 


//     $cv_filename = "";
//     if (isset($_FILES['cv']) && $_FILES['cv']['error'] === 0) {
//         $cv_filename = $_FILES['cv']['name'];
//         $cv_temp_path = $_FILES['cv']['tmp_name'];


//         $cv_destination = "../pdfs/" . $cv_filename;
//         move_uploaded_file($cv_temp_path, $cv_destination);
//     }

//     $sqltrabajo = "INSERT INTO trabajo (nombres, apellidos, correo, telefono, especialidad, cv) VALUES ('$nombres', '$apellidos', '$correo', '$telefono', '$especialidad', '$cv_filename')";

//     if ($conn->query($sqltrabajo) === TRUE) {
//         $response = array(
//             'message' => 'Formulario enviado con éxito.',
//             'icon' => 'success'
//         );
//     } else {
//         $response = array(
//             'message' => 'Error al guardar datos de suscripción: ' . $conn->error,
//             'icon' => 'error'
//         );
//     }

//     echo json_encode($response);
//     $conn->close();

// } else {
//     http_response_code(400);
//     echo 'Error: Acceso no permitido.';
// }

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
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $especialidad = $_POST['especialidad']; 

    // Manejar el archivo CV
    // $cv_filename = "";
    // if (isset($_FILES['cv']) && $_FILES['cv']['error'] === 0) {
    //     $cv_filename = $_FILES['cv']['name'];
    //     $cv_temp_path = $_FILES['cv']['tmp_name'];

    //     $cv_destination = "../pdfs/" . $cv_filename;
    //     move_uploaded_file($cv_temp_path, $cv_destination);
    // }
    
    $cv_filename = "";
    if (isset($_FILES['cv']) && $_FILES['cv']['error'] === 0) {
        $cv_filename = $_FILES['cv']['name'];
        $cv_temp_path = $_FILES['cv']['tmp_name'];

        // Mover el archivo a una ubicación permanente
        $cv_destination = "../pdfs/" . $cv_filename;
        move_uploaded_file($cv_temp_path, $cv_destination);
    }

    $sqltrabajo = "INSERT INTO trabajo (nombres, apellidos, correo, telefono, especialidad, cv) VALUES ('$nombres', '$apellidos', '$correo', '$telefono', '$especialidad', '$cv_filename')";

    if ($conn->query($sqltrabajo) === TRUE) {
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

} else {
    http_response_code(400);
    echo 'Error: Acceso no permitido.';
}


?>
