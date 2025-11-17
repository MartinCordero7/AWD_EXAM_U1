<?php
// conexion a base de datos con conexion/db.php
require_once '../conexion/db.php';
// consultar los usuarios de la base de datos
$sql = "SELECT * FROM usuarios";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
//printf("Usuarios cargados correctamente: %d usuarios encontrados\n", count($usuarios));



$sqlMaterias = "SELECT * FROM materias";
$stmtMaterias = $pdo->prepare($sqlMaterias);
$stmtMaterias->execute();
$materias = $stmtMaterias->fetchAll(PDO::FETCH_ASSOC);
//printf("Materias cargadas correctamente: %d materias encontradas\n", count($materias));

// Debug output
echo "<pre style='display:none;'>";
print_r($materias);
echo "</pre>";



?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar notas</title>
    <link rel="stylesheet" href="../public/bootstrap/css/bootstrap.min.css">
    <!-- Add SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Add SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Add Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .form-control:focus, .form-select:focus {
            border-color: #4e73df;
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        .bg-gradient-primary {
            background: linear-gradient(to right, #4e73df, #224abe);
        }
    </style>
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card mb-4">
        <div class="card-header bg-gradient-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Ingresar Notas</h2>
                <a href="../index.html" class="btn btn-light"><i class="bi bi-house-door-fill me-2"></i>Regresar al Menú</a>
            </div>
        </div>
        <div class="card-body p-4">
            <form action="guardar_notas.php" method="POST">
                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label for="usuario" class="form-label fw-bold"><i class="bi bi-person-fill me-2"></i>Seleccionar Estudiante</label>
                        <select id="usuario" name="usuario_id" class="form-select form-select-lg">
                            <?php foreach ($usuarios as $usuario): ?>
                                <option value="<?php echo htmlspecialchars($usuario['id']); ?>"><?php echo htmlspecialchars($usuario['nombre']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="materia" class="form-label fw-bold"><i class="bi bi-book-fill me-2"></i>Materia</label>
                        <select id="materia" name="id_materia" class="form-select form-select-lg">
                            <?php 
                            foreach ($materias as $materia) {
                                $id = $materia['id_materia'];
                                $nombre = $materia['nombre'];
                                echo "<option value='$id'>$nombre</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                
                <div class="row mb-4">
                    <h4 class="mb-3 text-primary"><i class="bi bi-clipboard-data me-2"></i>Calificaciones</h4>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100 bg-light">
                            <div class="card-body text-center">
                                <label for="nota1" class="form-label fw-bold">Nota 1</label>
                                <input type="number" id="nota1" name="nota1" class="form-control form-control-lg text-center" step="0.01" min="0" max="20" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100 bg-light">
                            <div class="card-body text-center">
                                <label for="nota2" class="form-label fw-bold">Nota 2</label>
                                <input type="number" id="nota2" name="nota2" class="form-control form-control-lg text-center" step="0.01" min="0" max="20" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100 bg-light">
                            <div class="card-body text-center">
                                <label for="nota3" class="form-label fw-bold">Nota 3</label>
                                <input type="number" id="nota3" name="nota3" class="form-control form-control-lg text-center" step="0.01" min="0" max="20" required>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" id="btnGuardar" class="btn btn-primary btn-lg"><i class="bi bi-save-fill me-2"></i>Guardar Notas</button>
                </div>
            </form>
        </div>
    </div>
    
    <div class="text-center">
        <a href="listado_notas.php" class="btn btn-outline-secondary"><i class="bi bi-table me-2"></i>Ver Listado de Notas</a>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get form and submit button
        const form = document.querySelector('form');
        const btnGuardar = document.getElementById('btnGuardar');
        
        // Check if there's a success parameter in the URL
        const urlParams = new URLSearchParams(window.location.search);
        if(urlParams.get('success') === '1') {
            // Clear the success parameter from the URL
            window.history.replaceState({}, document.title, window.location.pathname);
            
            // Show simplified success message
            Swal.fire({
                title: 'Notas guardadas correctamente',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
            
            // Reset the form values for number inputs
            const inputs = document.querySelectorAll('input[type="number"]');
            inputs.forEach(input => {
                input.value = '';
            });
        }
        
        // Add submit event listener
        form.addEventListener('submit', function(event) {
            // Let the form submit normally (no prevention)
            // The success message will show after redirect
        });
    });
</script>

</body>
</html>