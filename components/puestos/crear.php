<?php
    include("../../db.php");

    if($_POST) {
        print_r($_POST);
        $nombre=(isset($_POST["nombre"]) ? $_POST["nombre"] : "");
        $extraer = $conexion->prepare("INSERT INTO jobs (id, nombre)
                                        VALUES (null, :nombre)");

        $extraer->bindParam(":nombre", $nombre);
        $extraer->execute();

        $message = "Registro exitoso!!";
        header("Location:index.php?message=".$message);
    }
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
    <div class="card-header">Agregar Puesto</div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="col mb-3">
                <label for="nombre" class="form-label">Puesto</label>
                <input
                    type="text"
                    class="form-control"
                    name="nombre"
                    id="nombre"
                    aria-describedby="helpId"
                    placeholder="Ingresa un puesto"
                />
            </div>
            <div class="d-flex justify-content-end">
                <div class="me-2">
                <button
                    type="submit"
                    class="btn btn-success"
                >
                    Agregar Registro
                </button>
                </div>
                <div>
                    <a
                        class="btn btn-danger"
                        href="index.php"
                        role="button"
                        >Eliminar Contenido
                    </a>
                </div>
            </div>
        </form>
    </div>

</div>

<?php include("../../templates/footer.php") ?>