<?php 
    session_start();    

    if($_SESSION['utype'] != 'User'){
        echo "<script type='text/javascript'> document.location ='../controllers/logout.php'; </script>";
    }

    include('../includes/dbcon.php');
    include('../controllers/get-all.php');
?>

<!DOCTYPE html>
<html>
    <head>
    	<link rel="shortcut icon" href="../assets/img/favicon.png">
        <title>User | Home</title>
        <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../assets/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" type="text/css" href="../assets/font-awesome/css/All.css">
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
                            <h1>Employees</h1>
                        </div><!-- /.container-fluid -->
                    </section>

                    <div class="content" style="">
                        <div class="card" id="tableArea" >
                            <div class="row" style="margin: 10px;">    
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
                                            <th>Documents</th>
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
                                                    <td>".$em['date_joined']."</td>
                                                    <td align='center'><span style='color:blue;cursor: pointer;' data-eid='".$em['national_id']."' class='editBtn' data-toggle='modal' data-target='#docs'><b><i class='fas fa-folder'></i>&nbsp;View</b></span></td>
                                                </tr>";
                                            }
                                         ?>
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <!-- /.body -->
            </div>

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
    <script type="text/javascript" src="../assets/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="../assets/js/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript">
        $(function(){
            $("#List").DataTable();
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