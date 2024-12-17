<!DOCTYPE html>
<html lang="en">
<?php
include('base.php');
include('db.php');
?>
<body>
<div class="display-6 text-center m-3">List of employees</div>
<div class="contaier">
   
    <div class="row flex justify-content-center">
        <div class="col-10">
    <div class="text-end">
        <a href="form.php" class="btn btn-secondary m-2 p-2">Add new </a>
    </div>
            <table class="table table-hover table-striped table-bordered">
                <thead>
                    <th> ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Details</th>
                </thead>
                <tbody>
                  <?php  
                  $sql = 'SELECT * FROM employees';
                  $stmt = $conn->query($sql);
                  $employees = $stmt->fetchAll();

                  foreach($employees as $employee) { ?>

                    <tr>
                        <td><?php echo $employee['ID']; ?></td>
                        <td><?php echo $employee['name']; ?></td>
                        <td><?php echo $employee['phone']; ?></td>
                        <td><?php echo $employee['address']; ?></td>
                        <td>
                            <a href="detail.php?id=<?php echo $employee['ID'] ?>" class="btn btn-sm-m-2 p-2 btn-info">View</a>
                        </td>
                    </tr>


               <?php   } ?>
                  
                 
                </tbody>
            </table>
        </div>
    </div>
</div>


    
</body>
</html>