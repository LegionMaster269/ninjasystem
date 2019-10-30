<!DOCTYPE html>
<html>
<head>
	<?php 
	require_once 'manage_employee.php';

	?>
	<title></title>
</head>
<body>

									
										
									<form method="post" class="modal" style="display: block;">
										<div class="modal-content">
									
									<input type="hidden" name="id_number" value="<?php echo $id_number;?>">
									<br>
									<label>Last Name:</label>
									<input type="text" name="lastname" value="<?php echo $lastname;?>">
									<br>
									<label>First Name:</label>
									<input type="text" name="firstname" value="<?php echo $firstname;?>">
									<br>
									<label>Department:</label>
									<input type="text" name="department" value="<?php echo $department;?>">
									<br>
									<label>Program:</label>
									<input type="text" name="program" value="<?php echo $program;?>">
									<br>
									<input type="submit" name="update" value="Update">
									<input type="submit" name="cancel" value="Cancel">
										</div>
									</form>
									</body>
</html>
<style>
.modal-content{
	padding:20px !important;
}
input[type=submit] {
	margin: 3px 0;}

	input[type=text], input[type=date] {
    margin-bottom: 10px;}
	</style>