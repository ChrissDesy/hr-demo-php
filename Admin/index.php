<?php 
	session_start();
	include('../includes/dbcon.php');

	if($_SESSION['utype'] != 'Admin'){
        echo "<script type='text/javascript'> document.location ='../controllers/logout.php'; </script>";
    }

	include('../controllers/get-all.php');

	include('../controllers/employee-crud.php');
?>

<!DOCTYPE html>
<html>
    <head>
    	<link rel="shortcut icon" href="../assets/img/favicon.png">
        <title>Admin | Home</title>
        <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../assets/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" type="text/css" href="../assets/css/sweetalert2.min.css">
        <link rel="stylesheet" type="text/css" href="../assets/font-awesome/css/All.css">
        <!-- <link rel="stylesheet" type="text/css" href="../assets/css/adminlte.min.css"> -->
    </head>

    <body style="font-size: 13px;">

    	<div class="wrapper">
    		<div>
    			<!-- Navbar -->
	            <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="border-radius: 0; margin: 0; background-color: rgb(29, 0, 62); padding: 2% 4% 0;">
	                
	                <div class="row col-md-12" style="">
	                	<div class="col-md-6" style="">
	                		<label style="color: white;">
	                			<?php echo $_SESSION['username']; ?>
	                		</label>
	                	</div>
	                	<div class="col-md-6" style="" align="right">
	                		<label>
	                			<a href="../controllers/logout.php">Logout</a>
	                		</label>
	                	</div>
	                </div>
	            </nav>
	            <!-- /.navbar -->

	            <!-- body -->
	            <div class="content-wrapper" style="margin: 0;">
	            	<section class="content-header" style="">
			            <div class="container-fluid">
			                <h1>All Employees</h1>
			            </div><!-- /.container-fluid -->
			        </section>

	            	<div class="content" style="">
	            		<div class="card" id="tableArea" >
	                        <div class="row" style="margin: 10px;">    
	                        	<div class="card-header col-12" align="right">
	                                <button class="form-control" style="font-size: 10px;width: 100px;" id="addBtn">
	                                    <a style=""><i class="fa fa-plus"></i>&nbsp;Add&nbsp;New</a>
	                                </button>
	                            </div>
	                        </div>
                        
	                        <div class="card-body">
	                            <table class="table table-bordered table-striped" id="List" style="">
	                                <thead>
	                                    <tr>
	                                        <th>Employee&nbsp;Id</th>
	                                        <th>Name</th>
	                                        <th>Surname</th>
	                                        <th>Birth&nbsp;Date</th>
	                                        <th>Address</th>
	                                        <th>National&nbsp;Id</th>
	                                        <th>Position</th>
	                                        <th>Salary</th>
	                                        <th>Date&nbsp;Joined</th>
	                                        <th>Docs</th>
	                                        <th>Action</th>
	                                    </tr>
	                                </thead>
	                                <tbody id="">
	                                    <?php
	                                    	foreach ($result as $em) {
	                                    		echo "<tr>
	                                    			<td>".$em['id']."</td>
	                                    			<td>".$em['name']."</td>
	                                    			<td>".$em['surname']."</td>
	                                    			<td>".$em['dob']."</td>
	                                    			<td>".$em['address']."</td>
	                                    			<td>".$em['national_id']."</td>
	                                    			<td>".$em['position']."</td>
	                                    			<td>".$em['salary']."</td>
	                                    			<td>".$em['date_joined']."</td><td align='center'><span style='color:blue;cursor: pointer;' data-eid='".$em['national_id']."' class='editBtn' data-toggle='modal' data-target='#docs'><b><i class='fas fa-folder'></i>&nbsp;View</b></span></td><td align='center'><span style='color:blue;cursor: pointer;' data-eid='".$em['id']."' class='editBtn' data-toggle='modal' data-target='#edit'><b><i class='fas fa-edit'></i></b></span></td>
	                                    		</tr>";
	                                    	}
	                                     ?>
	                                </tbody>
	                            </table>
	                        </div>
	                        
	                    </div>
	                    <div class="card" id="formArea" style="display: none;">
	                    	<form method="post" enctype="multipart/form-data">
	                    		<div class="row" style="margin: 2%;">
		                    		<div class="col-md-4">
		                    			Name
		                    			<input type="text" class="form-control" name="name" placeholder="Name">
		                    		</div>
		                    		<div class="col-md-4">
		                    			Surname
		                    			<input type="text" class="form-control" name="sname" placeholder="Surname">
		                    		</div>
		                    		<div class="col-md-4">
		                    			National Id
		                    			<input type="text" class="form-control" name="natid" placeholder="National Id">
		                    		</div>
		                    	</div>
		                    	<div class="row" style="margin: 2%;">
		                    		<div class="col-md-4">
		                    			Address
		                    			<input type="text" class="form-control" name="address" placeholder="Address">
		                    		</div>
		                    		<div class="col-md-4">
		                    			Date of Birth
		                    			<input type="date" class="form-control" name="dob" placeholder="dd-MM-yyyy">
		                    		</div>
		                    		<div class="col-md-4">
		                    			Date of Joining
		                    			<input type="date" class="form-control" name="doj" placeholder="dd-MM-yyyy">
		                    		</div>
		                    	</div>
		                    	<div class="row" style="margin: 2%;">
		                    		<div class="col-md-6">
		                    			Position
		                    			<input type="text" class="form-control" name="position" placeholder="Position">
		                    		</div>
		                    		<div class="col-md-6">
		                    			Salary
		                    			<input type="text" class="form-control" name="salary" placeholder="Salary">
		                    		</div>
		                    	</div>
		                    	<div class="row" style="margin: 2%;">
		                    		<div class="col-md-6">
		                    			<input type="file" class="form-control" accept=".pdf,.docx,.doc" name="cv"/>
		                    		</div>
		                    		<div class="col-md-6">
		                    			<input type="file" class="form-control" accept=".pdf,.docx,.doc" name="cert[]" multiple="multiple">
		                    		</div>
		                    	</div>
		                    	<div  class="row" align="center" style="margin: 2%;">
		                    		<input style="width: 100px;border-color: green;color: green;" type="submit" class="form-control" name="addEmp">
		                    	</div>
	                    	</form>
	                    </div>
	            	</div>
	            </div>
	            <!-- /.body -->
    		</div>

    		<div class="modal fade" id="edit">
		        <div class="modal-dialog">
		          <div class="modal-content" style="min-height: 400px;">
		            <div class="modal-header">
		              <h4 class="modal-title">Edit Employee</h4>
		              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                <span aria-hidden="true">&times;</span>
		              </button>
		            </div>
		            <div class="modal-body">
		              <form method="post">
		              	<div id="editBody"></div>
		              	<div class="col-md-12" style="margin-top: 4%;" align="center">
		              		<button style="width: 100px;color: green;" type="submit" name="editEmp" class="form-control">Save</button>
		              	</div>
		              </form>
		            </div>
		          </div>
		          <!-- /.modal-content -->
		        </div>
		        <!-- /.modal-dialog -->
	      	</div>
		      <!-- /.modal -->

	      	<div class="modal fade" id="docs">
                <div class="modal-dialog modal-sm">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">List of Documents</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div id="docsBody">
                          
                      </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
          	</div>

    	</div>

    </body>

    <script type="text/javascript" src="../assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/js/sweetalert2.min.js"></script>
    <script type="text/javascript" src="../assets/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="../assets/js/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript">
    	$(function(){
    		$("#List").DataTable();
    	});

		$("#addBtn").click(function () {
			$("#tableArea").hide();
			$("#formArea").show();
		});		

		$("#edit").on('show.bs.modal', function (e) {
			$("#editBody").html('<div align="center"><span class="fas fa-spin fa-sync fa-2x"></span></div>');

            var Id = $(e.relatedTarget).data('eid');
            //alert(Id);
            $.ajax({
                url: '../controllers/get-employee.php',
                method: 'POST',
                data: {eid : Id},
                success: function (record) {
                    $('#editBody').html(record);
                }
            });
        });

		$("#docs").on('show.bs.modal', function (e) {
            $("#docsBody").html('<div align="center"><span class="fas fa-spin fa-sync fa-2x"></span></div>');

            var Id = $(e.relatedTarget).data('eid');
            //alert(Id);
            $.ajax({
                url: '../controllers/get-documents.php',
                method: 'POST',
                data: {nid : Id},
                success: function (record) {
                    $('#docsBody').html(record);
                }
            });
        });

    </script>

</html>