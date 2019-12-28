<?php

require_once('conn.php');


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if(!empty($_POST) && empty($_POST['UserID'])){

$username = htmlspecialchars($_POST['username']);
$city = htmlspecialchars($_POST['city']);
$dob = htmlspecialchars($_POST['dob']);
$contact = htmlspecialchars($_POST['contact']);



$sql = "INSERT INTO UserDetails (UserName, City, DOB, ContactNo)
VALUES ('$username', '$city', '$dob','$contact')";
// $s =  "SELECT * FROM userdetails where  ORDER BY date ASC";


if (mysqli_query($conn, $sql)) {
    $_SESSION['msg'] = 'success';
} else {
    $_SESSION['msg'] = 'error';
}

header("Location:http://localhost/mobiotics/user.php");
exit;
// mysqli_close($conn);
}

if(!empty($_GET)){ 
  
  $UID = $_GET["UID"];
  $sql = "DELETE FROM UserDetails WHERE UID=$UID";
  $conn->query($sql);
}

if(!empty($_POST['UserID'])){
  $UserID = htmlspecialchars($_POST['UserID']);
  $username = htmlspecialchars($_POST['Editusername']);
  $city = htmlspecialchars($_POST['Editcity']);
  $dob = htmlspecialchars($_POST['Editdob']);
  $contact = htmlspecialchars($_POST['EditContact']);

  $sql = "UPDATE userdetails SET UserName= '$username', City = '$city', DOB = '$dob', ContactNo = $contact WHERE UID=$UserID";

  
  if ($conn->query($s) === TRUE) {
      $_SESSION['msg'] = 'update';
  } else {
    $_SESSION['msg'] = 'error';
  }
  header("Location:http://localhost/mobiotics/user.php");
exit;
  // mysqli_close($conn);
  }
  







?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Page</title>

    
  <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
  
  <link href="assets/css/icons.css" rel="stylesheet" type="text/css"/>
  
  <link href="assets/css/app-style.css" rel="stylesheet"/>
  
  <link href="assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
  <link href="assets/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css">

  
  <!-- Bootstrap core JavaScript-->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
	
  <!-- simplebar js -->
  <script src="assets/plugins/simplebar/js/simplebar.js"></script>
  <!-- waves effect js -->
  <script src="assets/js/waves.js"></script>
  <!-- sidebar-menu js -->
  <script src="assets/js/sidebar-menu.js"></script>
  <!-- Custom scripts -->
  <script src="assets/js/app-script.js"></script>
  
  <script src="assets/plugins/bootstrap-datatable/js/jquery.dataTables.min.js"></script>
  <script src="assets/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>

<button class="btn btn-gradient-royal m-1" data-toggle="modal" id="Create" data-target="#royalmodal">CREATE USERS</button>
                <div class="modal fade" id="royalmodal">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content gradient-royal border-0">
                      <div class="modal-header">
                        <h5 class="modal-title text-white"><i class="fa fa-star"></i>Create profile</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body text-white">

                      <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                <form id="signupForm" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                                    <h4 class="form-header text-uppercase">
                                    <i class="fa fa-address-book-o"></i>
                                    User Profile
                                    </h4>
                                    <div class="form-group row">
                                    <label for="input-10" class="col-sm-2 col-form-label" >User Name</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" required id="input-10" name="username">
                                    </div>
                                    <label for="input-11" class="col-sm-2 col-form-label">City</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" required id="input-11" name="city">
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                    <label for="input-12" class="col-sm-2 col-form-label">DOB</label>
                                    <div class="col-sm-4">
                                        <input type="date" class="form-control" required id="input-12" name="dob">
                                    </div>
                                    <label for="input-13" class="col-sm-2 col-form-label">Contact No</label>
                                    <div class="col-sm-4">
                                        <input type="number" class="form-control" required id="input-13" name="contact">
                                    </div>
                                    </div>
                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i> CANCEL</button>
                                        <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> SAVE</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div><!--End Row-->






                      </div>
                      <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="button" class="btn btn-link text-dark bg-white"><i class="fa fa-check-square-o"></i> Save changes</button>
                      </div> -->
                    </div>
                  </div>
                </div><!--End Modal -->


<!-- -------------------------------------------------------flash data-------------------------------------------- -->

                <?php

                if(isset($_SESSION['msg'])){
                if($_SESSION['msg'] === "success"){
                    ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
				    <button type="button" class="close" data-dismiss="alert">&times;</button>
				    <div class="alert-icon contrast-alert">
					 <i class="icon-check"></i>
				    </div>
				    <div class="alert-message">
				      <span><strong>Success!</strong> User Created.</span>
				    </div>
                  </div>
                    <?php
                unset($_SESSION['msg']);
                }
                unset($_SESSION['msg']);
            }

            if(isset($_SESSION['msg'])){
              if($_SESSION['msg'] === "update"){
                  ?>
                  <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <div class="alert-icon contrast-alert">
         <i class="icon-check"></i>
          </div>
          <div class="alert-message">
            <span><strong>Success!</strong> User Updated.</span>
          </div>
                </div>
                  <?php
              unset($_SESSION['msg']);
              }
              unset($_SESSION['msg']);
          }


            if(isset($_SESSION['msg'])){
                if($_SESSION['msg'] === "error"){
                    ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
				   <button type="button" class="close" data-dismiss="alert">&times;</button>
				    <div class="alert-icon contrast-alert">
					 <i class="icon-close"></i>
				    </div>
				    <div class="alert-message">
				      <span><strong>Danger!</strong> Something Went Wrong.</span>
				    </div>
                  </div>
                    <?php
                    
                unset($_SESSION['msg']);
                }
                
                unset($_SESSION['msg']);
            }
                
                
                ?>



