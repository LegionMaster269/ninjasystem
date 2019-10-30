<?php $conn = mysqli_connect("localhost", "root", "", "attendance");

?>
<!DOCTYPE html>
<html>
<head>
	<title>Table</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="name.css">
</head>


<script>
$( document ).ready(function() {
 
  $('#mytable').DataTable();

		$(document).on('click', '.myModal', function(){
			$('#modal_edit').modal('show');
			$('#new_id').val($(this).attr('data-id'));
			$('#new_firstname').val($(this).attr(''));

			//alert($(this).attr('data-id'));

		});	

});
</script>
<body>
<section id="burn">
	<div class="container">
		<h2>Registration Table</h2>
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
							<th>Username</th>
							<th>Password</th>
			
			</tr>
						</thead>
						<tbody>
							<?php
								$sql="SELECT * from tblusers";

								$result = mysqli_query ($conn, $sql);
								while ($row = mysqli_fetch_assoc($result)) {


								echo'<tr>
							<td>'. $row['user']  .'</td>
							<td>'. $row['pass'] .'</td>
								
									
																			
								</tr>';}
								?>

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
</body>
</html>