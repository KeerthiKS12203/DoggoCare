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
$p_name="";
$color="";
$gender="";
$breed="";
$name="";
$phone="";
$address="";


$errorMessage="";
$successMessage="";

if($_SERVER['REQUEST_METHOD']=='GET'){
    if(!isset($_GET["pet_id"])){
        header("location: adoption.php");
        exit;
    }

    $pet_id=$_GET["pet_id"];
    $sql="SELECT * from pet where pet_id=$pet_id";
    $p_res=$conn->query($sql);
    $row=$p_res->fetch_assoc();

    if(!$row){
        header("location: adoption.php");
        exit;
    }
    $pid=$row["pet_id"];
    $p_name=$row["pet_name"];
    $breed=$row["breed"];
    $gender=$row["gender"];
    $color=$row["color"]; 

}



if($_SERVER['REQUEST_METHOD']=='POST'){

    $name=$_POST["name"];
    $phone=$_POST["phone"];
    $address=$_POST["address"];

    do{ 
        if(empty($name) || empty($phone) || empty($address)){
        $errorMessage="All fields are required";
        break;
        }

     
        
        if (isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['address']) ) {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];

            //check whether this person already exists
             $habitueSql = "SELECT hid from  habitue where lower(h_name) like lower('$name') and h_phno='$phone' and lower(h_address) like lower('$address')";
             if($conn->query($habitueSql)){
              $res=$conn->query($habitueSql);
              
              $number=mysqli_num_rows($res);
              if(!$number){
                      $h_Sql = "INSERT INTO habitue (h_name, h_phno, h_address) VALUES ('$name', '$phone', '$address')";
                      if ($conn->query($h_Sql) === TRUE) {
                          $fetch_hid="SELECT LAST_INSERT_ID() FROM habitue";
                          $hid=$conn->query($fetch_hid);
                          $hid = $hid->fetch_array();
                          $hid2 = intval($hid[0]);
                          echo $hid2;
                      }
              }
              else{
                  while($row = mysqli_fetch_assoc($res))
                  {
                      echo "hid:" .$row["hid"]. "<br>";
                      $hid2=$row["hid"];
                  }
              }
             }
          } 
          $pid=intval($_GET["pet_id"]);
          echo $pid, $hid2;
          $rescuesql = "INSERT INTO pet_adoption (hid, pet_id) VALUES ('$hid2','$pid')";
          if ($conn->query($rescuesql) == TRUE) {
              $name="";
              $phone="";
              $address="";
      
          
    
            $successMessage="Adoption successful! You will be contacted soon";
    
              header("location: homePage.html");
              exit;
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
    <title>Pet Adoption Owner Details</title>
    <style>
</style>
</head>
<body>
    <div class="container my-5">
        
        <h2>Adoption Form</h2>

        <form method="get">
    <input type="hidden" value="<?php echo $pet_id;?>">
            <div class="row mb-3">
                   <label class="col-sm-3 col-form-label">Pet Name</label>
                   <div class="col-sm-6">
                    <input type="text" class="form-control" name="p_name" value="<?php echo $p_name;?>">
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
            <h2>Your details</h2>
            
            <div class="row mb-3">
                   <label class="col-sm-3 col-form-label">Name</label>
                   <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name;?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Phone number</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="phone" value="<?php echo $phone;?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Address</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="address" value="<?php echo $address;?>">
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
                        <a class="btn btn-outline-primary" href="/dbms/adoption.php" role="button">Cancel</a>
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

        
    
    <div class="container">
            <h2>Make a Donation</h2>
            <p>Would you like to make a donation to support pet rescue and care?</p>
        <a href="donation.php">Donate Now</a></div>
  </div>
</body>
</html>