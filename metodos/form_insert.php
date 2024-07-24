<form action="metodos/insert.php" method="post">
    <p class="text-danger"><b>Los datos con (*) son obligatorios.</b></p>

    <div class="form-group">
        <label for="nombre">Nombre *</label>
        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombres" required>
        <small class="form-text text-muted">Si tienes dos nombres, colócalos aquí.</small>
    </div>

    <div class="form-group">
        <label for="apellidos">Apellidos *</label>
        <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos" required>
        <small class="form-text text-muted">Coloca tus apellidos.</small>
    </div>

    <div class="form-group">
        <label for="correo">Correo *</label>
        <input type="email" class="form-control" id="correo" name="correo" placeholder="correo@gmail.com" required>
    </div>

    <div class="form-group">
        <label for="servicio">Selecciona un servicio *</label>
        <select class="custom-select" id="servicio" name="servicio" required>
            <option value="" selected>Elige...</option>
            <option value="Consulta general">Consulta general</option>
            <option value="Consulta de Seguimiento">Consulta de Seguimiento</option>
            <option value="Endodoncia">Endodoncia</option>
            <option value="Ortodoncia">Ortodoncia</option>
            <option value="Periodoncias">Periodoncia</option>
            <option value="Rehabilitación Oral">Rehabilitación Oral</option>
            <option value="Ortodoncia y Ortopedia Dentofacial">Ortodoncia y Ortopedia Dentofacial</option>
            <option value="Prostodoncia">Prostodoncia</option>
            <option value="Odontología Pediátrica y Ortopedia Maxilar">Odontología Pediátrica y Ortopedia Maxilar</option>
            
        </select>
    </div>

    <div class="form-group">
                <label for="fecha">Fecha:</label>
                <input type="date" class="form-control" id="fecha" name="fecha" required>
                <div id="mensaje-error" style="color: red;"></div>
    </div>

    <div class="form-group">
        <label for="hora">Hora:</label>
        <select class="form-control" id="hora" name="hora" required>
            <option value="" selected>Elige la hora</option>
            <option value="08:00">08:00 AM</option>
            <option value="09:00">09:00 AM</option>
            <option value="10:00">10:00 AM</option>
            <option value="11:00">11:00 AM</option>
            <option value="12:00">12:00 PM</option>
            <option value="13:00">01:00 PM</option>
            <option value="14:00">02:00 PM</option>
            <option value="15:00">03:00 PM</option>
            <option value="16:00">04:00 PM</option>
            <option value="17:00">05:00 PM</option>
            <option value="18:00">06:00 PM</option>

        </select>
    </div>

    <div class="form-group">
        <label for="mensaje">Mensaje adicional:</label>
        <textarea class="form-control" id="mensaje" name="mensaje" rows="3"></textarea>
    </div>
    <input type="hidden" name="estado" value="Pendiente">
    <input type="hidden" name="oculto" value="1">
    <button type="reset" class="btn btn-warning">Borrar</button>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>


<script>
document.addEventListener("DOMContentLoaded", function() {
    // Función para validar si la fecha es válida
    function esFechaValida(fecha) {
        return fecha instanceof Date && !isNaN(fecha);
    }

    // Función para validar la fecha
    function validarFecha() {
        var fechaInput = document.getElementById("fecha");
        // Dividimos la entrada para evitar conversiones de zona horaria
        var partesFecha = fechaInput.value.split('-');
        // Creamos la fecha en UTC
        var fechaSeleccionada = new Date(Date.UTC(partesFecha[0], partesFecha[1] - 1, partesFecha[2]));
        var mensajeError = document.getElementById("mensaje-error");

        if (!esFechaValida(fechaSeleccionada)) {
            mensajeError.textContent = "Por favor, introduce una fecha válida.";
            fechaInput.value = "";
            return;
        }

        var diaSemana = fechaSeleccionada.getUTCDay(); // Usamos getUTCDay para obtener el día en UTC

        /*
            0: Domingo
            1: Lunes
            2: Martes
            3: Miércoles
            4: Jueves
            5: Viernes
            6: Sábado
        */

        // Coloca únicamente los dias que deseas habilitar
        if (diaSemana !== 1 && diaSemana !== 2 && diaSemana !== 3 && diaSemana !== 4 && diaSemana !== 5) {
            fechaInput.value = ""; // Borrar la fecha seleccionada
            mensajeError.textContent = "Dia no disponible, seleccione uno distinto.";
        } else {
            mensajeError.textContent = "";
        }
    }

    // Agregar un evento onchange al campo de fecha
    document.getElementById("fecha").addEventListener("change", validarFecha);
});

</script>

