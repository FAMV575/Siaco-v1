<?php 
include "header.php";
include "navbar.php";
?>

<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-sm-4 text-center">
      <h2>Siaco Infinity Tech</h2>
      <h5>Proyecto ADSI:</h5>
      <img src="img/logo.png" class="rounded mx-auto d-block border" width="80%" alt="...">
      <p><kbd>Reserva de citas odontologicas</kbd></p>
      <h3>Accesos rapidos</h3>
      <p>algunos links de acceso.</p>
      <ul class="nav nav-pills flex-column">
        <li class="nav-item">
          <a class="nav-link" href="mediosContacto.php">Medios de contacto</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="https://github.com/FAMV575">Acerca de</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"></a>
        </li>
      </ul>
      <hr class="d-sm-none">
    </div>

    <div class="col-sm-8">
      <div class="text-justify">
        <p class="alert alert-info">Por favor agende su cita.</p>
      </div>
      <?php 
        include "modal_reserva.php";
        // include "metodos/form_insert.php";
      ?>
      <hr>
      <div class="text-justify">
        <p class="alert alert-warning">¿Quieres consultar el estatus de su cita?, ¿No has recibido el mensaje de confirmación o falló el envío?</p>
      </div>
    </div>
  </div>
</div>

<?php include "footer.php"; ?>

<!-- Incluir los scripts de React -->
<script src="mi-aplicacion-react/build/static/js/main.chunk.js"></script>
<script src="mi-aplicacion-react/build/static/js/runtime-main.js"></script>
<script src="mi-aplicacion-react/build/static/js/2.chunk.js"></script>



<?php include "footer.php";?>