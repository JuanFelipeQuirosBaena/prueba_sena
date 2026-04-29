<?php
$host = 'localhost';
$dbname = 'prueba_sena';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Configurar PDO para que lance excepciones en caso de error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Si hay un error, lo mostramos y detenemos la ejecución
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
?>