<!-- ----------------------------------------------------Data Table----------------------------------------------------------------- -->


<div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Users detail</div>
            <div class="card-body">
              <div class="table-responsive">
              <table id="default-datatable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>City</th>
                        <th>DOB</th>
                        <th>Contact No</th>
                        <th> Date and Time</th>
                        <th>Action</th>
                        
                    </tr>
                </thead>
                <tbody>

                <?php

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

            $sql = "SELECT * FROM UserDetails ORDER by date DESC";
            $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    
                    foreach($result as $row){
                ?>
                    <tr>
                        <td id='name<?= $row["UID"]?>'><?= $row['UserName']?></td>
                        <td id='city<?= $row["UID"]?>'><?= $row['City']?></td>
                        <td id='dob<?= $row["UID"]?>'><?= $row['DOB']?></td>
                        <td id='contact<?= $row["UID"]?>'><?= $row['ContactNo']?></td>
                        <td id='date<?= $row["UID"]?>'><?= $row['date']?></td>
                        <td>
                        <a href="user.php?UID= <?= $row["UID"]?>"><i class="fa fa-trash" title="Delete" style="color:red"></i></a>
                        <a onclick="EditUser(<?=$row['UID']  ?>)" data-toggle="modal" data-target="#royalmodalEdit"><i class="fa fa-edit" title="Edit" style="color:blue"></i></a>


                        <!-- <button type="button" class="btn btn-danger waves-effect waves-light m-1"></button> -->
                        </td>
                        <td>  

                        

                        <!-- <button type="button" class="btn btn-danger waves-effect waves-light m-1"></button> -->
                        </td>

                    </tr>     
                <?php }}?>              
                </tbody>
                <tfoot>
                    <tr>
                        
                    </tr>
                </tfoot>
            </table>
            </div>
            </div>
          </div>
        </div>
      </div><!-- End Row-->





      <!-- --------------------------------------------------Edit modal--------------------------------------- -->

      <div class="modal fade" id="royalmodalEdit">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content gradient-royal border-0">
                      <div class="modal-header">
                        <h5 class="modal-title text-white"><i class="fa fa-star"></i> Modal title</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body text-white">

                      <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                <form id="signupForm" action="user.php" method="post"name="form">
                                    <h4 class="form-header text-uppercase">
                                    <i class="fa fa-address-book-o"></i>
                                    User Profile
                                    </h4>
                                    <div class="form-group row">
                                    <label for="input-10" class="col-sm-2 col-form-label" >User Name</label>
                                    <div class="col-sm-4">
                                        <input type="reset" class="form-control" required id="userName" name="Editusername">
                                        <input type="text" class="form-control" hidden required id="UserUID" name="UserID">
                                    </div>
                                    <label for="input-11" class="col-sm-2 col-form-label">City</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" required id="citys" name="Editcity">
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                    <label for="input-12" class="col-sm-2 col-form-label">DOB</label>
                                    <div class="col-sm-4">
                                        <input type="date" class="form-control" required id="EditDob" name="Editdob">
                                    </div>
                                    <label for="input-13" class="col-sm-2 col-form-label">Contact No</label>
                                    <div class="col-sm-4">
                                        <input type="number" class="form-control" required id="EditNo" name="EditContact">
                                    </div>
                                    </div>
                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i> CANCEL</button>
                                        <button type="submit" class="btn btn-success" onclick="submit()" value="reset form"><i class="fa fa-check-square-o"></i> SAVE</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div><!--End Row-->






                      </div>
                      <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="button" class="btn btn-link text-dark bg-white"><i class="fa fa-check-square-o"></i> Save changes</button>
                      </div> -->
                    </div>
                  </div>
                </div><!--End Modal -->

</body>
</html>

<script>
     $(document).ready(function() {
      //Default data table
       $('#default-datatable').DataTable();


       var table = $('#example').DataTable( {
        lengthChange: true,
        // lengthMenu:  [[10, 15, 50, -1], [10, 15, 50, "All"]],
        // buttons: [ 'copy', 'excel', 'pdf', 'print', 'colvis' ]
      } );
 
     table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
      
      } );

    </script>

    <script>
    
    function EditUser(UID){
      let UserID  = UID;
      let userName = $('#name'+UserID).text();
      let city = $('#city'+UserID).text();
      let dob = $('#dob'+UserID).text();
      let contact = $('#contact'+UserID).text();

      $('#userName').val(userName);
      $('#citys').val(city);
      $('#EditDob').val(dob);
      $('#EditNo').val(contact);
      $('#UserUID').val(UserID);
      
    }
    

    


</script>
	