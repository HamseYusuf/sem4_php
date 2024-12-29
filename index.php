<!DOCTYPE html>
<html lang="en">
<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
}

include('base.php');
include('db.php');

?>
<body>
<div class="display-6 text-center m-3">List of employees</div>
<div class="contaier">
<?php

if(isset($_SESSION['success'])){  ?>

<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <?php
    echo $_SESSION['success'];
    session_unset();
    ?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<?php } ?> 

<div class="container my-3">
    <div class="row flex justify-content-end">
        <div class="col-4">
            <form action="index.php" method="get" class="form-group">
               <div class="input-group">
               <input type="text" name="search" placeholder="Search" class="form-control ">
                <input type="submit" value="Search" class="btn btn-secondary ms-2">
               </div>
            </form>
        </div>
    </div>
</div>

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
                    <th>Detail</th>
                </thead>
                <tbody>
                  <?php
                    if(!empty($_GET['search'])) {
                        $search = $_GET['search'];
                        $sql = 'SELECT * FROM students WHERE name LIKE :name';
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':name' , $search);
                        $stmt->execute();
                        $students = $stmt->fetchAll();

                    } else{
                        $sql = 'SELECT * FROM students';
                        $stmt = $conn->query($sql);
                        $students = $stmt->fetchAll();
                    }
                  foreach($students as $student) { ?>
                    <tr>
                        <td><?php echo $student['ID']; ?></td>
                        <td><?php echo $student['name']; ?></td>
                        <td><?php echo $student['phone']; ?></td>
                        <td><?php echo $student['address']; ?></td>
                        <td>
                            <a href="detail.php?id=<?php echo $student['ID'];?>" class="btn btn-secondary btn-sm">View</a>
                        </td>
                    </tr>
               <?php   } ?>
                  
                 
                </tbody>
            </table>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>   
</body>

</html>