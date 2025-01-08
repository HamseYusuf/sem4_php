<!DOCTYPE html>
<html lang="en">
<?php

include('base.php');
include('db.php');

$upload_dir  = 'uploads/';

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {

    $filename = basename($_FILES['image']['name']);
    $targetpath = $upload_dir . $filename;

    if(move_uploaded_file($_FILES['image']['tmp_name'] , $targetpath)) {

        $sql = 'INSERT INTO images (filepath) VALUES (:path)';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':path' , $targetpath);
        $stmt->execute();
    } else {
        echo 'upload failed';
    }


}


?>

<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post"  enctype="multipart/form-data">
<label for="">Uplaod Image</label>
<input type="file" name="image">
<input type="submit" value="upload">
</form>


<?php

$sql = 'SELECT filepath FROM images';

$stmt = $conn->prepare($sql);
$stmt->execute();
$images = $stmt->fetchAll();

if(!empty($images)) { ?>

    <?php foreach($images as $image ) { ?>

        <img src="<?php echo $image['filepath']; ?>" alt="">

   <?php } ?>
 <?php } ?>





<body>
    
</body>
</html>