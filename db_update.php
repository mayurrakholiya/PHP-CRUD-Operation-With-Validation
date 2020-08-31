<?php

// Here is include database connection Using database.php file

require_once 'database.php';

$name = $_POST['name'];
$email = $_POST['email'];
$address = $_POST['address'];
$ct = $_POST['city'];
$gen = $_POST['gender'];
$hobby= $_POST['hobby'];
$img = $_FILES['user_img']['name'];
$h = implode($hobby,",");

$sql = "UPDATE test SET name='".$name."',email='".$email."',address='".$address."',city='".$ct."',gender='".$gen."',hobby='".$h."' WHERE id=".$_POST['id']."";

/* BOC image upload  */
$target_dir = "./uploads/";
// Check if image file is a actual image or fake image

/*
   check if image is change and not empty then upload image and
   update image name into database also
*/
if($_FILES['user_img']['name']) {
	$errors= array();
      $file_name = $_FILES['user_img']['name'];
      $file_size =$_FILES['user_img']['size'];
      $file_tmp =$_FILES['user_img']['tmp_name'];
      $file_type=$_FILES['user_img']['type'];
      $files = $_FILES['user_img']['name'];
      // $file_ext=strtolower(end(explode('.',$files)));
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

         /* update image only after upload in directory */
         $sql2 = "UPDATE test SET image='".$img."' WHERE id=".$_POST['id']."";
         mysqli_query($conn,$sql2);
      }else{
         print_r($errors);
      }
}
/* EOC image upload */

if(mysqli_query($conn,$sql)){
	// echo "Record Insert Success....";
	header('Location:view.php');
}else{
	echo "Error, Record Insert Fail....";
}

?>