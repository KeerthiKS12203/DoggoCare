


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <title>Veternary Details</title>
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
    table{
      max-width: 800px;
      margin: 2rem auto;
      padding: 2rem;
      background-color: #fff;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
      width:100%;
    }
    
    tbody.tr{
      background-color:rgb(184, 218, 222);
      padding: 0.5rem;
      border: 1px solid #ccc;
      border-radius: 5px;
      margin-bottom: 1rem;

    }
    thead{
      background-color:rgb(161, 229, 236);
      padding: 0.7rem;
      border: 2px solid #ccc;
      border-radius: 5px;
      margin-bottom: 2rem;
    }
    </style>
</head>
<body>
    <div class="container my-5" style="font-family: Arial, sans-serif; font-size: xx-large; text-align: center;">
        VETERNARY DETAILS
  </div>
    <div class="container" style="align">
    <a class='btn btn-primary btn-sm'  href='adminHomePage.html'  > Back </a>
    <table cellspacing="20" cellpadding="5" style="background-color:; font-size:12; align-items: center; align-self: center;">
      <thead>
        
          <th>VID</th>
          <th>pet_id</th>
          <th>Hospital Name</th>
          <th>Consulted Doctor</th>
          <th>Issue</th>
          <th>Fee</th>
          <th></th>
        </tr>
      </thead>
      <tbody><tr>
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

          $searchSql = "SELECT vid, pet_id, hospital_name, consulted_doctor, issue,fee from veternary_care"; 
          $result=$conn->query($searchSql);

              if(!$result){
                die("Invalid query: ".$conn->error);
              }

              while ($row = $result->fetch_assoc()) {
                echo "
                <tr>
                  <td>$row[vid]</td>
                  <td>$row[pet_id]</td>
                  <td>$row[hospital_name]</td>
                  <td>$row[consulted_doctor]</td>
                  <td>$row[issue]</td>
                  <td>$row[fee]</td>
                  
                  
                </tr>
                ";
              }
        
        ?>
    </div>
</body>
</html>

