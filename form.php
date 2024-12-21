<!doctype html>
<html lang="en">

<?php
include('base.php');
include('db.php');

?>

  <body>
  <?php
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $empty_err  = $username_err = $address_err = $phone_err = '';
    $pattern = '/^[a-zA-Z0-9]{3,20}$/';
    if(empty($username) || empty($address) ||  empty($phone)){
        $empty_err = 'All the Feilds are Required';
    } else{
        if(!preg_match($pattern , $username)){
            $username_err =  'Username is not Valid';
        }
        if(!preg_match($pattern , $address)) {
            $address_err = 'Your address is not valid ';

        }
        if(!filter_var($phone , FILTER_VALIDATE_INT)){
            $phone_err = 'Your phone number is not valid';
        }
        if(empty($empty_err) && empty($phone_err) && empty($address_err)) {

            $sql = 'INSERT INTO students (name , phone , address) VALUES (:name , :phone , :address)';

            try {

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':name' , $name);
                $stmt->bindParam(':phone' , $phone);
                $stmt->bindParam(':address' , $address);
                $stmt->execute();
                header("Location: index.php");
            } catch(PDOException $e){
                echo 'insertion failed' . $e;
            }   
        }
    }
  }
  ?>
  <div class="container">
    <div class="row flex justify-content-center">
        <div class="display-6 text-center mt-4 ">Add new Student </div>
        <div class="col-6 m-2">
            <form action="form.php" method="post" class="form-group">
                <div class="text-center"><small class=" fw-bold text-danger"><?php if(!empty($empty_err))  echo $empty_err; ?></small></div>
                <label for="" class="form-label">name</label>
                <input type="text" value="<?php if(!empty($name)){ echo $name;} ?>" name="name" class="form-control">
                <div class="text-center"><small class=" fw-bold text-danger"><?php if(!empty($username_err))  echo $username_err; ?></small></div>
                <label for="" class="form-label">Address</label>
                <input type="text" value="<?php if(!empty($address)) { echo $address;} ?>"  name="address" class="form-control">
                <div class="text-center"><small class=" fw-bold text-danger"><?php if(!empty($address_err))  echo $address_err; ?></small></div> 
                <label for="" class="form-label">Phone</label>
                <input type="number" name="phone" class="form-control">
                <div class="text-center"><small class=" fw-bold text-danger"><?php if(!empty($phone_err))  echo $phone_err; ?></small></div> 
                <input type="submit" value="submit" class="btn  btn-primary my-2 form-control ">
            </form>
        </div>
    </div>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>