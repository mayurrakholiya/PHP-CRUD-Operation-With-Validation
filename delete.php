<?php

// Here is include database connection Using database.php file

require_once 'database.php';
$id = $_GET['id'];

$selectSql = "SELECT image FROM test WHERE id=".$id."";
$result = mysqli_query($conn,$selectSql);


if(mysqli_num_rows($result) > 0){
	$img = mysqli_fetch_array($result);

	/*
		BOC image delete
		When exist in "uploads" directory 
	*/
	$file_pointer = "./uploads/".$img['image'];
	if (file_exists($file_pointer)) {
	    $imgPath = "./uploads/".$img['image'];
	    /*
			Currently image is not delete, i have comment this code
			unlink() is uncommented for image delete
	    */
	    // unlink($imgPath);
	}
	/*
		EOC image delete
	*/
}

$sql = "DELETE FROM test WHERE id=".$id."";

if(mysqli_query($conn,$sql)){
	header('Location:view.php');
}else{
	echo "Record NOT Deleted.";
}

?>