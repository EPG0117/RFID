<?php
    include("../../db.php");

    if(isset($_GET['txtID'])) {
        $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
        $sentencia = $conexion->prepare("SELECT * FROM employees WHERE id=:id");
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();

        $employee = $sentencia->fetch(PDO::FETCH_LAZY);

        $first_name = $employee['first_name'];
        $middle_name = $employee['middle_name'];
        $first_surname = $employee['first_surname'];
        $second_last_name = $employee['second_last_name'];
        $email = $employee['email'];
        $photo = $employee['photo'];
        $job_id = $employee['job_id'];


        $sentencia = $conexion->prepare("SELECT * FROM jobs");
        $sentencia->execute();
        $job_list = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    if($_POST) {
        print_r($_POST);
        print_r($_FILES);

        $first_name=(isset($_POST["first_name"]) ? $_POST["first_name"] : "");
        $middle_name=(isset($_POST["middle_name"]) ? $_POST["middle_name"] : "");
        $first_surname=(isset($_POST["first_surname"]) ? $_POST["first_surname"] : "");
        $second_last_name=(isset($_POST["second_last_name"]) ? $_POST["second_last_name"] : "");
        $email=(isset($_POST["email"]) ? $_POST["email"] : "");
        $job_id=(isset($_POST["job_id"]) ? $_POST["job_id"] : "");

        $sentencia = $conexion->prepare("UPDATE employees SET first_name=:first_name, 
                                                            middle_name=:middle_name, 
                                                            first_surname=:first_surname,
                                                            second_last_name=:second_last_name,
                                                            email=:email,
                                                            job_id=:job_id
                                                            WHERE id=:id");

        $sentencia->bindParam(":id", $txtID);
        $sentencia->bindParam(":first_name", $first_name);
        $sentencia->bindParam(":middle_name", $middle_name);
        $sentencia->bindParam(":first_surname", $first_surname);
        $sentencia->bindParam(":second_last_name", $second_last_name);
        $sentencia->bindParam(":email", $email);
        $sentencia->bindParam(":job_id", $job_id);
        
        $sentencia->execute();

        $photo = (isset($_FILES["photo"]["name"]) ? $_FILES["photo"]["name"] : "");

        $fecha_foto = new DateTime();
        $nombre_archivo_foto = ($photo != '') ? $fecha_foto->getTimestamp()."_".$_FILES["photo"]["name"] : "";
        $tmp_foto = $_FILES["photo"]["tmp_name"];

        if($tmp_foto!='') {
            move_uploaded_file($tmp_foto, "./image/".$nombre_archivo_foto);

            $sentencia = $conexion->prepare("SELECT photo FROM employees WHERE id=:id");
            $sentencia->bindParam(":id", $txtID);
            $sentencia->execute();
            $registro_foto = $sentencia->fetch(PDO::FETCH_LAZY);

            if(isset($registro_foto["photo"]) && $registro_foto["photo"] != "") {
                if(file_exists("./image/".$registro_foto["photo"])) {
                    unlink("./image/".$registro_foto["photo"]);
                }
            }

            $sentencia = $conexion->prepare("UPDATE employees SET photo=:photo 
                                                            WHERE id=:id");
            $sentencia->bindParam(":id", $txtID);
            $sentencia->bindParam(":photo", $nombre_archivo_foto);

            $sentencia->execute();
        }

        $message = "Registro editado!!";
        header("Location:index.php?message=".$message);
    }
?>

<?php include("../../templates/header.php") ?>
</br>
<div class="card">
    <div class="card-header">Editar Empleado</div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
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
                            placeholder="Editar id"
                        />
                    </fieldset>
                </div>
                <div class="col mb-3">
                    <label for="first_name" class="form-label">Primer nombre</label>
                    <input
                        value="<?php echo $first_name; ?>"
                        type="text"
                        class="form-control"
                        name="first_name"
                        id="first_name"
                        aria-describedby="helpId"
                        placeholder="Editar Primer Nombre"
                    />
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label for="middle_name" class="form-label">Segundo nombre</label>
                    <input
                        value="<?php echo $middle_name; ?>"
                        type="text"
                        class="form-control"
                        name="middle_name"
                        id="middle_name"
                        aria-describedby="helpId"
                        placeholder="Editar Segundo Nombre"
                    />
                </div>
                <div class="col mb-3">
                    <label for="first_surname" class="form-label">Primer apellido</label>
                    <input
                        value="<?php echo $first_surname; ?>"
                        type="text"
                        class="form-control"
                        name="first_surname"
                        id="first_surname"
                        aria-describedby="helpId"
                        placeholder="Editar Primer Apellido"
                    />
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label for="second_last_name" class="form-label">Segundo apellido</label>
                    <input
                        value="<?php echo $second_last_name; ?>"
                        type="text"
                        class="form-control"
                        name="second_last_name"
                        id="second_last_name"
                        aria-describedby="helpId"
                        placeholder="Editar Segundo Apellido"
                    />
                </div>
                <div class="col mb-3">
                <div class="row">
                    <div class="col-sm-10">
                        <label for="photo" class="form-label">Foto</label>
                        <input
                            value="<?php echo $photo; ?>"
                            type="file"
                            class="form-control"
                            name="photo"
                            id="photo"
                            aria-describedby="helpId"
                            placeholder="Editar Fotografía"
                        />
                    </div>
                    <div class="col">
                        <img width="50" src="./image/<?php echo $photo; ?> " class="img-fluid rounded" >
                    </div>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label for="email" class="form-label">Correo</label>
                    <input
                        value="<?php echo $email; ?>"
                        type="email"
                        class="form-control"
                        name="email"
                        id="email"
                        aria-describedby="helpId"
                        placeholder="ejemplo@yaskawa.com"
                    />
                </div>
                <div class="col mb-3">
                <label for="job_id" class="form-label">Puesto</label>
                    <select
                        class="form-select"
                        name="job_id"
                        id="job_id"
                    >
                    <?php foreach ($job_list as $job) { ?>
                        <option <?php echo ($job_id == $job['id']) ? "selected" : ""; ?> value="<?php echo $job['id'] ?>">
                            <?php echo $job['nombre'] ?>
                        </option>
                    <?php } ?>
                    </select>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <div class="me-2">
                <button
                    type="submit"
                    class="btn btn-success"
                >
                    Editar Registro
                </button>
                </div>
                <div>
                    <a
                        name=""
                        id=""
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