<?php
    include("../../db.php");

    if($_POST) {
        print_r($_POST);
        $name=(isset($_POST["name"]) ? $_POST["name"] : "");
        $email=(isset($_POST["email"]) ? $_POST["email"] : "");
        $password=(isset($_POST["password"]) ? $_POST["password"] : "");
        $extraer = $conexion->prepare("INSERT INTO users (id, name, email, password)
                                        VALUES (null, :name, :email, :password)");
                                        
        $extraer->bindParam(":name", $name);
        $extraer->bindParam(":email", $email);
        $extraer->bindParam(":password", $password);
        $extraer->execute();

        $message = "Registro exitoso!!";
        header("Location:index.php?message=".$message);
    }
?>

<?php include("../../templates/header.php") ?>

</br>
<div class="card">
    <div class="card-header">Agregar Usuario</div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input
                        type="text"
                        class="form-control"
                        name="name"
                        id="name"
                        aria-describedby="helpId"
                        placeholder="Ingresar Nombre"
                    />
                </div>
                <div class="col mb-3">
                    <label for="email" class="form-label">Correo</label>
                    <input
                        type="email"
                        class="form-control"
                        name="email"
                        id="email"
                        aria-describedby="helpId"
                        placeholder="Ingresar correo"
                    />
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input
                        type="password"
                        class="form-control"
                        name="password"
                        id="password"
                        aria-describedby="helpId"
                        placeholder="Ingresar contraseña"
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
                        >Eliminar Contenido
                    </a>
                </div>
            </div>
        </form>
    </div>

</div>

<?php include("../../templates/footer.php") ?>