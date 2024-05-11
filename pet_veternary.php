<?php

$servername = 'localhost';
$username = 'root';
$password ='tiger';
$dbname = 'output';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$pet_id="";
$pet_name="";
$color="";
$gender="";
$breed="";
$hospital_name="";
$consulted_doctor="";
$issue="";
$fee="";


$errorMessage="";
$successMessage="";

if($_SERVER['REQUEST_METHOD']=='GET'){
    if(!isset($_GET["pet_id"])){
        header("location: pet_display_edit.php");
        exit;
    }

    $pet_id=$_GET["pet_id"];
    $sql="SELECT * from pet where pet_id=$pet_id";
    $p_res=$conn->query($sql);
    $row=$p_res->fetch_assoc();

    if(!$row){
        header("location: pet_display_edit.php");
        exit;
    }
    $pet_id=$row["pet_id"];
    $pet_name=$row["pet_name"];
    $breed=$row["breed"];
    $gender=$row["gender"];
    $color=$row["color"]; 

}



if($_SERVER['REQUEST_METHOD']=='POST'){
    $hospital_name=$_POST["hospital_name"];
    $consulted_doctor=$_POST["consulted_doctor"];
    $issue=$_POST["issue"];
    $fee=$_POST["fee"];
    $v_date=$_POST['v_date'];

    do{ 
        if(empty($hospital_name) || empty($consulted_doctor) || empty($issue) || empty($fee) ||empty($v_date)){
        $errorMessage="All fields are required";
        break;
        }

     
        
        if (isset($_POST['hospital_name']) && isset($_POST['consulted_doctor']) && isset($_POST['issue']) && isset($_POST['fee']) && isset($_POST['v_date']) ) {
            
            $hospital_name = $_POST['hospital_name'];
            $consulted_doctor = $_POST['consulted_doctor'];
            $issue = $_POST['issue'];
            $fee=$_POST['fee'];
            $v_date=$_POST['v_date'];

            $pet_id=$_GET['pet_id'];
            $successMessage="pet_id is".$pet_id;

            $v_Sql = "INSERT INTO veternary_care (pet_id, hospital_name, consulted_doctor, issue, fee, v_date) VALUES ('$pet_id', '$hospital_name', '$consulted_doctor', '$issue', '$fee', '$v_date') ";

            //check whether this person already exists
            if ($conn->query($v_Sql) === TRUE) {
                $successMessage="Veternary Care recorded successful!";
    
                header("location: pet_display_edit.php");
                exit;
             }
        }
          
    }while(false);
}
$conn->close();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <title>Pet Veterinary Record </title>
    <style>
</style>
</head>
<body>
    <div class="container my-5">
        
        <h2>Veterinary Care</h2>

        <form method="GET">
   
                <div class="row mb-3">
                   <div class="col-sm-6">
                   <input type="hidden" value="<?php echo $pet_id;?>">
                    </div>
                </div>
    
            <div class="row mb-3">
                   <label class="col-sm-3 col-form-label">Pet Name</label>
                   <div class="col-sm-6">
                    <input type="text" class="form-control" name="pet_name" value="<?php echo $pet_name;?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Breed</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="breed" value="<?php echo $breed;?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Color</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="color" value="<?php echo $color;?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Gender</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="gender" value="<?php echo $gender;?>">
                    </div>
                </div>

                <?php
                if(!empty($successMesssage))
                    echo "
                    <div class='row mb-3'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>"
                
                ?>

            </div>
        
    </form>

        <form method="post">
            
            <div class="row mb-3">
                   <label class="col-sm-3 col-form-label">Hospital Name</label>
                   <div class="col-sm-6">
                    <input type="text" class="form-control" name="hospital_name" value="<?php echo $hospital_name;?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Consulted Doctor</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="consulted_doctor" value="<?php echo $consulted_doctor;?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Issue</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="issue" value="<?php echo $issue;?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Fee</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="fee" value="<?php echo $fee;?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Date</label>
                    <div class="col-sm-6">
                        <input type="date" class="form-control" name="v_date" value="<?php echo $v_date;?>">
                    </div>
                </div>

                <?php
                if(!empty($successMesssage))
                    echo "
                    <div class='row mb-3'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>"
                
                ?>

                <div class="row mb-3">
                    <div class="offset-sm-3 col-sm-3 d-grid">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <div class="offset-sm-3 col-sm-3 d-grid">
                        <a class="btn btn-outline-primary" href="pet_display_edit.php" role="button">Cancel</a>
                    </div>
                </div>

            </div>
        
    </form>
    

            <?php
            if(!empty($errorMessage))   {
                echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$errorMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert'  aria='Close'></button>
                    
                </div>
                ";
            }         
            ?>
  </div>
</body>
</html>