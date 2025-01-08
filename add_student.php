<!DOCTYPE html>
<html lang="en">
<?php 

include('base.php');
include('db.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_name = $_POST['name'];
    $class_id = $_POST['class_id'];

    $sql = 'INSERT INTO students1 (student_name , class_id) VALUES (:student_name , :class_id)';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':student_name' , $student_name);
    $stmt->bindParam(':class_id' , $class_id);
    $stmt->execute();
    header('Location: list.php');
}

?>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="display-6 text-center m-2"> Add Student</div>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <label class="form-label" for="">Student Name </label>
            <input type="text" name="name" class="form-control">
            <label class="form-label" for=""> Select Class</label>
            <select class="form-control" name="class_id" id="">
               <?php 
                $sql = 'SELECT * FROM classes';
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $classes = $stmt->fetchAll(); 
                foreach($classes as $class){?>
                <option value="<?php echo $class['id'] ?>"><?php echo $class['class_name']; ?></option>
              <?php  } ?>

              
            </select>
            <input type="submit" class="btn btn-secondary mt-2" value="Add Student">
        </form>
        </div>
    </div>
</div>
    
</body>
</html>