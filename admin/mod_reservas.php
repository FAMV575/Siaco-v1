<?php
include("header.php");
include("navbar.php");
include 'model/conexion.php';

// Procesamiento del formulario para ingresar nuevo registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $servicio = $_POST['servicio'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $mensaje = $_POST['mensaje'];

    try {
        // Insertar datos en la base de datos
        $stmt = $db->prepare("INSERT INTO reservas (Nombre, Apellidos, Correo, Servicio, Fecha, Hora, MensajeAdicional, Estado) 
                              VALUES (:nombre, :apellidos, :correo, :servicio, :fecha, :hora, :mensaje, 'Pendiente')");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':servicio', $servicio);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':hora', $hora);
        $stmt->bindParam(':mensaje', $mensaje);

        if ($stmt->execute()) {
            echo '<div class="alert alert-success" role="alert">Registro creado exitosamente.</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Error al crear el registro.</div>';
        }
    } catch (PDOException $e) {
        echo '<div class="alert alert-danger" role="alert">Error al insertar en la base de datos: ' . $e->getMessage() . '</div>';
    }
}

// Obtener la lista de reservas
$sentencia = $db->query("SELECT * FROM reservas;");
$dato = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

<div class="container">
    <br><br>
    <div class="row">
        <div class="container">
            <br><br>
            <div class="text-center">
                <h3>Lista de registros</h3>
                <a href="./inicio.php" class="btn btn-success"><i class="fas fa-home"></i> Regresar al inicio</a>
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#nuevoRegistroModal"><i class="fas fa-plus"></i> Ingresar Nuevo Registro</a>
            </div><br>

            <table class="table table-striped" id="tablaReservas">
                <thead>
                    <tr>
                        <th>NOMBRE</th>
                        <th>APELLIDOS</th>
                        <th>EMAIL</th>
                        <th>SERVICIO</th>
                        <th>FECHA</th>
                        <th>HORA</th>
                        <th>MENSAJE</th>
                        <th>ESTADO</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dato as $registro) { ?>
                        <tr>
                            <td><?php echo $registro->Nombre; ?></td>
                            <td><?php echo $registro->Apellidos; ?></td>
                            <td><?php echo $registro->Correo; ?></td>
                            <td><?php echo $registro->Servicio; ?></td>
                            <td><?php echo $registro->Fecha; ?></td>
                            <td><?php echo $registro->Hora; ?></td>
                            <td><?php echo $registro->MensajeAdicional; ?></td>
                            <td>
                                <?php
                                $estado = $registro->Estado;
                                $clase_color = '';

                                switch ($estado) {
                                    case 'Pendiente':
                                        $clase_color = 'text-warning'; // Amarillo para Pendiente
                                        break;
                                    case 'Cancelado':
                                        $clase_color = 'text-danger'; // Rojo para Cancelado
                                        break;
                                    case 'Confirmado':
                                        $clase_color = 'text-success'; // Verde para Confirmado
                                        break;
                                    default:
                                        $clase_color = ''; // Sin clase de color por defecto
                                        break;
                                }
                                ?>

                                <b class="<?php echo $clase_color; ?>"><?php echo $estado; ?></b>
                            </td>
                            <td>
                                <div class="d-flex">
                                    <a href="#" class="btn btn-sm btn-danger mr-1" data-toggle="modal" data-target="#confirmDelete">Eliminar</a>
                                    <a href="update/form_update.php?id=<?php echo $registro->ID;?>" class="btn btn-sm btn-info mr-1">Editar</a>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal de confirmación para eliminar -->
<?php include("modal_eliminar.php"); ?>
<?php include("../footer.php"); ?>

<!-- Modal para ingresar nuevo registro -->
<div class="modal fade" id="nuevoRegistroModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ingresar Nuevo Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="mod_reservas.php">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="apellidos">Apellidos:</label>
                        <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                    </div>
                    <div class="form-group">
                        <label for="correo">Correo:</label>
                        <input type="email" class="form-control" id="correo" name="correo" required>
                    </div>
                    <div class="form-group">
                        <label for="servicio">Selecciona un servicio:</label>
                        <select class="form-control" id="servicio" name="servicio" required>
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
                        <label for="mensaje">Mensaje Adicional:</label>
                        <textarea class="form-control" id="mensaje" name="mensaje" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Inicializar DataTable para la tabla de reservas
$(document).ready(function() {
    $('#tablaReservas').DataTable({
        "scrollX": true,
        "scrollCollapse": true
    });
});
</script>
