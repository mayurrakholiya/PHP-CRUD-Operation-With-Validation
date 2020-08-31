<?php

// Here is include database connection Using database.php file

require_once 'database.php';

// id is fetch from Query String parameter
$id = $_GET['id'];

$selectSql = "SELECT * FROM test WHERE id=".$id."";
$result = mysqli_query($conn,$selectSql);
// Select record by using id of that record only

if(mysqli_num_rows($result) > 0){
	$result = mysqli_fetch_array($result);
	$hobbyArr = explode(',', $result['hobby']);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit Record</title>
	<script src="./js/jquery.min.js"></script>
	<script src="./js/jquery.validate.js"></script>
	<style type="text/css">
		.error{
			    margin-left: 10px;
			    color: red;
			    font-size: 16px !important;
		}
	</style>
</head>
<body>
	<div style="text-align: center;">
		<span style="font-size: 25px">Edit Form..</span>
		<span style="font-size: 20px;margin-left: 100px;">
			<a href="./view.php" style="text-decoration: none;color: darkorange">Back</a>
		</span>
	</div>
<form id="userEditForm" method="post" action="db_update.php" enctype="multipart/form-data">
	<input type="hidden" name="id" value="<?= $result['id'] ?> ">
	<table align="center" cellspacing="0" cellpadding="10" border="1">
		<tr>
			<td>Name</td>
			<td>
				<input type="text" name="name" value="<?= $result['name'] ?>">
			</td>
		</tr>
		<tr>
			<td>Email</td>
			<td>
				<input type="text" name="email"  value="<?= $result['email'] ?>">
			</td>
		</tr>
		<tr>
				<td>Address</td>
				<td>
					<textarea name="address" rows="3"> <?= $result['address'] ?></textarea>
				</td>
			</tr>
			<tr>
				<td>City</td>
				<td>
					<select name="city">
						<option value="">Select City...</option>
						<option value="ahemdabad" <?php if($result['city'] == 'ahemdabad') { echo "selected"; } ?> >Ahemdabad</option>
						<option value="rajkot" <?php if($result['city'] == 'rajkot') { echo "selected"; } ?> >Rajkot</option>
						<option value="surat" <?php if($result['city'] == 'surat') { echo "selected"; } ?> >Surat</option>
						<option value="baroda" <?php if($result['city'] == 'baroda') { echo "selected"; } ?> >Baroda</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Gender</td>
				<td style="font-size: 20px;">
					<input style="height: 15px;" type="radio" name="gender" value="male" <?php if($result['gender'] == 'male') { echo "checked"; } ?> > Male 
					<input style="height: 15px;" type="radio" name="gender" value="female" <?php if($result['gender'] == 'female') { echo "checked"; } ?> > Female
					<div id="genderError"></div>
				</td>
			</tr>
			<tr>
				<td>Hobby</td>
				<td style="font-size: 20px;">
					<input style="height: 15px;"  type="checkbox" name="hobby[]" value="music" <?php if(in_array('music',$hobbyArr)) { echo "checked"; } ?> > Music 
					<input style="height: 15px;" type="checkbox" name="hobby[]" value="game" <?php if(in_array('game',$hobbyArr)) { echo "checked"; } ?> > Game 
					<input style="height: 15px;" type="checkbox" name="hobby[]" value="video" <?php if(in_array('video',$hobbyArr)) { echo "checked"; } ?> > Video  <br>
					<input style="height: 15px;" type="checkbox" name="hobby[]" value="swimming" <?php if(in_array('swimming',$hobbyArr)) { echo "checked"; } ?> > Swimming 
					<input style="height: 15px;" type="checkbox" name="hobby[]" value="riding" <?php if(in_array('riding',$hobbyArr)) { echo "checked"; } ?> > Riding 
					<div id="hobbyError"></div>
				</td>
			</tr>
			<tr>
				<td>Photo</td>
				<td>
					<?php 
						if($result['image'] == ''){
							echo '<input type="file" name="user_img">';
						}else{
							$file_pointer = "./uploads/".$result['image'];
					        if (file_exists($file_pointer)) {
					            $imgPath = "./uploads/".$result['image'];
					            echo "<img src='".$imgPath."' width='100'>";
					        }else{
					        	echo '<input type="file" name="user_img">';	
					        }
						}
					?>
					
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input type="submit" value="Submit Here..." name="submit">
					&nbsp;&nbsp;&nbsp;
					<input type="reset" value="Clear All">
				</td>
			</tr>
	</table>
</form>
</body>
<script>
	$(document).ready(function() {
    $("#userEditForm").validate({
        rules: {
            name: "required",
            email: {
                required: true,
                email: true
            },
            address: {
                required: true
            },
            city: {
                required: true
            },
            gender: {
                required: true
            },
            'hobby[]' : {
            	required : true
            }
        },
        messages: {
            name: "Please enter your name",
            email: "Please enter a valid email address",
            address: {
                required: "Please enter your address"
            },
            city: {
                required: "Please select city"
            },
            gender: {
                required: "Please select gender"
            },
            'hobby[]': {
                required: "Please select atleast one hobby"
            },
        },
        errorPlacement: function(error, element) {
            if (error.text() == "Please select atleast one hobby" ) {
                $("#hobbyError").html(error);
                console.log('aaa');
            }else if (error.text() == "Please select gender" ) {
                $("#genderError").html(error);
                console.log('aaa');
            }
            else {
                 error.insertAfter(element);
            }
        },
    });
});
</script>
</html>

<?php

}

?>