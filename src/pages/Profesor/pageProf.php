<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil</title>
    <link rel="stylesheet" href="../../css/inicioProfesor.css">
    <script src="../../scripts/loginP.js"></script>
</head>
<body>
    <div class="container">
        <header>
            <a href="#" class="back-arrow">&#8592;</a>
        </header>
        <main>
            <section class="profile-section">
                <div class="profile-card">
                    <img src="avatar-placeholder.png" alt="Avatar" class="avatar">
                    <h2>Mi perfil</h2>
                    <p>Juan Carlos D.<br>3B<br>Colegio MID</p>
                    <textarea placeholder="Agregar una nota"></textarea>
                </div>
            </section>
            <section class="students-section">
                <h3>Lista de alumnos</h3>
                <ul class="students-list">
                    <li>Raul B. <button class="delete-btn">&#128465;</button></li>
                    <li>Marcos E. <button class="delete-btn">&#128465;</button></li>
                    <li>Luis B. <button class="delete-btn">&#128465;</button></li>
                </ul>
                <button class="edit-btn">&#9998;</button>
            </section>
            <section class="activities-section">
                <h3>Actividades</h3>
                <ul class="activities-list">
                    <li>Actividad 1. Sumas y restas</li>
                    <li>Actividad 2. Fracciones</li>
                    <li>Actividad 4. Integrales</li>
                </ul>
                <button class="view-activities-btn">Ver las actividades</button>
            </section>
            <section class="teams-section">
                <h3>Lista de Equipos</h3>
                <ul class="teams-list">
                    <li>Alpha Centauri <button class="delete-btn">&#128465;</button></li>
                    <li>Escuadra <button class="delete-btn">&#128465;</button></li>
                    <li>Geométricos <button class="delete-btn">&#128465;</button></li>
                </ul>
                <button class="create-team-btn">Crear Equipo</button>
            </section>
            <section class="create-activity-section">
                <h3>Crear Actividad</h3>
                <button class="create-activity-btn">+</button>
            </section>
        </main>
        <footer>
            <p>Derechos Reservados 2023 &copy; Mathive</p>
        </footer>
    </div>
</body>
</html>
