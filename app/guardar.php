<?php
// conecar a base de datos con conexion/db.php
require_once '../conexion/db.php';

// recibir los datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // recbir los datos del formulario
    $piso = $_POST['piso'] ?? '';
    $numero = $_POST['numero'] ?? '';
    $caracteristicas = $_POST['caracteristicas'] ?? '';
    
    //  ingresar los datos en la base de datos
    $sql = "INSERT INTO departamentos (piso, numero, caracteristicas) VALUES (:piso, :numero, :caracteristicas)";
    // enviar varias con binparam para evitar inyeccion sql
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':piso', $piso);
    $stmt->bindParam(':numero', $numero);
    $stmt->bindParam(':caracteristicas', $caracteristicas);
    // ejecutar la consulta
    if ($stmt->execute()) {
        // redirigir a la pagina de listar usuarios
        header('Location: ../index.html');
        exit;
    } else {
        echo "Error al crear el departamento.";
    }
}

?>