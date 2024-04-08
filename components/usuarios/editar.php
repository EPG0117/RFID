<?php
    include("../../db.php");

    if(isset( $_GET['txtID'])) {
        $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
        $sentencia = $conexion->prepare("SELECT * FROM users WHERE id=:id");
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();

        $user = $sentencia->fetch(PDO::FETCH_LAZY);

        $name = $user['name'];
        $email = $user['email'];
        $password = $user['password'];
    }

    if($_POST) {
        print_r($_POST);
        
        $name=(isset($_POST["name"]) ? $_POST["name"] : "");
        $email=(isset($_POST["email"]) ? $_POST["email"] : "");
        $password=(isset($_POST["password"]) ? $_POST["password"] : "");
        
        $extraer = $conexion->prepare("UPDATE users SET  name=:name, email=:email, password=:password WHERE id=:id");
        $extraer->bindParam(":id", $txtID);
        $extraer->bindParam(":name", $name);
        $extraer->bindParam(":email", $email);
        $extraer->bindParam(":password", $password);
        
        $extraer->execute();

        $message = "Registro editado!!";
        header("Location:index.php?message=".$message);
    }
?>

<?php include("../../templates/header.php") ?>

</br>
<div class="card">
    <div class="card-header">Editar Usuario</div>
    <div class="card-body">
        <form method="post" enctype="multipart/form-data">
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
                    <label for="name" class="form-label">Nombre</label>
                    <input
                        value="<?php echo $name; ?>"
                        type="text"
                        class="form-control"
                        name="name"
                        id="name"
                        aria-describedby="helpId"
                        placeholder="Editar Nombre"
                    />
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
                        placeholder="Editar correo"
                    />
                </div>
                <div class="col mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input
                        value="<?php echo $password; ?>"
                        type="password"
                        class="form-control"
                        name="password"
                        id="password"
                        aria-describedby="helpId"
                        placeholder="Editar contraseña"
                    />
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