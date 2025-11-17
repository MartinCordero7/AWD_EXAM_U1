<?php

require_once '../conexion/db.php';

$usuario_id = $_POST['usuario_id'];
$materia_id = $_POST['id_materia']; // Changed to match the form field name

$nota1 = $_POST['nota1'];
$nota2 = $_POST['nota2'];
$nota3 = $_POST['nota3'];

$promedio = ($nota1 + $nota2 + $nota3) / 3;

//guardar las notas en la base de datos
// Using different column naming convention
try {
    // Let's query the database to see the structure of the notas table
    $sql = $pdo->prepare("DESCRIBE notas");
    $sql->execute();
    $columns = $sql->fetchAll(PDO::FETCH_COLUMN);
    
    // Now insert into the notas table with the correct column names
    $sql = $pdo->prepare("INSERT INTO notas (id, id_materia, nota1, nota2, nota3, promedio) 
                         VALUES (:usuario_id, :materia_id, :nota1, :nota2, :nota3, :promedio)");
    $sql->bindParam(':usuario_id', $usuario_id);
    $sql->bindParam(':materia_id', $materia_id);
    $sql->bindParam(':nota1', $nota1);
    $sql->bindParam(':nota2', $nota2);
    $sql->bindParam(':nota3', $nota3);
    $sql->bindParam(':promedio', $promedio);
    $sql->execute();
    
    // Redirect back to the form with success parameter
    header("Location: ingresar_notas.php?success=1");
    exit;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    // Debug output
    echo "<pre>";
    print_r($columns ?? []);
    echo "</pre>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guardando Notas</title>
    <link rel="stylesheet" href="../public/bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <a href="ingresar_notas.php" class="btn btn-primary">Volver al formulario</a>
    </div>
</body>
</html>
    <link rel="stylesheet" href="../public/bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <a href="ingresar_notas.php" class="btn btn-primary">Volver al formulario</a>
    </div>
</body>
</html>
