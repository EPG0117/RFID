<?php 
session_start();
$url_base="http://localhost/RFID/";

if(!isset($_SESSION['name'])) {
    header("Location:".$url_bae."login.php");
}

?>

<!doctype html>
<html lang="en">
    <head>
        <title></title>
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
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" 
                integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" 
                crossorigin="anonymous">
        </script>

        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css" />
        <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>

    <body>
        <header>
            <nav class="navbar navbar-expand navbar-light bg-light">
                <ul class="nav navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo $url_base; ?>index.php"
                            >Sistema
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo $url_base; ?>components/usuarios/index.php"
                            >Usuarios
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo $url_base; ?>components/empleados/index.php"
                            >Empleados
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo $url_base; ?>components/puestos/index.php"
                            >Puestos
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo $url_base; ?>cerrar.php"
                            >Cerrar Sesión
                        </a>
                    </li>
                </ul>
            </nav>
        </header>
        
        <main class="container">
            <?php if(isset($_GET['message'])) ?>
                <script>
                    Swal.fire({
                        title: "<?php echo $_GET['message']; ?>",
                        icon: "success"
                    });
                </script>