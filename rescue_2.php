<!DOCTYPE html>
<html lang="en">
<head>
  <!-- ... your existing meta tags and styles ... -->
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f5f5f5;
      
    }
    .container {
      max-width: 800px;
      margin: 2rem auto;
      padding: 2rem;
      background-color: #fff;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
    }
    </style>
</head>
<body>
  <div class="container">
    <!-- ... your existing Habitue Details form ... -->

    
    <div class="container">
  <?php
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

      // Handle Habitue Details form submission
      if (isset($_POST['habitueName']) && isset($_POST['habituePhone']) && isset($_POST['habitueAddress'])) {
        $habitueName = $_POST['habitueName'];
        $habituePhone = $_POST['habituePhone'];
        $habitueAddress = $_POST['habitueAddress'];

// Insert Habitue Details into the database      
           $habitueSql = "SELECT hid from  habitue where lower(h_name) like lower('$habitueName') and h_phno='$habituePhone' and lower(h_address) like lower('$habitueAddress')";
             if($conn->query($habitueSql)){
              $res=$conn->query($habitueSql);
              
              $number=mysqli_num_rows($res);
              if(!$number){
                      $h_Sql = "INSERT INTO habitue (h_name, h_phno, h_address) VALUES ('$habitueName', '$habituePhone', '$habitueAddress')";
                      if ($conn->query($h_Sql) === TRUE) {
                          $fetch_hid="SELECT LAST_INSERT_ID() FROM habitue";
                          $hid=$conn->query($fetch_hid);
                          $hid = $hid->fetch_array();
                          $hid2 = intval($hid[0]);
                          
                      }
              }
              else{
                  echo "We have met before and your data already exists";
                  while($row = mysqli_fetch_assoc($res))
                  {
                      $hid2=$row["hid"];
                  }
              }
             }

           
          }

      // Handle Pet Details form submission
      if (isset($_POST['breed']) && isset($_POST['petGender']) && isset($_POST['petColor']) ) {
        $breed = $_POST['breed'];
        $petGender = $_POST['petGender'];
        $petColor = $_POST['petColor'];
      }           

        // Insert Pet Details into the database
        $petSql = "INSERT INTO pet (breed,gender, color) VALUES ('$breed','$petGender', '$petColor')";
        if ($conn->query($petSql) === TRUE) {
          $fetch_pet_id="SELECT LAST_INSERT_ID() FROM pet";
          $pet_id=$conn->query($fetch_pet_id);
          $pet_id = $pet_id->fetch_array();
          $pet_id2 = intval($pet_id[0]);


        } else {
          echo "Error inserting Pet Details: " . $conn->error . "<br>";
        }
      

      if(isset($_POST['petLocation']) && isset($_POST['petDescription'])){
      $petLocation = $_POST['petLocation'];
      $petDescription = $_POST['petDescription'];
      }
      
      if (isset($_POST['petLocation']) && isset($_POST['petDescription']))  {
        $petLocation = $_POST['petLocation'];
        $petDescription = $_POST['petDescription'];       

        // Insert Pet Details into the database
        $rescuesql = "INSERT INTO rescue (hid, pet_id, rescue_loc,rescue_desc ) VALUES ('$hid2','$pet_id2', '$petLocation', '$petDescription')";
        if ($conn->query($rescuesql) === TRUE) {
          echo "Rescue Details stored successfully<br>";
        } else {
          echo "Error inserting Rescue Details: " . $conn->error . "<br>";
        }
      }


      $conn->close();
    }
  ?>
  </div>
  <div class="container" >
    <p>We highly appretiate you for your initiative.</p>
    <br>
    <p> Our team will reach out to you in a few minutes.</p>
  </div class="container">
  <a class="btn btn-outline-primary" href="homePage.html" role="button">Back</a>
  </div>


  </div>
</body>
</html>