<?php
    include("../../db.php");

    if($_POST) {
        print_r($_POST);
        print_r($_FILES);

        $first_name=(isset($_POST["first_name"]) ? $_POST["first_name"] : "");
        $middle_name=(isset($_POST["middle_name"]) ? $_POST["middle_name"] : "");
        $first_surname=(isset($_POST["first_surname"]) ? $_POST["first_surname"] : "");
        $second_last_name=(isset($_POST["second_last_name"]) ? $_POST["second_last_name"] : "");
        $email=(isset($_POST["email"]) ? $_POST["email"] : "");
        $photo=(isset($_FILES["photo"]["name"]) ? $_FILES["photo"]["name"] : "");
        $job_id=(isset($_POST["job_id"]) ? $_POST["job_id"] : "");

        $extraer = $conexion->prepare("INSERT INTO employees(id, first_name, middle_name, first_surname, second_last_name, email, photo, job_id)
                                        VALUES (null, :first_name, :middle_name, :first_surname, :second_last_name, :email, :photo, :job_id)");

        $extraer->bindParam(":first_name", $first_name);
        $extraer->bindParam(":middle_name", $middle_name);
        $extraer->bindParam(":first_surname", $first_surname);
        $extraer->bindParam(":second_last_name", $second_last_name);
        $extraer->bindParam(":email", $email);

        $fecha_foto = new DateTime();
        $nombre_archivo_foto = ($photo != '') ? $fecha_foto->getTimestamp()."_".$_FILES["photo"]["name"] : "";
        $tmp_foto = $_FILES["photo"]["tmp_name"];

        if($tmp_foto!='') {
            move_uploaded_file($tmp_foto, "./image/".$nombre_archivo_foto);
        }

        $extraer->bindParam(":photo", $nombre_archivo_foto);
        $extraer->bindParam(":job_id", $job_id);
        $extraer->execute();

        $message = "Registro exitoso!!";
        header("Location:index.php?message=".$message);
    }

    $sentencia = $conexion->prepare("SELECT * FROM jobs");
    $sentencia->execute();
    $job_list = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include("../../templates/header.php") ?>
</br>
<div class="card">
    <div class="card-header">Agregar Empleado</div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col mb-3">
                    <label for="first_name" class="form-label">Primer nombre</label>
                    <input
                        type="text"
                        class="form-control"
                        name="first_name"
                        id="first_name"
                        aria-describedby="helpId"
                        placeholder="Primer Nombre"
                    />
                </div>
                <div class="col mb-3">
                    <label for="middle_name" class="form-label">Segundo nombre</label>
                    <input
                        type="text"
                        class="form-control"
                        name="middle_name"
                        id="middle_name"
                        aria-describedby="helpId"
                        placeholder="Segundo Nombre"
                    />
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label for="first_surname" class="form-label">Primer apellido</label>
                    <input
                        type="text"
                        class="form-control"
                        name="first_surname"
                        id="first_surname"
                        aria-describedby="helpId"
                        placeholder="Primer Apellido"
                    />
                </div>
                <div class="col mb-3">
                    <label for="second_last_name" class="form-label">Segundo apellido</label>
                    <input
                        type="text"
                        class="form-control"
                        name="second_last_name"
                        id="second_last_name"
                        aria-describedby="helpId"
                        placeholder="Segundo Apellido"
                    />
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label for="photo" class="form-label">Foto</label>
                    <input
                        type="file"
                        class="form-control"
                        name="photo"
                        id="photo"
                        aria-describedby="helpId"
                        placeholder="Fotografía"
                    />
                </div>
                <div class="col mb-3">
                    <label for="job_id" class="form-label">Puesto</label>
                    <select
                        class="form-select"
                        name="job_id"
                        id="job_id"
                    >
                    <option selected>Elige un puesto</option>
                    <?php foreach ($job_list as $job) { ?>
                        <option value="<?php echo $job['id'] ?>">
                            <?php echo $job['nombre']; ?>
                        </option>
                    <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label for="email" class="form-label">Correo</label>
                    <input
                        type="email"
                        class="form-control"
                        name="email"
                        id="email"
                        aria-describedby="helpId"
                        placeholder="ejemplo@yaskawa.com"
                    />
                </div>
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
                        >Eliminar Contenido</a
                    >
                </div>
            </div>
        </form>
    </div>

</div>

<?php include("../../templates/footer.php") ?>