<?php
    include("../../db.php");

    if(isset($_GET['txtID'])) {
        $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

        $sentencia = $conexion->prepare("SELECT photo FROM employees WHERE id=:id");
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();
        $registro_foto = $sentencia->fetch(PDO::FETCH_LAZY);

        if(isset($registro_foto["photo"]) && $registro_foto["photo"] != "") {
            if(file_exists("./image/".$registro_foto["photo"])) {
                unlink("./image/".$registro_foto["photo"]);
            }
        }

        $sentencia = $conexion->prepare("DELETE FROM employees WHERE id=:id");
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();
        
        $message = "Eliminado!!";
        header("Location:index.php?message=".$message);
    }

    $sentencia=$conexion->prepare("SELECT *, (SELECT nombre FROM jobs WHERE jobs.id=employees.job_id LIMIT 1) 
                                            AS job_name FROM employees");
    $sentencia->execute();
    $employee_list=$sentencia->fetchAll(PDO::FETCH_ASSOC);
    
?>

<?php include("../../templates/header.php") ?>

</br>
<h1>Lista Empleados</h1>
<div class="card">
    <div class="card-header">
        <a
            class="btn btn-success"
            href="crear.php"
            role="button"
            >
            Agregar Empleado
        </a>
    </div>
    <div class="card-body">
        <div
            class="table-responsive-sm"
        >
            <table
                class="table"
                id="tabla_id"
            >
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Puesto</th>
                        <th scope="col">RFID</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($employee_list as $employee){ ?>
                    <tr>
                        <td><?php echo $employee['id']; ?></td>
                        <td>
                            <?php echo $employee['first_name'] ?>
                            <?php echo $employee['middle_name'] ?>
                        </td>
                        <td>
                            <?php echo $employee['first_surname'] ?>
                            <?php echo $employee['second_last_name'] ?>
                        </td>
                        <td>
                            <img width="50" src="./image/<?php echo $employee['photo']; ?>"
                                class="img-fluid rounded" >
                        </td>
                        <td><?php echo $employee['email'];  ?></td>
                        <td><?php echo $employee['job_name']; ?></td>
                        <td><?php echo $employee['rfid']; ?></td>
                        <td>
                            <a
                                class="btn btn-primary"
                                href="rfid.php?txtID=<?php echo $employee['id']; ?>"
                                role="button"
                                >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-credit-card-2-back-fill" viewBox="0 0 16 16">
                                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5H0zm11.5 1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zM0 11v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-1z"/>
                                </svg>
                                RFID
                            </a>
                            <a
                                class="btn btn-warning"
                                href="editar.php?txtID=<?php echo $employee['id']; ?>"
                                role="button"
                                >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                </svg>
                                Editar
                            </a>
                            <a
                                class="btn btn-danger"
                                href="javascript:borrar(<?php echo $employee['id']; ?>)"
                                role="button"
                                >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                </svg>
                                Eliminar
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        
    </div>
</div>

<script>
    function borrar(id) {
        alert(id);
    }
</script>


<?php include("../../templates/footer.php") ?>