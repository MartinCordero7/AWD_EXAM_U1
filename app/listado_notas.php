<?php
// conexion a base de datos con conexion/db.php
require_once '../conexion/db.php';

// Consultar las notas con información de usuarios y materias usando JOIN
// Updated query to include NRC from materias table
$sql = "SELECT n.id_n, u.nombre AS nombre_usuario, m.nombre AS nombre_materia, 
               m.nrc, n.nota1, n.nota2, n.nota3, n.promedio 
        FROM notas n
        JOIN usuarios u ON n.id = u.id
        JOIN materias m ON n.id_materia = m.id_materia
        ORDER BY u.nombre, m.nombre";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$notas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Notas</title>
    <link rel="stylesheet" href="../public/bootstrap/css/bootstrap.min.css">
    <!-- Add Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .table-hover tbody tr:hover {
            background-color: rgba(78, 115, 223, 0.1);
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        .bg-gradient-info {
            background: linear-gradient(to right, #36b9cc, #1a8a9e);
        }
        .badge-avg {
            font-size: 1rem;
            padding: 0.5rem 0.7rem;
        }
    </style>
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card">
        <div class="card-header bg-gradient-info text-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0"><i class="bi bi-list-columns-reverse me-2"></i>Listado de Notas</h2>
                <div>
                    <a href="ingresar_notas.php" class="btn btn-light me-2"><i class="bi bi-pencil-square me-2"></i>Ingresar Notas</a>
                    <a href="../index.html" class="btn btn-outline-light"><i class="bi bi-house-door-fill me-2"></i>Volver al Inicio</a>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <?php if (count($notas) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center"><i class="bi bi-person me-2"></i>Estudiante</th>
                                <th class="text-center"><i class="bi bi-book me-2"></i>Materia</th>
                                <th class="text-center"><i class="bi bi-hash me-2"></i>NRC</th>
                                <th class="text-center"><i class="bi bi-1-circle me-2"></i>Nota 1</th>
                                <th class="text-center"><i class="bi bi-2-circle me-2"></i>Nota 2</th>
                                <th class="text-center"><i class="bi bi-3-circle me-2"></i>Nota 3</th>
                                <th class="text-center"><i class="bi bi-calculator me-2"></i>Promedio</th>
                                <th class="text-center"><i class="bi bi-check-circle me-2"></i>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($notas as $nota): ?>
                                <tr>
                                    <td><i class="bi bi-person-badge me-2"></i><?php echo htmlspecialchars($nota['nombre_usuario']); ?></td>
                                    <td><?php echo htmlspecialchars($nota['nombre_materia']); ?></td>
                                    <td class="text-center"><?php echo htmlspecialchars($nota['nrc']); ?></td>
                                    <td class="text-center"><?php echo number_format($nota['nota1'], 2); ?></td>
                                    <td class="text-center"><?php echo number_format($nota['nota2'], 2); ?></td>
                                    <td class="text-center"><?php echo number_format($nota['nota3'], 2); ?></td>
                                    <td class="text-center">
                                        <span class="badge rounded-pill <?php echo $nota['promedio'] >= 10 ? 'bg-success' : 'bg-danger'; ?> badge-avg">
                                            <?php echo number_format($nota['promedio'], 2); ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($nota['promedio'] >= 14): ?>
                                            <span class="badge bg-success text-white"><i class="bi bi-check-circle-fill me-1"></i> Aprobado</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger text-white"><i class="bi bi-x-circle-fill me-1"></i> Reprobado</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-info m-4">
                    <i class="bi bi-info-circle-fill me-2"></i>No hay notas registradas todavía.
                </div>
            <?php endif; ?>
        </div>
        <div class="card-footer bg-white text-center p-3">
            <a href="ingresar_notas.php" class="btn btn-success"><i class="bi bi-plus-circle-fill me-2"></i>Ingresar Nuevas Notas</a>
        </div>
    </div>
</div>

</body>
</html>
