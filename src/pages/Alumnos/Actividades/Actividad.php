<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../css/ActividadesAlum.css">
  <script src="../Actividades/getActividad.js"></script>
<!--   <script src="../Actividades/getActividadAlumno.js"></script>
 -->  <title>Actividad</title>
</head>

<body>
  <header class="header">
  <a href="../pageAlum.php" class="back-button">←</a>
  <h1 class="activity-title"></h1><!-- Actividad 1. Sumas y restas  -->
    <div class="progress">
      <span></span><!-- 3 de 3 -->
      <div class="timer"></div> <!-- 00.00 -->
    </div>
  </header>

  <main class="main">
  <p>Bienvenido, <span class="user-name"></span></p> <!--  This is where the user's name will be displayed -->
  <p>Nombre de la Actividad, <span class="activity-name"></span></p> <!--  This is where the user's name, id_actividad will be displayed -->
    <div class="question-container">
      <h2 class="question-text"></h2> <!--  ¿Cuánto es la suma de 2+2??      -->
    </div>

    <div class="activity-container">
      <div class="activity-board"></div>
      <div class="controls">
        <button class="tool edit">✎</button>
        <button class="tool add">＋</button>
      </div>
    </div>
    <div class="answers">
      <button class="answer blue" id="opccionA"></button>
      <button class="answer orange" id="opccionB"></button>
      <button class="answer yellow" id="opccionC"></button>
      <button class="answer green" id="opccionD"></button>
    </div>
  </main>
  <footer>
        <div class="footer">Derechos Reservados 2023 © Mathive</div>
  </footer>

  <!-- Modal cuando se acabe el tiempo -->
  <div class="notification">
    <div class="notification-content">
      <img src="http://localhost/Math_Corregido/public/imagenes/fondo.jpg" alt="Alarma" class="notification-icon">
      <p>¡Se acabó el tiempo!</p>
    </div>
  </div>

</body>

</html>