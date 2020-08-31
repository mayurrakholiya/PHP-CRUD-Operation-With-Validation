<?php

// Here is include database connection Using database.php file
require_once 'database.php';

$name = $_POST['name'];
$email = $_POST['email'];
$pass = $_POST['password'];
$address = $_POST['address'];
$ct = $_POST['city'];
$gen = $_POST['gender'];
$hobby= $_POST['hobby'];
$img = $_FILES['user_img']['name'];
$h = implode($hobby,",");

$sql = "INSERT INTO test (name,email,password,address,city,gender,hobby,image) values('".$name."','".$email."','".$pass."','".$address."','".$ct."','".$gen."','".$h."','".$img."')";


/* BOC image upload code here.... */
$target_dir = "./uploads/";
// Check if image file is a actual image or fake image
if($_FILES['user_img']['name']) {
	$errors= array();
      $file_name = $_FILES['user_img']['name'];
      $file_size =$_FILES['user_img']['size'];
      $file_tmp =$_FILES['user_img']['tmp_name'];
      $file_type=$_FILES['user_img']['type'];
      $files = $_FILES['user_img']['name'];

      $arrVal = explode('.',$files);
      $text = end($arrVal);
      $file_ext=strtolower($text);

      
      $extensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$extensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"uploads/".$file_name);
         // echo "Success";
      }else{
         print_r($errors);
      }
}
/* EOC image upload code */


if(mysqli_query($conn,$sql)){
	// echo "Record Insert Success....";
   // When record is insert then display view all records
	header('Location:view.php');
}else{
	echo "Error, Record Insert Fail....";
}

?>