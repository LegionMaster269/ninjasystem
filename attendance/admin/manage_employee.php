<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript" src="jquery.3.3.1.js"></script>

<?php 
require_once 'header.php';
if(!$loggedin) die();
$id = "";
$seminar_name = "";
$results = "";
$selectResults = "";
?>


<?php $conn = mysqli_connect("localhost", "root", "", "attendance");
?>
 
 <?php
	 $error = $id_number  =  $lastname =  $firstname =  $department = $program = "";
	 
	   if (isset($_POST['id_number']))  {    
		$id_number = sanitizeString($_POST['id_number']);   
		 $lastname = sanitizeString($_POST['lastname']);  
     $firstname = sanitizeString($_POST['firstname']);
     $department = sanitizeString($_POST['department']);
     $program = sanitizeString($_POST['program']);
  $sql =  queryMysql("SELECT id_number FROM employee");
		 if ($id_number == "" || $lastname == "" || $firstname == "" || $department == "" ) 
      $error = "<script>
      Swal.fire({
        
        title: 'Please fill all fields',
        text: '',
        type: 'warning',
      })
      </script>";   

      	 else      {    
         $result = queryMysql("SELECT id_number FROM employee WHERE id_number='$id_number'");   
        if (isset($_POST['create'])) {
         
         if ($result->num_rows >= 1) {
          echo "<script>
      $(function() {
      
           Swal.fire(
      'error',
      'ID duplicated!',
      'warning'
      ).then(function() {
    window.location = 'manage_employee.php';
           });
           });
          </script>"; 
         } else  {
           queryMysql("INSERT INTO employee(id_number,lastname,firstname,department,program) VALUES('$id_number', '$lastname','$firstname','$department','$program')");        
         
          echo "<script>
      $(function() {
      
           Swal.fire(
            'Employee Successfully Registered!',
            '',
      'success'
      ).then(function() {
    window.location = 'manage_employee.php';
           });
           });
          </script>"; 
        }
    //       elseif (is_string($result->fetch_assoc())) {
    //        echo "<script>
    //   $(function() {
      
    //        Swal.fire(
    //   'error',
    //   'ID duplicated!',
    //   'success'
    //   ).then(function() {
    // window.location = 'manage_employee.php';
    //        });
    //        });
    //       </script>"; 
    //                }
         
           }    
        } 

        }
      	  



        $sql = "SELECT * FROM employee";
        $result = queryMysql($sql);
        $resultcheck = $result->fetch_assoc();
        
                if (isset($_POST['update'])) {
                  $id_number = sanitizeString($_POST['id_number']);
                  $lastname = sanitizeString($_POST['lastname']);
                  $firstname = sanitizeString($_POST['firstname']);
                  $department = sanitizeString($_POST['department']);
                  $program = sanitizeString($_POST['program']);
                  
                  
                  
          queryMysql("UPDATE employee SET lastname='$lastname',firstname='$firstname',department='$department',program='$program' WHERE id_number='$id_number'");

                  echo "<script>
      $(function() {
      
           Swal.fire(
      'Employee Successfully Updated ',
      '',
      'success'
      ).then(function() {
    window.location = 'manage_employee.php';
           });
           });
          </script>"; 
                  }

                  if(isset($_POST['cancel'])) {
                    if($_POST['cancel']) {
                      echo "<script>
                      $(function() {
                      
                           Swal.fire(
                      'Cancelled',
                      '',
                      'warning'
                      ).then(function() {
                    window.location = 'manage_employee.php';
                           });
                           });
                          </script>";
                    }
                  }

                if (isset($_GET['edit'])) {
                  $id_number = sanitizeString($_GET['edit']);
        $rec = queryMysql("SELECT * FROM employee WHERE id_number='$id_number'");
        $record = $rec->fetch_array();
                  $id_number = $record['id_number'];
                  $lastname = $record['lastname'];
                  $firstname = $record['firstname'];
                  $department = $record['department'];
                  $program = $record['program'];
    
}



        if (isset($_GET['del'])) {
          $id_number = SanitizeString($_GET['del']);
      
          queryMysql("DELETE FROM employee WHERE id_number='$id_number'");
          echo " <script>
          $(function() {
          
               Swal.fire(
                'Employee Deleted Successfully!',
          '',
          'success'
          )
               });
                   </script>";
        }
        ?>
<!DOCTYPE html>
<html>
<head>  
  <title>
    Home
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
    <button class="dropbtn"  ><i class="fas fa-user-tie" style="font-size:20px"></i> &nbsp; admin &nbsp;</button>
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
	<button onclick="document.getElementById('id01').style.display='block'" style="width:100%;" class="button"><i class="fas fa-user-plus"></i>  &nbsp; <label class= "button-label">Add Employee</label></button>
    <div id="id01" class="modal">
    <form class="modal-content animate" action="manage_employee.php" method="post">
        <div class="closecontainer">
        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>
    <div class="form"><?php echo $error?>
    <label for="uname"><b>ID Number </b></label>
    <input type='text' maxlength='12' name='id_number' value='<?php echo $id_number?>' required >
      <label for="uname"><b>Last Name </b></label>
      <input type='text' name='lastname' value='<?php echo $lastname?>' required>
      <label for="uname"><b>First Name </b></label>
      <input type='text' name='firstname' value='<?php echo $firstname?>' required>
      <label for="uname"><b>Department </b></label>
      <input type='text' name='department' value='<?php echo $department?>' required>
      <label for="uname"><b>Program </b></label>
      <select name="program">
				<?php 
				$result = queryMysql("SELECT course FROM courses");
				while($row = $result->fetch_assoc()) { ?>
				<option value="<?php echo $row['course'];?>"><?php echo $row['course'];?></option>
				<?php }
				?>
	  </select>
      <input type='submit' name="create" value='Create'>
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
		<h2>List of Employees</h2>
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
              <th></th>
              <th></th>

			</tr>
						</thead>
						<tbody>

							<?php
								$sql="SELECT * from employee";
								$result = mysqli_query ($conn, $sql);
								while ($row = mysqli_fetch_assoc($result)) {?>
																<td><?php echo $row['id_number']; ?></td>
                                <td><?php echo $row['lastname']; ?></td>
                                <td><?php echo $row['firstname']; ?></td>
                                <td><?php echo $row['department']; ?></td>
                                <td><?php echo $row['program']; ?></td>
                                <td><a href="editEmployee.php?edit=<?php echo $row['id_number']; ?>">UPDATE</a></td>
                                <td><a href="manage_employee.php?del=<?php echo $row['id_number']; ?>">DELETE</a></td>
                                
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

.button-label{
  margin-bottom: 0px !important;
}

body {
  background-color: #f8f8f8 !important;
}
Select{
    border-radius:5px !important;
    margin-bottom:5px !important;
    width: 100% !important;
    padding: 12px 20px !important;
    display: inline-block !important;
    border: 1px solid #ccc !important;
    box-sizing: border-box !important;
  }


 </style>