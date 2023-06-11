<?php
session_start();
require 'files/connection.php';

if (!isset($_SESSION['hid']) || empty($_SESSION['hid'])) {
    header("location: login.php");
    exit;
}
?>

<html>
<head>
    <title>Add Blood Group</title>
    <?php require 'head.php'; ?>
</head>

<body>
    <?php require 'header.php'; ?>
    <?php require 'message.php'; ?>
<br>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-header">
                        <h2 class="font-weight-bold">Add Blood Group</h2>
                    </div>
                    <div class="card-body">
                        <br>
                        <form method="post" action="files/add_blood.php">
                            <input type="checkbox" required>&nbsp Agree<br><br>
                            <select class="form-select" name="bg">
                                <option disabled selected value="">Select Blood Group</option>
                                <option value="A-">A-</option>
                                <option value="A+">A+</option>
                                <option value="B-">B-</option>
                                <option value="B+">B+</option>
                                <option value="AB-">AB-</option>
                                <option value="AB+">AB+</option>
                                <option value="O-">O-</option>
                                <option value="O+">O+</option>
                            </select><br>
                            <div class="text-center">
                                <button type="submit" name="add" value="Add" class="btn btn-primary" >ADD</button><br>
                                <a style="text-decoration:none" href="abs.php">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h2 class="font-weight-bold">Blood Bank</h2>
                    </div>
                    <div class="card-body">
                        <!-- Blood bank table -->
                        <table class="table">
                            <thead>
                                <th scope='col'>#</th>
                                <th scope='col'>Blood Sample</th>
                                <th scope='col'>Action</th>
                            </thead>
                            <tbody>
                                <?php
                                // Populate the blood bank table here
                                $sql = "SELECT * from bloodinfo where hid = ?";
                                $stmt=$conn->prepare($sql);
                                $stmt->bind_param("i",$_SESSION['hid']);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $id     = 1;
                                
                                if($result->num_rows > 0){ 
                                        while($row = $result->fetch_assoc()){
                                        $_SESSION['bid']   = $row['bid'];
                                        $bg                = $row['bgroup']; 
                                        echo '<tr>';

                                        echo '<th scope="row">'.$id.'</th>';
                                        echo '<td>'.$bg.'</td>';
                                        //Delete button add
                                        echo '<td>
                                        <form method="post" action="files/delete.php">
                                        <button type = submit name = "delete" class="btn btn-danger">Delete</button>
                                        </form>
                                        </td>';

                                        echo '</tr>';

                                        $id++;
                                    }
                                }
                                else{ 
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

    
</body>
</html>
