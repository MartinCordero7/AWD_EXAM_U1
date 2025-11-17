<?php
 
// conexion/db.php
$host = 'localhost';
$dbname = 'crud_departamentos';
$username = 'crud_departamentos';
$password = '12345';
$charset = 'utf8';
$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

try {
    // la variable $pdo se utiliza para crear una conexión a la base de datos
    // PDO es una extensión de PHP que permite acceder a bases de datos de manera segura y eficiente
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully to the database.";
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

?>
