<!DOCTYPE html>
<html lang="en">
<?php
include('db.php');
include('base.php');

$id = $_GET['id'];

$sql = 'SELECT * FROM students WHERE ID = :id';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id' , $id);
$stmt->execute();
$student = $stmt->fetch();

?>
<body>


<div class="container">
    <div class="row flex justify-content-center m-4 ">
        <div class="col-6">
        <div class="card">
            <div class="card-body">
                <div class="display-6 text-center">
                    Detail Page
                </div>
                <p>
                <strong>Student Name:  </strong> <?php echo $student['name'] ?>
                </p>
                <p>
                <strong>Address: </strong> <?php echo $student['address'] ?>
                </p>
                <p>
                <strong>Phone: </strong> <?php echo $student['phone'] ?>
                </p>
                <div class="text-center p-3">
                    <a href="update.php?id=<?php echo $student['ID']; ?>" class="btn btn-primary">Update</a>
                    <a href="delete.php?id=<?php echo $student['ID']; ?>" class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
    
</body>
</html>

