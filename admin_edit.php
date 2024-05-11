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
$id="";
$name="";
$pwd="";
$job="";
$errorMessage="";
$successMessage="";

if($_SERVER['REQUEST_METHOD']=='GET'){
    if(!isset($_GET["id"])){
        header("location: admin_details_edit.php");
        exit;
    }

    $id=$_GET["id"];
    $sql="SELECT * from admin where id=$id";
    $p_res=$conn->query($sql);
    $row=$p_res->fetch_assoc();

    if(!$row){
        header("location: admin_details.php");
        exit;
    }
    $id=$row["id"];
    $name=$row["name"];
    $job=$row["job"];
    $pwd=$row["pwd"]; 

}else{
    //POST method to update data
    $id=$_POST["id"];
    $name=$_POST["name"];
    $job=$_POST["job"];
    $pwd=$_POST["pwd"]; 

    do{
        if(empty($id) || empty($name) || empty($job) || empty($pwd)){
            $errorMessage="All fields are required";
            break;
        }
        $sql="UPDATE admin set  name='$name', job='$job', pwd='$pwd' where id='$id' ";
        $res=$conn->query($sql);
        if(!$res){
            $errorMessage="Invalid query: ". $conn->error;
            break;
        }

        $successMessage="Employee details updated successfully";
        header("location: admin_details.php");
        exit;
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
    <title>EmployeeDetails</title>
    <style>
</style>
</head>
<body>
    <div class="container my-5">
        
        <h2>Adoption Form</h2>

        <form method="post">

                <div class="row mb-3">
                   <label class="col-sm-3 col-form-label">Employee id</label>
                   <div class="col-sm-6">
                    <input type="text" class="form-control" name="id" value="<?php echo $id;?>">
                    </div>
                </div>

            <div class="row mb-3">
                   <label class="col-sm-3 col-form-label">Employee Name</label>
                   <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name;?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">pwd</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="pwd" value="<?php echo $pwd;?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">job</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="job" value="<?php echo $job;?>">
                    </div>
                </div>

                

                <div class="offset-sm-3 col-sm-3 d-grid">
                        <button type="submit" class="btn btn-primary">Submit</button>
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