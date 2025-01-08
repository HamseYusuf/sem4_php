<!DOCTYPE html>
<html lang="en">
<?php

include('base.php');
include('db.php');

?>
<body>

<div class="display-6 text-center">
    list of classes
</div>
<div class="contianer">
    <div class="row justify-content-center">
        <div class="col-10">
            <table class="table table-striped table-hover">
                <thead>
                    <th> ID</th>
                    <th>Class Name </th>
                </thead>
                <tbody>
                   <?php

                   $sql = 'SELECT * FROM classes';
                   $stmt = $conn->prepare($sql);
                   $stmt->execute();
                   $classes   = $stmt->fetchAll();

                   foreach($classes as $class) { ?>
                   <tr>
                    <td><?php echo $class['id'] ?></td>
                    <td><?php  echo $class['class_name']; ?></td>
                   </tr>
 

                 <?php  }  ?>

                  
                </tbody>
            </table>
        </div>
    </div>
</div>
    


<div class="display-6 text-center">
    list of Students
</div>
<div class="contianer">
    <div class="row justify-content-center">
        <div class="col-10">
            <a href="add_student.php" class="btn btn-primary me-4"> Add student </a>
            <table class="table table-striped table-hover">
                <thead>
                    <th> ID</th>
                    <th>Student Name </th>
                    <th> Student Class </th>
                </thead>
                <tbody>
                   <?php

                   $sql = 'SELECT students1.id , students1.student_name AS student_name , 
                   classes.class_name as class_name 
                   FROM students1 LEFT JOIN classes ON students1.class_id = classes.id';
                 
                   $stmt = $conn->prepare($sql);
                   $stmt->execute();
                   $students   = $stmt->fetchAll();

                   foreach($students as $student) { ?>
                   <tr>
                    <td><?php echo $student['id'] ?></td>
                    <td><?php  echo $student['student_name']; ?></td>
                    <td><?php  echo $student['class_name']; ?></td>
                   </tr>
  

                 <?php  }  ?>

                  
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>