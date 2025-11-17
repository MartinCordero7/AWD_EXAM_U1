<?php
require_once '../conexion/db.php';
$sql = "SELECT * FROM departamentos";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$departamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Departamentos</title>
    <link rel="stylesheet" href="../public/bootstrap/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@magicbruno/swalstrap5@1.0.8/dist/js/swalstrap5_all.min.js"></script>
</head>

<body>
    <div class="container py-5">
        <h1 class="text-center mb-4">Lista de Departamentos</h1>
        <table class="table table-striped table-bordered" id="tabla-departamentos">
            <thead>
                <tr>
                    <th>Piso</th>
                    <th>Número</th>
                    <th>Características</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($departamentos as $depto): ?>
                    <tr id="fila-<?php echo $depto['id']; ?>">
                        <td><?php echo $depto['piso']; ?></td>
                        <td><?php echo $depto['numero']; ?></td>
                        <td><?php echo $depto['caracteristicas']; ?></td>
                    
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    
</body>

</html>