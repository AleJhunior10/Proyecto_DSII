<?php include_once "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['nombre']) || empty($_POST['telefono']) || empty($_POST['direccion'])) {
        $alert = '<div class="alert alert-danger" role="alert">
                                    Todo los campos son obligatorio
                                </div>';
    } else {
        $ci_nit = $_POST['ci_nit'];
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $usuario_id = $_SESSION['idUser'];

        $result = 0;
        if (is_numeric($ci_nit) and $ci_nit != 0) {
            $query = mysqli_query($conexion, "SELECT * FROM cliente where ci_nit = '$ci_nit'");
            $result = mysqli_fetch_array($query);
        }
        if ($result > 0) {
            $alert = '<div class="alert alert-danger" role="alert">
                                    El numero de CI / NIT ya existe
                                </div>';
        } else {
            $query_insert = mysqli_query($conexion, "INSERT INTO cliente(ci_nit,nombre,telefono,direccion, usuario_id) values ('$ci_nit', '$nombre', '$telefono', '$direccion', '$usuario_id')");
            if ($query_insert) {
                $alert = '<div class="alert alert-primary" role="alert">
                                    Cliente Registrado
                                </div>';
            } else {
                $alert = '<div class="alert alert-danger" role="alert">
                                    Error al Guardar
                            </div>';
            }
        }
    }
    mysqli_close($conexion);
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4 margen">
        <h1 class="h3 mb-0 text-gray-800">Panel de Administracion</h1>
        <a href="lista_cliente.php" class="btn btn-primary">Clientes</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-6 m-auto">
        <div class="card-header bg-primary text-white text-center">
         Registrar Producto
       </div>
       <div class="card">
            <form action="" method="post" autocomplete="off" class="card-body p-2">
                <?php echo isset($alert) ? $alert : ''; ?>
                <div class="form-group">
                    <label for="ci_nit">CI / Nit</label>
                    <input type="number" placeholder="Ingrese CI / NIT" name="ci_nit" id="ci_nit" class="form-control">
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" placeholder="Ingrese Nombre" name="nombre" id="nombre" class="form-control">
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="number" placeholder="Ingrese Teléfono" name="telefono" id="telefono" class="form-control">
                </div>
                <div class="form-group">
                    <label for="direccion">Dirección</label>
                    <input type="text" placeholder="Ingrese Direccion" name="direccion" id="direccion" class="form-control">
                </div>
                <input type="submit" value="Guardar Cliente" class="btn btn-primary">
            </form>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php include_once "includes/footer.php"; ?>