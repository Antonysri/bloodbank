<?php 
session_start();
require 'files/connection.php';
    
    if(!isset($_SESSION['rid'])){

        header("location:login.php");
        exit;
    }


?>

<html>
    <head>
        <title>send_request</title>
        <?php require 'head.php';?>
    </head>
    <?php require 'header.php'; ?>
    <?php require 'message.php'; ?>
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

                                <tbody>
                                    <?php
                                    
                                    
                                    $sql = "SELECT * from blood_request";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    if($result->num_rows > 0){
                                        $id = 1;
                                        while($row = $result->fetch_assoc()){
                                            $hid   = $row['hid'];
                                            $hname = $row['hname'];
                                            $hemail = $row['hemail'];
                                            $hcity = $row['hcity'];
                                            $hmobile = $row['hmobile'];
                                            $bg = $row['bg'];
                                            $status = $row['status'];

                                            echo '<tr>';

                                            echo '<th scope="row">'.$id.'</th>';
                                            echo '<td>'.$hname.'</td>';
                                            echo '<td>'.$hemail.'</td>';
                                            echo '<td>'.$hcity.'</td>';
                                            echo '<td>'.$hmobile.'</td>';
                                            echo '<td>'.$bg.'</td>';
                                            

                                            //status 

                                            echo '<td>'.$status.' </td>';


                                            echo '<td>
                                            <form method="post" action="files/cancel.php">
                                            <input type="hidden" name="hid" value= "'.$hid.'">
                                            <button class="btn btn-danger" type="submit" name="cancel">Cancel</button>

                                            </form>
                                            
                                            </td>';

                                            echo '</tr>';
                                            $id++;
                                        }

                                    }else{
                                        echo '<b style="color:white;background-color:red;padding:7px;border-radius: 15px 50px;">Nothing to show.</b>';
                                    }
                                
                                    ?>
                               
                                </tbody>

                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    
</html>