<?php 

include('db.php');
include('base.php');
$id = $_GET['id'];

echo $id;


$sql = 'DELETE  FROM students WHERE ID = :id';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id' , $id);
$stmt->execute();
$student = $stmt->fetch();
header('Location: index.php');

?>