<?php 
include('../db.php');

    $sentencia=$conexion->prepare("SELECT *, (SELECT first_name FROM employees WHERE employees.id=registers.employee_id LIMIT 1) 
                                            AS namee FROM registers");
    $sentencia->execute();
    $register_list = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include("../templates/header.php") ?>

</br>
<h1>Lista Usuarios</h1>
<div class="card">
    <div class="card-header">
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
                        <th scope="col">Hora entrada</th>
                        <th scope="col">Hora salida</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($register_list as $register) { ?>
                        <tr>
                        <td><?php echo $register['id']; ?></td>
                            <td><?php echo $register['namee']; ?></td>
                            <td><?php echo $register['time_entry']; ?></td>
                            <td><?php echo $register['time_departure']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        
    </div>
</div>

<?php include("../templates/footer.php") ?>