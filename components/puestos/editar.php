<?php
    include("../../db.php");

    if(isset( $_GET['txtID'])) {
        $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
        $sentencia = $conexion->prepare("SELECT * FROM jobs WHERE id=:id");
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();

        $job = $sentencia->fetch(PDO::FETCH_LAZY);

        $nombre = $job['nombre'];
    }

    if($_POST) {
        print_r($_POST);
        $nombre = (isset($_POST["nombre"]) ? $_POST["nombre"] : "");
        $extraer = $conexion->prepare("UPDATE jobs SET nombre=:nombre WHERE id=:id");
        $extraer->bindParam(":nombre", $nombre);
        $extraer->bindParam(":id", $txtID);
        $extraer->execute();
        
        $message = "Registro editado!!";
        header("Location:index.php?message=".$message);
    };
?>

<?php include("../../templates/header.php") ?>

<?php if(isset($_GET['message'])) ?>
<script>
    Swal.fire({
        title: "<?php echo $_GET['message']; ?>",
        icon: "success"
    });
</script>

</br>
<div class="card">
    <div class="card-header">Editar Puesto</div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="col mb-3">
                <fieldset disabled>
                    <label for="txtID" class="form-label">ID</label>
                    <input
                        value="<?php echo $txtID; ?>"
                        type="txtID"
                        class="form-control"
                        name="txtID"
                        id="txtID"
                        aria-describedby="helpId"
                        placeholder="Ingresar id"
                    />
                </fieldset>
            </div>
            <div class="col mb-3">
                <label for="nombre" class="form-label">Puesto</label>
                <input
                    value="<?php echo $nombre; ?>"
                    type="text"
                    class="form-control"
                    name="nombre"
                    id="nombre"
                    aria-describedby="helpId"
                    placeholder="Modificar puesto"
                />
            </div>
            <div class="d-flex justify-content-end">
                <div class="me-2">
                <button
                    type="submit"
                    class="btn btn-success"
                >
                    Modificar Registro
                </button>
                </div>
                <div>
                    <a
                        class="btn btn-primary"
                        href="index.php"
                        role="button"
                        >Regresar
                    </a>
                </div>
            </div>
        </form>
    </div>

</div>

<?php include("../../templates/footer.php") ?>