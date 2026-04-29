<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $usuario = trim($_POST['usuario'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($usuario) || empty($password)) {
        header("Location: registro.html?error=empty");
        exit();
    }

    try {
        // Verificar si el usuario ya existe
        $stmt_check = $pdo->prepare("SELECT id FROM usuarios WHERE usuario = :usuario");
        $stmt_check->bindParam(':usuario', $usuario);
        $stmt_check->execute();
        
        if ($stmt_check->rowCount() > 0) {
            // El usuario ya existe
            header("Location: registro.html?error=exists");
            exit();
        }

        // Encriptar la contraseña de forma segura
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Insertar el nuevo usuario en la base de datos
        $stmt_insert = $pdo->prepare("INSERT INTO usuarios (usuario, password_hash) VALUES (:usuario, :password_hash)");
        $stmt_insert->bindParam(':usuario', $usuario);
        $stmt_insert->bindParam(':password_hash', $password_hash);
        
        if ($stmt_insert->execute()) {
            // Registro exitoso
            header("Location: registro.html?success=1");
            exit();
        } else {
            header("Location: registro.html?error=db");
            exit();
        }

    } catch (PDOException $e) {
        header("Location: registro.html?error=db");
        exit();
    }
} else {
    // Si acceden directamente al archivo sin POST
    header("Location: registro.html");
    exit();
}
?>
