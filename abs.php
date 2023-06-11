    <?php 
    session_start();
    require 'files/connection.php';
    if(!isset($_SESSION['hid']) && !isset($_SESSION['rid'])){
        header("location:login.php");
        exit;
   }
       ?>
        
        <html>
            <head>
                <title>abs</title>
                <?php require 'head.php'; ?>
                <script>
                    function requestFun(){
                        alert("hospital user can't provide request");
                    }
                </script>
              
            </head>
        <body>
        <?php require 'header.php'; ?>
        <?php require 'message.php';?>

        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="font-weight-bold text-muted">Available Blood Samples</h2>
                        </div>
                    <div class="card-body">
                         <!-- search -->
                        
                         <form action="" method="get" class="d-flex">
                            <div class="input-group me-2">
                                <select class="form-select" name="search" style="max-width: 200px;">
                                    <option selected disabled>Search blood group</option>
                                    <option value="A+"  >A+</option>
                                    <option value="B+"  >B+</option>
                                    <option value="AB+" >AB+</option>
                                    <option value="O+"  >O+</option>
                                    <option value="A-"  >A-</option>
                                    <option value="B-"  >B-</option>
                                    <option value="AB-" >AB-</option>
                                    <option value="O-"  >O-</option>
                                </select>
                            </div>
                            <button  class="btn btn-info" type="submit">Search</button>&nbsp
                            <button style="margin-right: 580;"class="btn btn-info">Reset</button>
                        
                        </form>


                            <!-- table -->
                            <table class="table table-striped table-responsive">
                                <thead>
                                    <th scope ="col">#</th>
                                    <th scope ="col">Hospital Name</th>
                                    <th scope ="col">Hospital City</th>
                                    <th scope ="col">Hospital Email</th>
                                    <th scope ="col">Hospital Phone</th>
                                    <th scope ="col">Blood Group</th>
                                    <th scope ="col">Action</th>
                                </thead>
                                <tbody>
                                <?php
                                if(isset($_GET['search'])){
                                    $searchWord = $_GET['search'];
                                    $sql = "SELECT * from hospitals INNER JOIN bloodinfo on hospitals.hid = bloodinfo.hid where bgroup = ?";
                                    $stmt=$conn->prepare($sql);
                                    $stmt->bind_param("s",$searchWord);
                                }
                               
                                
                                else{
                           
                                    $sql = "SELECT * from hospitals INNER JOIN bloodinfo on hospitals.hid = bloodinfo.hid";
                                    $stmt = $conn->prepare($sql);
                                    }

                                          
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $id = 1;
                                        if($result->num_rows > 0){
                                            while($row = $result->fetch_assoc()){
                                                $hid            = $row['hid'];
                                                $hname          = htmlspecialchars($row['h_name'],ENT_QUOTES,'UTF-8');
                                                $hcity          = htmlspecialchars($row['h_city'],ENT_QUOTES,'UTF-8');
                                                $hemail         = htmlspecialchars($row['h_email'],ENT_QUOTES,'UTF-8');
                                                $hmobile        = htmlspecialchars($row['h_mobile'],ENT_QUOTES,'UTF-8');
                                                $bg             = htmlspecialchars($row['bgroup'],ENT_QUOTES,'UTF-8');
                                                

                                                echo '<tr>';
                                                echo '<th>'.$id.'</th>';
                                                echo '<td>'.$hname.'</td>';
                                                echo '<td>'.$hcity.'</td>';
                                                echo '<td>'.$hemail.'</td>';
                                                echo '<td>'.$hmobile.'</td>';
                                                
                                                //blood group add
                                                echo '<td>'.$bg.'</td>';

                                                //Action add (REQUEST SAMPLE)
                                                if(isset($_SESSION['hid'])){
                                                echo '<td>
                                                
                                                <form method="POST" action="">
                                                    <button type="submit" class ="btn btn-success" onclick="requestFun()" >Request sample</button>
                                                </form>
                                                
                                                <td>';
                                                }
                                                elseif(isset($_SESSION['rid'])){
                                                    echo '<td>';
                                                    echo '<form method="POST" action="files/request.php">';
                                                    echo '<input type="hidden" name="hid" value="' . $hid . '">';
                                                
                                                    echo '<input type="hidden" name="hname" value="' . $hname . '">';
                                                    echo '<input type="hidden" name="hemail" value="' . $hemail . '">';
                                                    echo '<input type="hidden" name="hcity" value="' . $hcity . '">';
                                                    echo '<input type="hidden" name="hmobile" value="' . $hmobile . '">';
                                                    echo '<input type="hidden" name="bg" value="' . $bg . '">';
                                                    echo '<button type="submit" class="btn btn-success">Request sample</button>';
                                                    echo '</form>';
                                                    echo '</td>';
                                                    
                                                }

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
        </div>

        </body>
        </html>
        
        
        
     







