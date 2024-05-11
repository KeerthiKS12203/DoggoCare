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
$date_in="";
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
    $date_in=$row["date_in"];

}else{
    //POST method to update data
    $pet_id=$_POST["pet_id"];
    $pet_name=$_POST["pet_name"];
    $breed=$_POST["breed"];
    $gender=$_POST["gender"];
    $color=$_POST["color"]; 
    $date_in=$_POST["date_in"];

    do{
        if(empty($pet_id) || empty($pet_name) || empty($gender) || empty($color) || empty($date_in)){
            $errorMessage="All fields are required";
            break;
        }
        if($breed=="breed"){
            $errorMessage="Select Breed";
            break;
        }
        $sql="UPDATE pet set  pet_name='$pet_name', gender='$gender', breed='$breed', color='$color', date_in='$date_in' where pet_id='$pet_id' ";
        $res=$conn->query($sql);
        if(!$res){
            $errorMessage="Invalid query: ". $conn->error;
            break;
        }

        $successMessage="Pet details updated successfully";
        header("location: pet_display_edit.php");
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
    <title>Edit Pet Details</title>
    <style>
</style>
</head>
<body>
    <div class="container my-5">
        
        <h2>Edit Pet Details</h2>

        <form method="post">
    <input type="hidden" name="pet_id" value="<?php echo $pet_id;?>">
            <div class="row mb-3">
                   <label class="col-sm-3 col-form-label">Pet Name</label>
                   <div class="col-sm-6">
                    <input type="text" class="form-control" name="pet_name" value="<?php echo $pet_name;?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Breed</label>
                    <div class="col-sm-6">
                        <select name="breed" class="form-control" value="<?php echo $breed;?>">
                            <option value="breed" size="15">Breed</option>
                            <option value="unknown">Unkown</option>
                            <option value="Indian Pariah Dog">Indian Pariah Dog</option>
                            <option value="Indian Spitz">Indian Spitz</option>
                            <option value="Golden Retriever">Golden Retriever</option>
                            <option value="Labrador">Labrador</option>
                            <option value="Combai">Combai</option>
                            <option value="Chippiparai">Chippiparai(Kanni)</option>
                            <option value="Rajapalyam">Rajapalyam</option>
                            <option value="Rampur Hound">Rampur Hound</option>
                            <option value="Rottweiler">Rottweiler</option>
                            <option value="German Shepherd">German Shepherd</option>
                            <option value="Beagle">Beagle</option>
                            <option value="Pug">Pug</option>
                            <option value="Pomeranian">Pomeranian</option>
                            <option value="Doberman">Doberman</option>
                        </select>
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

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Date IN</label>
                    <div class="col-sm-6">
                        <input type="date" class="form-control" name="date_in" value="<?php echo $date_in;?>">
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