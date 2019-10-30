
<?php 
require_once 'header.php';
if(!$loggedin) die();
$id = "";
$seminar_name = "";
$results = "";
$selectResults = "";
$error = "";

$conn = mysqli_connect("localhost", "root", "", "attendance");
?>
 

<!DOCTYPE html>
<html>
<head>  
  <title>
    Home
  </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/reportstylesheet.css">
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

<div class=" col-3 col-t-2 nav-area">
    <div class=" menu">
    <button  onclick="window.location.href='admin_home.php'" style="width:100%;" class="button"> <i class="fas fa-arrow-left" style="font-size:20px;"></i></i> &nbsp; <label class= "button-label">Back</label></button>
</div>
</div>
  
<div class=" col-9 col-t-10 main">
<section id="burn">
	<div class="container">
		<h2>Reports</h2>
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
								<th>ID Number</th>
					 			<th>Last Name</th>
					 			<th>First Name</th>
					 			<th>Department</th>
					 			<th>Program</th>
								 <th>Event</th>
								 <th>Date</th>
								 <th>Date Inputed</th>
								 <th>Time</th>
							</tr>
						</thead>
						<tbody>
						<?php 
						$result2 = queryMysql("SELECT date1 FROM events");
						$record2 = $result2->fetch_array();
						
						?>
							<?php
								$sql="SELECT * from reports";
								$result = mysqli_query ($conn, $sql);
								while ($row = mysqli_fetch_assoc($result)) {
								echo'<tr>
							<td>'. $row['id_number']  .'</td>
							<td>'. $row['lastname'] .'</td>
							<td>'. $row['firstname'] .'</td>
							<td>'. $row['department'] .'</td>
							<td>'. $row['program'] .'</td>
							<td>'. $row['event'] .'</td>
							<td>'. $record2['date1'] .'</td>
							<td>'. $row['date_inputed'] .'</td>
							<td>'. $row['time'] .'</td>											
								</tr>';}
								?>

						</tbody>
					</table>
					<div class="modal fade" id="modal_edit" role="dialog">
						<div class="modal-dialog modal-md">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title" id="notestitle"><b>UPDATE</b></h4>
									<div id="crmNotessLoadinbody"></div>
								</div>
								<div class="modal-body">
									<div class="container1">
										<div class="row">
											<div class="col-md-12">
												<center>
													<div class="form-group">
														<div class="col-md-12">
													<input type="hidden" value="" name="id" id="new_id">
														</div>
													</div>
													<div class="form-group">
														<div class="col-md-12">
													<label>First Name:</label>
													<input type="text" class="form-control" name="new_firstname" id="new_Firstname"><br>
														</div>
													</div>
													<div class="form-group">
														<div class="col-md-12">
													<label>Middle Name:</label>
													<input type="text" class="form-control" name="new_middlename" id="new_middlename"><br>
														</div>
													</div>
													<div class="form-group">
														<div class="col-md-12">
													<label>Last Name:</label>
													<input type="text" class="form-control" name="new_lastname" id="new_lastname"><br>
														</div>
													</div>
													<div class="form-group">
														<div class="col-md-12">
													<label>Gender:</label>
													<input type="text" class="form-control" name="new_Gender" id="new_gradelevel"><br>
														</div>
													</div>
													<div class="form-group">
														<div class="col-md-12">
													<label>Age:</label>
													<input type="text" class="form-control" name="new_age" id="new_age"><br>
														</div>
													</div>
													<div class="form-group">
														<div class="col-md-12">
													<label>Specialization:</label>
													<input type="text" class="form-control" name="new_Special" id="new_specialization">
														</div>
													</div>
												</center>
											</div>
										</div>
									</div>
													<div class="modal-footer">
													<input type="submit" name="update" class="btn notes_action_btn" value="Update">
													<input type="submit" name="delete" class="btn notes_action_btn" value="Delete">
													<button type="button" class="btn notes_action_btn" data-dismiss="modal">Close</button>
													</div>
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