<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
 <script type="text/javascript" src="jquery.3.3.1.js"></script>

<?php 
require_once 'header.php';
date_default_timezone_set("Asia/Taipei");
$id_number = $lastname = $firstname = $department = $program = $event = $time = "";
if (isset($_POST['id_number']) && isset($_POST['lastname']) && isset($_POST['firstname']) && isset($_POST['department']) && isset($_POST['program']) && isset($_POST['event']) && isset($_POST['time'])) {
$id_number = SanitizeString($_POST['id_number']);
$lastname = SanitizeString($_POST['lastname']);
$firstname = SanitizeString($_POST['firstname']);
$department = SanitizeString($_POST['department']);
$program = SanitizeString($_POST['program']);
$events = SanitizeString($_POST['event']);
$time = SanitizeString($_POST['time']);

QueryMysql("INSERT INTO reports(id_number,lastname,firstname,department,program,event,time) VALUES('$id_number','$lastname','$firstname','$department','$program','$events','$time')");

echo " <script>
  $(function() {
        Swal.fire(
        'Good job!',
        'Employee Successfully Registered!',
        'success'
        )
      });
</script>";
}
?>

<!DOCTYPE html>
<html>
 <head>
</head>
  <title>Start Attendance</title>
   <Style>
 a{
   text-decoration:none !important;
  position: fixed !important;
  top: 6% !important;
  transform: translateY(-50%) !important;
  padding: 14px 20px !important;
  color: #ffffff !important;
  background-color: #4285f4 !important;
  border-radius:5px !important;
}


 a:hover{
  background-color: #73a9ff !important;
}
</style>

  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../css/attendancestylesheet.css">
  
 </head>
 <body>
 <a href="admin_home.php" ><i class="fas fa-home" style ="font-size:20px;"> &nbsp; </i>Home</a> 
  <div class="container" style="width:900px;">

    <form action="" method="post" class = "input-box">
      <!-- EVENTS AND SEMINARS MUST BE INTO ONE-->
      <select name="event" class="selection" style="color: black;">
      
          <?php
            $result = QueryMysql("SELECT * FROM events");
            while ($row = $result->fetch_assoc()) { ?>
            <option class = '' value='<?php echo $row['seminar_name']; ?>'><?php echo $row['seminar_name']; ?></option>
          <?php } ?>

      </select>

      <input type="text" name="id_number" id="id_number" placeholder="Search Employee Details" class="form-control" />
      <input type="hidden" name="lastname" id="lastname" placeholder="Search Employee Details" class="form-control" />
      <input type="hidden" name="firstname" id="firstname" placeholder="Search Employee Details" class="form-control" />
      <input type="hidden" name="department" id="department" placeholder="Search Employee Details" class="form-control" />
      <input type="hidden" name="program" id="program" placeholder="Search Employee Details" class="form-control" />
      <input type="text" name="time" placeholder="Time" style="color: black;" value="<?php echo date("h:i:sa");?>"></input>
    <input type="submit" name="submit" id="submit" onclick="return func();">

  </form>
   </div>
   <ul class="list-group" id="result"></ul>
   <br />
  </div>
 </body>
</html>

<script>
$(document).ready(function(){
 $.ajaxSetup({ cache: false });
 $('#id_number').keyup(function(){
  $('#result').html('');
  $('#state').val('');
  var searchField = $('#id_number').val();
  var expression = new RegExp(searchField, "i");
  $.getJSON('data.json', function(data) {
   $.each(data, function(key, value){
    if (value.id_number.search(expression) != -1 || value.lastname.search(expression) != -1)
    {
     $('#result').append('<li class="list-group-item link-class">'+value.id_number+'<span class="text-muted">|'+value.lastname+' </span>|'+value.firstname+'<span>| '+value.department+'</span>| '+value.program+'</li>');
    }
   });   
  });
 });
 
 $('#result').on('click', 'li', function() {
  var click_text = $(this).text().split('|');
  $('#id_number').val($.trim(click_text[0]));
  $('#lastname').val($.trim(click_text[1]));
  $('#firstname').val($.trim(click_text[2]));
  $('#department').val($.trim(click_text[3]));
  $('#program').val($.trim(click_text[4]));
  $("#result").html('');
 });
});
</script>


<?php

require_once 'header.php';
  $rows = array();
          $result = QueryMysql("SELECT * FROM  employee");
    $x = $result->num_rows;
       if ($x > 0) {
       }
       while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
        $filename = "data.json";
   $file = fopen( $filename, "w" );
   
   if( $file == false ) {
      echo ( "Error in opening new file" );
      exit();
   }

 fwrite($file, json_encode($rows) );
 fclose($file);
       }

      ?>


