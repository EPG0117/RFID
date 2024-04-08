<?php 
    session_start();
    if($_POST) {
        include("./db.php");

        $sentencia = $conexion->prepare("SELECT *, count(*) AS n_user FROM users WHERE name=:name AND password=:password");
        $name = $_POST["name"];
        $password = $_POST["password"];

        $sentencia->bindParam(":name", $name);
        $sentencia->bindParam(":password", $password);

        $sentencia->execute();
        $user = $sentencia->fetch(PDO::FETCH_LAZY);
        if($user["n_user"]>0) {
            $_SESSION['name'] = $user['name'];
            $_SESSION['logueado'] = true;

            header("Location:index.php");
        } else {
            $mensaje = "Error: el usuario o la contraseña son incorrectos";
        }
    }
?>

<!doctype html>
<html lang="en">
    <head>
        <title>Login</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>
        <header>
            <!-- place navbar here -->
        </header>
        <main class="container">
            <div class="row">
                <div class="col-md-4 ">
                </div>
                <div class="col-md-4 align-self-center align-item-center justify-content-center">
                <br>
                <br>
                <br>
                <br>
                    <div class="card">
                        <div class="card-header">Login usuarios</div>
                        <div class="card-body">
                            <?php if(isset($mensaje)) { ?>
                            <div class="alert alert-danger" role="alert">
                                <strong><?php echo $mensaje; ?></strong>
                            </div>
                            <?php } ?>

                            <form action="" method="post">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Usuario</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="name"
                                        id="name"
                                        aria-describedby="helpId"
                                        placeholder="Ingrese su usuario"
                                    />
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input
                                        type="password"
                                        class="form-control"
                                        name="password"
                                        id="password"
                                        aria-describedby="helpId"
                                        placeholder="Ingrese su contraseña"
                                    />
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                    >
                                        Ingresar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
