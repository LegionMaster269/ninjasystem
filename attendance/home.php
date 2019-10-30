<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript" src="jquery.3.3.1.js"></script>

<?php 
require_once 'Admin/header.php';
if(!$loggedin) die();
$id = "";
$seminar_name = "";
$results = "";
$selectResults = "";

$result = QueryMysql("SELECT * FROM events");

if(isset($_POST['submit'])) {
  $seminar_name = SanitizeString($_POST['seminar_name']);
  $date1 = SanitizeString($_POST['date1']);
  
  if($seminar_name == "" || $date1 =="") {
    echo "<script>alert('No entry in fields!');</script>";
  }

  else {
    $selectResults  = QueryMysql("SELECT seminar_name, date1 FROM events WHERE seminar_name='$seminar_name' AND date1='$date1'");
    if($selectResults->num_rows) {
      echo "<script>
      $(function() {
      
           Swal.fire(
            'warning',
      'Event Already Exists!',
      'warning'
      ).then(function() {
    window.location = 'home.php';
           });
           });
          </script>"; 
    } else {
      QueryMysql("INSERT INTO events(seminar_name,date1) VALUES('$seminar_name','$date1')");
      echo "<script>
      $(function() {
      
           Swal.fire(
            'success',
      'Event Successfully Registered!',
      'success'
      ).then(function() {
    window.location = 'home.php';
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
    Home
  </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/homestylesheet.css">
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
			//alert($(this).attr('data-id'));
		});	
});
</script>

<body>
<div class="col-12 col-t-12 header-brand">
<a href="home.php" class="brand-name" >Attendance</a>
  <div class="dropdown" style="float: right;">
    <button class="dropbtn"  ><i class="fas fa-user" style="font-size:20px"></i> &nbsp; User &nbsp;</button>
    <div class="dropdown-content">
      <a href="logout.php"><i class='fas fa-sign-out-alt' style="font-size:20px"></i></i> &nbsp; Logout</a>
    </div>
  </div>
</div>


<div class=" col-3 col-t-2 nav-area">
    <div class=" menu">
    <button onclick="document.getElementById('id01').style.display='block'" style="width:100%;" class="button"><i class="far fa-calendar-alt" style="font-size:20px;"></i>  &nbsp; <label class= "button-label">Add Event</label></button>
    <button  onclick="window.location.href='admin/start_attendance.php'" style="width:100%;" class="button"> <i class="fas fa-hourglass-start"  style="font-size:20px;"></i> &nbsp; <label class= "button-label">Start Attendance</label></button>
<div id="id01" class="modal">
  <form class="modal-content animate" action="home.php" method="post">
    <div class="closecontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>

    <div class="form">
      <label for="uname"><b>Event Name </b></label>
      <input type='text' name='seminar_name' value='<?php echo $seminar_name?>' placeholder="Enter Event Name">
      <label for="psw"><b>Date</b></label>
        <input required type="date" name="date1"  value="<?php $date1?>" title="Choose your desired date"/>
      <input type='submit' name='submit' value='OK'>
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
        modal.style.display = "none";    }
}
</script>

</div>
  
<div class=" col-9 col-t-10 main">
<section id="burn">
	<div class="container">
		<h2>List of Events</h2>
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
							<th>Event Name</th>
              <th>Date</th>
			</tr>
						</thead>
						<tbody>
							<?php
								$sql="SELECT * from events";

								$result = mysqli_query ($conn, $sql);
								while ($row = mysqli_fetch_assoc($result)) {


								echo'<tr>
							<td>'. $row['seminar_name']  .'</td>
              <td>'. $row['date1'] .'</td>

								
									
																			
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
</div>

</body>
</html>

<style>
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
.button-label{margin-bottom: 0px !important;}

body{
  background-color: #f8f8f8 !important;
}
 </style>