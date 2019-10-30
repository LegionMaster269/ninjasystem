<!DOCTYPE html>
<html>
<head>
	<?php 
	require_once 'manage_user.php';

	?>
	<title></title>
</head>
<body>

									<script type="text/javascript">
									mytable.style.display = 'none';
									header1.style.display = 'none';	
									adduserheader.style.display = 'none';
									adduserbtn.style.display = 'none';
									admindrpdwn.style.display = 'none';
															
									</script>
										
									<form method="post" class="modal" style="display: block;">
										<div class="modal-content">
									<!-- <label>Username:</label> -->
									<input type="hidden" name="user" value="<?php echo $username;?>">
									<br>
									<label>Password:</label>
									<input type="text" name="pass" value="<?php echo $password;?>">
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