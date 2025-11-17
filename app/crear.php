<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar departamento</title>
    <link rel="stylesheet" href="../public/bootstrap/css/bootstrap.min.css">
</head>
<body>
    
    <div class="container py-5">
        <!-- crear un formulario con metodo post, para campos nombre,email y edad -->
        <h1>Crear </h1>
        <form action="guardar.php" method="post">
            <div class="mb-3">
                <label for="piso" class="form-label">Piso</label>
                <input type="number" class="form-control" id="piso" name="piso" required>
            </div>
            <div class="mb-3">
                <label for="numero" class="form-label">Numero de habitacion</label>
                <input type="number" class="form-control" id="numero" name="numero" required>
            </div>
            <div class="mb-3">
                <label for="caracteristicas" class="form-label">Caracteristicas</label>
                <input type="text" class="form-control" id="caracteristicas" name="caracteristicas" required>
            </div>
            <button type="submit" class="btn btn-primary">Crear Departamento</button>
        </form>
    </div>
</body>
</html>
