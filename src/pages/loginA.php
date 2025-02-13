<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mathive - Ingresa Equipo</title>
    <link rel="stylesheet" href="../css/login.css">

    <script src="../scripts/loginA.js"> </script>
</head>

<body>

    <header>
        <div class="logo">
            <img src="../../public/imagenes/logo-mathive.svg" alt="Logo Mathive">
        </div>
        <nav>
            <a href="../../index.php">Inicio</a>
        </nav>
    </header>

    <main>
        <div class="card">
            <h1>Ingresa el nombre del Alumno</h1>
            <form id="login-form">
                <label for="team-name">Ingresa</label>
                <input type="text" id="team-name" name="team-name" placeholder="Nombre del Alumno">
                <button type="submit">Ir a Equipo</button>
            </form>
            <div id="message-container"></div> <!-- Contenedor para mensajes -->
            <p>¿No tienen equipo? Pídanle a su profesor que les asigne uno.</p>
        </div>
    </main>

    <footer>
        <div class="footer">Derechos Reservados 2023 © Mathive</div>
    </footer>
</body>

</html>