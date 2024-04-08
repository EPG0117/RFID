<?php 
include('../../db.php');

    if(isset($_GET['txtID'])) {
        $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

        $sentencia = $conexion->prepare("DELETE FROM users WHERE id=:id");
        $sentencia->bindParam(':id', $txtID);
        $sentencia->execute();
        
        $message = "Eliminado!!";
        header("Location:index.php?message=".$message);
    }

    $sentencia = $conexion->prepare("SELECT * FROM users");
    $sentencia->execute();
    $user_list = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include("../../templates/header.php") ?>

</br>
<h1>Lista Usuarios</h1>
<div class="card">
    <div class="card-header">
        <a
            name=""
            id=""
            class="btn btn-success"
            href="crear.php"
            role="button"
            >
            Agregar Usuario
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
                        <th scope="col">Correo</th>
                        <th scope="col">Contraseña</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($user_list as $user) { ?>
                        <tr>
                        <td><?php echo $user['id']; ?></td>
                            <td><?php echo $user['name']; ?></td>
                            <td>**********************</td>
                            <td><?php echo $user['password']; ?></td>
                            <td>
                                <a
                                    class="btn btn-warning"
                                    href="editar.php?txtID=<?php echo $user['id']; ?>"
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
                                    href="javascript:borrar(<?php echo $user['id']; ?>)"
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
        Swal.fire({
            title: "¿Deseas borrar este registro?",
            text: "¡No hay marcha atras!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "¡Si, eliminar!"
            }).then((result) => {
            if (result.isConfirmed) {
                window.location = "index.php?txtID=" + id;
                Swal.fire({
                title: "Deleted!",
                text: "Your file has been deleted.",
                icon: "success"
                });
            }
});
    }
</script>


<?php include("../../templates/footer.php") ?>