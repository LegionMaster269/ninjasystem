<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript" src="jquery.3.3.1.js"></script>

<?php 

require_once 'header.php';
if(!$loggedin) die();
$id = "";
$results = "";
$selectResults = "";
?>

<?php $conn = mysqli_connect("localhost", "root", "", "attendance");
?>
 
 <?php
	 $error =  "";
	 
	   if (isset($_POST['course']))  {    
        $course = sanitizeString($_POST['course']);
        
  $sql =  queryMysql("SELECT course FROM courses WHERE course='$course'");
		 if ($course == "") 
		 $error = "<script>
		 Swal.fire({
		   type: 'warning',
		   title: 'Please fill the field!',
		   text: '',
		 })
		 </script>";  
      	 else      {     
						   	if($sql->num_rows >= 1) {
								echo "<script>
								$(function() {
								
									 Swal.fire(
								'Course Already Exists!',
								'',
								'warning'
								).then(function() {
							  window.location = 'course.php';
									 });
									 });
									</script>"; 
							   } else {
 queryMysql("INSERT INTO courses(course) VALUES('$course')");        
				echo "<script>
      $(function() {
      
           Swal.fire(
      'Course successfully added!',
      '',
      'success'
      ).then(function() {
    window.location = 'course.php';
           });
           });
          </script>"; 
							   }
						   
      	   }    
        } 
        	
		?>
		
		<?php $conn = mysqli_connect("localhost", "root", "", "attendance");
?>



<!DOCTYPE html>
<html>
<head>  
  <title>
    Program
  </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/homestylesheet.css">
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script> 
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
</head>

<script>
$( document ).ready(function() {
  $('#mytable').DataTable();
		$(document).on('click', '.myModal', function(){
			$('#modal_edit').modal('show');
			$('#new_id').val($(this).attr('data-id'));
			$('#new_firstname').val($(this).attr(''));
		});	
});
</script>

<body>


<div class="col-12 col-t-12 header-brand">
<a href="admin_home.php" class="brand-name" >Attendance</a>
  <div class="dropdown" style="float: right;">
    <button id="admindrpdwn" class="dropbtn"  ><i class="fas fa-user-tie" style="font-size:20px"></i> &nbsp; admin &nbsp;</button>
    <div class="dropdown-content">
        <a href="course.php"><i class="fas fa-building" style="font-size:20px"></i> &nbsp; Program   </a>
    <a href="manage_user.php"><i class="fas fa-user-cog" style="font-size:20px"></i> &nbsp; Users</a>
      <a href="manage_employee.php"><i class="fas fa-users" style="font-size:20px"></i> &nbsp; Employees</a>
      <a href="../logout.php"><i class='fas fa-sign-out-alt' style="font-size:20px"></i></i> &nbsp; Logout</a>
    </div>
  </div>
</div>

<div class=" col-3 col-t-2 nav-area">

    <div class=" menu">
	<button id="adduserbtn" onclick="document.getElementById('id01').style.display='block'" style="width:100%;" class="button"><i class="fas fa-user-plus"></i>  &nbsp; <label class= "button-label" id="adduserheader">Add Program</label></button>
    <div id="id01" class="modal">
	<form class="modal-content animate" action="course.php" method="post">
        <div class="closecontainer">
        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>
    <div class="form"><?php echo $error?>
   <label for="">Program:</label>
    <input type="text" name="course">
    <br>
      <input type='submit' name='create' value='Create'>
    </div>
  </form>
</div>
</div>

						


<script>
// Get the modal
var modal = document.getElementById('id01');


// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";    
    }

}

								
								
</script>

</div>
  
<div class=" col-9 col-t-10 main">
<section id="burn">
	<div class="container">
		<h2 id="header1">List of Programs</h2>
	</div>
</section>

<section id="burn2">
 <form method="post">
	<!-- Table Form -->
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<table class="table table-striped" id="mytable">
						<thead>
							<tr>
							<th>Program</th>
							<th></th>
							<th></th>
			  				
			</tr>
						</thead>
						<tbody>
							<?php
								$sql="SELECT course FROM courses";
								
									if(isset($_GET['del'])) 
									{
										$course = sanitizeString($_GET['del']);
										
										queryMysql("DELETE FROM courses WHERE course='$course'");
										echo "<script>
										$(function() {
										
											 Swal.fire(
												' Program Deleted Successfully',
										'',
										'success'
										).then(function() {
									  window.location = 'course.php';
											 });
											 });
											</script>";

								}

								if (isset($_POST['update'])) {
									
									$course = sanitizeString($_POST['course']);
									$result = queryMysql("SELECT course FROM courses WHERE course='$course'");

									if($_POST['update']) {
										
					 queryMysql("UPDATE courses SET course='$course' WHERE course='$course'");
					if($result->num_rows > 1) {
						echo "<script>
						$(function() {
						
							 Swal.fire(
								'Please fill all fields!',
								 '',
								'warning'
								).then(function() {
					  window.location = 'course.php';
							 });
							 });
							</script>";
					} else
					 {
						echo "<script>
						$(function() {
						
							 Swal.fire(
						' Program Updated Successfully',
						'',
						'success'
						).then(function() {
					  window.location = 'course.php';
							 });
							 });
							</script>"; 
					 }
					
									}
				
									}

									if(isset($_POST['cancel'])) {
										if($_POST['cancel']) {
											echo "<script>
											$(function() {
											
												 Swal.fire(
											'Cancelled!',
											'',
											'warning'
											).then(function() {
										  window.location = 'course.php';
												 });
												 });
												</script>";
										}
										
									}

								if (isset($_GET['edit'])) {
  								$course = sanitizeString($_GET['edit']);
  			$rec = queryMysql("SELECT course FROM courses WHERE course='$course'");
  			$record = $rec->fetch_array();
  			$course = $record['course'];
  	
}

								$result = queryMysql("SELECT course FROM courses");
								while ($row = $result->fetch_assoc()) { ?>
									
								<tr>
								<td><?php echo $row['course'];?></td>	
								<td><a href="edit.php?edit=<?php echo $row['course'];?>" >UPDATE</a></td>
								<td><a type="button" href="course.php?del=<?php echo $row['course'];?>" >DELETE</a></td>
  								</form>
								</div>

								
								</tr>
							
								<?php } ?>

								



						</tbody>
					</table>
					
								</div>
							</div>
						</div>
					</div>
			</div>
		</div>
	</div>
</form>
</section>
</div>

</body>
</html>
<style>
*{
  text-decoration:none !important;
}


label{
      font-weight:normal !important; 
    }
    div.container {
        width: 100%;
        padding:20px;
    }
a:focus, a:hover{
  color:rgb(230, 107, 134);
        text-decoration: none;
}


body{
  background-color: #f8f8f8 !important;
}
 </style>