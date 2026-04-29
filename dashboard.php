<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: #f4f7f6; color: #333; display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100vh; }
        .dashboard-container { background: white; padding: 40px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); text-align: center; max-width: 500px; width: 100%; }
        h1 { margin-bottom: 20px; color: #667eea; }
        p { margin-bottom: 30px; font-size: 18px; }
        .logout-btn { padding: 10px 20px; background-color: #e74c3c; color: white; text-decoration: none; border-radius: 6px; font-weight: 600; transition: background-color 0.3s; }
        .logout-btn:hover { background-color: #c0392b; }
    </style>
</head>
<body>

<div class="dashboard-container">
    <h1>¡Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</h1>
    <p>Has iniciado sesión correctamente.</p>
    <a href="logout.php" class="logout-btn">Cerrar Sesión</a>
</div>

</body>
</html>
