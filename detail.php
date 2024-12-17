<!DOCTYPE html>
<html lang="en">
<?php 
include('db.php');
include('base.php');

$id = $_GET['id'];

$sql = 'SELECT * FROM employees WHERE ID = :id';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id' , $id);
$stmt->execute();
$employee = $stmt->fetch();



?>
<body>

<div class="container">
    <div class="row flex justify-content-center">
        <div class="col-6">
            <div class="m-4">
            <div class="border border-4">
    <div class="text-center fw-bold">
        <?php  echo $employee['name']; ?>
    </div>
    <div class="text-center fw-bold">
        <?php  echo $employee['address']; ?>
    </div>
    <div class="text-center fw-bold">
        <?php  echo $employee['phone']; ?>
    </div>
</div>
            </div>
        </div>
    </div>
</div>
    
</body>
</html>