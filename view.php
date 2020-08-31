<?php

// Here is include database connection Using database.php file

require_once 'database.php';

$sql = "SELECT * FROM test ORDER BY id DESC";
$result = mysqli_query($conn,$sql);

/*
	$result fetch all record from database
	Display all records in HTML code
	Here is combine HTML code inside PHP(echo statement)
*/

echo "<table border=0 width=100% cellspacing=0 cellpadding=10>";
	echo "<tr>";
		echo "<td align='left'><div><b><a href='./' style='text-decoration: none;font-size: 20px;color: orange;'>Home</a></b><div></td>";
		echo "<td align='center'><div style='font-size: 25px; color: green;'><b>View Records...</b></div></td>";
		echo "<td align='right'><div><b><a href='insert.php' style='text-decoration: none;font-size: 20px;color: #00dcff;'>Insert Record</a></b></div></td>";
	echo "</tr>";
echo "</table>";
	
if(mysqli_num_rows($result) > 0){
	echo "<table width='100%' align='center' border='1' cellpadding='10' cellspacing='0'>";
		echo "<tr>";
			echo "<th>No</td>";
			echo "<th>Image</td>";
			echo "<th>Name</td>";
			echo "<th>Email</td>";
			echo "<th>Address</td>";
			echo "<th>City</td>";
			echo "<th>Gender</td>";
			echo "<th>Hobby</td>";
			echo "<th>Action</td>";
		echo "</tr>";
		$srNo = 1;
		while ($row = mysqli_fetch_array($result)) {
			$file_pointer = "./uploads/".$row['image'];
	        if (file_exists($file_pointer)) {
	            $imgPath = "./uploads/".$row['image'];
	        }else {
	            $imgPath = "./uploads/no-image.png";
	        }

	        if($row['image'] == ''){
	        	$imgPath = "./uploads/no-image.png";	
	        }
			echo "<tr>";
				echo "<td>".$srNo."</td>";
				echo "<td> <img src='".$imgPath."' width='60'></td>";
				echo "<td>".$row['name']."</td>";
				echo "<td>".$row['email']."</td>";
				echo "<td>".$row['address']."</td>";
				echo "<td>".$row['city']."</td>";
				echo "<td>".$row['gender']."</td>";
				echo "<td>".$row['hobby']."</td>";
				echo "<td><a href='edit.php?id=".$row['id']."' style='text-decoration: none;color:lightgreen;'> Edit </a>";
				echo "<a href='delete.php?id=".$row['id']."' style='text-decoration: none;color:red;'>&nbsp; Delete</a></td>";
			echo "</tr>";
	        
			
			$srNo++;
		}
	echo "</table>";
}else{
	echo "No Record Found";
}

?>