<!doctype html>
<html lang="en">
  <?php include('base.php'); ?>
  <body>

<?php

include('db.php');

$id = $_GET['id'];


$sql = 'SELECT * FROM students WHERE ID = :id';

$stmt = $conn->prepare($sql);
$stmt->bindParam(':id' , $id);
$stmt->execute();
$student = $stmt->fetch();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $pattern  = '/^[a-zA-Z0-9]{3,20}$/';
    $emptyerr = $nameerr = $addresserr = $phoneerr = '';

    if(empty($name) || empty($address) || empty($phone)) {
        $emptyerr =  'Inputs Are Required';
    } else {
        if(!preg_match($pattern , $name)) {
            $nameerr =  'Username is Invalid';
        }
        if(!preg_match($pattern , $address)) {
            $addresserr =  'address is Invalid';
        }
        if(!filter_var($phone , FILTER_VALIDATE_INT)) {
            $phoneerr = 'Your Phone Number Is No Valid';
        }

        if(preg_match($pattern , $name) && preg_match($pattern , $address) && filter_var($phone , FILTER_VALIDATE_INT)) {
           $sql  = 'UPDATE students SET name = :name , address = :address,  phone = :phone WHERE ID = :id ';
           $stmt = $conn->prepare($sql);
           $stmt->bindParam(':id' , $id);
           $stmt->bindParam(':name' , $name);
           $stmt->bindParam(':address' , $address);
           $stmt->bindParam(':phone' , $phone);
           $stmt->execute();
           header('Location: index.php');
        } 

    }


}


?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="display-6 m-3 text-center">Update</div>
                <span class="text-danger"><?php if(!empty($emptyerr)) {echo $emptyerr;} ?></span>
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="form-group">
                <input value= "<?php if(!empty($student['name'])) { echo $student['name'];} ?>" type="text" name="name" placeholder="Enter Your Username" class="form-control m-1">
                <span class="text-danger"><?php if(!empty($nameerr)) {echo $nameerr;} ?></span>
                <input value= "<?php if(!empty($student['address'])) { echo $student['address'];} ?>" type="text"  name="address" placeholder="Enter Your address" class="form-control m-1">
                <span class="text-danger"><?php if(!empty($addresserr)) {echo $addresserr;} ?></span>
                <input value= "<?php if(!empty($student['phone'])) { echo $student['phone'];} ?>" type="text" name="phone" placeholder="Enter Your Pone Number" class="form-control m-1">
                <span class="text-danger"><?php if(!empty($phoneerr)) {echo $phoneerr;} ?></span>
                <input type="submit" value="Update" class="form-control btn btn-primary">
            </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>