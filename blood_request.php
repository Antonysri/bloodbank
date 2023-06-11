<?php
require 'files/connection.php';
session_start();
if(!isset($_SESSION['hid']) && empty($_SESSION['hid'])){
    header("location:login.php");
    exit;
}

?>
<html>
    <head>

        <title>Blood Request</title>
        
      <?php require 'head.php'; ?>
    </head>
    <body>
        <?php require "header.php" ?>
        <?php require "message.php" ?>
        <br><br>
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-center text-muted"><b>Blood Request</b></h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-responsive">
                                <thead>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">City</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Blood Group</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </thead>
                                <?php
                                  if(isset($_SESSION['hid'])){  
                                    
                                $sql = "SELECT receivers.r_name,receivers.r_email,receivers.r_city,receivers.r_phone,blood_request.brid,blood_request.bg,blood_request.status from receivers inner join blood_request on receivers.rid = blood_request.rid";
                                $stmt = $conn->prepare($sql);
                                
                                $stmt->execute();
                                $result = $stmt->get_result();
                                if($result->num_rows > 0){
                                    $id = 1;
                                    while($row = $result->fetch_assoc()){
                                        $_SESSION['brid']   = $row['brid'];
                                        $rname = $row['r_name'];
                                        $remail = $row['r_email'];
                                        $rcity = $row['r_city'];
                                        $rmobile = $row['r_phone'];
                                        $bg = $row['bg'];
                                        $status = $row['status'];

                                        echo '<tr>';

                                        echo '<th scope="row">'.$id.'</th>';
                                        echo '<td>'.$rname.'</td>';
                                        echo '<td>'.$remail.'</td>';
                                        echo '<td>'.$rcity.'</td>';
                                        echo '<td>'.$rmobile.'</td>';
                                        echo '<td>'.$bg.'</td>';
                                        //status
                                        echo '<td> you have '.$status.'</td>';

                                        // add accecpt and delete button
                        
                                        echo '<td>';
                                        // accept function
                                       if($status == 'Accepted'){
                                        echo '<a href="#" class="btn btn-success disabled">Accepted</a>&nbsp';
                                       }
                                       else{
                                        echo '<a href="files/accept.php" class="btn btn-success">Accept</a>&nbsp';
                                       }
                                       // reject function

                                       if($status == 'Rejected'){
                                        echo '<a href="#" class="btn btn-danger disabled">Rejected</a>&nbsp';
                                       }
                                       else{
                                        echo '<a href="files/reject.php" class="btn btn-danger">Reject</a>&nbsp';
                                       }


                                        echo '</td>';
                                        echo '</tr>';
                                        $id++;
                                    }

                                }else{
                                    echo '<b style="color:white;background-color:red;padding:7px;border-radius: 15px 50px;">Nothing to show.</b>';
                                }
                            }
                                ?>

                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </body>
</html>