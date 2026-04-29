<?php
session_start();
require_once 'db.php';

// Verificar si se enviaron datos por el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Obtener y limpiar los datos del formulario
    $usuario = trim($_POST['usuario'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Verificar que los campos no estén vacíos
    if (empty($usuario) || empty($password)) {
        header("Location: index.html?error=empty");
        exit();
    }

    try {
        // Preparar la consulta SQL para evitar inyección SQL
        $stmt = $pdo->prepare("SELECT id, usuario, password_hash FROM usuarios WHERE usuario = :usuario");
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();

        // Obtener el usuario de la base de datos
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si el usuario existe y si la contraseña (hasheada) coincide
        // Nota: En la base de datos, las contraseñas deben estar encriptadas con password_hash()
        // Para este ejemplo sencillo, si quieres usar contraseñas en texto plano, cambiaríamos la validación a:
        // if ($user && $password === $user['password_hash'])
        // Pero por seguridad usaremos password_verify
        
        if ($user && password_verify($password, $user['password_hash'])) {
            // Contraseña correcta: iniciar sesión
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['usuario'] = $user['usuario'];
            
            // Redirigir al panel de control (dashboard)
            header("Location: dashboard.php");
            exit();
        } else {
            // Usuario o contraseña incorrectos
            header("Location: index.html?error=invalid");
            exit();
        }

    } catch (PDOException $e) {
        die("Error en la consulta: " . $e->getMessage());
    }
} else {
    // Si alguien intenta acceder a login.php directamente sin enviar el formulario
    header("Location: index.html");
    exit();
}
?>
