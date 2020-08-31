<!DOCTYPE html>
<html>
<head>
	<title>Insert Record</title>
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
		<span style="font-size: 25px">Registration Form..</span>
		<span style="font-size: 20px;margin-left: 100px;">
			<a href="./" style="text-decoration: none;color: darkorange">Home</a>
		</span>
	</div>
<form id="userForm" method="post" action="db_insert.php" enctype="multipart/form-data">
	<table align="center" cellspacing="0" cellpadding="10" border="1">
		<tr>
			<td>Name</td>
			<td>
				<input type="text" name="name">
			</td>
		</tr>
		<tr>
			<td>Email</td>
			<td>
				<input type="text" name="email">
			</td>
		</tr>
		<tr>
			<td>Password</td>
			<td>
				<input type="password" name="password">
			</td>
		</tr>
		<tr>
				<td>Address</td>
				<td>
					<textarea name="address" rows="3"></textarea>
				</td>
			</tr>
			<tr>
				<td>City</td>
				<td>
					<select name="city">
						<option value="">Select City...</option>
						<option value="ahemdabad">Ahemdabad</option>
						<option value="rajkot">Rajkot</option>
						<option value="surat">Surat</option>
						<option value="baroda">Baroda</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Gender</td>
				<td style="font-size: 20px;">
					<input style="height: 15px;" type="radio" name="gender" value="male"> Male 
					<input style="height: 15px;" type="radio" name="gender" value="female"> Female
					<div id="genderError"></div>
				</td>
			</tr>
			<tr>
				<td>Hobby</td>
				<td style="font-size: 20px;">
					<input style="height: 15px;"  type="checkbox" name="hobby[]" value="music"> Music 
					<input style="height: 15px;" type="checkbox" name="hobby[]" value="game"> Game 
					<input style="height: 15px;" type="checkbox" name="hobby[]" value="video"> Video  <br>
					<input style="height: 15px;" type="checkbox" name="hobby[]" value="swimming"> Swimming 
					<input style="height: 15px;" type="checkbox" name="hobby[]" value="riding"> Riding 
					<div id="hobbyError"></div>
				</td>
			</tr>
			<tr>
				<td>Photo</td>
				<td>
					<input type="file" name="user_img">
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
    $("#userForm").validate({
        rules: {
            name: "required",
            email: {
                required: true,
                email: true
            },
            password: {
                required: true
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
            password: {
                required: "Please enter your password"
            },
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