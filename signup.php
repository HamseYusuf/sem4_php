<!DOCTYPE html>
<html lang="en">
<?php

include('base.php');
include('db.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $pattern = '/^[a-zA-Z0-9]{3,20}$/';
    $empyt_err = $username_err = $email_err = $password_err = '';

    if(empty($name) || empty($email) || empty($password)){
        $empyt_err = 'All the feilds are requiered';
    } else{
        if(!preg_match($pattern , $name)){
            $username_err = 'username is not valid';
        }
        if(!filter_var($email , FILTER_VALIDATE_EMAIL)){
            $email_err = 'Your email is not valid';
        }
        if(!preg_match($pattern , $password)){
            $password_err =' Your password is not valid';
        }

        if(empty($username_err) && empty($email_err) && empty($password_err)){

            $sql = 'INSERT INTO users (username , email , password) VALUES (:username , :email , :password)';
            $stmt = $conn->prepare($sql);
            $stmt-> bindParam(':username' , $name);
            $stmt->bindParam(':email' , $email);
            $stmt->bindParam(':password' , password_hash($password , PASSWORD_DEFAULT));
            $stmt->execute();
            header('Location: login.php');

        }
   }
}

?>
<body>
<div class="container">
    <div class="row flex justify-content-center">
        <div class="display-6 m-3 p-3 text-center">Signup</div>
        <div class="col-6 m-2 p-2">
          <div class="border border-3 p-4 border-info  rounded-4">
          <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" class="form-group">
          <span class="text-center text-danger m-1"><?php if(!empty($empyt_err)){ echo $empyt_err;} ?></span>
                <label class="form-label text-center m-2">
                    Username
                </label>
                <span class="text-center text-danger m-1"><?php if(!empty($username_err)){ echo $username_err;} ?></span>
                <input type="text" value="<?php if(!empty($name)){ echo $name;} ?>" name='username' class="form-control m-2">
                <label class="form-label text-center m-2">
                    Email
                </label>
                <span class="text-center text-danger m-1"><?php if(!empty($email_err)){ echo $email_err;} ?></span>
                <input type="text" vlaue="<?php if(!empty($email)){ echo $email;} ?>" name='email' class="form-control m-2">
                <label class="form-label text-center m-2">
                    Password
                </label>
                <span class="text-center text-danger m-1"><?php if(!empty($password_err)){ echo $password_err;} ?></span>
                <input type="password" vlaue="<?php if(!empty($password)){ echo $password;} ?>" name='password' class="form-control m-2">
                <input type="submit" value="Signup" class="btn btn-lg btn-info form-control my-2">
            </form>
          </div>
        </div>
    </div>
</div>
    
</body>
</html>